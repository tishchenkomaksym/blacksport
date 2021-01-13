<?php

namespace Tests\Feature;

use App\Models\Program;
use Tests\TestCase;

class ProgramTest extends TestCase
{

    public function testGetPrograms()
    {
        $program = factory(Program::class)->create()->toArray();

        $this->get(route('api.programs'), ['Accept' => 'application/json'])
             ->assertStatus(200)->assertJsonFragment($program);
    }

    public function testProgramCanHaveProgramRequest()
    {
        $program = factory(Program::class)->create();

        $program->requests()->create([
            'name' => 'Crossing',
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->email
        ]);

        $this->assertEquals('Crossing', $program->requests()->getResults()[0]->name);

    }

    public function testCanCreateProgramRequest()
    {
        $this->withoutExceptionHandling();
        $program = factory(Program::class)->create();
        $data = [
            'program_id' => $program->id,
            'name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->email
        ];

        $this->post(route('api.program.request'), $data)
             ->assertStatus(201)
             ->assertJson(['success' => 'success']);
        $this->assertDatabaseHas('program_request', $data);
    }

    public function testCanNotCreateProgramRequestWithoutProgramId()
    {
        $data = [
            'program_id' => null,
            'name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->email
        ];

        $this->post(route('api.program.request'), $data)
             ->assertSessionHasErrors(['program_id']);
    }

    public function testCanNotCreateProgramRequestWithWrongEmail()
    {
        $program = factory(Program::class)->create();
        $data = [
            'program_id' => $program->id,
            'name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'email' => 'efegegege'
        ];

        $this->post(route('api.program.request'), $data)
             ->assertSessionHasErrors(['email']);
    }

    public function testCanNotCreateProgramRequestWithoutPhone()
    {
        $program = factory(Program::class)->create();
        $data = [
            'program_id' => $program->id,
            'name' => $this->faker->name,
            'phone' => null,
        ];

        $this->post(route('api.program.request'), $data)
             ->assertSessionHasErrors(['phone']);
    }

    public function testCanNotCreateProgramRequestWithoutName()
    {
        $program = factory(Program::class)->create();
        $data = [
            'program_id' => $program->id,
            'name' => null,
            'phone' => $this->faker->phoneNumber,
        ];

        $this->post(route('api.program.request'), $data)
             ->assertSessionHasErrors(['name']);
    }


}
