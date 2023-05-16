<?php

namespace App\Http\Controllers\UserController;

use App\Models\Products;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Subscribers;

class HomeController extends Controller
{
    public function home()
    {
        $newProducts = Products::where('product_status', 1)->paginate(6);
        $categories = Categories::orderBy('id')->get();
        $news = News::where('news_status', 1)->get();
        $newProduct_count = $newProducts->count();
        return view(
            'frontend.mainPages.home',
            compact(
                'newProducts',
                'categories',
                'newProduct_count',
                'news'
            )
        );
    }

    public function subscriber_store(Request $request)
    {
        $input  = $request->all();
        Subscribers::create($input);
        return redirect()->route('home')
            ->with('success', 'You subscribered to get email from shop !');
    }

    public function search_product()
    {
        $search_text = $_GET['search_product'];
        $search_products = Products::where('product_name', 'LIKE', '%' . $search_text . '%')->get();
        return view(
            'frontend.mainPages.search_product',
            compact(
                'search_products',
                'search_text'
            )
        );
    }
}
