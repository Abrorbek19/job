<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaveJob extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'save_job';
    protected $fillable = ['user_id','vacancy_id'];
}
