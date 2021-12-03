<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserTest extends TestCase
{

    public function test_user_list_retrieved_successfully()
    {
        DB::table('roles')->insert([
            [
                'name' => 'Admin'
            ],
            [
                'name' => 'Author'
            ]
        ]);

        User::factory()->make([
            'name' => 'User 1',
            'email' => 'user1@example.com'
        ]);

        User::factory()->make([
            'name' => 'User 2',
            'email' => 'user2@example.com'
        ]);

        $this->json('GET','/api/admin/users',['Accept' => 'application/json'])
            ->dump();
    }
}
