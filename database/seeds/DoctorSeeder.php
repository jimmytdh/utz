<?php

use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('doctors')
            ->insert([
                'fname' => 'Ethel',
                'mname' => '',
                'lname' => 'Lariego'
            ]);
        DB::table('doctors')
            ->insert([
                'fname' => 'Aubrey',
                'mname' => 'Santos',
                'lname' => 'Miles'
            ]);
    }
}
