<?php

namespace Tests\Unit;

use Tests\TestCase;

class SigninTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testSignin()
    {
        $this->get('/sign-in')->assertSuccessful();
    }
}
