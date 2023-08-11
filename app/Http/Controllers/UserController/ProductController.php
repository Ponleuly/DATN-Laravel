<?php

namespace App\Http\Controllers\UserController;

use App\Models\Groups;
use App\Models\Products;
use App\Models\Products_Imgreviews;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\Products_Sizes;
use App\Models\Products_Attributes;
use App\Http\Controllers\Controller;
use App\Models\Categories_Subcategories;

class ProductController extends Controller
{

    public function shop()
    {
        $allProducts = Products::orderByDesc('id')->paginate(8);
        return view(
            'frontend.product.shop',
            compact('allProducts')
        );
    }


    public function product($group)
    {
        $groupName = Groups::where('group_name', ucfirst($group))->first();
        $groupId = $groupName->id;
        $group_name = $groupName->group_name;
        $productGroups = Products_Attributes::where('group_id', $groupId)->paginate('8');
        return view(
            'frontend.product.product',
            compact('productGroups', 'group_name')
        );
        //return dd($productGroups);
    }


    public function product_detail($code)
    {
        $productDetails = Products::where('product_code', $code)->first();
        $productId = $productDetails->id;

        $productSizes = Products_Sizes::where('product_id', $productId)->get();
        $productGroups = Products_Attributes::where('product_id', $productId)->get();
        $productAttribute = Products_Attributes::where('product_id', $productId)->first();
        $sizeStock = 0;
        $headCode = trim($code, "0..9");
        $productCode = Products::where('product_code', 'LIKE', '%' . $headCode . '%')->get();

        // Join table Product and Products_Imgreviews to get all images reviews with the same product_code
        $allImgReviews = Products::join('Products_Imgreviews', 'products_imgreviews.product_id', '=', 'products.id')
            ->where('products.product_code', 'LIKE', '%' . $headCode . '%')
            ->get(['products_imgreviews.*']);
        $imgReviews = Products_Imgreviews::where('product_id', $productId)->orderBy('id', 'desc')->get();
        foreach ($productSizes as $row) {
            $sizeStock += $row->size_quantity;
        }
        $stockLeft = $sizeStock;
        // if(is_null($productDetails)){
        //     return abort(404);
        // }
        return view(
            'frontend.product.product_detail',
            compact(
                'productDetails',
                'stockLeft',
                'productCode',
                'productGroups',
                'productSizes',
                'productAttribute',
                'imgReviews',
                'allImgReviews'
            )
        );
    }


    public function product_category($category)
    {
        if ($category == 'new-featured') {
            //=== Get new product and sale off pruduct that have saleprice < price
            $products = Products::where('product_status', 1)
                ->orWhereColumn('product_price', '>', 'product_saleprice')->paginate(8);
            $category_name = 'New & Featured';
            return view(
                'frontend.product.product_new_featured',
                compact(
                    'products',
                    'category_name'
                )
            );
        } else {
            $categoryName = Categories::where('category_name', ucfirst($category))->first();
            $categoryId = $categoryName->id;
            $products = Products_Attributes::where('category_id', $categoryId)
                ->distinct('product_id')->paginate('8', 'product_id');
            $category_name = $categoryName->category_name;
            return view(
                'frontend.product.product_category',
                compact(
                    'products',
                    'category_name'
                )
            );
        }


        //return dd($products->toArray());
    }

    public function product_subcategory($sub)
    {
        if ($sub == 'new-arrival') {
            //=== Get new product
            $products = Products::where('product_status', 1)->paginate(8);
            $category_name = 'New Arrival';
            return view(
                'frontend.product.product_new_featured',
                compact(
                    'products',
                    'category_name'
                )
            );
        } elseif ($sub == 'sale-off') {
            //=== Get sale off pruduct that have saleprice < price
            $products = Products::whereColumn('product_price', '>', 'product_saleprice')->paginate(8);
            $category_name = 'Sale Off';
            return view(
                'frontend.product.product_new_featured',
                compact(
                    'products',
                    'category_name'
                )
            );
        } else {
            $subName = Categories_Subcategories::where('sub_category', ucfirst($sub))->first();
            $subId = $subName->id;
            $products = Products_Attributes::where('subcategory_id', $subId)
                ->distinct('product_id')->paginate('8', 'product_id');
            $sub_name = $subName->sub_category;

            return view(
                'frontend.product.product_subcategory',
                compact(
                    'products',
                    'sub_name'
                )
            );
        }

        //return dd($products->toArray());
    }


    public function product_group_category($group, $category)
    {
        $groupName = Groups::where('group_name', ucfirst($group))->first();
        $groupId = $groupName->id;

        $categoryName = Categories::where('category_name', ucfirst($category))->first();
        $categoryId = $categoryName->id;
        $group_categories = Products_Attributes::where('group_id', $groupId)
            ->where('category_id', $categoryId)->paginate(8);

        $group_name = $groupName->group_name;
        $category_name = $categoryName->category_name;

        return view(
            'frontend.product.product_group_category',
            compact(
                'group_categories',
                'group_name',
                'category_name'
            )
        );
        //return dd($subcategoryName);
    }


    public function product_group_subcategory($group, $category, $subcategory)
    {
        $groupName = Groups::where('group_name', ucfirst($group))->first();
        $groupId = $groupName->id;

        $categoryName = Categories::where('category_name', ucfirst($category))->first();
        $categoryId = $categoryName->id;

        $subcategoryName = Categories_Subcategories::where('sub_category', ucfirst($subcategory))->first();
        $subcategoryId = $subcategoryName->id;

        $productSubcategory = Products_Attributes::where('group_id', $groupId)
            ->where('category_id', $categoryId)
            ->where('subcategory_id', $subcategoryId)
            ->paginate('8');

        $group_name = $groupName->group_name;
        $category_name = $categoryName->category_name;
        $subcategory_name = $subcategoryName->sub_category;

        return view(
            'frontend.product.product_group_subcategory',
            compact(
                'productSubcategory',
                'group_name',
                'category_name',
                'subcategory_name'
            )
        );
        //return dd($subcategoryName);
    }
}
