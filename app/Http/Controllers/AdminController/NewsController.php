<?php

namespace App\Http\Controllers\AdminController;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{
    public function news_list()
    {
        $news = News::orderByDesc('id')->get();
        $count = 1;
        $search_text = '';
        return view(
            'adminfrontend.pages.news.news_list',
            compact(
                'news',
                'count',
                'search_text'
            )
        );
    }

    public function news_view($id)
    {
        $news = News::where('id', $id)->first();
        return view(
            'adminfrontend.pages.news.news_view',
            compact(
                'news',
            )
        );
    }

    public function news_search()
    {
        $search_text = $_GET['search_news'];
        $news = News::where('news_title', 'LIKE', '%' . $search_text . '%')->get();
        $count = 1;

        return view(
            'adminfrontend.pages.news.news_list',
            compact(
                'news',
                'count',
                'search_text'
            )
        );
    }

    public function news_add()
    {
        return view('adminfrontend.pages.news.news_add');
    }


    public function news_store(Request $request)
    {
        $input  = $request->all();
        if ($request->hasFile('news_img')) {
            $destination_path = 'product_img/imgnews/';
            $image = $request->file('news_img');

            $image_name = $image->getClientOriginalName();
            $image->move($destination_path, $image_name);

            $input['news_img'] = $image_name;
        }
        News::create($input);
        return redirect('admin/news-list')
            ->with('message', 'News & Introducing is added successfully !');
    }

    public function news_edit($id)
    {
        $new = News::where('id', $id)->first();
        return view(
            'adminfrontend.pages.news.news_edit',
            compact(
                'new'
            )
        );
    }


    public function news_update(Request $request, $id)
    {
        $update_news = News::where('id', $id)->first();
        $update_news->news_title = $request->input('news_title');
        $update_news->news_status = $request->input('news_status');
        $update_news->news_content = $request->input('news_content');

        if ($request->hasFile('news_img')) {
            $destination_path = 'product_img/imgnews';
            $image = $request->file('news_img');
            if (File::exists(public_path($destination_path))) {
                File::delete(public_path($destination_path));
            }
            $image_name = $image->getClientOriginalName();
            $image->move($destination_path, $image_name);

            $update_news['news_img'] = $image_name;
        }
        $update_news->update();

        return redirect('admin/news-list')
            ->with(
                'message',
                'News is updated successfully !'
            );
    }


    public function news_update_status($id, $status) {
        $news = News::where('id', $id)->first();
        $news['news_status'] = $status;
        $news->update();
        return redirect()->back()->with(
            'message',
            'News status is updated successfully !'
        );

    }

    
    public function news_delete($id)
    {
        $delete_new = News::where('id', $id)->first();
        $delete_new->delete();

        return redirect('admin/news-list')
            ->with(
                'message',
                'News is deleted successfully !'
            );
    }
}
