<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		User::factory()
			->create([
				'pseudo' => 'admin',
				'email' => 'info@admin.com',
				'password' => 'password',
				'admin' => true
			]);

		User::factory()
			->create([
				'pseudo' => 'player',
				'email' => 'info@player.com',
				'password' => 'password',
				'email_verified_at' => now(),
				'admin' => false
			]);

		User::factory()
			->count(10)
			->create();
	}
}
