<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use App\Models\User;
use Tests\TestCase;

class BasicTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testMainPageResponse()
    {
        $this->get('/')->assertStatus(200);
        //$this->assertTrue(true);
    }

    public function testThePasswordIsRequired()
    {
        $this->get('/')->assertStatus(200);
        $user = User::where('email', 'zaratedev@gmail.com');
        if ($user !== null) {
            $user->delete();
        }
        
        $user = User::create(['email' => 'zaratedev@gmail.com',
                              'name' => 'zara',
                              'password' => 'zara',
                              'username' => 'zara',
                              'address' => 'zara',
        ]);
        $credentials = [
            "email" => "zaratedev@gmail.com",
            "password" => null,
        ];

        $response = $this->from('/login')->post('/login', $credentials);
        $response->assertRedirect('/login')
            ->assertSessionHasErrors([
                'password' => 'The password field is required.',
            ]);
    }
}
