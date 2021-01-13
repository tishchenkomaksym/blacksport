<?php

namespace Tests\Feature;

use App\Models\Category;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    public function testGetCategories()
    {
        $categories = factory(Category::class)->create()->toArray();
        $this->get(route('api.categories'), ['Accept' => 'application/json'])
             ->assertStatus(200)->assertJsonFragment($categories);
    }
}
