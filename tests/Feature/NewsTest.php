<?php

namespace Tests\Feature;

use App\Models\News;
use Tests\TestCase;

class NewsTest extends TestCase
{

    public function testGetNews()
    {
        $news = factory(News::class)->create()->toArray();
        $this->get(route('api.news'), ['Accept' => 'application/json'])
             ->assertStatus(200)->assertJsonFragment($news);
    }

    public function testGetNewsModel()
    {
        $news = factory(News::class)->create();

        $this->get(route('api.news.model', ['id' => $news->id]),
            ['Accept' => 'application/json'])
             ->assertStatus(200)->assertJsonFragment($news->toArray());
    }
}
