<?php

namespace Tests\Feature;

use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
	/**
	 * A basic feature test example.
	 *
	 * @return void
	 */
	public function testExampleTest()
	{
		$response = $this->get('/');
		$response->assertStatus(200);
	}

	public function testLoginWrongTest()
	{
		$response = $this->post(route("auth/checkLogin"), [
			'input-email' => 'aaaaaa',
			'input-password' => 'aaaaaaa'
		]);

		$response->assertRedirect(route('auth/login'));
	}

	public function testLoginSuccessTest()
	{
		$response = $this->post(route("auth/checkLogin"), [
			'input-email' => 'indah.hartati@hasanah.co',
			'input-password' => '12345'
		]);

		$response->assertRedirect(redirect()->intended()->getTargetUrl());
	}
}
