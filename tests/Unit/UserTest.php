<?php

namespace Tests\Unit;

use App\Models\User;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    // use RefreshDatabase;

    public function testSignupGuestCanVisit()
    {
        $this->assertGuest();

        $response = $this->get(route('user.signup'));

        $response->assertViewIs('user.signup');
    }

    public function testSignupUserCantVisit()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('user.signup'));

        $response->assertRedirect(route('homepage'));
    }

    public function testSignupCorrectRepeatPassword()
    {
        $user = User::factory()->make();
        $password = 'hey';

        $response = $this->post(route('user.signup'), [
            'username' => $user->username,
            'password' => $password,
            'repeat_password' => $password,
        ]);

        $response->assertRedirect(route('user.signin'));
    }

    public function testSignupIncorrectRepeatPassword()
    {
        $user = User::factory()->make();
        $password = 'hey';

        $response = $this->post(route('user.signup'), [
            'username' => $user->username,
            'password' => $password,
            'repeat_password' => 'not same password',
        ]);

        $response
            ->assertRedirect(route('user.signup'))
            ->assertSessionHas('message', "Passwords didn't match. Please try again!");
    }

    public function testSigninGuestCanVisit()
    {
        $this->assertGuest();

        $response = $this->get(route('user.signin'));

        $response->assertViewIs('user.signin');
    }

    public function testSigninUserCantVisit()
    {
        $user = User::first();
        $this->actingAs($user);

        $response = $this->get(route('user.signin'));

        $response->assertRedirect(route('homepage'));
    }

    public function testSigninCorrectCredentials()
    {
        $user = User::factory()->create([
            'password' => Hash::make($password = 'Hey'),
        ]);

        $response = $this->post(route('user.signin'), [
            'username' => $user->username,
            'password' => $password,
        ]);

        $response->assertRedirect(route('homepage'));
    }

    public function testSigninIncorrectCredentials()
    {
        $user = User::factory()->create([
            'password' => Hash::make($password = 'Hey'),
        ]);

        $response = $this->post(route('user.signin'), [
            'username' => $user->username,
            'password' => 'Not-correct',
        ]);

        $response
            ->assertRedirect(route('user.signin'))
            ->assertSessionHas('message', 'Incorrect username/password. Please try again!');
    }

    public function testSignout()
    {
        $user = User::first();
        $this->actingAs($user);

        $response = $this->post(route('user.signout'));

        $response->assertRedirect(route('homepage'));
        $this->assertGuest();
    }

    public function testEditProfileGuestCantVisit()
    {
        $targetUser = User::first();
        $this->assertGuest();

        $response = $this->get(route('user.editProfile', [
            'username' => $targetUser->username,
        ]));

        $response->assertRedirect(route('homepage'));
    }

    public function testEditProfileNotAuthUserCantVisit()
    {
        $targetUser = User::first();
        $user = User::factory()->make();
        $this->actingAs($user);

        $response = $this->get(route('user.editProfile', [
            'username' => $targetUser->username,
        ]));

        $response->assertRedirect(route('homepage'));
    }

    public function testEditProfileAuthUserCanVisit()
    {
        $user = User::first();
        $this->actingAs($user);

        $response = $this->get(route('user.editProfile', [
            'username' => $user->username,
        ]));

        $response->assertViewIs('user.editProfile');
    }

    public function testUpdateProfileSubmitNull()
    {
        $user = User::first();

        $response = $this->put(route('user.updateProfile', [
            'user' => $user->id,
        ]), [
            'username' => null,
        ]);

        $response
            ->assertRedirect(route('user.editProfile', [
                'username' => $user->username,
            ]))
            ->assertSessionHas('type', 'error')
            ->assertSessionHas('message', 'No changes made');
    }

    public function testUpdateProfileSubmitUnchanged()
    {
        $user = User::first();

        $response = $this->put(route('user.updateProfile', [
            'user' => $user->id,
        ]), [
            'username' => $user->username,
        ]);

        $response
            ->assertRedirect(route('user.editProfile', [
                'username' => $user->username,
            ]))
            ->assertSessionHas('type', 'error')
            ->assertSessionHas('message', 'No changes made');
    }

    public function testUpdateProfileSubmitMatchRecord()
    {
        $user = User::factory()->create();
        $targetUser = User::first();

        $response = $this->put(route('user.updateProfile', [
            'user' => $user->id,
        ]), [
            'username' => $targetUser->username,
        ]);

        $response
            ->assertRedirect(route('user.editProfile', [
                'username' => $user->username,
            ]))
            ->assertSessionHas('type', 'error')
            ->assertSessionHas('message', 'Username exists - Please try a different username');
    }

    public function testUpdateProfileSubmitChanged()
    {
        $user = User::factory()->create([
            'password' => Hash::make($password = 'hey'),
        ]);

        $response = $this->put(route('user.updateProfile', [
            'user' => $user->id,
        ]), [
            'username' => $username = Str::random(10),
        ]);

        $response
            ->assertRedirect(route('user.editProfile', [
                'username' => $username,
            ]))
            ->assertSessionHas('type', 'success')
            ->assertSessionHas('message', 'Username updated!');

        $this->assertCredentials([
            'username' => $username,
            'password' => $password,
        ]);
    }

    public function testEditPasswordGuestCantVisit()
    {
        $targetUser = User::first();
        $this->assertGuest();

        $response = $this->get(route('user.editPassword', [
            'username' => $targetUser->username,
        ]));

        $response->assertRedirect(route('homepage'));
    }

    public function testEditPasswordNotAuthUserCantVisit()
    {
        $targetUser = User::first();
        $user = User::factory()->make();
        $this->actingAs($user);

        $response = $this->get(route('user.editPassword', [
            'username' => $targetUser->username,
        ]));

        $response->assertRedirect(route('homepage'));

    }

    public function testEditPasswordAuthUserCanVisit()
    {
        $user = User::first();
        $this->actingAs($user);

        $response = $this->get(route('user.editPassword', [
            'username' => $user->username,
        ]));

        $response->assertViewIs('user.editPassword');
    }

    public function testUpdatePasswordAllSubmitNull()
    {
        $user = User::first();

        $response = $this->put(route('user.updatePassword', [
            'user' => $user->id,
        ]), [
            'current_password' => null,
            'new_password' => null,
            'repeat_password' => null,
        ]);

        $response
            ->assertRedirect(route('user.editPassword', [
                'username' => $user->username,
            ]))
            ->assertSessionHas('type', 'error')
            ->assertSessionHas('message', 'One or more fields were empty - No changes made');
    }

    public function testUpdatePasswordCurrentPasswordSubmitNull()
    {
        $user = User::first();
        $password = Str::random(10);

        $response = $this->put(route('user.updatePassword', [
            'user' => $user->id,
        ]), [
            'current_password' => null,
            'new_password' => $password,
            'repeat_password' => $password,
        ]);

        $response
            ->assertRedirect(route('user.editPassword', [
                'username' => $user->username,
            ]))
            ->assertSessionHas('type', 'error')
            ->assertSessionHas('message', 'One or more fields were empty - No changes made');
    }

    public function testUpdatePasswordNewPasswordSubmitNull()
    {
        $user = User::first();
        $password = Str::random(10);

        $response = $this->put(route('user.updatePassword', [
            'user' => $user->id,
        ]), [
            'current_password' => $password,
            'new_password' => null,
            'repeat_password' => $password,
        ]);

        $response
            ->assertRedirect(route('user.editPassword', [
                'username' => $user->username,
            ]))
            ->assertSessionHas('type', 'error')
            ->assertSessionHas('message', 'One or more fields were empty - No changes made');
    }

    public function testUpdatePasswordRepeatPasswordSubmitNull()
    {
        $user = User::first();
        $password = Str::random(10);

        $response = $this->put(route('user.updatePassword', [
            'user' => $user->id,
        ]), [
            'current_password' => $password,
            'new_password' => $password,
            'repeat_password' => null,
        ]);

        $response
            ->assertRedirect(route('user.editPassword', [
                'username' => $user->username,
            ]))
            ->assertSessionHas('type', 'error')
            ->assertSessionHas('message', 'One or more fields were empty - No changes made');
    }

    public function testUpdatePasswordCurrentPasswordSubmitIncorrect()
    {
        $user = User::first();
        $password = Str::random(10);

        $response = $this->put(route('user.updatePassword', [
            'user' => $user->id,
        ]), [
            'current_password' => $password,
            'new_password' => $password,
            'repeat_password' => $password,
        ]);

        $response
            ->assertRedirect(route('user.editPassword', [
                'username' => $user->username,
            ]))
            ->assertSessionHas('type', 'error')
            ->assertSessionHas('message', 'Incorrect Current Password');
    }

    public function
    testUpdatePasswordNewPasswordSubmitDoesntMatchRepeatPassword() {
        $user = User::factory()->create([
            'password' => Hash::make($password = 'hey'),
        ]);

        $randPassword = Str::random(10);

        $response = $this->put(route('user.updatePassword', [
            'user' => $user->id,
        ]), [
            'current_password' => $password,
            'new_password' => $password,
            'repeat_password' => $randPassword,
        ]);

        $response
            ->assertRedirect(route('user.editPassword', [
                'username' => $user->username,
            ]))
            ->assertSessionHas('type', 'error')
            ->assertSessionHas('message', "New Password didn't match Repeat Password");

        $this->assertCredentials([
            'username' => $user->username,
            'password' => $password,
        ]);

    }

    public function
    testUpdatePasswordNewPasswordSubmitSimilarToCurrentPassword() {
        $user = User::factory()->create([
            'password' => Hash::make($password = 'hey'),
        ]);

        $response = $this->put(route('user.updatePassword', [
            'user' => $user->id,
        ]), [
            'current_password' => $password,
            'new_password' => $password,
            'repeat_password' => $password,
        ]);

        $response
            ->assertRedirect(route('user.editPassword', [
                'username' => $user->username,
            ]))
            ->assertSessionHas('type', 'error')
            ->assertSessionHas('message', "New Password is similar to Current Password - No changes made");

        $this->assertCredentials([
            'username' => $user->username,
            'password' => $password,
        ]);
    }

    public function
    testUpdatePasswordNewPasswordSubmitChanged() {
        $user = User::factory()->create([
            'password' => Hash::make($password = 'hey'),
        ]);

        $newPassword = Str::random(10);

        $response = $this->put(route('user.updatePassword', [
            'user' => $user->id,
        ]), [
            'current_password' => $password,
            'new_password' => $newPassword,
            'repeat_password' => $newPassword,
        ]);

        $response
            ->assertRedirect(route('user.editPassword', [
                'username' => $user->username,
            ]))
            ->assertSessionHas('type', 'success')
            ->assertSessionHas('message', "Password updated!");

        $this->assertCredentials([
            'username' => $user->username,
            'password' => $newPassword,
        ]);
    }
}
