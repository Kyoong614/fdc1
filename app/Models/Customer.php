<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    //declaration
    protected $fillable=[
        'customer_id',
        'name',
        'email',
        'address',
        'gender',
        'date_of_birth',
        'phone',

    ];
}
