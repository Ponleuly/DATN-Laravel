<?php

namespace App\Http\Controllers\AdminController;

use App\Models\Orders;
use App\Models\Invoices;
use App\Models\Customers;
use Illuminate\Http\Request;
use App\Models\Orders_Details;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\Products_Sizes;
use App\Models\Contacts;
use App\Models\Settings;

class OrderController extends Controller
{

    public function order_list_page($res, $title, $sort)
    {
        if ($res == 'all') {
            $orders = Orders::all()->count();
            $res = $orders;
        }
        if ($title == 'code') {
            $orders = Orders::orderBy('id', $sort)->paginate($res);
        } else if ($title == 'totalpaid') {
            $orders = Orders::orderBy('total_paid', $sort)->paginate($res);
        }elseif($title == 'date'){
            $orders = Orders::orderBy('created_at', $sort)->paginate($res);
        }elseif($title == 'customer'){
        /*
            $orders = Customers::join('orders', 'orders.id', '=', 'customers.order_id')
            ->orderBy('customers.c_name', $sort)
            ->paginate($res,['orders.*','customers.c_name']); // get orders table with column c_name 
        */   
            //==== Join orders table and customers table by order_id 
            // then sort join_table by c_name with 'asc' or 'desc'
            // then get orders table that sorted by c_name with paginate =====//
            $orders = Orders::join('customers', 'customers.order_id', '=', 'orders.id')
            ->orderBy('customers.c_name', $sort)
            ->paginate($res,['orders.*']);
        }elseif($title == 'payment'){
            $orders = Orders::orderBy('payment_method', $sort)->paginate($res);
        }elseif($title == 'status'){
            $orders = Orders::where('order_status', $sort)->paginate($res);
        }
        $search_text = '';
        return view(
            'adminfrontend.pages.orders.order_list',
            compact(
                'orders',
                'search_text',
                'res',
                'title',
                'sort'
            )

        );
    }

    public function order_search($res, $title, $sort)
    {
        $search_text = $_GET['search_order'];
        if ($search_text == '') {
            return redirect()->back()->with('alert', 'Please fill order code to search !');
        }
        $orders = Orders::where('invoice_code', 'LIKE', '%' . $search_text . '%')->get();
       
        return view(
            'adminfrontend.pages.orders.order_list',
            compact(
                'orders',
                'search_text',
                'res',
                'title',
                'sort'
            )

        );
        
        return dd($orders->toArray());
    }
    //======  Order Details =======//
    public function order_details($id)
    {
        $order = Orders::where('id', $id)->first();
        $customer = Customers::where('id', $order->id)->first();
        $orderDetails = Orders_Details::where('order_id', $id)->get();
        $count = 1;
        $contacts = Contacts::orderBy('id')->get();
        $shopName = Settings::all()->first();

        return view(
            'adminfrontend.pages.orders.order_details',
            compact(
                'count',
                'order',
                'customer',
                'orderDetails',
                'contacts',
                'shopName'
            )
        );
    }


    public function order_invoice($id)
    {
        $order = Orders::where('id', $id)->first();
        $customer = Customers::where('id', $order->customer_id)->first();
        $orderDetails = Orders_Details::where('order_id', $id)->get();
        $count = 1;
        $contacts = Contacts::orderBy('id')->get();
        $shopName = Settings::all()->first();

        return view(
            'adminfrontend.pages.orders.order_invoice',
            compact(
                'count',
                'order',
                'customer',
                'orderDetails',
                'contacts',
                'shopName'
            )
        );
    }


    public function download_invoice($id)
    {
        $order = Orders::where('id', $id)->first();
        $customer = Customers::where('id', $order->id)->first();
        $orderDetails = Orders_Details::where('order_id', $id)->get();
        $count = 1;
        $contacts = Contacts::orderBy('id')->get();
        $shopName = Settings::all()->first();
        $data = [
            'count' => $count,
            'order' =>  $order,
            'customer' => $customer,
            'orderDetails' => $orderDetails,
            'contacts' => $contacts,
            'shopName' => $shopName,
        ];
        $pdf = Pdf::loadView('adminfrontend.pages.orders.order_invoice', $data);

        return $pdf->download($order->invoice_code . '.pdf');
    }


    //============= Update invoice status ============//
    public function order_status_action($orderId, $statusName)
    {
        $orderStatus = Orders::where('id', $orderId)->first();
        $orderStatus['order_status'] = ucfirst($statusName);
        $orderStatus->update();
        if (ucfirst($statusName) == 'Delivered') {
            $deliveryFee = $orderStatus->delivery_fee;
            $discount = $orderStatus->discount;
            $totalAmount = 0;
            $total = 0;
            $orderDetails = Orders_Details::where('order_id', $orderStatus->id)->get();
            foreach ($orderDetails as  $orderDetail) {
                $price = $orderDetail->product_price;
                $qty = $orderDetail->product_quantity;
                $totalAmount += $price * $qty;
                
                /*
                //===== update product size quantity ======//
                $proId = $orderDetail->product_id;
                $sizeId = $orderDetail->size_id;
                $pro_size_qty = Products_Sizes::where('product_id', $proId)
                ->where('size_id', $sizeId)->first();
                $pro_size_qty->size_quantity -= $orderDetail->product_quantity;
                $pro_size_qty->update();
                */
            }
            $total = $totalAmount + $deliveryFee - $discount;
            $orderStatus['total_paid'] = $total;
            $orderStatus->update();
        }

        // ==== If order is cancenled, update product size quantity
        if (ucfirst($statusName) == 'Canceled') {
            $order_details = Orders_Details::where('order_id', $orderId)->get();
            foreach ($order_details as $order_detail) {
                $productSize = Products_Sizes::where('product_id', $order_detail->product_id)
                    ->where('size_id', $order_detail->size_id)->first();
                $order_qty = $order_detail->product_quantity;
                $size_qty = $productSize->size_quantity;
                $productSize->size_quantity = $size_qty + $order_qty;
                $productSize->update();

            }
        }

        return redirect()->back()
            ->with('message', 'Order with invoice code ' . $orderStatus->invoice_code  . ' updated status successfully !');
    }

    public function order_delete($id)
    {
        $delete_order = Orders::where('id', $id)->first();
        $delete_order->delete();

        return redirect('admin/order-list/show=10/by-code=desc')
            ->with(
                'message',
                'Order ' . '"' . $delete_order->invoice_code . '"' .
                    ' is deleted successfully !'
            );
    }
    
    //===== update product size quantity plus ======//
    public function pro_qty_plus($orderId){
        $order = Orders::where('id', $orderId)->first();
        $order_details = Orders_Details::where('order_id', $order->id)->get();
            foreach ($order_details as  $order_detail) {
                $proId = $order_detail->product_id;
                $sizeId = $order_detail->size_id;
                $pro_size_qty = Products_Sizes::where('product_id', $proId)
                                ->where('size_id', $sizeId)->first();
                $pro_size_qty->size_quantity += $order_detail->product_quantity;
                $pro_size_qty->update();
            }
    }

    //===== update product size quantity sub ======//
    public function pro_qty_sub($orderId){
        $order = Orders::where('id', $orderId)->first();
        $order_details = Orders_Details::where('order_id', $orderId)->get();
        foreach ($order_details as $order_detail) {
            $proId = $order_detail->product_id;
            $sizeId = $order_detail->size_id;
            $pro_size_qty = Products_Sizes::where('product_id', $proId)
                            ->where('size_id', $sizeId)->first();
            $pro_size_qty->size_quantity -= $order_detail->product_quantity;
            $pro_size_qty->update();

        }
    }
}
