<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          if(DB::table('permissions')->get()->count() == 0){
            $tasks = 
            [
                //Question Category
                [ 'id' => 1, 'name' => 'Question Category List',    'slug' => 'question-category-list',         'module_id' => 1, 'status' => 1 ],
                [ 'id' => 2, 'name' => 'Question Category Create',  'slug' => 'question-category-create',       'module_id' => 1, 'status' => 1 ],
                [ 'id' => 3, 'name' => 'Question Category Edit',    'slug' => 'question-category-edit',         'module_id' => 1, 'status' => 1 ],
                [ 'id' => 4, 'name' => 'Question Category Delete',  'slug' => 'question-category-delete',       'module_id' => 1, 'status' => 1 ],
                  
                //Questions
                [ 'id' => 5, 'name' => 'Questions List',    'slug' => 'questions-list',         'module_id' => 1, 'status' => 1 ],
                [ 'id' => 6, 'name' => 'Questions Create',  'slug' => 'questions-create',       'module_id' => 1, 'status' => 1 ],
                [ 'id' => 7, 'name' => 'Questions Edit',    'slug' => 'questions-edit',         'module_id' => 1, 'status' => 1 ],
                [ 'id' => 8, 'name' => 'Questions Delete',  'slug' => 'questions-delete',       'module_id' => 1, 'status' => 1 ],
                  
                //Package
                [ 'id' => 9, 'name' => 'Package List',      'slug' => 'package-list',         'module_id' => 2, 'status' => 1 ],
                [ 'id' => 10, 'name' => 'Package Create',   'slug' => 'package-create',       'module_id' => 2, 'status' => 1 ],
                [ 'id' => 11, 'name' => 'Package Edit',     'slug' => 'package-edit',         'module_id' => 2, 'status' => 1 ],
                [ 'id' => 12, 'name' => 'Package Delete',   'slug' => 'package-delete',       'module_id' => 2, 'status' => 1 ],
                 
                [ 'id' => 13, 'name' => 'Sets List',        'slug' => 'sets-list',       'module_id' => 2, 'status' => 1 ],
                [ 'id' => 14, 'name' => 'Sets Assign',      'slug' => 'sets-assign',       'module_id' => 2, 'status' => 1 ],
                  
              
               
            ];
             
            DB::table('permissions')->insert($tasks);
         }
    }
}
