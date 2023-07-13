<?php

namespace App\Http\Controllers\AdminController;

use DateTime;
use DateTimeZone;
use App\Models\Groups;
use App\Models\Coupons;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Categories_Subcategories;

class CouponController extends Controller
{

    public function coupon_list()
    {
        $coupons = Coupons::orderByDesc('id')->paginate(10);
        $count = 1;
        $search_text = '';
        $this->coupon_date();
        return view(
            'adminfrontend.pages.coupons.coupon_list',
            compact(
                'coupons',
                'count',
                'search_text'
            )
        );
    }
    public function coupon_date(){
        $allCoupon = Coupons::orderByDesc('id')->get();
        $currentTime = Carbon::now();
        foreach($allCoupon as $coupon){
            //$end_date = date('Y-m-d  H:i:s', strtotime($request->end_date));
            $start_date = Carbon::create($coupon->start_date);
            $end_date = Carbon::create($coupon->end_date);
            if ($currentTime->gt($start_date) && $currentTime->gt($end_date)) {
                $status = 0; //expired
            } elseif ($currentTime->gte($start_date) && $currentTime->lt($end_date)) {
                $status = 1; //active
            } elseif ($currentTime->lt($start_date) && $currentTime->lt($end_date)) {
                $status = 2; //future
            }
            $coupon->coupon_status = $status;
            $coupon->update();
        }
        return $allCoupon;
    }
    public function coupon_search()
    {
        $search_text = $_GET['search_coupon'];
        $coupons = Coupons::where('campaign_name', 'LIKE', '%' . $search_text . '%')->get();
        $count = 1;
        return view(
            'adminfrontend.pages.coupons.coupon_list',
            compact(
                'coupons',
                'count',
                'search_text'
            )
        );
    }
    
    public function coupon_view($id)
    {
        $coupon = Coupons::where('id', $id)->first();
        $groups = Groups::orderBy('id')->get();
        $categories = Categories::orderBy('id')->get();
        $subcategories = Categories_Subcategories::orderBy('id')->get();
        
        return view(
            'adminfrontend.pages.coupons.coupon_view',
            compact(
                'coupon',
                'groups',
                'categories',
                'subcategories'
            )
        );
    }


    public function coupon_add()
    {
        $categories = Categories::orderBy('id')->get();
        $subcategories = Categories_Subcategories::orderBy('id')->get();

        return view(
            'adminfrontend.pages.coupons.coupon_add',
            compact(
                'categories',
                'subcategories'
            )
        );
    }



    public function coupon_store(Request $request)
    {
        $currentTime = Carbon::now();
        //$end_date = date('Y-m-d  H:i:s', strtotime($request->end_date));
        $start_date = Carbon::create($request->start_date);
        $end_date = Carbon::create($request->end_date);
        if ($currentTime->gt($start_date)) {

            return redirect()->back()->with(
                'alert',
                'Your Start Date is expired !'
            );
        } elseif ($start_date->gt($end_date)) {
            return redirect()->back()->with(
                'alert',
                'Your Date is expired ! '
            );
        } else {
            if ($currentTime->gt($start_date) && $currentTime->gt($end_date)) {
                $status = 0; //expired
            } elseif ($currentTime->gte($start_date) && $currentTime->lt($end_date)) {
                $status = 1; //active
            } elseif ($currentTime->lt($start_date) && $currentTime->lt($end_date)) {
                $status = 2; //future
            }
            $input = $request->all();
            $input['coupon_status'] = $status;
            Coupons::create($input);
            return redirect('/admin/coupon-list')
                ->with('message', 'Coupon ' . $request->campaign_name . ' is added successfully!');
        }
    }


    public function coupon_edit($id)
    {
        $coupon = Coupons::where('id', $id)->first();
        $categories = Categories::orderBy('id')->get();
        $subcategories = Categories_Subcategories::orderBy('id')->get();
        return view(
            'adminfrontend.pages.coupons.coupon_edit',
            compact(
                'coupon',
                'categories',
                'subcategories'
            )
        );
    }


    public function coupon_update(Request $request, $id)
    {
        $update_coupon = Coupons::where('id', $id)->first();
        $update_coupon->campaign_name = $request->input('campaign_name');
        $update_coupon->code = $request->input('code');
        $update_coupon->discount_percentage = $request->input('discount_percentage');
        $update_coupon->discount_value = $request->input('discount_value');
        $update_coupon->start_date = $request->input('start_date');
        $update_coupon->end_date = $request->input('end_date');
        $update_coupon->category_id = $request->input('category_id');
        $update_coupon->subcategory_id = $request->input('subcategory_id');
        $currentTime = Carbon::now();
        //$end_date = date('Y-m-d  H:i:s', strtotime($request->end_date));
        $start_date = Carbon::create($request->start_date);
        $end_date = Carbon::create($request->end_date);
        if ($currentTime->gt($start_date) && $currentTime->gt($end_date)) {
            $status = 0; //expired
        } elseif ($currentTime->gte($start_date) && $currentTime->lt($end_date)) {
            $status = 1; //active
        } elseif ($currentTime->lt($start_date) && $currentTime->lt($end_date)) {
            $status = 2; //future
        }
        $update_coupon->coupon_status = $status;
        $update_coupon->update();

        return redirect('admin/coupon-list')
            ->with(
                'message',
                'Coupon ' . '"' . $update_coupon->campaign_name . '"' .
                    ' is updated successfully !'
            );
    }



    public function coupon_delete($id)
    {
        $delete_coupon = Coupons::where('id', $id)->first();
        $delete_coupon->delete();

        return redirect('/admin/coupon-list')
            ->with(
                'message',
                'Coupon ' . '"' . $delete_coupon->campaign_name . '"' .
                    ' is deleted successfully !'
            );
    }
}
