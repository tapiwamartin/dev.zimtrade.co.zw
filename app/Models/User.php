<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;

class User extends Authenticatable implements MustVerifyEmail
{

    use HasFactory, Notifiable, LogsActivity,CausesActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function routeNotificationForSlack($notification)
    {
       return  'https://hooks.slack.com/services/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';
    }
    protected $fillable = [
        'name',
        'email',
        'isAuthorised',
        'password',
        'city',
        'country',
        'phonenumber',
        'organisation'
    ];

     protected static $logAttributes = ['name', 'email'];
      protected static $recordEvents = ['deleted','created','updated'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users','userId','roleId');
    }

    public function departments()
    {
         return $this->belongsToMany(Department::class, 'department_users','userId','departmentId');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class,'agentId','id');
    }
     public function comments()
    {
        return $this->hasMany(Comment::class,'ticketId','id');
    }

    public function hasRole($id)
    {
        return null !== $this->roles()->where('roleId',$id)->first();
    }

    public  function authorised($id)
    {
        return null  !==$this->where(['isAuthorised'=>1,'id'=>$id])->first();
    }




}
