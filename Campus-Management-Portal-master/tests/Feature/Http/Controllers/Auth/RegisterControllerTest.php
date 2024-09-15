<?php

namespace Tests\Feature\Http\Controllers\Auth;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Inertia\Testing\AssertableInertia as Assert;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;


    /** @test */
    public function register_displays_the_register_form()

    {
        $this->get('/register')
            ->assertInertia(
                fn (Assert $page) => $page
                    ->component('User/RegisterPage')
            );
    }

    /** @test */
    public function register_displays_validation_errors()
    {
        $this->post('/register', [])
            ->assertStatus(302)
            ->assertSessionHas('errors');
    }

    /** @test */
    public function register_creates_and_authenticates_a_applicant_user()
    {
        //Seed roles
        $this->seed(RoleSeeder::class);

        $this->post('register', [
            'name' => 'Ahsan',
            'father_name' => 'Faisal',
            'email' => 'testuser@mail.com',
            'password' => 'testpassword',
            'password_confirmation' => 'testpassword',
            'gender' => 'male',
            'phone' => '03214522363',
            'cnic' => '3310025641429',
            'date_of_birth' => date(today())
        ])->assertRedirect(route('applicant.dashboard', ['status' => 'registered']));

        $this->followingRedirects()->get(route('applicant.dashboard', ['status' => 'registered']))->assertInertia(
            fn (Assert $page) => $page
                ->component('Applicant/Dashboard')
                ->has('notifications', 1)
        );


        //Phone number gets formatted 
        $this->assertDatabaseHas('users',  [
            'name' => 'Ahsan',
            'father_name' => 'Faisal',
            'email' => 'testuser@mail.com',
            'gender' => 'male',
            'phone' => '+923214522363',
            'cnic' => '3310025641429',
            'date_of_birth' => date(today())
        ]);

        $user = User::where('email', 'testuser@mail.com')->where('name', 'Ahsan')->first();
        $this->assertNotNull($user);

        $this->assertAuthenticatedAs($user);
    }
}
