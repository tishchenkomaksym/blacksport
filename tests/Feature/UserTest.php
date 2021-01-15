<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class UserTest extends TestCase
{

    public function testVoyagerLogin()
    {
        $this->get(route('voyager.login'))->assertStatus(200);
    }
}
