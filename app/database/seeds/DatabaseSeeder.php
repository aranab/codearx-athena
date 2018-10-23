<?php

use app\models\super;
use app\models\core;
use app\models\entrust;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
        $this->call('RoleTableSeeder');
		$this->call('UserTableSeeder');
		$this->call('CMSConfigsSeeder');

        $this->command->info('User table seeded!');
	}

}

class RoleTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->delete();

        entrust\Role::create(
            array(
                'type'  => 'SC',
                'name' => 'super'
            )
        );
    }

}

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('core_users')->delete();

        $user = core\CoreUser::create(
            array(
                'fname'                => null,
                'lname'                => null,
                'username'             => 'super@orbitinformatics.com',
                'email'                => 'super@orbitinformatics.com',
                'password'             => Hash::make('Orbit@321'),
                'mobile'               => '01711342029',
                'gender'               => 'Male',
                'address'              => null,
                'pic_name'             => null,
                'ext'                  => null,
                'path'                 => '/uploads/users/',
                'user_type'            => 'SC',
                'confirmed'            => 1,
                'confirmation_code'    => null,
                'remember_token'       => null,
                'password_reset_token' => null,
                'last_visit_ip'        => null,
                'status'               => 1,
                'uploaded_by'          => 'system',
                'uploaded_date'        => date('Y-m-d H:i:s'),
                'modified_by'            => 'system',
                'modified_date'          => date('Y-m-d H:i:s')
            )
        );

        $role = entrust\Role::where(
            'name',
            'super'
        )->where(
            'type',
            'SC'
        )->pluck(
            'ID'
        );

        $user->roles()->attach($role);
    }

}

class CMSConfigsSeeder extends Seeder
{
    public function run()
    {
        DB::table('cms_configs')->delete();

        $tableValue = [
            'siteurl'        => 'http://localhost/athena_v1.0/public/',
            'home'           => 'http://localhost/athena_v1.0/public/',
            'page_on_front'  => 0,
            'page_for_posts' => 0,
            'page_for_auth'  => 0,
            'site_logo'      => '',
            'site_favicon'   => '',
            'fb_link'        => '',
            'twitter_link'   => '',
            'linkedin_link'  => '',
            'idea_limit'     => '',
            'mail_username'  => '',
            'mail_password'  => ''
        ];

        foreach ($tableValue as $key => $val) {
            super\CMSConfig::create(
                array(
                    'name'  => $key,
                    'value' => $val
                )
            );
        }
    }
}
