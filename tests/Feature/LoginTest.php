<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

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
        $this->assertAuthenticatedAs($this->user);
    }

    public function test_フロント側ログアウト()
    {
        $response = $this->actingAs($this->user)
            ->json('POST', route('logout'));
        $response->assertStatus(302);
        $this->assertGuest();
    }

    public function test_認証が必要_purchase()
    {
        $response = $this->get('/purchase');
        $response->assertStatus(404);
    }

    public function test_認証が必要_mypage()
    {
        $response = $this->get('/mypage');
        $response->assertStatus(302);
    }

    public function test_認証が必要_purchase_ログイン後()
    {
        $cart = ['items' => 1];
        $response = $this->actingAs($this->user)
            ->withSession(['cart' => $cart])
            ->get('/purchase');
        $response->assertStatus(200);
    }

    public function test_認証が必要_mypage_ログイン後()
    {
        $response = $this->actingAs($this->user)
            ->get('/mypage');
        $response->assertStatus(200);
    }
}
