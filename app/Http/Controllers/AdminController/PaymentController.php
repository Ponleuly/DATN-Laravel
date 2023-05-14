<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\Payments;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payment_list()
    {
        $payments = Payments::orderBy('id')->get();
        $count = 1;
        $search_text  = '';
        return view(
            'adminfrontend.pages.payments.payment_list',
            compact(
                'payments',
                'count',
                'search_text'
            )
        );
    }

    public function payment_search()
    {
        $search_text = $_GET['search_payment'];
        $payments = Payments::where('payment_title', 'LIKE', '%' . $search_text . '%')->get();
        $count = 1;
        return view(
            'adminfrontend.pages.payments.payment_list',
            compact(
                'payments',
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

    public function payment_add()
    {
        return view('adminfrontend.pages.payments.payment_add');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function payment_store(Request $request)
    {
        $input = $request->all();
        Payments::create($input);
        return redirect('admin/payment-add')
            ->with('message', 'Payment method is added successfully!');
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
    public function payment_edit($id)
    {
        $payment = Payments::where('id', $id)->first();

        return view(
            'adminfrontend.pages.payments.payment_edit',
            compact(
                'payment'
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
    public function payment_update(Request $request, $id)
    {
        $update_payment = Payments::where('id', $id)->first();
        $update_payment->payment_title = $request->input('payment_title');
        $update_payment->payment_detail = $request->input('payment_detail');

        $update_payment->update();

        return redirect('/admin/payment-list')
            ->with(
                'message',
                'Payment method is updated successfully!'
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function payment_delete($id)
    {
        $delete_payment = Payments::where('id', $id)->first();
        $delete_payment->delete();

        return redirect('/admin/payment-list')
            ->with(
                'message',
                'Payment method is deleted successfully!'
            );
    }
}
