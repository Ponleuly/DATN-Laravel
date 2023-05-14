<?php

namespace App\Http\Controllers\AdminController;

use App\Models\Deliveries;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeliveryController extends Controller
{
    public function delivery_list()
    {
        $deliveries = Deliveries::orderBy('id')->get();
        $count = 1;
        $search_text  = '';
        return view(
            'adminfrontend.pages.deliveries.delivery_list',
            compact(
                'deliveries',
                'count',
                'search_text'
            )
        );
    }

    public function delivery_search()
    {
        $search_text = $_GET['search_delivery'];
        $deliveries = Deliveries::where('delivery_option', 'LIKE', '%' . $search_text . '%')->get();
        $count = 1;
        return view(
            'adminfrontend.pages.deliveries.delivery_list',
            compact(
                'deliveries',
                'count',
                'search_text'
            )
        );
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function delivery_add()
    {
        return view('adminfrontend.pages.deliveries.delivery_add');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delivery_store(Request $request)
    {
        $input = $request->all();
        Deliveries::create($input);
        return redirect('admin/delivery-add')
            ->with('message', 'Delivery option is added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delivery_edit($id)
    {
        $delivery = Deliveries::where('id', $id)->first();

        return view(
            'adminfrontend.pages.Deliveries.delivery_edit',
            compact(
                'delivery'
            )
        );
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delivery_update(Request $request, $id)
    {
        $update_delivery = Deliveries::where('id', $id)->first();
        $update_delivery->delivery_option = $request->input('delivery_option');
        $update_delivery->delivery_fee = $request->input('delivery_fee');

        $update_delivery->update();

        return redirect('/admin/delivery-list')
            ->with(
                'message',
                'Delivery option is updated successfully!'
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delivery_delete($id)
    {
        $delete_delivery = Deliveries::where('id', $id)->first();
        $delete_delivery->delete();

        return redirect('/admin/delivery-list')
            ->with(
                'message',
                'Delivery option is deleted successfully!'
            );
    }
}
