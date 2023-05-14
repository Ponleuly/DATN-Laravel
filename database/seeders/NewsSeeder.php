<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news')->insert([
            [
                'id' => 1,
                'news_title' => 'VULCANIZED SHOES',
                'news_content' => '
                                <p><strong>(1) Vamp:</strong> toe - the part located in front of the shoe, in contact with the toe.&nbsp;</p>
                                <p><strong>(2) Tongue:</strong> commonly known with the pure Vietnamese name of the reed. This is the upper part of the foot and is connected to the top of the Vamp.&nbsp;</p>
                                <p><strong>(3) Stamp: </strong>the pineapple logo stamp is sewn or heat pressed directly on the tongue.&nbsp;</p>
                                <p><strong>(4) Eyestays:</strong> is the part that contains 2 rows of eyelet holes. In manufacturing, this part is known as an oz brace. Shoes may or may not have a brace, depending on the intent of the design.&nbsp;</p>
                                <p><strong>(5) Eyelets:</strong> located on the Eyestays, Eyelets is the word used to refer to the eyelet, if there are eyelets attached, the Eyelets are also known as the buttonhole.</p>
                                <p><strong>(6) Stitching:</strong> the stitches both have the effect of attaching the parts together and have a decorative effect.</p>
                                <p><strong>(7) Laces: </strong>shoelaces - a very familiar component and can be changed easily.</p>',
                'news_img' => 'news_4.jpg',
                'news_status' => 0,
                'created_at' => Carbon::now()
            ],
            [
                'id' => 2,
                'news_title' => 'VINTAS SAIGON 1980s',
                'news_content' => fake()->text($maxNbChars = 450),
                'news_img' => 'news_2.jpg',
                'news_status' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'id' => 3,
                'news_title' => 'URBAS CORLURAY PACK',
                'news_content' => fake()->text($maxNbChars = 450),
                'news_img' => 'news_3.jpg',
                'news_status' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'id' => 4,
                'news_title' => 'SNEAKER FEST VIETNAM',
                'news_content' => fake()->text($maxNbChars = 450),
                'news_img' => 'news_1.jpg',
                'news_status' => 1,
                'created_at' => Carbon::now()
            ],

        ]);
    }
}
