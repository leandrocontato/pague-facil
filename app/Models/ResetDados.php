<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetDados extends Model
{
    use HasFactory;

    protected $table = 'reset_dados';

    protected $primaryKey = 'id_reset_dados';

    protected $fillable = [
        'email_antigo',
        'email_novo',
        'token',
        'password',
        'created_at',
        'updated_at',
        'id_costumer'
    ];

}
