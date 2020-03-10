<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(['name'=>'Администратор', 'email'=>'admin@admin.ru', 'password'=>bcrypt('levalevaka'), 'is_admin'=>1]);
    }
}
