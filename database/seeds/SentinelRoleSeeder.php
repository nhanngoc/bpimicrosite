<?php

use Illuminate\Database\Seeder;

class SentinelRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Super Admin',
            'slug' => 'suppers',
        ]);

        Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Admins',
            'slug' => 'admins',
        ]);

        Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Users',
            'slug' => 'users',
        ]);
        $this->command->info('Roles seeded!');
    }
}
