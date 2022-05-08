<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeder\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert(
            ['id' => '$id'],
            ['username' => 'TestUser'],
            ['mail' => 'test@gettest.com'],
            ['password' => 'Password'],
        );
    }
}
