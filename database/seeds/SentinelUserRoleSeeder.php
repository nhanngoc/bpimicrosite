<?php

use Illuminate\Database\Seeder;

class SentinelUserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_users')->delete();
        $adminUser = Sentinel::findByCredentials(['login' => 'quochieuhcm@gmail.com']);
        $userUser  = Sentinel::findByCredentials(['login' => 'user@user.com']);
        $userRole  = Sentinel::findRoleByName('Users');
        $adminRole = Sentinel::findRoleByName('Super Admin');
        // Assign the roles to the users
        $userRole->users()->attach($userUser);
        $adminRole->users()->attach($adminUser);
        $this->command->info('Users assigned to roles seeded!');
    }
}
