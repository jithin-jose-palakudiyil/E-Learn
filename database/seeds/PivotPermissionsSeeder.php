<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PivotPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
             if(DB::table('pivot_permissions')->get()->count() == 0){
             $tasks =   [ 
                            //Question Category
                            [ 'permission_id'=>1, 'user_id'=>1 ],
                            [ 'permission_id'=>2, 'user_id'=>1 ],
                            [ 'permission_id'=>3, 'user_id'=>1 ],
                            [ 'permission_id'=>4, 'user_id'=>1 ],
                           
                            //Questions
                            [ 'permission_id'=>5, 'user_id'=>1 ],
                            [ 'permission_id'=>6, 'user_id'=>1 ],
                            [ 'permission_id'=>7, 'user_id'=>1 ],
                            [ 'permission_id'=>8, 'user_id'=>1 ],
                 
                            //Package
                            [ 'permission_id'=>9, 'user_id'=>1 ],
                            [ 'permission_id'=>10, 'user_id'=>1 ],
                            [ 'permission_id'=>11, 'user_id'=>1 ],
                            [ 'permission_id'=>12, 'user_id'=>1 ],
                 
                            [ 'permission_id'=>13, 'user_id'=>1 ],
                            [ 'permission_id'=>14, 'user_id'=>1 ],
                           
                           
                        ];
             
             DB::table('pivot_permissions')->insert($tasks);
         }
    }
}
