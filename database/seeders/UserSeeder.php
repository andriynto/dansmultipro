<?php
namespace Database\Seeders;

use Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //** @var \App\Models\Role $user1 */
        $user1 = \App\User::firstOrCreate(
            ['email' => 'andriyanto@indonusamedia.co.id', 'username' => 'andriyanto'],
            [
                'name'      => 'Andriyanto',
                'uuid'      => Str::uuid(),
                'picture'   => 'avatar.png',
                'enabled'   => 1,
                'locale'    => 'id-ID',
                'password'  => 'indonesia'
            ]
        );

        $user1->attachRole('administrator');
        $user1->createToken('Hms Cloud ' . ucfirst($user1->name))->accessToken;
    }
}
