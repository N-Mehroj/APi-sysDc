<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rates extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'hosting_rates';
    protected $primaryKey = 'id';

    protected $fillable = ['definition_name','server_number', 'definition_status', 'definition_userId','definition_paymentStatus','definition_publicStatus','daily_prices','monthly_prices','yearly_prices'];
}
