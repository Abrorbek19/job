<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'user_profile';
    protected $fillable = ['user_id','job','about_yourself','image','birth_date','gender','country','phone','website','experiance','languages'];
}
