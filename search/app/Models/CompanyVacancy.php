<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyVacancy extends Model
{
    use HasFactory;

    protected $table = 'company_vacancy';
    protected $primaryKey = 'id';
    protected $fillable = ['company_id','salary','job_type','description','title','image'];
}
