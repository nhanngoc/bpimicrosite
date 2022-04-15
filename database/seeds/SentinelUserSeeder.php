<?php

use Illuminate\Database\Seeder;

class SentinelUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->delete();
        Sentinel::registerAndActivate([
            'email'      => 'user@user.com',
            'password'   => 'sentineluser',
            'name'       => 'UserFirstName',
            'first_name' => 'UserFirstName',
            'last_name'  => 'UserLastName',
        ]);
        Sentinel::registerAndActivate([
            'email'      => 'quochieuhcm@gmail.com',
            'password'   => 'admin123',
            'name'       => 'Quoo Hieu',
            'first_name' => 'AdminFirstName',
            'last_name'  => 'AdminLastName',
        ]);
        $this->command->info('Users seeded!');
    }
}
