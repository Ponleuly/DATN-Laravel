<?php

namespace App\Http\Controllers\AdminController;

use App\Models\Groups;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\Categories_Groups;
use App\Http\Controllers\Controller;
use App\Models\Categories_Subcategories;
use Illuminate\Support\Facades\File;

class ProductCategoryController extends Controller
{
    
    public function product_category_list()
    {
        $categories = Categories::orderBy('category_name')->get();
        $search_text = '';
        $count = 1;
        return view(
            'adminfrontend.pages.categories.product_category_list',
            compact(
                'categories',
                'count',
                'search_text'
            )
        );
    }


    public function product_category_search()
    {
        $search_text = $_GET['search_category'];
        $categories = Categories::where('category_name', 'LIKE', '%' . $search_text . '%')->get();
        $count = 1;
        return view(
            'adminfrontend.pages.categories.product_category_list',
            compact(
                'categories',
                'count',
                'search_text'
            )
        );
    }


    public function product_subcategory_list()
    {
        $subcategories = Categories_Subcategories::orderBy('id')->paginate(8);
        $count = 1;
        $search_text = '';
        return view(
            'adminfrontend.pages.categories.product_subcategory_list',
            compact(
                'subcategories',
                'search_text',
                'count',
            )
        );
    }


    public function product_subcategory_search()
    {
        $search_text = $_GET['search_subcategory'];
        $subcategories = Categories_Subcategories::where('sub_category', 'LIKE', '%' . $search_text . '%')->get();;
        $count = 1;
        return view(
            'adminfrontend.pages.categories.product_subcategory_list',
            compact(
                'subcategories',
                'count',
                'search_text'
            )
        );
    }


    public function product_category_view($id)
    {
        $category = Categories::where('id', $id)->first();
        $groups = Categories_Groups::where('category_id', $id)->get();
        $subCategories = Categories_Subcategories::where('category_id', $id)->get();

        return view(
            'adminfrontend.pages.categories.product_category_view',
            compact(
                'category',
                'groups',
                'subCategories'
            )
        );
    }
    

    public function product_category_add()
    {
        $groups = Groups::orderBy('id')->get();
        $groups_count = Groups::all()->count();

        return view(
            'adminfrontend.pages.categories.product_category_add',
            compact('groups', 'groups_count')
        );
    }

    
    public function product_category_store(Request $request)
    {
        $category_cmp = Categories::where('category_name', ucfirst($request->category_name))->first();
        if($category_cmp){
            return redirect('/admin/product-category-add')
                    ->with('alert', 'Product catrgory ' . '"' .ucfirst($request->category_name) . '"' . ' already existed !');
        }else{
            $input = $request->all();
            if ($request->hasFile('category_img')) {
                $destination_path = 'product_img/imgcategory/';
                $image = $request->file('category_img');

                $image_name = $image->getClientOriginalName();
                $image->move($destination_path, $image_name);

                $input['category_img'] = $image_name;
            }
            // Storing category_name data to table categories
            $input['category_name'] = ucfirst($request->category_name);
            Categories::create($input);

            // Storing category_id and group_id to table product_group_cate
            $category = Categories::latest()->first();
            $categoryId = $category->id; 
            $groupId = $request->group_id;
            for ($i = 0; $i < count($groupId); $i++) {
                $save['category_id'] = $categoryId;
                $save['group_id'] = $groupId[$i];
                Categories_Groups::create($save);
            }
            if($request->sub_category != null){
                $subCategory = explode(',', $request->sub_category);
                for ($j = 0; $j < count($subCategory); $j++) {
                    $sub['category_id'] = $categoryId;
                    $sub['sub_category'] = $subCategory[$j];
                    Categories_Subcategories::create($sub);
                }
            }
            // After inputed -> go back to category pages
            return redirect('/admin/product-category-list')
                ->with('message', 'Product category ' . $request->category_name . ' successfully!');
            }
        //return dd($explode_id);
    }

    
    public function product_category_edit($id)
    {
        $category = Categories::where('id', $id)->first();
        $groups_count = Groups::all()->count();
        $groups = Groups::orderBy('id')->get();

        $categoryId = $category->id;
        $selected_group = Categories_Groups::where('category_id', $categoryId)->get();
        $subCategory = Categories_Subcategories::where('category_id', $id)->get();
        return view(
            'adminfrontend.pages.categories.product_category_edit',
            compact(
                'category',
                'categoryId',
                'groups_count',
                'groups',
                'selected_group',
                'subCategory'
            )
        );

        //return dd($subCategory->toArray());
    }

    
    public function product_category_update(Request $request, $id)
    {
       

            $update_category_name = Categories::where('id', $id)->first();
            $update_category_name->category_name = ucfirst($request->input('category_name'));
            if ($request->hasFile('category_img')) {
                $destination_path = 'product_img/imgcategory';
                $image = $request->file('category_img');
                if (File::exists(public_path($destination_path))) {
                    File::delete(public_path($destination_path));
                }
                $image_name = $image->getClientOriginalName();
                $image->move($destination_path, $image_name);

                $update_category_name['category_img'] = $image_name;
            }
            $update_category_name->update();

            $categoryId = $update_category_name->id;
            $category_count = Categories_Groups::where('category_id', $categoryId)->count();
            //===== Table categories_groups =====///
            for ($i = 0; $i < $category_count; $i++) {
                $delete_cate = Categories_Groups::where('category_id', $categoryId)->first();
                $delete_cate->delete();
            }

            $categoryId = $update_category_name->id;
            $groupId = $request->group_id;
            for ($i = 0; $i < count($groupId); $i++) {

                $update['category_id'] = $categoryId;
                $update['group_id'] = $groupId[$i];
                Categories_Groups::create($update);
            }
            //================================================//

            //===== Table categories_subcategories =====///
            $subcategory_count = Categories_Subcategories::where('category_id', $categoryId)->get();
            foreach ($subcategory_count as $row) {
                $delete_sub = Categories_Subcategories::where('category_id', $row->category_id)->first();
                $delete_sub->delete();
            }
            $sub_request = explode(',', $request->sub_category);
            $subCategory = preg_replace('/\s+/', '', $sub_request); // eliminate whitespace from input form

            for ($j = 0; $j < count($subCategory); $j++) {
                $sub['category_id'] = $categoryId;
                $sub['sub_category'] = $subCategory[$j];
                Categories_Subcategories::create($sub);
            }

            return redirect('/admin/product-category-list')
                ->with(
                    'message',
                    'Product category ' . '"' . $update_category_name->category_name . '"' .
                        ' is updated successfully !'
                );
    }

    
    public function product_category_delete($id)
    {
        $delete_category = Categories::where('id', $id)->first();
        $delete_category->delete();

        return redirect('/admin/product-category-list')
            ->with(
                'message',
                'Product category ' . '"' . $delete_category->category_name . '"' .
                    ' is deleted successfully !'
            );
    }
}
