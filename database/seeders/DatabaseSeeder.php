<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PermissionSeeder::class);

        $admin = Permission::where('permission_title', 'admin')->first();
        $editor = Permission::where('permission_title', 'editor')->first();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'permission_id' => $admin->id,
        ]);

        User::create([
            'name' => 'Editor',
            'email' => 'editor@editor.com',
            'password' => Hash::make('password'),
            'permission_id' => $editor->id,
        ]);

        $this->call(CategoriesSeeder::class);
        $this->call(PostSeeder::class);
    }
}
