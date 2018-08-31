<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_normal = Role::where('name', 'normal')->first();
        $role_emailer  = Role::where('name', 'emailer')->first();
        $role_anonymous  = Role::where('name', 'anonymous')->first();

        $normal = new User();
        $normal->name = 'Glenton';
        $normal->email = 'glenton92@gmail.com';
        $normal->password = bcrypt('normal132');
        $normal->save();
        $normal->roles()->attach($role_normal);

        $emailer = new User();
        $emailer->name = 'Koketso';
        $emailer->email = 'test@emailer.com';
        $emailer->password = bcrypt('emailer132');
        $emailer->save();
        $emailer->roles()->attach($role_emailer);

        $anonymous = new User();
        $anonymous->name = 'Koki';
        $anonymous->email = 'koki@test.com';
        $anonymous->password = bcrypt('anonymous132');
        $anonymous->save();
        $anonymous->roles()->attach($role_anonymous);
    }
}
