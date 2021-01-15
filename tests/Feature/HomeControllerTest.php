<?php

namespace Tests\Feature;


use App\Models\News;
use App\Models\Page;
use App\Models\Product;
use App\Models\Program;
use App\Models\Service;
use App\Models\Category;
use Carbon\Carbon;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    public function testIndex()
    {
        factory(Category::class)->create();
        $product = factory(Product::class)->create()->get();
        $news = factory(News::class)->create()->get()->whereBetween('created_at', [Carbon::now()->subDays(60)->toDateTime()->format('Y-m-d H:i:s'),now()->format('Y-m-d H:i:s')])
                                                     ->sortBy('created_at')[0];
//        dd($news);
        $news = (object)[
            'created_at' => $news->created_at,
            'description' => $news->description,
            'id' => $news->id,
            'images' => $news->images,
            'published' =>$news->published,
            'title' => $news->title,
            'updated_at' =>$news->updated_at
        ];
        $service = factory(Service::class)->create()->get();
        $program = factory(Program::class)->create()->get();
        $page = factory(Page::class)->create()->get();

        $this->get(route('api.home', [
            'locale' => 'ru'
        ]), ['Accept' => 'application/json'])
             ->assertStatus(200);
//             ->assertJsonFragment([
////                'news' => $news,
//                'services' => $service,
//                'programs' => $program,
//                'popular_products' => $product,
//                'texts' => $page
//            ]);
    }
}
