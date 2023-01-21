<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;

class Deposit extends Model
{

    use HasFactory,LogsActivity,CausesActivity;

    protected $guarded =[''];
    protected static $logAttributes = ['subject'];
    protected static $recordEvents = ['deleted','created','updated'];

    public function user()
    {
    	return $this->hasOne(User::class,'id','userId');
    }
    public function region()
    {
    	return $this->hasOne(Region::class,'id','regionId');
    }

    public function narration()
    {
        return $this->hasOne(Narration::class,'id','narrationId');
    }

    public function currency()
    {
    	return $this->hasOne(Currency::class,'id','currencyId');
    }


}
