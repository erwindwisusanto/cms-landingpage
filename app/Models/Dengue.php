<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dengue extends Model
{
    use HasFactory;
    protected $table = 'dengue_log';
    public $timestamps = false;
}
