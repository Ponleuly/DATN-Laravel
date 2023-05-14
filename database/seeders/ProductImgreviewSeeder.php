<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductImgreviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $j = 1;
        $k = 1;
        $x = 1;
        for ($i = 1; $i <= 12; $i++) {
            DB::table('products_imgreviews')->insert([
                [
                    'id' => $i,
                    'product_imgreview' => 'Pro_ba000' . $j . '_' . $k++ . '.jpg',
                    'product_id' => $x,
                    'created_at' => Carbon::now()
                ],
            ]);
            if ($i == $j * 4) $j++;
            if ($k == 5) $k = 1;
            if ($i == $x * 4) $x++;
        }
        //===========================================//
        $b = 1;
        $c = 1;
        $d = 4;
        for ($a = 13; $a <= 24; $a++) {
            DB::table('products_imgreviews')->insert([
                [
                    'id' => $a,
                    'product_imgreview' => 'Pro_va000' . $b . '_' . $c++ . '.jpg',
                    'product_id' => $d,
                    'created_at' => Carbon::now()
                ],
            ]);
            if ($a == $d * 4) $b++;
            if ($c == 5) $c = 1;
            if ($a == $d * 4) $d++;
        }
        //===========================================//
        $b = 1;
        $c = 1;
        $d = 7;
        for ($a = 25; $a <= 40; $a++) {
            DB::table('products_imgreviews')->insert([
                [
                    'id' => $a,
                    'product_imgreview' => 'Pro_ua000' . $b . '_' . $c++ . '.jpg',
                    'product_id' => $d,
                    'created_at' => Carbon::now()
                ],
            ]);
            if ($a == $d * 4) $b++;
            if ($c == 5) $c = 1;
            if ($a == $d * 4) $d++;
        }
        //===========================================//
        $b = 1;
        $c = 1;
        $d = 11;
        for ($a = 41; $a <= 52; $a++) {
            DB::table('products_imgreviews')->insert([
                [
                    'id' => $a,
                    'product_imgreview' => 'Pro_pa000' . $b . '_' . $c++ . '.jpg',
                    'product_id' => $d,
                    'created_at' => Carbon::now()
                ],
            ]);
            if ($a == $d * 4) $b++;
            if ($c == 5) $c = 1;
            if ($a == $d * 4) $d++;
        }


        //===========================================//
        $b = 1;
        $c = 1;
        $d = 14;
        for ($a = 53; $a <= 64; $a++) {
            DB::table('products_imgreviews')->insert([
                [
                    'id' => $a,
                    'product_imgreview' => 'Pro_hac000' . $b . '_' . $c++ . '.jpg',
                    'product_id' => $d,
                    'created_at' => Carbon::now()
                ],
            ]);
            if ($a == $d * 4) $b++;
            if ($c == 5) $c = 1;
            if ($a == $d * 4) $d++;
        }
    }
}
