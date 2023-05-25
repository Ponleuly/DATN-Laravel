<?php

namespace App\Http\Controllers\AdminController;

use App\Models\Orders;
use Illuminate\Http\Request;
use App\Models\Orders_Statuses;
use App\Http\Controllers\Controller;

class OrderStatusController extends Controller
{

    public function order_status_list()
    {
        $statuses = Orders_Statuses::orderBy('id')->get();
        $count = 1;
        $search_text = '';
        return view(
            'adminfrontend.pages.order_statuses.status_list',
            compact(
                'count',
                'statuses',
                'search_text'
            )
        );
    }

    public function order_status_search()
    {
        $search_text = $_GET['search_order_status'];
        $statuses = Orders_Statuses::where('status', 'LIKE', '%' . $search_text . '%')->get();
        $count = 1;
        return view(
            'adminfrontend.pages.order_statuses.status_list',
            compact(
                'count',
                'statuses',
                'search_text'
            )
        );
    }


    public function order_status_add()
    {
        return view('adminfrontend.pages.order_statuses.status_add');
    }


    public function order_status_store(Request $request)
    {
        $statusAll = Orders_Statuses::all();
        foreach ($statusAll as $status) {
            if (ucfirst($request->status) == ucfirst($status->status)) {
                return redirect('admin/order-status-add')
                    ->with('alert', 'Order status ' . '"' . ucfirst($status->status) . '"' . ' already existed !');
            }
        }
        $input  = $request->all();
        Orders_Statuses::create($input);
        // After inputed -> go back to category page
        return redirect('admin/order-status-add')
            ->with('message', 'Order status option ' . $request->status . ' is added successfully!');
        //return dd($request->toArray());
    }


    public function order_status_edit($id)
    {
        $order_status = Orders_Statuses::where('id', $id)->first();
        return view(
            'adminfrontend.pages.order_statuses.status_edit',
            compact(
                'order_status'
            )
        );
    }


    public function order_status_update(Request $request, $id)
    {
        $update_order_status = Orders_Statuses::where('id', $id)->first();
        $update_order_status->status = $request->input('status');
        $update_order_status->status_color = $request->input('status_color');
        $update_order_status->update();

        return redirect('/admin/order-status-list')
            ->with(
                'message',
                'Order status option ' . '"' . $update_order_status->status . '"' .
                    ' is updated successfully !'
            );
    }


    public function order_status_delete($id)
    {
        $delete_status = Orders_Statuses::where('id', $id)->first();
        $delete_status->delete();

        return redirect('admin/order-status-list')
            ->with(
                'message',
                'Order status option ' . '"' . $delete_status->status . '"' .
                    ' is deleted successfully !'
            );
    }
}
