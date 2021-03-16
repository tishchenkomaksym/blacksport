<?php

use Illuminate\Database\Seeder;

class PageTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        DB::table('pages')->insert([
            'name' => 'О нас',
            'page_key' => 'home',
            'meta_description' => 'Et aperiam repudiandae labore nam itaque. Molestiae ipsa omnis molestias vel eligendi voluptatem. Odio molestiae accusamus est odit fugiat repellat est. Est praesentium pariatur provident eaque et. In hic ullam eius nisi tenetur sed. Fugiat adipisci esse ut velit tempore.',
            'noindex' => false,
            'nofollow' => false
        ]);

        DB::table('pages')->insert([
            'name' => 'Сделано',
            'page_key' => 'made',
            'meta_description' => 'Et aperiam repudiandae labore nam itaque. Molestiae ipsa omnis molestias vel eligendi voluptatem. Odio molestiae accusamus est odit fugiat repellat est. Est praesentium pariatur provident eaque et. In hic ullam eius nisi tenetur sed. Fugiat adipisci esse ut velit tempore.',
            'noindex' => false,
            'nofollow' => false
        ]);

        DB::table('pages')->insert([
            'name' => 'Partner',
            'page_key' => 'partners',
            'meta_description' => 'Et aperiam repudiandae labore nam itaque. Molestiae ipsa omnis molestias vel eligendi voluptatem. Odio molestiae accusamus est odit fugiat repellat est. Est praesentium pariatur provident eaque et. In hic ullam eius nisi tenetur sed. Fugiat adipisci esse ut velit tempore.',
            'noindex' => false,
            'nofollow' => false
        ]);

        DB::table('pages')->insert([
            'name' => 'Ambassador',
            'page_key' => 'ambassadors',
            'meta_description' => 'Et aperiam repudiandae labore nam itaque. Molestiae ipsa omnis molestias vel eligendi voluptatem. Odio molestiae accusamus est odit fugiat repellat est. Est praesentium pariatur provident eaque et. In hic ullam eius nisi tenetur sed. Fugiat adipisci esse ut velit tempore.',
            'noindex' => false,
            'nofollow' => false
        ]);

        DB::table('pages')->insert([
            'name' => 'Правила и условия',
            'page_key' => 'terms_conditions',
            'meta_description' => 'Et aperiam repudiandae labore nam itaque. Molestiae ipsa omnis molestias vel eligendi voluptatem. Odio molestiae accusamus est odit fugiat repellat est. Est praesentium pariatur provident eaque et. In hic ullam eius nisi tenetur sed. Fugiat adipisci esse ut velit tempore.',
            'noindex' => false,
            'nofollow' => false
        ]);

        DB::table('pages')->insert([
            'name' => 'Правила возврата средств',
            'page_key' => 'refund_policy',
            'meta_description' => 'Et aperiam repudiandae labore nam itaque. Molestiae ipsa omnis molestias vel eligendi voluptatem. Odio molestiae accusamus est odit fugiat repellat est. Est praesentium pariatur provident eaque et. In hic ullam eius nisi tenetur sed. Fugiat adipisci esse ut velit tempore.',
            'noindex' => false,
            'nofollow' => false
        ]);
    }
}
