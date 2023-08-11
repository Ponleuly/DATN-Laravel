<?php

namespace App\Http\Controllers\UserController;

use App\Models\Cards;
use App\Models\Carts;
use App\Models\Orders;
use App\Models\Coupons;
use App\Models\Contacts;
use App\Models\Payments;
use App\Models\Products;
use App\Models\Settings;
use App\Models\Customers;
use App\Models\Deliveries;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Orders_Details;
use App\Models\Products_Sizes;
use Illuminate\Support\Carbon;
use App\Models\Products_Attributes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\AdminController\OrderController;


class CartController extends Controller
{
    public function cart()
    {
        if (Auth::check() && Auth::user()->role == 1) {
            $carts = Carts::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
            $carts_count = $carts->count();
        } else {
            $carts = Cart::content()->sortByDesc('rowId');
            $carts_count = $carts->count();
            //return dd($carts);
        }
        //return dd($carts);
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
        //return dd($request->toArray());
        //========== If User Sign in then save to Carts table============== //
        if (Auth::check() && Auth::user()->role == 1) {
            $user_id = Auth::user()->id;
            //==== update quantity if add the same size, prudct and user incart ===//
            $update_qty = Carts::where('user_id', $user_id)
                ->where('product_id', $id)
                ->where('size_id', $request->size_id)
                ->first();
            $pro_size_qty = Products_Sizes::where('product_id', $id)
                ->where('size_id', $request->size_id)->first();
            // If found product with the same size in cart
            if ($update_qty) {
                //=== Alert if size quantity > size stock
                if (($request->product_quantity + $update_qty->product_quantity) > $pro_size_qty->size_quantity) {
                    return redirect()->back()
                        ->with(
                            'error',
                            'Only ' . $pro_size_qty->size_quantity .
                                ' products left. Your cart already have '
                                . $update_qty->product_quantity .
                                ' products with size ' . $pro_size_qty->rela_product_size->size_number . '.',
                        );
                } else {
                    $update_qty->product_quantity += $request->product_quantity;
                    $update_qty->update();
                }
            }
            //  If there is no the same size of product in cart
            else {
                //=== Alert if size quantity > size stock
                if ($request->product_quantity > $pro_size_qty->size_quantity) {
                    return redirect()->back()
                        ->with(
                            'error',
                            'Only ' . $pro_size_qty->size_quantity .
                                ' products with size ' . $pro_size_qty->rela_product_size->size_number . '.',
                        );
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
        }
        //========== If User is guest then save data to Cart (Cart is a model from package) ==============//
        else {
            $product = Products::findOrFail($id);
            $pro_size_qty = Products_Sizes::where('product_id', $id)
                ->where('size_id', $request->size_id)->first();
            $carts = Cart::content();
            foreach ($carts as $cart) {
                //=== Check if found any product the same size in cart ===//
                if ($cart->id == $id && $cart->options->size == $request->size_id) {
                    //===== Check qty of the same size product in cart > product size stock ? ===//
                    if (($cart->qty + $request->product_quantity) > $pro_size_qty->size_quantity) {
                        return redirect()->back()
                            ->with(
                                'error',
                                'Only ' . $pro_size_qty->size_quantity .
                                    ' products left. Your cart already have '
                                    . $cart->qty .
                                    ' products with size ' . $pro_size_qty->rela_product_size->size_number . '.',
                            );
                    }
                } else {
                    if ($request->product_quantity > $pro_size_qty->size_quantity) {
                        return redirect()->back()
                            ->with(
                                'error',
                                'Only ' . $pro_size_qty->size_quantity .
                                    ' products with size ' . $pro_size_qty->rela_product_size->size_number . '.',
                            );
                    }
                }
            }
            if ($request->product_quantity > $pro_size_qty->size_quantity) {
                return redirect()->back()
                    ->with(
                        'error',
                        'Only ' . $pro_size_qty->size_quantity . ' products left with this size',
                    );
            } else {
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
        //return dd($request->toArray());

        if (Auth::check() && Auth::user()->role == 1) {
            //return dd($request->toArray());
            $item = Carts::where('id', $cartId)->first();
            $pro_size_qty = Products_Sizes::where('product_id', $item->product_id)
                ->where('size_id', $request->size_id)->first();
            //=== Alert if size quantity > size stock
            if ($request->product_quantity  > $pro_size_qty->size_quantity) {
                return redirect()->back()
                    ->with(
                        'error',
                        'Only ' . $pro_size_qty->size_quantity .
                            ' products left with size ' . $pro_size_qty->rela_product_size->size_number . '.',
                    );
            } else {
                $item->size_id = $request->size_id;
                $item->product_quantity = $request->product_quantity;
                $item->update();
                $carts = Carts::where('user_id', $item->user_id)
                    ->where('product_id', $item->product_id)
                    ->where('size_id', $request->size_id)->get();
                if (count($carts) == 2) {
                    $item->delete();
                    $update_cart = Carts::where('user_id', Auth::user()->id)
                        ->where('product_id', $item->product_id)
                        ->where('size_id', $request->size_id)->first();
                    $update_cart->product_quantity = $request->product_quantity;
                    $update_cart->update();
                }
                //return dd(count($carts));
            }
        } else {
            //return dd($request->toArray());
            $item = Cart::content()->where('rowId', $cartId);

            foreach ($item as $key => $value) {
                $productId = $value->id;
                $sizeId = $value->options->size;
                $itemQty = $value->qty;
            }


            //===== Check qty of the same size product item > product size stock ? ===//
            $pro_size_qty = Products_Sizes::where('product_id', $productId)
                ->where('size_id', $request->size_id)->first();
            //return dd($cart->rowId);
            if (($request->product_quantity > $pro_size_qty->size_quantity)) {
                return redirect()->back()
                    ->with(
                        'error',
                        'Only ' . $pro_size_qty->size_quantity .
                            ' products left with size ' . $pro_size_qty->rela_product_size->size_number . '.',
                    );
            } else {

                $products = Products::findOrFail($productId);
                Cart::update(
                    $cartId, // $cartId == rowId
                    [
                        'qty' => $request->product_quantity,
                        'options' => [
                            'image' => $products->product_imgcover, // return error if not update with product img
                            'size' => $request->size_id
                        ],
                    ]
                );
                $carts = Cart::content();
                foreach ($carts as $cart) {
                    if ($cart->id == $productId && $cart->options->size == $request->size_id) {
                        if ($cart->qty > $pro_size_qty->size_quantity) {
                            $product = Products::findOrFail($cart->id);
                            Cart::update(
                                $cart->rowId,
                                [
                                    'qty' => $request->product_quantity,
                                    'options' => [
                                        'image' => $product->product_imgcover,
                                        'size' => $cart->options->size
                                    ],
                                ]
                            );
                            return redirect()->back()
                                ->with(
                                    'info',
                                    'Updated on duplicated item ' .

                                        ' and only ' . $pro_size_qty->size_quantity . ' products left with size '
                                        . $pro_size_qty->rela_product_size->size_number . '.',
                                );
                            //return dd($request->size_id);

                        } else {
                            $product = Products::findOrFail($cart->id);
                            Cart::update(
                                $cart->rowId,
                                [
                                    'qty' => $request->product_quantity,
                                    'options' => [
                                        'image' => $product->product_imgcover,
                                        'size' => $cart->options->size
                                    ],
                                ]
                            );
                        }
                    }
                }
            }
        }
        return redirect()->back()
            ->with(
                'success',
                'Item is updated successfully !',
            );
        //return dd(Cart::content()->where('rowId', $cartId));
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
                'success',
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
                    'error',
                    'Your promo code is expired !',
                );
            } elseif ($current->lt($start) && $current->lt($end)) {
                //$status = 0; //expired
                return redirect($routeName)->with(
                    'info',
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
                        'info',
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
                'error',
                'Your promo code not found !',
            );
        }
    }


    public function checkout($discount)
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
                'payments',
                'discount'
            )
        );
    }

    public function place_order(Request $request)
    {
        // If customer is member and loged in
        if (Auth::check() && Auth::user()->role == 1) {
            // Count order row
            $order_count = Orders::all()->count();
            $dis = preg_replace('/[^0-9]/', '', $request->discount);
            //=== Passing total discount to discount value by each product ====//
            $discount = $dis / 100;
            // Store data to table orders
            Orders::create([
                'invoice_code' => '#iv' . sprintf('%04d', ++$order_count),
                'order_status' => 'Pending', // set t default is pending, processing, derliverd, canceled
                'user_id' => Auth::user()->id,
                'discount' => number_format($discount, 2),
                'payment_method' => $request->payment,
                'delivery_fee' => $request->delivery_fee,
                'total_paid' => substr($request->total_paid, 2),
            ]);
            // Get customer id
            $order = Orders::orderBy('id', 'desc')->first();
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
        } else { // If customer is guest and not loged in
            // Count order row
            $order_count = Orders::all()->count();
            //=== Get total discount without string $ ====//
            $dis = preg_replace('/[^0-9]/', '', $request->discount);
            //=== Passing total discount to discount value by each product ====//
            $discount = $dis / 100;
            // Store data to table orders
            Orders::create([
                'invoice_code' => '#iv' . sprintf('%04d', ++$order_count),
                'order_status' => 'Pending', // set t default status = 1 is pending, 2=processing, 3=derliverd, 4=cancel
                'user_id' => 0, // if cumstomer is guest, other if is cumstomer is member
                'discount' => number_format($discount, 2),
                'payment_method' => $request->payment,
                'delivery_fee' => $request->delivery_fee,
                'total_paid' => substr($request->total_paid, 2),
            ]);

            // Get order id
            $order = Orders::orderBy('id', 'desc')->first();
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
        $placeOrder = Orders::orderBy('id', 'desc')->first();
        $orderId = $placeOrder->id;
        //===== Calll OrderController =====//
        $orderController = new OrderController();
        $orderController->pro_qty_sub($orderId);
        //app('App\Http\Controllers\AdminController\OrderController')->pro_qty_sub($orderId); //** Can use this replace of 2 lines above */
        //=================================//
        /*
            $orderDetails = Orders_Details::where('order_id', $orderId)->get();
            foreach ($orderDetails as $orderDetail) {
                $sizeId = $orderDetail->size_id;
                $quantity = $orderDetail->product_quantity;
                $productId = $orderDetail->product_id;
                $productSize_qty = Products_Sizes::where('product_id', $productId)
                    ->where('size_id', $sizeId)->first();
                /*
                $stock_qty = ($productSize_qty->size_quantity) - $quantity;
                // If total quantity of order bigger than or equal to size stock ==> stock = 0
                if ($stock_qty <= 0) {
                    $productSize_qty->size_quantity = 0;
                } else {
                    $productSize_qty->size_quantity = ($productSize_qty->size_quantity) - $quantity;
                }
                $productSize_qty->update();

                //============ Update product stockleft after order==============//
                $stockLeft = 0;
                $productSize = Products_Sizes::where('product_id', $productId)->get();
                foreach ($productSize as $row) {
                    $stockLeft  += $row->size_quantity;
                }

                //============ Update product stockleft after order ==============//
                $pro_stockleft = Products::where('id', $productId)->first();
                $pro_stockleft->product_stockleft = $stockLeft;
                $pro_stockleft->update();
            }
        */
        //================= Payment Credit Card =======================//
        if ($request->payment == 'Credit Card') {
            return redirect('payment/invoicecode=' . substr($order->invoice_code, 1) . '/' . 'totalpaid=' . substr($request->total_paid, 2));
        } else {
            return redirect('order-completed/invoice=' . substr($order->invoice_code, 1));
        }

        //return $this->order_completed(substr($order->invoice_code, 1));
        //return dd($request->toArray());
    }

    //=============================================//
    public function order_completed($code)
    {
        //=============== Get data to display on user invoice =======================S//
        $order = Orders::where('invoice_code', '#' . $code)->first();
        $orderId = $order->id;
        $customer = Customers::where('order_id', $orderId)->first();
        $orderDetails = Orders_Details::where('order_id', $orderId)->get();
        $count = 1;
        $contacts = Contacts::orderBy('id')->get();
        $shopName = Settings::all()->first();
        $card = Cards::where('order_code', $order->invoice_code)->first();
        return view(
            'frontend.mainPages.order_completed',
            compact(
                'count',
                'order',
                'customer',
                'orderDetails',
                'contacts',
                'shopName',
                'card'
            )
        );
        //return dd($customer);
    }


    public function order_canceled($code)
    {
        $order = Orders::where('invoice_code', '#' . $code)->first();
        $orderId = $order->id;
        //============ Update product size qty ===========//
        //===== Calll OrderController =====//
        $orderController = new OrderController();
        $orderController->pro_qty_plus($orderId);
        //app('App\Http\Controllers\AdminController\OrderController')->pro_qty_plus($orderId);
        /**================================= */
        // ========== Delete order if credit card is canceled ===========//
        $order->delete();
        return view(
            'frontend.mainPages.order_completed',
        );
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
                'success',
                'Product removed from cart successfully!',
            );
        //return dd($rowId);
    }


    public function remove_all_cart($num)
    {
        if ($num == 0) { // 0 is condiction for showing question are you sure?
            return redirect()->back()
                ->with(
                    'question',
                    'remove-all-cart/1', // redirect to page with new url/1 then show question
                );
        } else if ($num == 1) { // 1 is condiction if user click yes then remove all from cart
            if (Auth::check() && Auth::user()->role == 1) {
                Carts::where('user_id', Auth::user()->id)->delete();
            } else {
                Cart::destroy();
            }
            return redirect()->back()
                ->with(
                    'success',
                    'All products removed from cart successfully !',
                );
        }

        //return dd($rowId);
    }
}
