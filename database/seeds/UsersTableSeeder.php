<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();
        User::create([
            'name' => 'Nermin',
            'email' => 'Nermin.Khaled20@gmail.com',
            'password' => bcrypt('15c')
        ]);
    }
}
