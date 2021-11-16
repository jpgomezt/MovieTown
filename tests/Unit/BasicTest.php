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
    public function test_main_page_response()
    {
        $this->get('/')->assertStatus(200);
        //$this->assertTrue(true);
    }

    public function test_the_password_is_required()
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

    //public function test_interaction_with_headers()
    //{
    //    //$response = $this->withHeaders([
    //    //    '1-Heer' => 'Vdslue',
    //    //])->get('/');
    //    //$response->assertStatus(200);
    //    $this->get('/movie/list')
    //        ->see('MOVIETOWN')
    //        ->assertRedirect(route('home.index'));
    //    //$this->visit('/')
    //    //     ->see('MOVIETOWN');
    //}
}
