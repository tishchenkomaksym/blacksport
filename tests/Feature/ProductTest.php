<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Tests\TestCase;

class ProductTest extends TestCase
{


    public function testGetProductsWithCategories()
    {
        $category = factory(Category::class)->create();

        $category->products()->save(factory(Product::class)->create());

        $this->get(route('api.products'), ['Accept' => 'application/json'])
             ->assertStatus(200)->assertJsonFragment($category->toArray());
    }

    public function testGetProduct()
    {
        $category = factory(Category::class)->create();
        $category->products()->save($product = factory(Product::class)->create());

        $this->get(route('api.product', ['id' => $product->id]),
            ['Accept' => 'application/json'])
             ->assertStatus(200)->assertJsonFragment($category->toArray());
    }

    public function testGetProductByCategory()
    {
        $category = factory(Category::class)->create();

        $category->products()->save(factory(Product::class)->create());

        $this->get(route('api.product.category', ['categoryId' => $category->id]),
            ['Accept' => 'application/json'])
             ->assertStatus(200)->assertJsonFragment($category->toArray());
    }


}
