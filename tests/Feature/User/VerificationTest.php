<?php

use Alpaca\Models\User;
use Alpaca\Repositories\UserRepository;
use Tests\IntegrationTest;

class VerificationTest extends IntegrationTest
{

    public function setUp()
    {
        parent::setUp();
        User::truncate();
    }

    public function testVerifyProcess()
    {
        $this->withoutExceptionHandling();

        // create user
        $repo = new UserRepository();
        $user = $this->createUser();

        // generate
        $this->assertEquals(0, User::first()->verified);
        $token = $repo->generateVerifyToken($user);

        // check db
        $this->assertNotEmpty($token);
        $this->assertEquals($token, User::first()->verification_token);
        $this->assertEquals(0, User::first()->verified);

        // verify account
        $this->get('/register/verify/' . $token)->assertRedirect('/');

        // check db
        $this->assertNull(User::first()->verification_token);
        $this->assertEquals(1, User::first()->verified);
    }


    protected function createUser()
    {
        $repo = new UserRepository();
        return $repo->create([
            'name' => 'JohnDoe',
            'email' => 'john@example.com',
            'password' => '123456',
            'password_confirmation' => '123456',
        ]);
    }

}
