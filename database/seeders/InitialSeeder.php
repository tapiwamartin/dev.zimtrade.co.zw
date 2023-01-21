<?php

namespace Database\Seeders;

use App\Models\Narration;
use App\Models\Region;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\RoleUser;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Schema;
class InitialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $narration = new Narration();
        $narration->name = "Expense";
        $narration->save();

        $narration = new Narration;
        $narration->name = "Income";
        $narration->save();




        /*Sectors*/
        $region = new Region;
        $region->name ="Manicaland";
        $region->save();

        $region = new Region;
        $region->name ="Mashonaland Central";
        $region->save();

        $region = new Region;
        $region->name ="Mashonaland East";
        $region->save();



    	$role = new Role;
    	$role->name = "Administrator";
    	$role->save();

    	$role = new Role;
    	$role->name = "Supervisor";
    	$role->save();

        $user = new User;
        $user->name ="Administrator";
        $user->email="admin@wallet.co.zw";
        $user->organisation="Wallet";
        $user->phonenumber="+26377200000";
        $user->isAuthorised=1;
        $user->city="Harare";
        $user->country="Zimbabwe";
        $user->email_verified_at=Carbon::now();
        $user->password =bcrypt("secret");
        $user->save();

        $role = Role::find(1);
        $user->roles()->attach(['roleId'=>$role->id]);


    }
}
