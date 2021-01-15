<?php

namespace Tests\Feature;

use App\Models\Partner;
use Tests\TestCase;

class PartnerTest extends TestCase
{

    public function testGetPartners()
    {
        $partner = factory(Partner::class)->create()->toArray();

        $this->get(route('api.partners'), ['Accept' => 'application/json'])
             ->assertStatus(200)->assertJsonFragment($partner);
    }
}
