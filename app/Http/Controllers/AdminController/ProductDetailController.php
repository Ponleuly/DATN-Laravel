<?php

namespace App\Http\Controllers\AdminController;

use App\Models\Sizes;
use App\Models\Categories_Subcategories;
use App\Models\Groups;
use App\Models\Products;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\Products_Sizes;
use App\Models\Products_Imgreviews;
use App\Http\Controllers\Controller;
use App\Models\Products_Attributes;
use Illuminate\Support\Facades\File;

class ProductDetailController extends Controller
{
    public function product_detail_list($res, $title, $sort)
    {
        if ($res == 'all') {
            $products = Products::all()->count();
            $res = $products;
        }
        if ($title == 'name') {
            $products = Products::orderBy('product_name', $sort)->paginate($res);
        } elseif ($title == 'price') {
            $products = Products::orderBy('product_price', $sort)->paginate($res);
        } elseif ($title == 'stock') {
            $products = Products::orderBy('product_stock', $sort)->paginate($res);
        } elseif ($title == 'stockleft') {
            $products = Products::orderBy('product_stockleft', $sort)->paginate($res);
        } elseif ($title == 'date') {
            $products = Products::orderBy('created_at', $sort)->paginate($res);
        } elseif ($title == 'status') {
            if ($sort == 'new') {
                $products = Products::where('product_status', 1)->paginate($res);
            } elseif ($sort == 'selling') {
                $products = Products::where('product_status', 2)->paginate($res);
            } elseif ($sort == 'soldout') {
                $products = Products::where('product_status', 3)->paginate($res);
            } elseif ($sort == 'asc') {
                $products = Products::orderBy('product_status', $sort)->paginate($res);
            } elseif ($sort == 'desc') {
                $products = Products::orderBy('product_status', $sort)->paginate($res);
            }
        }
        $search_text = '';
        return view(
            'adminfrontend.pages.products.product_detail_list',
            compact(
                'products',
                'search_text',
                'res',
                'title',
                'sort'
            )
        );
    }

    public function product_search($res, $title, $sort)
    {
        $search_text = $_GET['search_product'];
        if ($search_text == '') {
            return redirect()->back()->with('alert', 'Please fill product name to search !');
        }
        $products = Products::where('product_name', 'LIKE', '%' . $search_text . '%')->get();
        $count = 1;
        return view(
            'adminfrontend.pages.products.product_detail_list',
            compact(
                'products',
                'search_text',
                'res',
                'title',
                'sort',
                'count'
            )
        );
        //return dd($products);
    }

    public function product_detail_view($code)
    {
        $product_view = Products::where('product_code', $code)->first();
        $productId = $product_view->id;
        $productSize = Products_Sizes::where('product_id', $productId)->get();
        $productGroups = Products_Attributes::where('product_id', $productId)->get();
        $productCategory = Products_Attributes::where('product_id', $productId)->first();
        $allStock = $product_view->product_stock;
        $headCode = trim($code, " 0..9");
        $productCode = Products::where('product_code', 'LIKE', '%' . $headCode . '%')->get();
        // Join table Product and Products_Imgreviews to get all images reviews with the same product_code
        $allImgReviews = Products::join('Products_Imgreviews', 'products_imgreviews.product_id', '=', 'products.id')
            ->where('products.product_code', 'LIKE', '%' . $headCode . '%')
            ->get(['products_imgreviews.*']);
        $imgReviews = Products_Imgreviews::where('product_id', $productId)->get();

        $stockLeft = $product_view->product_stockleft;
        $status = Products::where('product_code', $code)->first();
        //===== Update product status if product stock sold out ======//
        if ($stockLeft == 0) {
            $status->product_status = 3; // is sold out
            $status->update();
        } elseif ($stockLeft > 0 && $stockLeft < $allStock) {
            $status->product_status = 2; // is selling
            $status->update();
        } else {
            $status->product_status = 1; // is selling
            $status->update();
        }
        return view(
            'adminfrontend.pages.products.product_detail_view',
            compact(
                'product_view',
                'productCode',
                'productGroups',
                'productCategory',
                'allImgReviews',
                'imgReviews'
            )

        );
    }

