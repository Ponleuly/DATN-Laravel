<?php

namespace App\Http\Controllers\UserController;

use App\Models\Carts;
use App\Models\Products_Sizes;
use App\Models\Orders;
use App\Models\Coupons;
use App\Models\Products;
use App\Models\Customers;
use App\Models\Deliveries;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Orders_Details;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Products_Attributes;
use App\Http\Controllers\Controller;
use App\Models\Contacts;
use App\Models\Payments;
use App\Models\Settings;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{

    public function cart()
    {
        if (Auth::check() && Auth::user()->role == 1) {
            $carts = Carts::where('user_id', Auth::user()->id)->get();
            $carts_count = $carts->count();
        } else {
            $carts = Cart::content();
            $carts_count = $carts->count();
        }
        return view(
            'frontend.mainPages.cart',
            compact(
                'carts',
                'carts_count'
            )
        );
        //return dd($carts->toArray());
    }




    public function add_to_cart(Request $request, $id)
    {
        //========== If User Sign in then save to Carts table============== //
        if (Auth::check() && Auth::user()->role == 1) {
            $user_id = Auth::user()->id;
            //==== update quantity if add the same size, prudct and user incart ===//
            $update_qty = Carts::where('user_id', $user_id)
                ->where('product_id', $id)
                ->where('size_id', $request->size_id)
                ->first();
            if ($update_qty) {
                $update_qty->product_quantity += $request->product_quantity;
                $update_qty->update();
            } else {
                $product = Products::findOrFail($id);
                $input = $request->all();
                $input['user_id'] = $user_id;
                $input['product_id'] = $id;
                $input['size_id'] = $request->size_id;
                $input['product_quantity'] = $request->product_quantity;
                $input['product_price'] =  $product->product_saleprice;

                Carts::create($input);
            }
        }
        //========== If User is guest then save data to Cart (Cart is a model from package) ==============//
        else {
            $product = Products::findOrFail($id);
            Cart::add(
                [
                    'id' => $product->id,
                    'name' => $product->product_name,
                    'price' => $product->product_saleprice,
                    'qty' => $request->product_quantity,
                    'weight' => 0, //defualt column in Cart
                    'options' => [
                        'image' => $product->product_imgcover,
                        'size' => $request->size_id
                    ],
                ]
            );
        }
        //=============== Check if Add to cart or Buy now =================//
        if ($request->action == 'addtocart') {
            return redirect()->back()
                ->with(
                    'success',
                    'Product added to cart successfully.',
                );
        } else if ($request->action == 'buynow') {
            return redirect('/cart');
        }
        //return dd($request->toArray());
    }





    public function update_cart(Request $request, $cartId)
    {
        if (Auth::check() && Auth::user()->role == 1) {
            //$user_id = Auth::user()->id;
            //==== update quantity if add the same size, prudct and user incart ===//
            $update_cart = Carts::where('id', $cartId)->first();
            $update_cart->size_id = $request->size_id;
            $update_cart->product_quantity = $request->product_quantity;
            $update_cart->update();
        } else {
            $cart = Cart::content()->where('rowId', $cartId);
            foreach ($cart as $key => $value) {
                $prouductId = $value->id;
            }
            $products = Products::findOrFail($prouductId);
            foreach ($cart as $key => $value) {
                $rowId = $value->rowId;
            }
            Cart::update(
                $rowId,
                [
                    'qty' => $request->product_quantity,
                    'options' => [
                        'image' => $products->product_imgcover,
                        'size' => $request->size_id
                    ],
                ]
            );

            // return dd($prouductId);
        }
        return redirect()->back()
            ->with(
                'message',
                'Item is updated successfully!',
            );

        //return dd(Cart::content());
    }




    // ============================ Coupon Apply ===========================================//
    public function coupon_apply(Request $request, $userId)
    {
        //==== Convert input to uppercase ===//
        $code = Str::upper($request->code);
        //==== passing route name to $routeName ===//
        $routeName = 'cart';
        //=== Return with calling method coupon_cal to get discount value ======///
        return $this->coupon_cal($code, $userId, $routeName)
            ->with(
                'message',
                'Your promo code is applied !',
            );;
    }





    //================= Create Method to return discount value ================================//
    //======= Method will get parameter code, userId, routeName====//
    //======= After calculated discount will redirect to routeName ===//
    public function coupon_cal($code, $userId, $routeName)
    {
        //===== get coupon by input code =====//
        $coupon = Coupons::where('code', $code)->first();
        //========= Coupon Founded =======//
        if ($coupon) {
            $percentage = $coupon->discount_percentage;
            $value = $coupon->discount_value;
            //====== Get Coupon Status ===== ///
            $start = date('M d, Y', strtotime($coupon->start_date));
            $end = date('M d, Y', strtotime($coupon->end_date));
            $current = Carbon::now();
            if ($current->gt($start) && $current->gt($end)) {
                //$status = 0; //expired
                return redirect($routeName)->with(
                    'alert',
                    'Your promo code is expired !',
                );
            } elseif ($current->lt($start) && $current->lt($end)) {
                //$status = 0; //expired
                return redirect($routeName)->with(
                    'alert',
                    'This promo code is start from ' . $start . ' to ' . $end
                );
            } elseif ($current->gte($start) && $current->lt($end)) {
                //$status = 1; //active
                $discount = 0;
                $subtotal = 0;

                // ============================= Get User Cart =========================//
                if (Auth::check() && Auth::user()->role == 1) {
                    $carts = Carts::where('user_id', $userId)->get();
                } else {
                    // ========================= Get System Cart ======================//
                    $carts = Cart::content();
                }
                // ====== Check each products in carts ================//
                foreach ($carts as $cart) {
                    //==== Get product_id, price, quantity from user Carts ====//
                    if (Auth::check() && Auth::user()->role == 1) {
                        $productId = $cart->product_id;
                        $quantity = $cart->product_quantity;
                        $price = $cart->product_price;
                    } else {
                        //==== Get product_id, price, quantity from System Cart ====//
                        $productId = $cart->id;
                        $quantity = $cart->qty;
                        $price = $cart->price;
                    }
                    //==== Get product attributes by product_id ====//
                    $productAtt = Products_Attributes::where('product_id', $productId)
                        ->first();
                    //foreach ($productAtts as $productAtt) {
                    // ==== Compare id between Product_Attributes and Coupons dicount category subcategory ===//
                    //$group = $productAtt->group_id == $coupon->group_id;
                    $category = $productAtt->category_id == $coupon->category_id;
                    $subcategory = $productAtt->subcategory_id == $coupon->subcategory_id;

                    //=== For discount coupon with only category ===//
                    if ($coupon->subcategory_id == null) {
                        if ($category) {
                            $subtotal = $quantity * $price;
                            //== Check in table coupons if there are discount is value or percentage ===//
                            if ($value == 0) {
                                $discount += ($subtotal * $percentage) / 100;
                            } elseif ($percentage == 0) {
                                $discount += $value * $quantity;
                            }
                        } //=== Not discount ===//
                        else {
                            $discount;
                        }
                    } else {  //=== For discount coupon with category and subcategory ===//
                        if ($category && $subcategory) {
                            $subtotal = $quantity * $price;
                            //== Check in table coupons if there are discount is value or percentage ===//
                            if ($value == 0) {
                                $discount += ($subtotal * $percentage) / 100;
                            } elseif ($percentage == 0) {
                                $discount += $value * $quantity;
                            }
                        } else {
                            $discount;
                        }
                    }
                    //}
                }
                //=== If there is no discount product in cart ===//
                if ($discount == 0) {
                    return redirect($routeName)->with(
                        'alert',
                        'This promo code is not availabled to this product !',
                    );
                }
                //=== If there is discount product in cart ===//
                else {
                    return redirect($routeName)
                        ->with('discount', $discount);
                }
            }
        } else {
            return redirect($routeName)->with(
                'alert',
                'Your promo code not found !',
            );
        }
    }




    public function checkout()
    {
        if (Auth::check() && Auth::user()->role == 1) {
            $carts = Carts::where('user_id', Auth::user()->id)->get();
        } else {
            $carts = Cart::content();
        }
        $deliveries = Deliveries::orderBy('id')->get();
        $payments = Payments::orderBy('id')->get();

        return view(
            'frontend.mainPages.checkout',
            compact(
                'carts',
                'deliveries',
                'payments'
            )
        );
    }




    public function place_order(Request $request)
    {
        //====================== Place Order without input Coupon code ==============//
        if ($request->action == 'placeorder') {

            if (Auth::check() && Auth::user()->role == 1) {

                // Count order row
                $order_count = Orders::all()->count();
                $dis = preg_replace('/[^0-9]/', '', $request->discount);
                //=== Passing total discount to discount value by each product ====//
                $discount = $dis / 100;
                // Store data to table orders
                Orders::create([
                    'invoice_code' => '#iv' . sprintf('%04d', ++$order_count),
                    'order_status' => 1, // set t default status = 1 is pending, 2=processing, 3=derliverd, 4=cancel
                    'user_id' => Auth::user()->id,
                    'discount' => number_format($discount, 2),
                    'payment_method' => $request->payment,
                    'delivery_fee' => $request->delivery_fee,
                ]);
                // Get customer id
                $order = Orders::latest()->first();
                $orderId = $order->id;

                $input = $request->all();
                $input['order_id'] = $orderId;
                //==== Store data to table customer =====//
                Customers::create($input);
                // Get data from Carts model
                $carts = Carts::where('user_id', Auth::user()->id)->get();
                foreach ($carts as $cart) {

                    // Store data to table orderDetails
                    Orders_Details::create([
                        'order_id' => $orderId,
                        'product_id' => $cart->product_id,
                        'product_price' => $cart->rela_product_cart->product_saleprice,
                        'product_quantity' => $cart->product_quantity,
                        'size_id' => $cart->size_id,
                    ]);
                }

                // Remove all products in carts after user completed order
                Carts::where('user_id', Auth::user()->id)->delete();
            } else {
                // Count order row
                $order_count = Orders::all()->count();
                //=== Get total discount without string $ ====//
                $dis = preg_replace('/[^0-9]/', '', $request->discount);
                //=== Passing total discount to discount value by each product ====//
                $discount = $dis / 100;
                // Store data to table orders
                Orders::create([
                    'invoice_code' => '#iv' . sprintf('%04d', ++$order_count),
                    'order_status' => 1, // set t default status = 1 is pending, 2=processing, 3=derliverd, 4=cancel
                    'user_id' => 0,
                    'discount' => number_format($discount, 2),
                    'payment_method' => $request->payment,
                    'delivery_fee' => $request->delivery_fee,
                ]);

                // Get order id
                $order = Orders::latest()->first();
                $orderId = $order->id;
                //==== Store data to table customer =====//
                $input = $request->all();
                $input['order_id'] = $orderId;
                Customers::create($input);
                // Get data from Cart if customer not signin
                $carts = Cart::content();
                foreach ($carts as $cart) {
                    // Store data to table orderDetails
                    Orders_Details::create([
                        'order_id' => $orderId,
                        'product_id' => $cart->id,
                        'product_price' => $cart->price,
                        'product_quantity' => $cart->qty,
                        'size_id' => $cart->options->size,
                    ]);
                }
                // Remove all products in Cart after user completed order
                Cart::destroy();
            }
            //===================== Update product stock after ordered =======================//
            $placeOrder = Orders::latest()->first();
            $orderId = $placeOrder->id;
            $orderDetails = Orders_Details::where('order_id', $orderId)->get();
            foreach ($orderDetails as $orderDetail) {
                $sizeId = $orderDetail->size_id;
                $quantity = $orderDetail->product_quantity;
                $productId = $orderDetail->product_id;
                $productSize_qty = Products_Sizes::where('product_id', $productId)
                    ->where('size_id', $sizeId)->first();
                $stock_qty = ($productSize_qty->size_quantity) - $quantity;
                // If total quantity of order bigger than or equal to size stock ==> stock = 0
                if ($stock_qty <= 0) {
                    $productSize_qty->size_quantity = 0;
                } else {
                    $productSize_qty->size_quantity = ($productSize_qty->size_quantity) - $quantity;
                }
                $productSize_qty->update();
            }

            //=============== Get data to display on user invoice =======================S//
            $order = Orders::where('id', $orderId)->first();
            $customer = Customers::where('id', $orderId)->first();
            $orderDetails = Orders_Details::where('order_id', $orderId)->get();
            $count = 1;
            $contacts = Contacts::orderBy('id')->get();
            $shopName = Settings::all()->first();    

            return view(
                'frontend.mainPages.thankyou',
                compact(
                    'count',
                    'order',
                    'customer',
                    'orderDetails',
                    'contacts',
                    'shopName'
                )
            );
            //return dd($orderDetails->toArray());
        }
        //====================== If Submit input Coupon code ============================//
        elseif ($request->action == 'apply' || $request->action == 'delivery') {
            if (Auth::check() && Auth::user()->role == 1) {
                $userId = Auth::user()->id;
                //==== Convert input to uppercase ===//
                $code = Str::upper($request->code);
                //==== passing route name to $routeName ===//
                $routeName = 'checkout';
                $input = $request->all();
                // Convert discount valeu string to number if there is coupon apllied
                $dis = preg_replace('/[^0-9]/', '', $request->discount);
                //=== Passing total discount to discount value by each product ====//
                $discount = $dis / 100;
                $input['discount'] = $discount;

                //=== Return with calling method coupon_cal to get discount value ======//
                if ($request->action == 'apply') {
                    return $this->coupon_cal($code, $userId, $routeName)
                        ->withInput($input)
                        ->with(
                            'message',
                            'Your promo code is applied !',
                        );
                } elseif ($request->action == 'delivery') {
                    return redirect('checkout')
                        ->withInput($input)
                        ->with(
                            'message',
                            'Delivery method is applied !',
                        );
                }
            } else {
                $userId = 0;
                //==== Convert input to uppercase ===//
                $code = Str::upper($request->code);
                //==== passing route name to $routeName ===//
                $routeName = 'checkout';
                //=== Return with calling method coupon_cal to get discount value ======//
                //== Get input request in old page ===//
                $input = $request->all();

                // Convert discount valeu string to number if there is coupon apllied
                $dis = preg_replace('/[^0-9]/', '', $request->discount);
                //=== Passing total discount to discount value by each product ====//
                $discount = $dis / 100;
                $input['discount'] = $discount;
                if ($request->action == 'apply') {
                    return $this->coupon_cal($code, $userId, $routeName)
                        ->withInput($input)
                        ->with(
                            'message',
                            'Your promo code is applied !',
                        );
                } elseif ($request->action == 'delivery') {
                    return redirect('checkout')
                        ->withInput($input)
                        ->with(
                            'message',
                            'Delivery method is applied !',
                        );
                }
            }
        }
    }

    //======================================================================================================================//




    //====================== Download Invoice ============================//
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
            'shopName'=> $shopName,
        ];
        $pdf = Pdf::loadView('adminfrontend.pages.orders.order_invoice', $data);

        return $pdf->download($order->invoice_code . '.pdf');
    }




    public function remove_from_cart($id)
    {
        if (Auth::check() && Auth::user()->role == 1) {
            $removeCart = Carts::where('id', $id)->first();
            $removeCart->delete();
        } else {
            /*
            $cart = Cart::content()->where('rowId', $id);
            foreach ($cart as $key => $value) {
                $rowId = $value->rowId;
            }
            */
            Cart::remove($id);
        }
        return redirect()->back()
            ->with(
                'message',
                'Product is removed from cart successfully!',
            );
        //return dd($rowId);
    }




    public function remove_all_cart()
    {
        if (Auth::check() && Auth::user()->role == 1) {
            Carts::where('user_id', Auth::user()->id)->delete();
        } else {
            Cart::destroy();
        }
        return redirect()->back()
            ->with(
                'message',
                'All products is removed from cart successfully!',
            );
        //return dd($rowId);
    }
}
