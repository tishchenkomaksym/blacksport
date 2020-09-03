<?php

use App\Models\Ambassador;
use App\Models\News;
use App\Models\Order;
use App\Models\ParticipationRequest;
use App\Models\Partner;
use App\Models\Product;
use App\Models\Program;
use App\Models\Service;
use App\Models\ServicesExapmle;
use App\Models\ServicesOrder;
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
//         $this->call(UserSeeder::class);
        factory(User::class, 10)->create();
        factory( Program::class, 10)->create();
        factory( Ambassador::class, 10)->create();
        factory( Partner::class, 10)->create();
        factory( News::class, 30)->create();
        factory( Product::class, 30)->create();
        factory( Order::class, 20)->create();
        factory( ParticipationRequest::class, 20)->create();
        factory( ServicesExapmle::class, 20)->create();
        factory( Service::class, 20)->create();
        factory( ServicesOrder::class, 20)->create();
    }
}
