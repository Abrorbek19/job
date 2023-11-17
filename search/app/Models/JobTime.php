<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobTime extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'job_time';
    protected $fillable = ['title'];
}
