<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Schema;
use Tests\TestCase;
use App\Models\User;

class AuthLoginTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Schema::create('users', function ($table) {
            $table->id();
            $table->string('account_id')->unique();
            $table->string('user_name');
            $table->string('password');
            $table->string('profile_image')->nullable();
            $table->timestamps();
        });
    }

    public function test_plain_text_password_can_login(): void
    {
        User::create([
            'account_id' => 'plain-user',
            'user_name' => 'Plain User',
            'password' => 'plain-password',
        ]);

        $response = $this->post('/login', [
            'account_id' => 'plain-user',
            'password' => 'plain-password',
        ]);

        $response->assertRedirect('/home');
        $this->assertSame('plain-user', User::where('account_id', 'plain-user')->first()->account_id);
        $this->assertSame(session('login_user_id'), User::where('account_id', 'plain-user')->first()->id);
    }
}
