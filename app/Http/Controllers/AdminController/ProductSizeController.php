<?php

namespace App\Http\Controllers\AdminController;

use App\Models\Sizes;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function product_size_list()
    {
        $sizes = Sizes::orderBy('size_number')->paginate(8);
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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function product_size_add()
    {
        return view('adminfrontend.pages.sizes.product_size_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            $input = $request->all();
            Sizes::create($input);
            return redirect('/admin/product-size-add')
                ->with('message', 'Product size ' . $request->size_number . ' is added successfully!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function product_size_edit($id)
    {
        $sizes = Sizes::where('id', $id)->first();

        return view(
            'adminfrontend.pages.sizes.product_size_edit',
            compact('sizes')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function product_size_update(Request $request, $id)
    {
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
