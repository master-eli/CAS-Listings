<?php

use Illuminate\Database\Seeder;

class ListingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('listings')->insert([
            'id' => 1,
            'user_id' => 1,
            'inventory_no' => 1,
            'quantity' => 1,
            'cost' => 1,
            'description' => 'Description 1',
            'date' => '',
            'condemn' => 0,
            'reason' => '',
        ]);
    }
}
