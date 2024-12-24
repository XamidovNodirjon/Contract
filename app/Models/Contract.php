<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'passport_number',
        'phone',
        'additional_info',
        'company_name',
        'inn',
        'director_name',
        'email',
        'e_signature',
        'type', // jismoniy yoki yuridik shaxsni aniqlash uchun
    ];

}
