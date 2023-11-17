<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'company';
    protected $fillable =['name','logo','location','description','web_site_link','phone','email','telegram_link','instagram_link'];
}