    public function product_detail_add()
    {
        $sizes = Sizes::orderBy('size_number')->get();
        $groups = Groups::orderBy('id')->get();
        $categories = Categories::orderBy('id')->get();
        $subCategories = Categories_Subcategories::orderBy('id')->get();
        return view(
            'adminfrontend.pages.products.product_detail_add',
            compact(
                'sizes',
                'groups',
                'categories',
                'subCategories'
            )
        );
    }

    public function product_detail_store(Request $request)
    {
        //return dd($request->toArray());
        $input  = $request->all();
        $input['product_name'] = ucwords($request->product_name);
        $input['product_colorname'] = ucwords($request->product_colorname);
        //========= Storing data for table products ======//
        if ($request->hasFile('product_imgcover')) {
            $destination_path = 'product_img/imgcover/';
            $image = $request->file('product_imgcover');
            $image_name = $image->getClientOriginalName();
            $fileExt  = $image->getClientOriginalExtension();
            $new_image_name = preg_replace("/\.[^.]+$/", "", $image_name); // remove file extension
            $cnt = count(glob($destination_path . $new_image_name . '*.jpg')); // count the duplicate img in directory
            if (file_exists($destination_path . $image_name)) {
                $image->move($destination_path, $new_image_name . '(' .  $cnt . ')' . '.' . $fileExt);
                $input['product_imgcover'] = $new_image_name . '(' .  $cnt . ')' . '.' . $fileExt;
            } else {
                $image->move($destination_path, $image_name);
                $input['product_imgcover'] = $image_name;
            }
        }
        Products::create($input);
        //=======================================//

        //========= Storing data for table products_imgreviews ======//
        $product = Products::where('product_name', $request->product_name)->latest()->first();
        $productId = $product->id;

        //$imgCount = count($request->product_imgreview);
        if ($file = $request->hasFile('product_imgreview')) {
            $file = $request->file('product_imgreview');
            $destinationPath = 'product_img/imgreview/';
            if (is_array($file)) {
                foreach ($file as $part) {
                    $fileName = $part->getClientOriginalName();
                    $newName = preg_replace("/\.[^.]+$/", "", $fileName); // remove file extension
                    $num = count(glob($destinationPath . $newName . '*.jpg')); // count the duplicate img in directory
                    $fileExt  = $part->getClientOriginalExtension();
                    if (file_exists($destinationPath . $fileName)) {
                        $part->move($destinationPath, $newName . '(' . $num . ')' . '.' . $fileExt);
                        $input['product_imgreview'] = $newName . '(' . $num . ')' . '.' . $fileExt;
                        $input['product_id'] = $productId;
                        Products_Imgreviews::create($input);
                        $num++;
                    } else {
                        $part->move($destinationPath, $newName . '.' . $fileExt);

                        $input['product_imgreview'] = $newName . '.' . $fileExt;
                        $input['product_id'] = $productId;
                        Products_Imgreviews::create($input);
                    }
                }
            }
        }
        //=======================================//
        $total_stock = 0;
        //========= Storing data for table products_sizes ======//
        if ($request->size_id) {
            foreach ($request->size_id as $key => $sizeId) {
                $product->rela_product_size()->create(
                    [
                        'product_id' => $product->id,
                        'size_id' => $sizeId,
                        'size_quantity' => $request->size_quantity[$key] ?? 0
                    ]
                );
                $total_stock += $request->size_quantity[$key] ?? 0;
            }
        }
        // =========== Store Total stock ==================//
        $stock = Products::latest()->first();
        $stock->product_stock = $total_stock;
        $stock->product_stockleft = $total_stock;
        $stock->update();
        //========= Storing data for table products_attributes ======//
        /*
        foreach ($request->group_id as  $row => $value) {
            $group['group_id'] = $value;
            $group['product_id'] = $productId;
            Products_Groups::create($group);
        }
        */
        foreach ($request->group_id as  $row => $value) {
            $attribute['product_id'] = $productId;
            $attribute['subcategory_id'] = $request->subcategory_id;
            $attribute['category_id'] = $request->category_id;
            $attribute['group_id'] = $value;
            Products_Attributes::create($attribute);
        }
        return redirect('/admin/product-detail-add')
            ->with('message', 'Product ' . $request->product_name . ' is added successfully!');

        //return dd($total_stock);
    }


