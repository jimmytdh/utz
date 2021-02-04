<?php

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
        DB::table('users')
            ->insert([
                'name' => 'Administrator',
                'username' => 'admin',
                'password' => Hash::make('admin'),
                'designation' => 'Administrator'
            ]);

        DB::table('users')
            ->insert([
                'name' => 'Yenn Kwek',
                'username' => 'yenn',
                'password' => Hash::make('123'),
                'designation' => 'Standard'
            ]);

        DB::table('patients')
            ->insert([
                'hospital_no' => '00003',
                'fname' => 'Jane',
                'mname' => 'Dela',
                'lname' => 'Cruz',
                'dob' => '1999-03-05'
            ]);
    }
}
