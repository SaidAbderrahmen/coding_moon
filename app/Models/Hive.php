<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hive extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'number',
        'total_bees',
        'present_bees',
        'infected_bees',
        'tempreture',
        'humidity',
        'status',
        'beekeeper_id',
    ];

    protected $searchableFields = ['*'];

    public function beekeeper()
    {
        return $this->belongsTo(Beekeeper::class);
    }

    public function histories()
    {
        return $this->hasMany(History::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
