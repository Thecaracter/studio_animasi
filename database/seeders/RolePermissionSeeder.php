<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default roles
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $editor3dRole = Role::firstOrCreate(['name' => 'editor_3d', 'guard_name' => 'web']);
        $editorAnimasiRole = Role::firstOrCreate(['name' => 'editor_animasi', 'guard_name' => 'web']);
        $reviewerRole = Role::firstOrCreate(['name' => 'reviewer', 'guard_name' => 'web']);

        // Create permissions for Admin
        $adminPermissions = [
            'create-user',
            'edit-user',
            'delete-user',
            'view-users',
            'create-task',
            'edit-task',
            'delete-task',
            'view-all-tasks',
            'assign-task',
            'manage-permissions',
            'view-dashboard',
            'view-performance',
        ];

        foreach ($adminPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create permissions for Editor 3D / Editor Animasi
        $editorPermissions = [
            'view-assigned-tasks',
            'submit-task',
            'view-own-tasks',
            'view-own-performance',
        ];

        foreach ($editorPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create permissions for Reviewer
        $reviewerPermissions = [
            'view-submissions',
            'review-task',
            'approve-task',
            'reject-task',
            'view-all-tasks',
        ];

        foreach ($reviewerPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Assign permissions to roles
        $adminRole->syncPermissions($adminPermissions);
        
        $editor3dRole->syncPermissions($editorPermissions);
        $editorAnimasiRole->syncPermissions($editorPermissions);
        
        $reviewerRole->syncPermissions($reviewerPermissions);
    }
}
