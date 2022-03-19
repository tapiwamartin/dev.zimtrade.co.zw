<?php

namespace Database\Seeders;

use App\Models\Sector;
use App\Models\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\RoleUser;
use App\Models\User;
use App\Models\Role;
class InitialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $status = new Status;
        $status->name = "opened";
        $status->save();

        $status = new Status;
        $status->name = "closed";
        $status->save();

        $status = new Status;
        $status->name ="re-opened";
        $status->save();

        $status = new Status;
        $status->name ="overdue";
        $status->save();


        /*Sectors*/
        $sector = new Sector;
        $sector->name ="Agricultural";
        $sector->save();

        $sector = new Sector;
        $sector->name ="Information and Communication Technology";
        $sector->save();

        $sector = new Sector;
        $sector->name ="Manufacturing";
        $sector->save();

        $sector = new Sector;
        $sector->name ="Tourism";
        $sector->save();

        $sector = new Sector;
        $sector->name ="Banking";
        $sector->save();

        $sector = new Sector;
        $sector->name ="Art and Crafts";
        $sector->save();


    	$role = new Role;
    	$role->name = "Admin";
    	$role->save();

    	$role = new Role;
    	$role->name = "Agent";
    	$role->save();

        $user = new User;
        $user->name ="Administrator";
        $user->email="admin@zimtrade.co.zw";
        $user->organisation="ZimTrade";
        $user->phonenumber="+263773072202";
        $user->isAuthorised=1;
        $user->city="Harare";
        $user->country="Zimbabwe";
        $user->password =bcrypt("secret");
        $user->save();

        $role = Role::find(1);
        $user->roles()->attach(['roleId'=>$role->id]);


    }
}
