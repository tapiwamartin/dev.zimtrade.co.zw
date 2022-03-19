<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class newsletterFile extends Model
{
    use HasFactory;
    protected $fillable =['newsletterId','path','name'];
}
