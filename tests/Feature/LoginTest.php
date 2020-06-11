<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // テストユーザー作成
        $this->user = factory(User::class)->create();
    }

    public function test_フロント側ログイン()
    {
        $response = $this->json('POST', route('login'), [
            'email' => $this->user->email,
            'password' => 'password',
        ]);

        $response
            ->assertStatus(302);
            //->assertJson(['name' => $this->user->name]);

        $this->assertAuthenticatedAs($this->user);
    }

    public function test_フロント側ログアウト()
    {
        $response = $this->actingAs($this->user)
            ->json('POST', route('logout'));

        $response->assertStatus(302);
        $this->assertGuest();
    }
}