    public function product_detail_edit($id)
    {
        $sizes = Sizes::orderBy('size_number')->get();
        $groups = Groups::orderBy('id')->get();
        $selected_group = Products_Attributes::where('product_id', $id)->get();
        $selected_category = Products_Attributes::where('product_id', $id)->first();
        $categories = Categories::orderBy('id')->get();
        $subCategories = Categories_Subcategories::orderBy('id')->get();
        $products = Products::where('id', $id)->first();
        $imgreviews = Products_Imgreviews::where('product_id', $id)->get();
        return view(
            'adminfrontend.pages.products.product_detail_edit',
            compact(
                'sizes',
                'groups',
                'categories',
                'products',
                'subCategories',
                'selected_group',
                'selected_category',
                'imgreviews'
            )
        );

        //return dd($colors->toArray());
    }

    public function product_detail_update(Request $request, $id)
    {
        //======== Update data on table products ========//
        $update_product  = Products::where('id', $id)->first();
        $update_product->product_name = ucwords($request->input('product_name'));
        $update_product->product_code = $request->input('product_code');
        $update_product->product_des = $request->input('product_des');
        $update_product->product_price = $request->input('product_price');
        $update_product->product_color = $request->input('product_color');
        $update_product->product_colorname = ucwords($request->input('product_colorname'));
        $update_product->product_saleprice = $request->input('product_saleprice');

        //========= Storing new img cover for table products ======//
        if ($request->hasFile('product_imgcover')) {
            $old_img_cover = $update_product->product_imgcover;
            $destination_path = 'product_img/imgcover/';
            if (File::exists(public_path($destination_path .  $old_img_cover))) {
                File::delete(public_path($destination_path .  $old_img_cover));
            }

            $destination_path = 'product_img/imgcover/';
            $image = $request->file('product_imgcover');
            $image_name = $image->getClientOriginalName();
            $fileExt  = $image->getClientOriginalExtension();
            $new_image_name = preg_replace("/\.[^.]+$/", "", $image_name); // remove file extension
            $cnt = count(glob($destination_path . $new_image_name . '*.jpg')); // count the duplicate img in directory
            if (file_exists($destination_path . $image_name)) {
                $image->move($destination_path, $new_image_name . '(' .  $cnt . ')' . '.' . $fileExt);
                $update_product['product_imgcover'] = $new_image_name . '(' .  $cnt . ')' . '.' . $fileExt;
            } else {
                $image->move($destination_path, $image_name);
                $update_product['product_imgcover'] = $image_name;
            }
        }
        $update_product->update();

        //===========================================================//

        //========= Update data for table products_imgreviews ======//
        $productId = $update_product->id;
        $destinationPath = 'product_img/imgreview/';
        //$imgReview = Products_Imgreviews::where('product_id', $productId)->get();
        //===== Delecte old img from DB and Directory ====//
        for ($i = 0; $i < count($request->img_remove); $i++) {
            if ($request->img_remove[$i] != '') {
                $delete_img = Products_Imgreviews::where('id', $request->img_remove[$i])->first();
                $path = 'product_img/imgreview/' . $delete_img->product_imgreview;
                if (File::exists(public_path($path))) {
                    File::delete(public_path($path));
                }
                $delete_img->delete();
            }
        }
        //===== Store new img if upload to DB and Directory ====//
        if ($file = $request->hasFile('product_imgreview')) {
            $file = $request->file('product_imgreview');
            $destinationPath = 'product_img/imgreview/';
            if (is_array($file)) {
                foreach ($file as $part) {
                    $fileName = $part->getClientOriginalName();
                    $newName = preg_replace("/\.[^.]+$/", "", $fileName); // remove file extension
                    $num = count(glob($destinationPath . $newName . '*.jpg')); // count the duplicate img in directory
                    $fileExt  = $part->getClientOriginalExtension();
                    if (file_exists($destinationPath . $fileName)) {
                        $part->move($destinationPath, $newName . '(' . $num . ')' . '.' . $fileExt);
                        $input['product_imgreview'] = $newName . '(' . $num . ')' . '.' . $fileExt;
                        $input['product_id'] = $productId;
                        Products_Imgreviews::create($input);
                        $num++;
                    } else {
                        $part->move($destinationPath, $newName . '.' . $fileExt);

                        $input['product_imgreview'] = $newName . '.' . $fileExt;
                        $input['product_id'] = $productId;
                        Products_Imgreviews::create($input);
                    }
                }
            }

            /*
            if (is_array($file)) {
                foreach ($file as $part) {
                    $filename = $part->getClientOriginalName();
                    $part->move($destinationPath, $filename);

                    $input['product_imgreview'] = $filename;
                    $input['product_id'] = $productId;
                    Products_Imgreviews::create($input);
                }
            }
            */
            //====== Delete imgreview in table Product_imgreview ======/
            /*
                for ($i = 0; $i < count($imgReview); $i++) {
                    $delete_img = Products_Imgreviews::where('product_id', $productId)->first();
                    $path = 'product_img/imgreview/' . $delete_img->product_imgreview;

                    if (File::exists(public_path($path))) {
                        File::delete(public_path($path));
                    }
                    $delete_img->delete();
                }

                $file = $request->file('product_imgreview');
                $destinationPath = 'product_img/imgreview';
                if (is_array($file)) {
                    foreach ($file as $part) {
                        $filename = $part->getClientOriginalName();
                        $part->move($destinationPath, $filename);

                        $input['product_imgreview'] = $filename;
                        $input['product_id'] = $productId;
                        Products_Imgreviews::create($input);
                    }
                }
            */
        }

        //========= Update data for table products_sizes ======//
        $productSize = Products_Sizes::where('product_id', $productId)->get();
        if ($request->size_id) {
            //==== Delete all data on table products_sizes if request has new size_id and value
            for ($i = 0; $i < count($productSize); $i++) {
                $deleteSize = Products_Sizes::where('product_id', $productId)->first();
                $deleteSize->delete();
            }
            $total_stock = 0;
            foreach ($request->size_id as $key => $sizeId) {
                $update_product->rela_product_size()->create(
                    [
                        'product_id' => $update_product->id,
                        'size_id' => $sizeId,
                        'size_quantity' => $request->size_quantity[$key] ?? 0
                    ]
                );
                $total_stock += $request->size_quantity[$key] ?? 0;
            }
        }
        // =========== Update Total stock ==================//
        $stock = Products::where('id', $id)->first();
        $stock->product_stock = $total_stock;
        $stock->product_stockleft = $total_stock;
        $stock->update();

        //=============================================================================//

        //========= Update data for table products_groups ======//
        $deleteGroup = Products_Attributes::where('product_id', $productId)->get();
        foreach ($deleteGroup as $group) {
            $delete_group = Products_Attributes::where('product_id', $group->product_id)->first();
            $delete_group->delete();
        }
        foreach ($request->group_id as  $row => $value) {
            $attribute['group_id'] = $value;
            $attribute['product_id'] = $productId;
            $attribute['subcategory_id'] = $request->subcategory_id;
            $attribute['category_id'] = $request->category_id;
            Products_Attributes::create($attribute);
        }
        return redirect('admin/product-detail-list/show=10/by-name=asc')
            ->with('message', 'Product ' . $request->product_name . ' is updated successfully!');
        //return dd($new_stock);
    }


    public function product_detail_delete($id)
    {
        $delete_product = Products::where('id', $id)->first();
        $delete_product->delete();
        return redirect('admin/product-detail-list/show=10/by-name=asc')
            ->with(
                'message',
                'Product ' . '"' . $delete_product->product_name . '"' .
                    ' is deleted successfully !'
            );
    }

    //============= Update product status ============//
    public function product_detail_status($productId, $statusId)
    {
        $productStatus = Products::where('id', $productId)->first();
        $productStatus['product_status'] = $statusId;
        $productStatus->update();
        return redirect()->back()
            ->with('message', 'Product ' . $productStatus->product_name  . ' updated status successfully !');
    }
}
