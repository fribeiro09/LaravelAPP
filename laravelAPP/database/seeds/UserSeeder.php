<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Fernando Ribeiro',
            'email' => 'admin@admin.com',
            'password' => bcrypt('oi'),
            'status' => 'A'
        ]);
    }
}
