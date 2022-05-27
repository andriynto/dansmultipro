<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var \App\Models\Role $user1 */
        $role1 = \App\Models\Role::firstOrCreate(
            ['name' => 'administrator'],
            ['name' => 'administrator', 'display_name' => 'Administrator', 'description' => 'Administrator']
        );
    }
}
