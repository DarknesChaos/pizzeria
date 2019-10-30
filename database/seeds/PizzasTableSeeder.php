<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PizzasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamps = Carbon::now();
        DB::table('pizzas')->insert(array(
            array(
                'name' => 'Pepperoni',
                'size' => 'Chica',
                'price' => '60.99',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ),
            array(
                'name' => 'Pepperoni',
                'size' => 'Mediana',
                'price' => '80',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ),
            array(
                'name' => 'Pepperoni',
                'size' => 'Grande',
                'price' => '130.35',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ),
        ));
    }
}
