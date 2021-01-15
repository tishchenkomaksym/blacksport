<?php

namespace Tests\Feature;

use App\Models\Contact;
use Tests\TestCase;

class ContactTest extends TestCase
{
    public function testGetCategories()
    {
        $contacts = factory(Contact::class)->create();
        $exploded = explode(',', $contacts->social_links);
        $contacts->social_links = $exploded;

        $this->get(route('api.contacts'), ['Accept' => 'application/json'])
             ->assertStatus(200)->assertJsonFragment($contacts->toArray());
    }
}
