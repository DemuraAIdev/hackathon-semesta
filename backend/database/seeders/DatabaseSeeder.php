<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        $residents = Role::create(['name' => 'residents']);
        $officer = Role::create(['name' => 'officer']);
        $supervisor = Role::create(['name' => 'supervisor']);

        $plumber = Role::create(['name' => 'plumber']);
        $electrician = Role::create(['name' => 'electrician']);
        $cleaner = Role::create(['name' => 'cleaner']);
        $security = Role::create(['name' => 'security']);

        $A40L1 = Location::create([
            'address' => 'L1, A40'
        ]);

        User::factory()->create([
            'name' => 'Residents1',
            'email' => 'res1@home.com',
            'location_id' => $A40L1
        ])->assignRole($residents);

        User::factory()->create([
            'name' => 'Plumber',
            'email' => 'p1@home.com',
        ])->assignRole([$plumber, $officer]);

        User::factory()->create([
            'name' => 'electrician guy',
            'email' => 'e1@home.com',
        ])->assignRole([$electrician, $officer]);

        User::factory()->create([
            'name' => 'Cleaner Guy',
            'email' => 'c1@home.com',
        ])->assignRole([$cleaner, $officer]);

        User::factory()->create([
            'name' => 'Security Guy',
            'email' => 's1@home.com',
        ])->assignRole([$security, $officer]);
    }
}
