<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\User;

class ProfileEditTest extends TestCase
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

    public function test_profile_image_can_be_updated_on_profile_edit(): void
    {
        Storage::fake('public');

        $user = User::create([
            'account_id' => 'old-account',
            'user_name' => 'Old Name',
            'password' => 'old-password',
        ]);

        session(['login_user_id' => $user->id]);

        $image = UploadedFile::fake()->image('avatar.png');

        $response = $this->post('/profile/edit', [
            'account_id' => 'new-account',
            'user_name' => 'New Name',
            'password' => 'new-password',
            'profile_image' => $image,
        ]);

        $response->assertRedirect('/profile');

        $user->refresh();

        $this->assertNotNull($user->profile_image);
        $this->assertTrue(Storage::disk('public')->exists($user->profile_image));
    }
}
