<?php

namespace App\Http\Controllers\AdminController;

use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{

    public function general_setting()
    {
        $settings = Settings::orderBy('id')->get();
        $count = 1;
        return view(
            'adminfrontend.pages.settings.general_setting',
            compact(
                'count',
                'settings'
            )
        );
    }


    public function general_layout()
    {

        return view(
            'adminfrontend.pages.settings.general_layout',
        );
    }

    
    public function general_setting_edit()
    {
        $settings = Settings::all()->first();
        return view(
            'adminfrontend.pages.settings.general_setting_edit',
            compact(
                'settings'
            )
        );
    }


    public function general_setting_update(Request $request)
    {
        $update_setting = Settings::all()->first();
        $update_setting->website_name = $request->input('website_name');
        $update_setting->home_pageSlogan = $request->input('home_pageSlogan');
        $update_setting->home_pageText = $request->input('home_pageText');
        $update_setting->facebook_link = $request->input('facebook_link');
        $update_setting->instagram_link = $request->input('instagram_link');
        $update_setting->youtube_link = $request->input('youtube_link');
        $update_setting->tiktok_link = $request->input('tiktok_link');

        if ($request->hasFile('home_pageImage')) {
            $destination_path = 'product_img/imghomepage';
            $image = $request->file('home_pageImage');
            if (File::exists(public_path($destination_path))) {
                File::delete(public_path($destination_path));
            }
            $image_name = $image->getClientOriginalName();
            $image->move($destination_path, $image_name);
            $update_setting['home_pageImage'] = $image_name;
        }
        if ($request->hasFile('section_pageImage')) {
            $destination_path = 'product_img/imghomepage';
            $image = $request->file('section_pageImage');
            if (File::exists(public_path($destination_path))) {
                File::delete(public_path($destination_path));
            }
            $image_name = $image->getClientOriginalName();
            $image->move($destination_path, $image_name);
            $update_setting['section_pageImage'] = $image_name;
        }
        $update_setting->update();
        return redirect('admin/general-setting')
            ->with(
                'message',
                'General Settings is updated successfully !'
            );
    }
}
