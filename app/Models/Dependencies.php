<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dependencies extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dependences';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_dependence';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dependence_name',
        'active',
        'status'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'id_dependence' => 'integer',
        'dependence_name' => 'string',
        'active' => 'string',
        'status' => 'integer'
    ];
}