<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectStack extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_project',
        'id_stack',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])
            ->setTimezone("Asia/Jakarta")
            ->format('Y-m-d H:i:s');
    }

    public function stack()
    {
        return $this->belongsTo(Stack::class, 'id_stack', 'id');
    }
}
