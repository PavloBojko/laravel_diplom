<?php

namespace Tests\Unit;

use App\Data_user;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    // use RefreshDatabase;

    /** @test */
    public function register()
    {
        $data = [
            'email' => 'pacha75@gmail.com',
            'password' => '123',
            'name' => 'Pavlo',
            'avatar' => 'uploads/1_avatar.jpg',
            'work' => 'GGPZ MNU',
            'tel' => '0664184593',
            'adres' => 'varva',
            'role_id' => '2',
            'status_id' => '2'
        ];
        Data_user::add_data_user($data);

        $this->assertDatabaseHas('users', [
            'email' => 'pacha75@gmail.com',
            'password' => '123',
        ]);

        $this->assertDatabaseHas('data_users', [
            'name' => 'Pavlo',
            'avatar' => 'uploads/1_avatar.jpg',
            'work' => 'GGPZ MNU',
            'tel' => '0664184593',
            'adres' => 'varva',
            'role_id' => '2',
            'status_id' => '2'
        ]);
    }

    /** @test */
    public function edit_data()
    {
        $data = [
            'name' => 'Rosik',
            'work' => 'shkola',
            'tel' => '0664184593',
            'adres' => 'Varva Galitska',
        ];
        Data_user::edit_user(3, $data);

        $this->assertDatabaseHas('data_users', [
            'name' => 'Rosik',
            'work' => 'shkola',
            'tel' => '0664184593',
            'adres' => 'Varva Galitska'
        ]);
    }
}
