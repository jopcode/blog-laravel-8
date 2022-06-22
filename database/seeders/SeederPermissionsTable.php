<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class SeederPermissionsTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            // Articles
            'view-article',
            'create-article',
            'edit-article',
            'delete-article',
            // Roles
            'view-rol',
            'create-rol',
            'edit-role',
            'delete-rol',
            // Categories
            'view-category',
            'create-category',
            'edit-category',
            'delete-category',
        ];
        foreach($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
