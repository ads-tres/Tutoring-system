<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['Manager','Subordinate','Tutor','Parent','Accountant'];

        foreach ($roles as $r) {
            Role::firstOrCreate(['name' => $r, 'guard_name' => 'web']);
        }

        // assign Manager to the existing Filament user (adjust email)
        $admin = User::where('email', 'admin@example.com')->first();
        if ($admin) {
            $admin->assignRole('Manager');
        }
    }
}
?>