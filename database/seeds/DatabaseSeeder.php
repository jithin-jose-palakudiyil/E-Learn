<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        if( $this->call(UserAdminSeeder::class))
        $this->command->info('Table Admin Users seeded!');  
        
        if( $this->call(ModuleSeeder::class))
        $this->command->info('Table Admin Module seeded!');  
        
        if( $this->call(PermissionsSeeder::class))
        $this->command->info('Table Admin Permissions seeded!');  
        
        if( $this->call(PivotPermissionsSeeder::class))
        $this->command->info('Table Admin Pivot Permissions seeded!');  
        
    }
}
