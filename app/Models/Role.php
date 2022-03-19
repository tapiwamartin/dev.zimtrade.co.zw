<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;

class Role extends Model
{
    use HasFactory,LogsActivity,CausesActivity;
     protected static $logAttributes = ['name'];
      protected static $recordEvents = ['deleted','created','updated'];
}
