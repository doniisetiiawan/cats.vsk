<?php

use Illuminate\Database\Seeder;

class BreedsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('breeds')->insert(array(
            array('id' => 1, 'name' => "Domestic"),
            array('id' => 2, 'name' => "Persian"),
            array('id' => 3, 'name' => "Siamese"),
            array('id' => 4, 'name' => "Abyssinian"),
        ));
    }
}
