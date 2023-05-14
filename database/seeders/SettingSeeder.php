<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'id' => 1,
                'website_name' => '15Steps',
                'home_pageSlogan' => 'Stylish comfortable quality',
                'home_pageText' => 'Bring you the most stylish and newest shoes. For the young generation who are passionated with modern and diverse styles.',
                'home_pageImage' => 'home_pageImage.png',
                'section_pageImage' => 'new_feature.jpg',
                'facebook_link' => 'https://www.facebook.com/AllofEntertainment',
                'instagram_link' => 'https://www.instagram.com/_callme_ponleu_15_',
                'youtube_link' => 'https://www.youtube.com/channel/UCShcp6skfqHU6eTsTQ1Te_g',
                'tiktok_link' => null,
                'created_at' => Carbon::now()
            ],
        ]);
    }
}
