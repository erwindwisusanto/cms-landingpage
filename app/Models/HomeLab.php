<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeLab extends Model
{
    use HasFactory;
    protected $table = 'homelab_logs';
    public $timestamps = false;
}
