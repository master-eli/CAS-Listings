<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'fn' => 'bio',
            'mn' => 'bio',
            'ln' => 'bio',
            'role_id' => 1,
            'email' => 'bio',
            'password' => 'bio',
        ]);
    }
}
