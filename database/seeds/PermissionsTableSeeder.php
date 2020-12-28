<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $keys = [
            'browse_admin',
            'browse_bread',
            'browse_database',
            'browse_media',
            'browse_compass',
        ];

        foreach ($keys as $key) {
            Permission::firstOrCreate([
                'key'        => $key,
                'table_name' => null,
            ]);
        }

        Permission::generateFor('menus');

        Permission::generateFor('roles');

        Permission::generateFor('users');

        Permission::generateFor('settings');

        Permission::generateFor('ambassadors');
        Permission::generateFor('categories');
        Permission::generateFor('contacts');
        Permission::generateFor('news');
        Permission::generateFor('orders');
        Permission::generateFor('pages');
        Permission::generateFor('partners');
        Permission::generateFor('services');
        Permission::generateFor('products');
        Permission::generateFor('programs');
        Permission::generateFor('view_texts');
        Permission::generateFor('view_texts_images');
        Permission::generateFor('services_examples');

    }
}
