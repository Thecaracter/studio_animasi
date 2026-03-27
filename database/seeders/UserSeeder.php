<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Seed the users table.
     */
    public function run(): void
    {
        // Create admin user
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin User', 'password' => bcrypt('password')]
        );
        if (!$adminUser->hasRole('admin')) {
            $adminUser->assignRole('admin');
        }

        // Create editor 3d user
        $editor3dUser = User::firstOrCreate(
            ['email' => 'daus@example.com'],
            ['name' => 'Daus (Editor 3D)', 'password' => bcrypt('password')]
        );
        if (!$editor3dUser->hasRole('editor_3d')) {
            $editor3dUser->assignRole('editor_3d');
        }

        // Create editor animasi user
        $editorAnimasiUser = User::firstOrCreate(
            ['email' => 'animasi@example.com'],
            ['name' => 'Editor Animasi', 'password' => bcrypt('password')]
        );
        if (!$editorAnimasiUser->hasRole('editor_animasi')) {
            $editorAnimasiUser->assignRole('editor_animasi');
        }

        // Create reviewer user
        $reviewerUser = User::firstOrCreate(
            ['email' => 'reviewer@example.com'],
            ['name' => 'Reviewer User', 'password' => bcrypt('password')]
        );
        if (!$reviewerUser->hasRole('reviewer')) {
            $reviewerUser->assignRole('reviewer');
        }
    }
}
