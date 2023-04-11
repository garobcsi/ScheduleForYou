<?php

namespace Tests\Feature\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use WithFaker, DatabaseTransactions;

    /**
     * Test user registration success.
     *
     * @return void
     */
    public function testUserRegistrationSuccess()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => $this->faker->password(8),
        ];

        $response = $this->postJson(route('user.register'), $data);

        $response->assertStatus(JsonResponse::HTTP_OK)
            ->assertJson(['message' => 'Registration Success.']);

        $this->assertDatabaseHas('users', [
            'name' => $data['name'],
            'email' => $data['email']
        ]);
    }

    /**
     * Test user login success.
     *
     * @return void
     */
    public function testUserLoginSuccess()
    {
        $password = $this->faker->password(8);

        $user = User::create([
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'password' => Hash::make($password),
        ]);

        $data = [
            'email' => $user->email,
            'password' => $password,
        ];

        $response = $this->postJson(route('user.login'), $data);

        $response->assertStatus(JsonResponse::HTTP_OK)
            ->assertJsonStructure(['data' => ['token']]);

        $this->assertAuthenticatedAs($user);
    }

    /**
     * Test user login failure.
     *
     * @return void
     */
    public function testUserLoginFailure()
    {
        $data = [
            'email' => $this->faker->unique()->safeEmail,
            'password' => $this->faker->password(8),
        ];

        $response = $this->postJson(route('user.login'), $data);

        $response->assertStatus(JsonResponse::HTTP_UNAUTHORIZED)
            ->assertJson(['message' => 'Login Unsuccessful.']);

        $this->assertGuest();
    }

    /**
     * Test authenticated user.
     *
     * @return void
     */
    public function testAuthenticatedUser()
    {
        $password = $this->faker->password(8);
        $user = User::create([
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => Hash::make($password),
        ]);

        $response = $this->actingAs($user)
            ->getJson(route('user.login.valid'));

        $response->assertStatus(JsonResponse::HTTP_OK)
            ->assertJson(['message' => 'Authenticated.']);
    }

    /**
     * Test token refresh.
     *
     * @return void
     */
    public function testTokenRefresh()
    {
        $password = $this->faker->password(8);
        $user = User::create([
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'password' => Hash::make($password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->actingAs($user)
            ->getJson(route('user.login.alive'), [
                'Authorization' => 'Bearer '.$token,
            ]);

        $response->assertStatus(JsonResponse::HTTP_OK)
            ->assertJson(['message' => 'Token Kept Alive.']);
    }

    public function testUserLogoutSuccess()
    {
        // Create a user
        $password = $this->faker->password(8);
        $user = User::create([
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'password' => Hash::make($password),
        ]);

        // Create a personal access token for the user
        $token = $user->createToken('auth_token')->plainTextToken;
        // Make the API call to logout
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get(route('user.logout'));
        // Assert that the response has a 200 status code
        $response->assertStatus(200);

        // Assert that the token was deleted
        $this->assertDatabaseMissing('personal_access_tokens', [
            'tokenable_type' => 'App\Models\User',
            'tokenable_id' => $user->id,
        ]);
    }

    public function testUserLogoutAllSuccess()
    {
        // Create a user
        $user = User::create([
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make($this->faker->password),
        ]);

        // Generate two tokens for the user
        $token1 = $user->createToken('token1')->plainTextToken;
        $token2 = $user->createToken('token2')->plainTextToken;

        // Call the logout all API endpoint
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token1,
            'Accept' => 'application/json',
        ])->get(route('user.logout.all'));
        // Assert that the response has a 200 status code
        $response->assertStatus(200);

        // Assert that both tokens were deleted from the database
        $this->assertDatabaseMissing('personal_access_tokens', [
            'tokenable_id' => $user->id,
            'token' => $token1,
        ]);
        $this->assertDatabaseMissing('personal_access_tokens', [
            'tokenable_id' => $user->id,
            'token' => $token2,
        ]);
    }
}
