<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\Subscribers;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function customer_list()
    {
        $customers = Customers::orderBy('id')->paginate(8);
        $count = 1;
        $search_text = '';
        return view(
            'adminfrontend.pages.customers.customer_list',
            compact(
                'customers',
                'count',
                'search_text'
            )

        );
    }
    public function customer_edit($id)
    {
        $customer = Customers::where('id', $id)->first();
        return view(
            'adminfrontend.pages.customers.customer_edit',
            compact(
                'customer',
            )

        );
    }
    public function customer_update(Request $request, $id)
    {
        $update_customer = Customers::where('id', $id)->first();
        $update_customer->c_name = $request->input('c_name');
        $update_customer->c_phone = $request->input('c_phone');
        $update_customer->c_email = $request->input('c_email');
        $update_customer->c_address = $request->input('c_address');
        $update_customer->update();
        return redirect('admin/customer-list')
            ->with('message', 'Customer details updated successfully !');


        //return dd($request->toArray());
    }
    public function customer_search()
    {
        $search_text = $_GET['search_customer'];
        $customers = Customers::where('c_name', 'LIKE', '%' . $search_text . '%')->get();
        $count = 1;
        return view(
            'adminfrontend.pages.customers.customer_list',
            compact(
                'customers',
                'count',
                'search_text'
            )

        );
    }


    public function customer_delete($id)
    {
        $customer = Customers::where('id', $id)->first();
        $customer->delete();
        return redirect()->back()
            ->with('message', 'Customer name : ' . $customer->c_name . ' is deleted successfully!');
    }


    public function member_list()
    {
        $members = User::orderBy('id')->where('role', 1)->paginate(8);
        $count = 1;
        $search_text = '';
        return view(
            'adminfrontend.pages.customers.member_list',
            compact(
                'members',
                'count',
                'search_text'
            )

        );
    }
    public function member_search()
    {
        $search_text = $_GET['search_member'];
        $members = User::where('name', 'LIKE', '%' . $search_text . '%')->get();
        $count = 1;
        return view(
            'adminfrontend.pages.customers.member_list',
            compact(
                'members',
                'count',
                'search_text'
            )

        );
    }
    public function member_delete($id)
    {
        $member = User::where('id', $id)->first();
        $member->delete();
        return redirect()->back()
            ->with('message', 'Member name : ' . $member->name . ' is deleted successfully!');
    }



    public function subscriber_list()
    {
        $subscribers = Subscribers::orderByDesc('id')->paginate(8);
        $count = 1;
        $search_text = '';
        return view(
            'adminfrontend.pages.customers.subscriber_list',
            compact(
                'subscribers',
                'count',
                'search_text'
            )

        );
    }
    public function subscriber_search()
    {
        $search_text = $_GET['search_subscriber'];
        $subscribers = Subscribers::where('s_name', 'LIKE', '%' . $search_text . '%')->get();
        $count = 1;
        return view(
            'adminfrontend.pages.customers.subscriber_list',
            compact(
                'subscribers',
                'count',
                'search_text'
            )

        );
    }
    public function subscriber_delete($id)
    {
        $subscriber = Subscribers::where('id', $id)->first();
        $subscriber->delete();
        return redirect()->back()
            ->with('message', 'Subscriber name : ' . $subscriber->s_name . ' is deleted successfully!');
    }
}
