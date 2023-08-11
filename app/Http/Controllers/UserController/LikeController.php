<?php

namespace App\Http\Controllers\UserController;

use App\Models\Likes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like()
    {
        $likes = Likes::Where('user_id', Auth::user()->id)->orderByDesc('id')->get();
        $likes_count = $likes->count();
        return view(
            'frontend.mainPages.like',
            compact(
                'likes',
                'likes_count'
            )
        );
    }


    public function add_like($product_id, $user_id)
    {
        if (Auth::check() && Auth::user()->role == 1) {
            $add_like = Likes::where('product_id', $product_id)->where('user_id', $user_id)->first();
            if ($add_like) {
                $add_like->delete();
            } else {
                $add_like['product_id'] = $product_id;
                $add_like['user_id'] = $user_id;
                Likes::create($add_like);
                return redirect()->back()->with(
                    'success',
                    'Product added to favorite successfully.',
                );
            }
            return redirect()->back()->with(
                'success',
                'Product removed from favorite successfully.',
            );
        } else {
            return redirect()->back()->with(
                'info',
                'Please sign in to add product to favorite !',
            );
        }
    }


    public function remove_like($id)
    {
        $removeLike = Likes::where('id', $id)->first();
        $removeLike->delete();

        return redirect()->back()
            ->with(
                'success',
                'Product removed from favorite successfully.',
            );
        //return dd($rowId);
    }


    public function remove_all_like($num)
    {   
        if ($num == 0){
            return redirect()->back()
            ->with(
                'question',
                'remove-all-like/1',
            );
        }else if ($num == 1){
            Likes::where('user_id', Auth::user()->id)->delete();
            return redirect()->back()    
            ->with(
                'success',
                'All products removed from favorite list successfully.',
            );
        //return dd($rowId);
        }
    }
}
