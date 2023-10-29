<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Servers extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'hosting_servers';
    protected $primaryKey = 'id';

    protected $fillable = ['server_name','server_ip', 'server_login', 'server_password','server_userId','server_status','server_type','server_address','server_port','NS1_address','NS2_address','NS3_address','NS4_address','IP1_address','IP2_address','IP3_address','IP4_address','server_location','server_description'];
}
