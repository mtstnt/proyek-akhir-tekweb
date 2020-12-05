<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		// $faker = \Faker\Factory::create("id_ID");
		// for ($i = 0; $i < 10; $i++) 
		// {
		// 	$user = new User();
		// 	$user->first_name = $faker->firstName;
		// 	$user->last_name = $faker->lastName;
		// 	$user->email = $faker->email;
		// 	$user->password = bcrypt('12345');
		// 	$user->level = 1;
		// 	$user->credit_points = 0;
		// 	$user->role = 0;
		// 	$user->save();
		// }

		if (count(User::where('email', '=', 'admin@memeail.com')->take(1)->get('id')) == 0) 
		{
			$user = new User();
			$user->first_name = "Admin";
			$user->last_name = "One";
			$user->password = bcrypt("admin123");
			$user->email = 'admin@memeail.com';
			$user->level = 1;
			$user->credit_points = 0;
			$user->role = 1;
			$user->save();
		}
    }
}
