<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_normal = new Role();
        $role_normal->name = 'normal';
        $role_normal->description = 'A Normal User';
        $role_normal->save();

        $role_emailer = new Role();
        $role_emailer->name = 'emailer';
        $role_emailer->description = 'An Emailer User';
        $role_emailer->save();

        $role_anonymous = new Role();
        $role_anonymous->name = 'anonymous';
        $role_anonymous->description = 'An Anonymous User';
        $role_anonymous->save();
  }
}
