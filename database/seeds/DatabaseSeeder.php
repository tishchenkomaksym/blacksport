<?php

use App\Models\Achievement;
use App\Models\Ambassador;
use App\Models\Category;
use App\Models\Contact;
use App\Models\News;
use App\Models\Order;
use App\Models\Page;
use App\Models\ParticipationRequest;
use App\Models\Partner;
use App\Models\Product;
use App\Models\Program;
use App\Models\Service;
use App\Models\ServiceInstance;
use App\Models\ServicesOrder;
use App\Models\ViewTextImage;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        factory(User::class, 10)->create();
//        factory(Category::class, 5)->create();
//        factory(Program::class, 10)->create();
//        factory(Ambassador::class, 10)->create();
        factory(Partner::class, 10)->create();
//        factory(News::class, 30)->create();
//        factory(Product::class, 30)->create();
//        factory(Order::class, 20)->create();
//        factory(ParticipationRequest::class, 20)->create();
//        factory(Service::class, 20)->create();
//        factory(ServiceInstance::class, 40)->create();
//        factory(ServicesOrder::class, 20)->create();
//        factory( Contact::class, 1)->create();
////        factory( ViewText::class, 10)->create();
//        factory( Achievement::class, 10)->create();
//        $this->call([
//            PageTableSeeder::class,
//            ViewTextTableSeeder::class
//        ]);
//
//        factory( ViewTextImage::class, 20)->create();
    }
}
