<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;

class DataRowsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $userDataType = DataType::where('slug', 'users')->firstOrFail();
        $menuDataType = DataType::where('slug', 'menus')->firstOrFail();
        $roleDataType = DataType::where('slug', 'roles')->firstOrFail();

        $dataRow = $this->dataRow($userDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('voyager::seeders.data_rows.id'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.name'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'email');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.email'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'password');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'password',
                'display_name' => __('voyager::seeders.data_rows.password'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'remember_token');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.remember_token'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.created_at'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.updated_at'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 7,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'avatar');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => __('voyager::seeders.data_rows.avatar'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 8,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'user_belongsto_role_relationship');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'relationship',
                'display_name' => __('voyager::seeders.data_rows.role'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => [
                    'model'       => 'TCG\\Voyager\\Models\\Role',
                    'table'       => 'roles',
                    'type'        => 'belongsTo',
                    'column'      => 'role_id',
                    'key'         => 'id',
                    'label'       => 'display_name',
                    'pivot_table' => 'roles',
                    'pivot'       => 0,
                ],
                'order'        => 10,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'user_belongstomany_role_relationship');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'relationship',
                'display_name' => 'Roles',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => [
                    'model'       => 'TCG\\Voyager\\Models\\Role',
                    'table'       => 'roles',
                    'type'        => 'belongsToMany',
                    'column'      => 'id',
                    'key'         => 'id',
                    'label'       => 'display_name',
                    'pivot_table' => 'user_roles',
                    'pivot'       => '1',
                    'taggable'    => '0',
                ],
                'order'        => 11,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'settings');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'hidden',
                'display_name' => 'Settings',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 12,
            ])->save();
        }

        $dataRow = $this->dataRow($menuDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('voyager::seeders.data_rows.id'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($menuDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.name'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($menuDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.created_at'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($menuDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.updated_at'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($roleDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('voyager::seeders.data_rows.id'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($roleDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.name'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($roleDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.created_at'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($roleDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.updated_at'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($roleDataType, 'display_name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.display_name'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'role_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.role'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 9,
            ])->save();
        }


        $ambassadorsDataType = DataType::where('slug', 'ambassadors')->firstOrFail();

        /*
         4	id	text	Id	1	0	0	0	0	0	{}	1
4	description	text_area	Описание	1	1	1	1	1	1	{}	2
4	image	text	Картинка	0	1	1	1	1	1	{}	3
4	created_at	timestamp	Created At	0	1	1	1	0	1	{}	4
4	updated_at	timestamp	Updated At	0	0	0	0	0	0	{}	5

         * */

        $dataRow = $this->dataRow($ambassadorsDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '{}',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($ambassadorsDataType, 'description');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'Описание',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($ambassadorsDataType, 'image');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'Картинка',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($ambassadorsDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Created At',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($ambassadorsDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Updated At',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '{}',
                'order'        => 5,
            ])->save();
        }

        $categoriesDataType = DataType::where('slug', 'categories')->firstOrFail();

        /*
         * 5	id	text	Id	1	0	0	0	0	0	{}	1
5	name	text	Название	1	1	1	1	1	1	{}	2
5	url	text	url	1	1	1	1	1	1	{}	3
5	image	text	Картинка	0	1	1	1	1	1	{}	4
5	created_at	timestamp	Created At	0	1	1	1	0	1	{}	5
5	updated_at	timestamp	Updated At	0	0	0	0	0	0	{}	6
*/
        $dataRow = $this->dataRow($categoriesDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '{}',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($categoriesDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Название',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($categoriesDataType, 'url');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'url',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($categoriesDataType, 'image');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'Картинка',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($categoriesDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Created At',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($categoriesDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Updated At',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '{}',
                'order'        => 6,
            ])->save();
        }

        $contactDataType = DataType::where('slug', 'contacts')->firstOrFail();

        /*
         * 6	id	text	Id	1	0	0	0	0	0	{}	1
6	phone	text	Телефон	0	1	1	1	1	1	{}	2
6	email	text	Email	0	1	1	1	1	1	{}	3
6	social_links	text_area	Социальные ссылки	0	1	1	1	1	1	{}	4
6	address	text	Адрес	0	1	1	1	1	1	{}	5
6	created_at	timestamp	Created At	0	1	1	1	0	1	{}	6
6	updated_at	timestamp	Updated At	0	0	0	0	0	0	{}	7

*/

        $dataRow = $this->dataRow($contactDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '{}',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($contactDataType, 'phone');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Телефон',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($contactDataType, 'email');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Email',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($contactDataType, 'social_links');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'Социальные ссылки',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($categoriesDataType, 'address');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Адркс',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($contactDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Created At',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($contactDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Updated At',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '{}',
                'order'        => 7,
            ])->save();
        }

        $newsDataType = DataType::where('slug', 'news')->firstOrFail();

        /*
         * 7	id	text	Id	1	0	0	0	0	0	{}	1
7	title	text	Название	1	1	1	1	1	1	{}	2
7	description	text_area	Описание	1	1	1	1	1	1	{}	3
7	images	text	Картинки	0	1	1	1	1	1	{}	4
7	created_at	timestamp	Created At	0	1	1	1	0	1	{}	5
7	updated_at	timestamp	Updated At	0	0	0	0	0	0	{}	6
7	published	text	Published	1	1	1	1	1	1	{}	7
*/

        $dataRow = $this->dataRow($newsDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '{}',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($newsDataType, 'title');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Название',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($newsDataType, 'description');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'Описание',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($newsDataType, 'images');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'images',
                'display_name' => 'Картинки',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($newsDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Created At',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($newsDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Updated At',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '{}',
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($newsDataType, 'published');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Published',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 7,
            ])->save();
        }

        $ordersDataType = DataType::where('slug', 'orders')->firstOrFail();
        /*
         * 8	id	text	Id	1	0	0	0	0	0	{}	1
8	products	text_area	Товары	1	1	1	1	1	1	{}	2
8	is_paid	checkbox	Оплачено	1	1	1	1	1	1	{}	3
8	delivery	text	Доставка	1	1	1	1	1	1	{}	4
8	created_at	timestamp	Created At	0	1	1	1	0	1	{}	5
8	updated_at	timestamp	Updated At	0	0	0	0	0	0	{}	6
*/

        $dataRow = $this->dataRow($ordersDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '{}',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'products');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'Товары',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'is_paid');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'checkbox',
                'display_name' => 'Оплачено',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'delivery');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Доставка',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Created At',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Updated At',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '{}',
                'order'        => 6,
            ])->save();
        }


        $pageDataType = DataType::where('slug', 'pages')->firstOrFail();
        /*
9	id	text	Id	1	0	0	0	0	0	{}	1
9	name	text	Название	1	1	1	1	1	1	{}	2
9	page_key	text	Page Key	1	0	0	0	0	1	{}	3
9	meta_description	text_area	мета описание	1	1	1	1	1	1	{}	4
9	noindex	checkbox	Noindex	1	1	1	1	1	1	{}	5
9	nofollow	checkbox	Nofollow	1	1	1	1	1	1	{}	6
9	created_at	timestamp	Created At	0	1	1	1	0	1	{}	7
9	updated_at	timestamp	Updated At	0	0	0	0	0	0	{}	8

*/

        $dataRow = $this->dataRow($pageDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '{}',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($pageDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Название',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($pageDataType, 'page_key');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Page Key',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($pageDataType, 'meta_description');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'мета описание',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($pageDataType, 'noindex');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'checkbox',
                'display_name' => 'Noindex',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($pageDataType, 'nofollow');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'checkbox',
                'display_name' => 'Nofollow',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($pageDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Created At',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 7,
            ])->save();
        }

        $dataRow = $this->dataRow($pageDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Updated At',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '{}',
                'order'        => 8,
            ])->save();
        }

        $partnerDataType = DataType::where('slug', 'partners')->firstOrFail();

        /*
10	id	text	Id	1	0	0	0	0	0	{}	1
10	created_at	timestamp	Created At	0	1	1	1	0	1	{}	2
10	updated_at	timestamp	Updated At	0	0	0	0	0	0	{}	3
10	description	text_area	Описание	1	1	1	1	1	1	{}	4
10	image	text	Картинка	0	1	1	1	1	1	{}	5

*/

        $dataRow = $this->dataRow($partnerDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '{}',
                'order'        => 1,
            ])->save();
        }


        $dataRow = $this->dataRow($partnerDataType, 'description');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'Описание',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 2,
            ])->save();
        }


        $dataRow = $this->dataRow($partnerDataType, 'image');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'Картинка',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($partnerDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Created At',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($partnerDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Updated At',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '{}',
                'order'        => 5,
            ])->save();
        }

        $serviceDataType = DataType::where('slug', 'services')->firstOrFail();

        /*
11	id	text	Id	1	0	0	0	0	0	{}	1
11	name	text	Название	1	1	1	1	1	1	{}	2
11	description	text	Описание	1	1	1	1	1	1	{}	3
11	created_at	timestamp	Created At	0	1	1	1	0	1	{}	4
11	updated_at	timestamp	Updated At	0	0	0	0	0	0	{}	5


*/

        $dataRow = $this->dataRow($serviceDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '{}',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($serviceDataType, 'image');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'Картинка',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($serviceDataType, 'description');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'Описание',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 3,
            ])->save();
        }


        $dataRow = $this->dataRow($serviceDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Created At',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($serviceDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Updated At',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '{}',
                'order'        => 5,
            ])->save();
        }

        $productDataType = DataType::where('slug', 'products')->firstOrFail();

        /*
12	id	text	Id	1	0	0	0	0	0	{}	1
12	title	text	Название	1	1	1	1	1	1	{}	2
12	description	text_area	Описание	1	1	1	1	1	1	{}	3
12	specifications	text_area	Спецификации	1	1	1	1	1	1	{}	4
12	price	number	Цена	1	1	1	1	1	1	{}	5
12	image	text	Картинка	1	1	1	1	1	1	{}	6
12	category_id	text	Category Id	1	0	0	0	0	0	{}	7
12	order_count	text	Количество купленного товара	1	1	1	1	1	1	{}	8
12	created_at	timestamp	Created At	0	1	1	1	0	1	{}	9
12	updated_at	timestamp	Updated At	0	0	0	0	0	0	{}	10
12	product_belongsto_category_relationship	relationship	Категория	0	1	1	1	1	1	{"model":"\\App\\Models\\Category","table":"categories","type":"belongsTo","column":"id","key":"name","label":"name","pivot_table":"ambassadors","pivot":"0","taggable":"0"}	11
*/

        $dataRow = $this->dataRow($productDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '{}',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'title');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Название',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'description');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'Описание',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'specifications');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'Спецификации',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'price');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Цена',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'image');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'Картинка',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'category_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Category id',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '{}',
                'order'        => 7,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'order_count');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Количество купленного товара',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '{}',
                'order'        => 8,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Created At',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 9,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Updated At',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '{}',
                'order'        => 10,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'product_belongsto_category_relationship');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'relationship',
                'display_name' => 'Категория',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => [
                    "model" =>"\\App\\Models\\Category",
                    "table" => "categories",
                    "type" => "belongsTo",
                    "column" =>"id",
                    "key" => "name",
                    "label" => "name",
                    "pivot_table" => "ambassadors",
                    "pivot" => "0",
                    "taggable" => "0"
                ],
                'order'        => 11,
            ])->save();
        }

        $programDataType = DataType::where('slug', 'programs')->firstOrFail();

        /*
13	id	text	Id	1	0	0	0	0	0	{}	1
13	name	text	Название	1	1	1	1	1	1	{}	2
13	description	text_area	Описание	1	1	1	1	1	1	{}	3
13	images	text	Картинки	0	1	1	1	1	1	{}	4
13	created_at	timestamp	Created At	0	1	1	1	0	1	{}	5
13	updated_at	timestamp	Updated At	0	0	0	0	0	0	{}	6



*/

        $dataRow = $this->dataRow($programDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '{}',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($programDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Название',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '{}',
                'order'        => 2,
            ])->save();
        }


        $dataRow = $this->dataRow($programDataType, 'description');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'Описание',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($programDataType, 'images');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'images',
                'display_name' => 'Картинки',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 4,
            ])->save();
        }



        $dataRow = $this->dataRow($programDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Created At',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($programDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Updated At',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '{}',
                'order'        => 6,
            ])->save();
        }

        $serviceExampleDataType = DataType::where('slug', 'services-examples')->firstOrFail();

        /*
16	id	text	Id	1	0	0	0	0	0	{}	1
16	service_id	text	Service Id	1	0	0	0	0	0	{}	2
16	name	text	Название	1	1	1	1	1	1	{}	3
16	description	text	Описание	1	1	1	1	1	1	{}	4
16	created_at	timestamp	Created At	0	1	1	1	0	1	{}	5
16	updated_at	timestamp	Updated At	0	0	0	0	0	0	{}	6
16	media	media_picker	Ьедиа	0	1	1	1	1	1	{}	7
16	services_example_belongsto_service_relationship	relationship	Услуга	0	1	1	1	1	1	{"model":"\\App\\Models\\Service","table":"services","type":"belongsTo","column":"id","key":"name","label":"name","pivot_table":"ambassadors","pivot":"0","taggable":"0"}	8





*/

        $dataRow = $this->dataRow($serviceExampleDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Service Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '{}',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($serviceExampleDataType, 'service_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '{}',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($serviceExampleDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Название',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '{}',
                'order'        => 2,
            ])->save();
        }


        $dataRow = $this->dataRow($serviceExampleDataType, 'description');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'Описание',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($serviceExampleDataType, 'images');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'images',
                'display_name' => 'Картинки',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 4,
            ])->save();
        }



        $dataRow = $this->dataRow($serviceExampleDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Created At',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($serviceExampleDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Updated At',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '{}',
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($serviceExampleDataType, 'media');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'media_picker',
                'display_name' => 'Медиа',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 7,
            ])->save();
        }

        //{"model":"\\App\\Models\\Service","table":"services","type":"belongsTo","column":"id","key":"name","label":"name","pivot_table":"ambassadors","pivot":"0","taggable":"0"}
        $dataRow = $this->dataRow($serviceExampleDataType, 'services_example_belongsto_service_relationship');
        if (!$dataRow->exists) {
            $dataRow->fill( [
                'type'         => 'relationship',
                'display_name' => 'Услуга',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "model"       => "\\App\\Models\\Service",
                    "table"       => "services",
                    "type"        => "belongsTo",
                    "column"      => "id",
                    "key"         => "name",
                    "label"       => "name",
                    "pivot_table" => "ambassadors",
                    "pivot"       => "0",
                    "taggable"    => "0"
                ],
                'order'        => 8,
            ] )->save();
        }

        $viewTextDataType = DataType::where('slug', 'view-texts')->firstOrFail();

        /*
17	id	text	Id	1	0	0	0	0	0	{}	1
17	page_id	text	Page Id	1	0	0	0	0	0	{}	2
17	description	text	Описание	0	1	1	1	1	1	{}	3
17	created_at	timestamp	Created At	0	1	1	1	0	1	{}	4
17	updated_at	timestamp	Updated At	0	0	0	0	0	0	{}	5
17	deleted_at	timestamp	Deleted At	0	1	1	1	1	1	{}	6
17	view_text_belongsto_page_relationship	relationship	страница	0	1	1	1	1	1	{"model":"\\App\\Models\\Page","table":"pages","type":"belongsTo","column":"id","key":"name","label":"name","pivot_table":"ambassadors","pivot":"0","taggable":"0"}	7


*/

        $dataRow = $this->dataRow($viewTextDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '{}',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($viewTextDataType, 'page_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Page Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '{}',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($viewTextDataType, 'description');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'Описание',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($viewTextDataType, 'images');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'images',
                'display_name' => 'Картинки',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 4,
            ])->save();
        }



        $dataRow = $this->dataRow($viewTextDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Created At',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($viewTextDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Updated At',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '{}',
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($viewTextDataType, 'deleted_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Deleted At',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($viewTextDataType, 'view_text_belongsto_page_relationship');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'relationship',
                'display_name' => 'Страница',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "model" => "\\App\\Models\\Page",
                    "table" => "pages",
                    "type"=>"belongsTo",
                    "column" => "id",
                    "key" => "name",
                    "label" => "name",
                    "pivot_table" =>"ambassadors",
                    "pivot" => "0",
                    "taggable" =>"0"
                ],
                'order'        => 7,
            ])->save();
        }

        $viewTextsImagesDataType = DataType::where('slug', 'view-texts-images')->firstOrFail();

        /*
19	id	text	Id	1	0	0	0	0	0	{}	1
19	view_texts_id	text	View Texts Id	1	0	0	0	0	0	{}	2
19	image	text	Картинка	1	1	1	1	1	1	{}	3
19	created_at	timestamp	Created At	0	1	1	1	0	1	{}	4
19	updated_at	timestamp	Updated At	0	0	0	0	0	0	{}	5
19	deleted_at	timestamp	Deleted At	0	1	1	1	1	1	{}	6
19	view_texts_image_belongsto_view_text_relationship	relationship	view_texts	0	1	1	1	1	1	{"model":"\\App\\Models\\ViewText","table":"view_texts","type":"belongsTo","column":"id","key":"description","label":"description","pivot_table":"ambassadors","pivot":"0","taggable":"0"}	7


*/

        $dataRow = $this->dataRow($viewTextsImagesDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '{}',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($viewTextsImagesDataType, 'view_texts_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'View Texts Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '{}',
                'order'        => 2,
            ])->save();
        }


        $dataRow = $this->dataRow($viewTextsImagesDataType, 'image');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'Картинка',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 4,
            ])->save();
        }



        $dataRow = $this->dataRow($viewTextsImagesDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Created At',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($viewTextsImagesDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Updated At',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '{}',
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($viewTextsImagesDataType, 'deleted_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Deleted At',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{}',
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($viewTextsImagesDataType, 'view_texts_image_belongsto_view_text_relationship');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'relationship',
                'display_name' => 'View Texts',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    "model" =>"\\App\\Models\\ViewText",
                    "table" => "view_texts",
                    "type" => "belongsTo",
                    "column" =>"id",
                    "key" =>"description",
                    "label" => "description",
                    "pivot_table" => "ambassadors",
                    "pivot" => "0",
                    "taggable" =>"0"
                ],
                'order'        => 7,
            ])->save();
        }

    }

    /**
     * [dataRow description].
     *
     * @param [type] $type  [description]
     * @param [type] $field [description]
     *
     * @return [type] [description]
     */
    protected function dataRow($type, $field)
    {
        return DataRow::firstOrNew([
            'data_type_id' => $type->id,
            'field'        => $field,
        ]);
    }
}
