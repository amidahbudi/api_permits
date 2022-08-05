<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where("email", "amidahbu@gmail.com")->first();
        if (!$user) {
            DB::table('users')->insert([
                'name' => 'Amidah Budi Utami',
                'email' => 'amidahbu@gmail.com',
                'email_verified_at' => now(),
                'password' => Crypt::encrypt('12345678'), // password
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
