<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PickersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pickers')->insert([
            'name' => 'Aleksandr 1',
            'deleted' => 0
        ]);
        DB::table('pickers')->insert([
            'name' => 'Aleksandr 2',
            'deleted' => 0
        ]);
        DB::table('pickers')->insert([
            'name' => 'Aleksandr 3',
            'deleted' => 0
        ]);
        DB::table('pickers')->insert([
            'name' => 'Aleksandr 4',
            'deleted' => 0
        ]);
        DB::table('pickers')->insert([
            'name' => 'Aleksandr 5',
            'deleted' => 0
        ]);
    }
}
