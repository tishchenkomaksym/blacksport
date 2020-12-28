<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Role;

class ViewTextTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        DB::table('view_texts')->insert([
            'page_id' => 1,
            'description' => 'Et aperiam repudiandae labore nam itaque. Molestiae ipsa omnis molestias vel eligendi voluptatem. Odio molestiae accusamus est odit fugiat repellat est. Est praesentium pariatur provident eaque et. In hic ullam eius nisi tenetur sed. Fugiat adipisci esse ut velit tempore.',
        ]);

        DB::table('view_texts')->insert([
            'page_id' => 2,
            'description' => 'Et aperiam repudiandae labore nam itaque. Molestiae ipsa omnis molestias vel eligendi voluptatem. Odio molestiae accusamus est odit fugiat repellat est. Est praesentium pariatur provident eaque et. In hic ullam eius nisi tenetur sed. Fugiat adipisci esse ut velit tempore.',
        ]);
    }
}
