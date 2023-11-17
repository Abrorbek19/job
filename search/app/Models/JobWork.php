<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobWork extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'work_job';
    protected $fillable = ['user_id','job_status','company_name','enter_work_date','end_work_date','work_description'];

}
