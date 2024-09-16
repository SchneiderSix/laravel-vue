<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'llamada';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'llamada_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cliente_id',
        'user_id',
        'llamada_telefono',
        'llamada_fecha',
        'llamada_observacion'
    ];
}
