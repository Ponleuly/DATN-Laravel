<?php

namespace App\Http\Controllers\AdminController;

use App\Models\User;
use Nette\Utils\Json;
use App\Models\Orders;
use App\Models\Products;
use App\Models\Customers;
use App\Models\Subscribers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\UserController\ProfileController;

class AdminFrontendController extends Controller
{
    public function dashboard()
    {
        $newOrder = Orders::where('order_status', 'Pending')->count();
        $totalOrder = Orders::all()->count();
        $orders = Orders::where('order_status', 'Delivered')->get();
        $totalIncome = 0;
        $totalProduct = Products::all()->count();
        $totalMember = User::all()->count();
        $totalCustomer = Customers::all()->count();
        $totalSubscriber = Subscribers::all()->count();
        foreach ($orders as $order) {
            $totalIncome += $order->total_paid;
        }
        // Using whereBetween to get order by id from id=1 to id =20
        // $orders = Orders::whereBetween('id', [4,20])->paginate(5); // Showing only 10 ordered per page
        $count = 1;
        $orders = Orders::orderBydesc('id')->paginate(10); // Showing only 10 ordered per page
        //========== Order Status Chart ============//
        $pending = Orders::where('order_status', 'Pending')->count();
        $processing = Orders::where('order_status', 'Processing')->count();
        $delivered = Orders::where('order_status', 'Delivered')->count();
        $canceled = Orders::where('order_status', 'Canceled')->count();
        $order_chart = "";
        $order_chart = 
            "['Processing'," .$processing."],"
            . "['Canceled'," .$canceled."],"
            . "['Pending'," .$pending."],"
            . "['Delivered'," .$delivered."]";
        //========= Order Amount ======//
        $order_select = Orders::select('id', 'created_at', 'order_status', 'total_paid')
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('m');
            });
        $order_count = [];
        $order_monthly = [];
        $order_income = [];
        $total = 0;
        foreach ($order_select as $key => $value) {
            $order_count[(int)$key] = count($value);//==== Store total order per month to array===//
            foreach($value as $row){
                if($row['order_status'] == 'Delivered'){//==== Get only order that Delivered ===//
                    $total += $row['total_paid'];
                }
            }
            $order_income[(int)$key] = $total; //==== Store total paid per month to array===//
            $total = 0;

        }
        
        $month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        
        for ($i = 1; $i <= 12; $i++) {
            if (!empty($order_count[$i])) {
                $order_monthly[$i]['order'] = $order_count[$i];
                $order_monthly[$i]['income'] = $order_income[$i];
            } else {
                $order_monthly[$i]['order'] = 0;
                $order_monthly[$i]['income'] = 0;
            }
            $order_monthly[$i]['month'] = $month[$i - 1];
            //$order_amount =   "['". $month[$i]. "'," .$order_count[$i][$i]."],";
        }
        //return dd($order_amount);
        
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
                'orders',
                'order_chart',
                'order_monthly'
            )
        );
    }

    public function profile($id)
    {
        $user = User::where('id', $id)->first();
        return view(
            'adminfrontend.pages.profile.general_profile',
            compact(
                'user'
            )
        );
    }

    public function update_profile(Request $request, $id)
    {
        //return dd($request->toArray());
        $update_profile = User::where('id', $id)->first();
        $input = $this->validate($request, [
            'name' => [
                'required', 'string', 'max:50'
            ],
            'phone' => ['required', 'string', 'max:15', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'phone:VN,BE', Rule::unique('users', 'phone')->ignore(Auth::user()->id)], /*'regex:/(01)[0-9]{9}'*/ // verify only number is acceptable
            'email' => ['required', 'string',  'max:50', Rule::unique('users', 'email')->ignore(Auth::user()->id)],
            'address' => ['required', 'string', 'max:100'],
            'city' => [
                'required', 'string', 'max:50'
            ],
            'district' => ['required', 'string', 'max:50'],
            'ward' => [
                'required', 'string', 'max:50'
            ],
        ]);
        if ($input) {
            $update_profile->name = $input['name'];
            $update_profile->phone = $input['phone'];
            $update_profile->email = $input['email'];
            $update_profile->address = $input['address'];
            $update_profile->city = $input['city'];
            $update_profile->district = $input['district'];
            $update_profile->ward = $input['ward'];
            $update_profile->update();
        }

        if ($request->current_password != '') {
            $profileController = new ProfileController();
            $profileController->update_password($request, $id);
            //app('App\Http\Controllers\UserController\ProfileController')->update_password($request, $id);
        }
        if ($request->hasFile('profile_img')) {
            $destination_path = 'profile_img/';
            $image = $request->file('profile_img');
            if (File::exists(public_path($destination_path))) {
                File::delete(public_path($destination_path));
            }
            $image_name = $image->getClientOriginalName();
            $image->move($destination_path, $image_name);

            $update_profile['profile_img'] = $image_name;
        }
        $update_profile->update();
        return redirect()->back()
            ->with(
                'message',
                'Profils is updated successfully !'
            );
        //return dd($request->toArray());
    }

    public function change_password($id)
    {
        $user = User::where('id', $id)->first();
        return view(
            'adminfrontend.pages.profile.change_password',
            compact(
                'user'
            )
        );
    }

    public function update_password(Request $request, $id)
    {
        $profileController = new ProfileController();
        $profileController->update_password($request, $id);
        //app('App\Http\Controllers\UserController\ProfileController')->update_password($request, $id);
        return redirect()->back()
            ->with(
                'message',
                'Password is changed successfully !'
            );
        //return dd($request->toArray());
    }
}
