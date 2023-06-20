<?php

namespace App\Http\Controllers\UserController;

use App\Models\User;
use App\Models\Orders;
use App\Models\Contacts;
use App\Models\Settings;
use App\Models\Customers;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Orders_Details;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('frontend.userProfile.general_profile');
    }

    public function profile_update(Request $request, $id)
    {
        //return dd($request->toArray());
        $update_user = User::where('id', $id)->first();
        if ($request->hasFile('profile_img')) {
            $destination_path = 'profile_img/';
            $image = $request->file('profile_img');
            if (File::exists(public_path($destination_path))) {
                File::delete(public_path($destination_path));
            }
            $image_name = $image->getClientOriginalName();
            $image->move($destination_path, $image_name);
            $update_user['profile_img'] = $image_name;
            $update_user->update();
        } else {

            $update_user = User::where('id', $id)->first();
            $input = $this->validate($request, [
                'name' => ['required', 'string', 'max:50'],
                'phone' => ['required', 'string', 'max:20', 'phone:VN,BE', 'unique:users'], /*'regex:/(01)[0-9]{9}'*/ // verify only number is acceptable
                'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
                'address' => ['required', 'string', 'max:100'],
                'city' => ['required', 'string', 'max:50'],
                'district' => ['required', 'string', 'max:50'],
                'ward' => ['required', 'string', 'max:50'],
            ]);
            if ($input) {
                $update_user->name = $input['name'];
                $update_user->phone = $input['phone'];
                $update_user->email = $input['email'];
                $update_user->address = $input['address'];
                $update_user->city = $input['city'];
                $update_user->district = $input['district'];
                $update_user->ward = $input['ward'];
            }
            $update_user->create();
        }

        return redirect('profile')
            ->with('success', 'Profile updated successfully !');


        //return dd($request->toArray());
    }
    public function change_password()
    {
        return view('frontend.userProfile.change_password');
    }


    public function update_password(Request $request, $id)
    {

        $password_validate = $this->validate($request, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
            'current_password' => ['required', 'string', 'min:8', 'current_password'],

        ]);

        if ($password_validate) {
            $user = User::where('id', $id)->first();
            $password = $user->password;
            $input = $request->all();
            if (Hash::check($input['current_password'], $password)) {
                $user['password'] = bcrypt($input['password']);
                $user->update();
            } else {
                return redirect()->back()->with('error', 'Current password does not matched !');
            }
        } else {
            return redirect()->back();
        }

        return redirect('profile')
            ->with('success', 'Password has been changed successfully !');
    }

    public function purchase_history()
    {
        $userId = Auth::user()->id;
        $orders = Orders::where('user_id', $userId)->get();
        $orderCount = 0;
        $totalPurchase = 0;
        foreach ($orders as $order) {
            $orderDetails = Orders_Details::where('order_id', $order->id)->get();
            $orderCount += $orderDetails->count();
            $totalAmount = 0;
            $deliveryFee = $order->delivery_fee;
            $discount = $order->discount;
            foreach ($orderDetails as  $orderDetail) {
                $price = $orderDetail->product_price;
                $qty = $orderDetail->product_quantity;
                $totalAmount += $price * $qty;
                $total = $totalAmount + $deliveryFee - $discount;
            }
            $totalPurchase += $total;
        }
        return view(
            'frontend.userProfile.purchase_history',
            compact(
                'orders',
                'orderCount',
                'totalPurchase'
            )
        );
    }
    public function purchase_order_detail($orderId)
    {
        $order = Orders::where('id', $orderId)->first();
        $customer = Customers::where('id', $orderId)->first();
        $orderDetails = Orders_Details::where('order_id', $orderId)->get();
        $count = 1;
        $shopName = Settings::all()->first();
        $contacts = Contacts::orderBy('id')->get();

        return view(
            'frontend.userProfile.order_history',
            compact(
                'count',
                'order',
                'customer',
                'orderDetails',
                'shopName',
                'contacts'
            )
        );
    }
}
