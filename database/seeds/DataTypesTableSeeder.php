<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataType;

class DataTypesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $dataType = $this->dataType('slug', 'users');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'users',
                'display_name_singular' => __('voyager::seeders.data_types.user.singular'),
                'display_name_plural'   => __('voyager::seeders.data_types.user.plural'),
                'icon'                  => 'voyager-person',
                'model_name'            => 'TCG\\Voyager\\Models\\User',
                'policy_name'           => 'TCG\\Voyager\\Policies\\UserPolicy',
                'controller'            => 'TCG\\Voyager\\Http\\Controllers\\VoyagerUserController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'menus');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'menus',
                'display_name_singular' => __('voyager::seeders.data_types.menu.singular'),
                'display_name_plural'   => __('voyager::seeders.data_types.menu.plural'),
                'icon'                  => 'voyager-list',
                'model_name'            => 'TCG\\Voyager\\Models\\Menu',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'roles');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'roles',
                'display_name_singular' => __('voyager::seeders.data_types.role.singular'),
                'display_name_plural'   => __('voyager::seeders.data_types.role.plural'),
                'icon'                  => 'voyager-lock',
                'model_name'            => 'TCG\\Voyager\\Models\\Role',
                'controller'            => 'TCG\\Voyager\\Http\\Controllers\\VoyagerRoleController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'ambassadors');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'ambassadors',
                'display_name_singular' => 'Амбассадор',
                'display_name_plural'   => 'Амбассадоры',
                'icon'                  => null,
                'model_name'            => 'App\\Models\\Ambassador',
                'controller'            => null,
                'generate_permissions'  => 1,
                'description'           => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null}',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'categories');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'categories',
                'display_name_singular' => 'Категория',
                'display_name_plural'   => 'Категории',
                'icon'                  => null,
                'model_name'            => 'App\\Models\\Category',
                'controller'            => null,
                'generate_permissions'  => 1,
                'description'           => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null}',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'contacts');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'contacts',
                'display_name_singular' => 'Контакт',
                'display_name_plural'   => 'Контакты',
                'icon'                  => null,
                'model_name'            => 'App\\Models\\Contact',
                'controller'            => null,
                'generate_permissions'  => 1,
                'description'           => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null}',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'news');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'news',
                'display_name_singular' => 'Новость',
                'display_name_plural'   => 'Новости',
                'icon'                  => null,
                'model_name'            => 'App\\Models\\News',
                'controller'            => null,
                'generate_permissions'  => 1,
                'description'           => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null}',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'orders');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'orders',
                'display_name_singular' => 'Заказ',
                'display_name_plural'   => 'Заказы',
                'icon'                  => null,
                'model_name'            => 'App\\Models\\Order',
                'controller'            => null,
                'generate_permissions'  => 1,
                'description'           => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null}',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'pages');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'pages',
                'display_name_singular' => 'Текст страницы',
                'display_name_plural'   => 'Тексты страницы',
                'icon'                  => null,
                'model_name'            => 'App\\Models\\Page',
                'controller'            => null,
                'generate_permissions'  => 1,
                'description'           => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null}',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'partners');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'partners',
                'display_name_singular' => 'Партнер',
                'display_name_plural'   => 'Партнеры',
                'icon'                  => null,
                'model_name'            => 'App\\Models\\Partner',
                'controller'            => null,
                'generate_permissions'  => 1,
                'description'           => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null}',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'services');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'services',
                'display_name_singular' => 'Услуга',
                'display_name_plural'   => 'Услуги',
                'icon'                  => null,
                'model_name'            => 'App\\Models\\Service',
                'controller'            => null,
                'generate_permissions'  => 1,
                'description'           => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null}',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'products');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'products',
                'display_name_singular' => 'Товар',
                'display_name_plural'   => 'Товары',
                'icon'                  => null,
                'model_name'            => 'App\\Models\\Product',
                'controller'            => null,
                'generate_permissions'  => 1,
                'description'           => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'programs');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'programs',
                'display_name_singular' => 'Программа',
                'display_name_plural'   => 'Программы',
                'icon'                  => null,
                'model_name'            => 'App\\Models\\Program',
                'controller'            => null,
                'generate_permissions'  => 1,
                'description'           => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null}',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'services-examples');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'services_examples',
                'display_name_singular' => 'Пример услуги',
                'display_name_plural'   => 'Пример услуги',
                'icon'                  => null,
                'model_name'            => 'App\\Models\\ServiceInstance',
                'controller'            => null,
                'generate_permissions'  => 1,
                'description'           => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null}',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'view-texts');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'view_texts',
                'display_name_singular' => 'Текст для страниц',
                'display_name_plural'   => 'Тексты для страниц',
                'icon'                  => null,
                'model_name'            => 'App\\Models\\ViewText',
                'controller'            => null,
                'generate_permissions'  => 1,
                'description'           => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'details'               =>  [
                    "order_column"       => null,
                    "order_display_column" => null,
                    "order_direction"        => "desc",
                    "default_search_key"      => null,
                    "scope"         => null
                ],
            ])->save();
        }

        $dataType = $this->dataType('slug', 'view-texts-images');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'view_texts_images',
                'display_name_singular' => 'Картинка текста страницы',
                'display_name_plural'   => 'Картинки текста страницы',
                'icon'                  => null,
                'model_name'            => 'App\\Models\\ViewTextImage',
                'controller'            => null,
                'generate_permissions'  => 1,
                'description'           => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'achievements');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'achievements',
                'display_name_singular' => 'Достижение',
                'display_name_plural'   => 'Достижения',
                'icon'                  => null,
                'model_name'            => 'App\\Models\\Achievement',
                'controller'            => null,
                'generate_permissions'  => 1,
                'description'           => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'program-request');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'program_request',
                'display_name_singular' => 'Заявка Программы',
                'display_name_plural'   => 'Заявки Программы',
                'icon'                  => null,
                'model_name'            => 'App\\Models\\ProgramRequest',
                'controller'            => null,
                'generate_permissions'  => 1,
                'description'           => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'services-order');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'services_order',
                'display_name_singular' => 'Заявка Услуги',
                'display_name_plural'   => 'Заявки Услуги',
                'icon'                  => null,
                'model_name'            => 'App\\Models\\ServicesOrder',
                'controller'            => null,
                'generate_permissions'  => 1,
                'description'           => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
            ])->save();
        }
    }

    /**
     * [dataType description].
     *
     * @param [type] $field [description]
     * @param [type] $for   [description]
     *
     * @return [type] [description]
     */
    protected function dataType($field, $for)
    {
        return DataType::firstOrNew([$field => $for]);
    }
}
