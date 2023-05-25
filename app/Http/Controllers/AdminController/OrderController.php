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

    public function order_list_page($page)
    {
        if ($page == 'all') {
            $orders = Orders::all()->count();
            $page = $orders;
        }

        $orders = Orders::orderByDesc('id')->paginate($page);
        $count = 1;
        $search_text = '';
        return view(
            'adminfrontend.pages.orders.order_list',
            compact(
                'count',
                'orders',
                'search_text',
                'page'
            )
        );
        //return dd($orders);
    }
    public function order_search()
    {
        $search_text = $_GET['search_order'];
        if ($search_text == '') {
            return redirect()->back()->with('alert', 'Please fill order code to search !');
        }
        $orders = Orders::where('invoice_code', 'LIKE', '%' . $search_text . '%')->get();
        $count = 1;
        $page = $orders->count();
        return view(
            'adminfrontend.pages.orders.order_list',
            compact(
                'orders',
                'count',
                'search_text',
                'page',
            )

        );
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
    public function order_status_action($orderId, $statusId)
    {
        $orderStatus = Orders::where('id', $orderId)->first();
        $orderStatus['order_status'] = $statusId;
        $orderStatus->update();
        if ($statusId == 3) {
            $deliveryFee = $orderStatus->delivery_fee;
            $discount = $orderStatus->discount;
            $totalAmount = 0;
            $total = 0;
            $orderDetails = Orders_Details::where('order_id', $orderStatus->id)->get();
            foreach ($orderDetails as  $orderDetail) {
                $price = $orderDetail->product_price;
                $qty = $orderDetail->product_quantity;
                $totalAmount += $price * $qty;
            }
            $total = $totalAmount + $deliveryFee - $discount;
            $orderStatus['total_paid'] = $total;
            $orderStatus->update();
        }

        // ==== If order is cancenled, update product size quantity
        if ($statusId == 4) {
            $order_details = Orders_Details::where('order_id', $orderId)->get();
            foreach ($order_details as $order_detail) {
                $productSize = Products_Sizes::where('product_id', $order_detail->product_id)
                    ->where('size_id', $order_detail->size_id)->first();
                $order_qty = $order_detail->product_quantity;
                $size_qty = $productSize->size_quantity;
                $productSize->size_quantity = $size_qty + $order_qty;
                $productSize->update();
            }
            //return dd($order_details->toArray());
        }

        return redirect()->back()
            ->with('message', 'Order with invoice code ' . $orderStatus->invoice_code  . ' updated status successfully !');
    }

    public function order_delete($id)
    {
        $delete_order = Orders::where('id', $id)->first();
        $delete_order->delete();

        return redirect('/admin/order-list')
            ->with(
                'message',
                'Order ' . '"' . $delete_order->invoice_code . '"' .
                    ' is deleted successfully !'
            );
    }
}
