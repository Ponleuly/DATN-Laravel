<?php

namespace App\Http\Controllers\AdminController;

use App\Models\User;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\Orders_Details;
use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\Subscribers;
use Illuminate\Support\Facades\Auth;

class AdminFrontendController extends Controller
{
    public function dashboard()
    {
        $newOrder = Orders::where('order_status', 1)->count();
        $totalOrder = Orders::all()->count();
        $orders = Orders::where('order_status', 3)->get();
        $totalIncome = 0;
        $totalProduct = Products::all()->count();
        $totalMember = User::all()->count();
        $totalCustomer = Customers::all()->count();
        $totalSubscriber = Subscribers::all()->count();
        foreach ($orders as $order) {
            $totalIncome += $order->total_paid;
        }
        $orders = Orders::orderByDesc('id')->paginate(10); // Showing only 10 ordered per page
        $count = 1;
        return view(
            'adminfrontend.pages.dashboard',
            compact(
                'newOrder',
                'totalOrder',
                'totalIncome',
                'totalProduct',
                'totalMember',
                'totalCustomer',
                'totalSubscriber',
                'count',
                'orders'
            )
        );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
