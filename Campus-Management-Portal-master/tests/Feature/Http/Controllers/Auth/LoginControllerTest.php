<?php

namespace Tests\Feature\Http\Controllers\Auth;

use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Inertia\Testing\AssertableInertia as Assert;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function login_displays_the_login_form()

    {
        $this->get('/login')
            ->assertInertia(
                fn (Assert $page) => $page
                    ->component('User/LoginPage')
            );
    }

    /** @test */
    public function login_displays_validation_errors()
    {
        $this->post('/login', [])
            ->assertStatus(302)
            ->assertSessionHas('errors');
    }

    /** @test */
    public function login_authenticates_and_redirects_admin_user()
    {
        //Seed roles
        $this->seed(RoleSeeder::class);

        $user = User::factory()->create();

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password'
        ])
            ->assertRedirectToRoute('admin.dashboard');

        $this->assertAuthenticatedAs($user);
    }


    /** @test */
    public function doesnt_allow_access_to_dashboard_without_login()
    {
        $this->get('/admin/dashboard')
            ->assertStatus(302)
            ->assertRedirectToRoute('login');
    }
}
