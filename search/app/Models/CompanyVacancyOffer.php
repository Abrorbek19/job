<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyVacancyOffer extends Model
{
    use HasFactory;
    protected $primaryKey = 'company_vacancy_id';
    protected $table = 'company_vacancy_offers';
    protected $fillable = ['company_vacancy_id','offer_id'];
}
