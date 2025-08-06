<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Areas extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'area';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_area';

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
        'id_dependence',
        'name',
        'status'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'id_area' => 'integer',
        'id_dependence' => 'integer',
        'status' => 'integer',
    ];

    /**
     * Get the dependency that owns this area.
     */
    public function dependency()
    {
        return $this->belongsTo(Dependencies::class, 'id_dependence', 'id_dependence');
    }

    /**
     * Scope a query to only include active areas.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}