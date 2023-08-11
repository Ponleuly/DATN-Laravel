<?php

namespace App\Http\Controllers\AdminController;

use App\Models\Sizes;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductSizeController extends Controller
{
    
    public function product_size_list()
    {
        $sizes = Sizes::orderBy('size_number', 'desc')->paginate(10);
        $count = 1;
        $search_text = '';
        return view(
            '
                adminfrontend.pages.sizes.product_size_list',
            compact(
                'sizes',
                'count',
                'search_text'
            )
        );
    }


    public function product_size_search()
    {
        $search_text = $_GET['search_size'];
        $sizes = Sizes::where('size_number', 'LIKE', '%' . $search_text . '%')->get();
        $count = 1;
        return view(
            '
                adminfrontend.pages.sizes.product_size_list',
            compact(
                'sizes',
                'count',
                'search_text'
            )
        );
    }
   
    
    public function product_size_add()
    {
        return view('adminfrontend.pages.sizes.product_size_add');
    }

   
    public function product_size_store(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'size_number' => 'required|unique:sizes',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors()->all()
                ]);
            }
            Sizes::create([
                'size_number' => $request->size_number,
            ]);
            $size = Sizes::latest()->first();
            return response()->json([
                'id' => $size->id,
                'size_number' => $size->size_number,
                'message' => 'Size number ' . $size->size_number . ' is added.'
            ]);
        } else {
            $find_size = Sizes::where('size_number', $request->size_number)->first();
            if($find_size){
                return redirect('/admin/product-size-add')
                    ->with('alert', 'Product size ' . '"' .$request->size_number . '"' . ' already existed !');
            }
            $input = $request->all();
            Sizes::create($input);
            return redirect('/admin/product-size-list')
                ->with('message', 'Product size ' . $request->size_number . ' is added successfully!');
        }
    }

    
    public function product_size_edit($id)
    {
        $sizes = Sizes::where('id', $id)->first();

        return view(
            'adminfrontend.pages.sizes.product_size_edit',
            compact('sizes')
        );
    }

   
    public function product_size_update(Request $request, $id)
    {
        $find_size = Sizes::where('size_number', $request->size_number)->first();
            if($find_size){
                return redirect('/admin/product-size-edit/'.$id)
                    ->with('alert', 'Product size ' . '"' .$request->size_number . '"' . ' already existed !');
            }
        $update_size = Sizes::where('id', $id)->first();
        $update_size->size_number = $request->input('size_number');
        $update_size->update();

        return redirect('admin/product-size-list')
            ->with(
                'message',
                'Product size ' . '"' . $update_size->size_number . '"' .
                    ' is updated successfully !'
            );
    }

    
    public function product_size_delete($id)
    {
        $delete_size = Sizes::where('id', $id)->first();
        $delete_size->delete();

        return redirect('admin/product-size-list')
            ->with(
                'message',
                'Product size ' . '"' . $delete_size->size_number . '"' .
                    ' is deleted successfully !'
            );
    }
}
