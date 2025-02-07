<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PIC extends Model
{
    use HasFactory;

    protected $table = 'master_pic';
    protected $primaryKey = 'id';
    protected $fillable = [
        'pic'
    ];
}
