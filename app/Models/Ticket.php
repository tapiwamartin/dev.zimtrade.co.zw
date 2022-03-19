<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;

class Ticket extends Model
{

    use HasFactory,LogsActivity,CausesActivity;

    protected $guarded =[''];
    protected static $logAttributes = ['subject'];
    protected static $recordEvents = ['deleted','created','updated'];

    public function status()
    {
    	return $this->hasOne(Status::class,'id','statusId');
    }
    public function department()
    {
    	return $this->hasOne(Department::class,'id','departmentId');
    }

    public function sector()
    {
        return $this->hasOne(Sector::class,'id','sectorId');
    }

    public function agent()
    {
    	return $this->hasOne(User::class,'id','agentId');
    }

    public function ticketOwner()
    {
        return $this->hasOne(User::class,'id','userId');
    }

    public function ticketFile()
    {
        return $this->hasMany(TicketFile::class,'ticketId','id');
    }

    public function  sla()
    {
        return $this->hasOne(ServiceLevelAgreement::class,'id','slaId');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,'ticketId','id');
    }

}
