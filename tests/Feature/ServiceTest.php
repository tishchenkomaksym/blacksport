<?php

namespace Tests\Feature;

use App\Models\Service;
use App\Models\ServiceInstance;
use App\Models\ServicesOrder;
use Tests\TestCase;

class ServiceTest extends TestCase
{

    public function testGetPrograms()
    {

        $service = factory(Service::class)->create();
        $service->examples()->save(new ServiceInstance(
            [
                'name' => $this->faker->name,
                'description' => $this->faker->text
            ]
        ));

        $this->get(route('api.services'), ['Accept' => 'application/json'])
             ->assertStatus(200)
             ->assertJsonFragment($service->toArray());
    }

    public function testCanCreateServiceRequest()
    {
        $service = factory(Service::class)->create();
        $serviceOder = factory(ServicesOrder::class)->create(['service_id' => $service->id])->toArray();

        $this->post(route('api.service.request'), $serviceOder)
             ->assertStatus(201)
             ->assertJson(['success' => 'success']);
    }

    public function testCanNotCreateServiceRequestWithoutServiceId()
    {
        $data = [
            'service_id' => null,
            'name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->email
        ];

        $this->post(route('api.service.request'), $data)
             ->assertSessionHasErrors(['service_id']);
    }

    public function testCanNotCreateServiceRequestWithWrongEmail()
    {
        $program = factory(Service::class)->create();
        $data = [
            'service_id' => $program->id,
            'name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'email' => 'efegegege'
        ];

        $this->post(route('api.service.request'), $data)
             ->assertSessionHasErrors(['email']);
    }

    public function testCanNotCreateServiceRequestWithoutPhone()
    {
        $program = factory(Service::class)->create();
        $data = [
            'service_id' => $program->id,
            'name' => $this->faker->name,
            'phone' => null,
        ];

        $this->post(route('api.service.request'), $data)
             ->assertSessionHasErrors(['phone']);
    }

    public function testCanNotCreateServiceRequestWithoutName()
    {
        $program = factory(Service::class)->create();
        $data = [
            'service_id' => $program->id,
            'name' => null,
            'phone' => $this->faker->phoneNumber,
        ];

        $this->post(route('api.service.request'), $data)
             ->assertSessionHasErrors(['name']);
    }
}
