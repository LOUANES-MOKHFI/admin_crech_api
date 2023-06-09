<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(WilayaSeeder::class);
        $this->call(CommuneSeeder::class);
        $this->call(SettingsSeeder::class);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
          /* \App\Models\Admin::create([
            'name' => 'louanes mokhfi',
            'email' => 'louanes.mokhfi@gmail.com',
            'password' => bcrypt(123456789)
        ]);   */
         /* \App\Models\User::create([
            'name' => 'Creche test',
            'email' => 'creche@gmail.com',
            'password' => bcrypt(123456789)
        ]);   */

          \App\Models\About::create([
            'site_name' => 'Rawdati',
            'email' => 'creche@gmail.com',
            'phone' => '0123456789'
        ]);  
    }
}
