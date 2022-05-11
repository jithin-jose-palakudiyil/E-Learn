<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          if(DB::table('module')->get()->count() == 0){
            $tasks = 
            [
                [ 'id' => 1, 'name' => 'Question',  'slug' => 'question',   'status' => 1 ],
                [ 'id' => 2, 'name' => 'Package',   'slug' => 'package',    'status' => 1 ],
          
            ];
             
            DB::table('module')->insert($tasks);
         }
    }
}
