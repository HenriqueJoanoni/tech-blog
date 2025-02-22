<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['permission_title' => 'Admin'],
            ['permission_title' => 'Editor'],
            ['permission_title' => 'Viewer'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
