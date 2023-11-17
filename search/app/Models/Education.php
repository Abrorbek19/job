<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'education';
    protected $fillable = ['user_id','university_name','education_type','end_education','enter_education','university_description'];
}
