<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamps = Carbon::now();
        DB::table('users')->insert(array(
            array(
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('123456789'),
                'role' => 'Administrador',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ),
            array(
                'name' => 'empleado1',
                'email' => 'empleado1@mail.com',
                'password' => bcrypt('123456789'),
                'role' => 'Empleado',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ),
            array(
                'name' => 'empleado2',
                'email' => 'empleado2@mail.com',
                'password' => bcrypt('123456789'),
                'role' => 'Empleado',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ),
        ));
    }
}
