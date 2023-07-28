<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'title',
        'start_periode',
        'end_periode',
        'summary',
        'link',
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
        return $this->hasMany(ProjectStack::class, 'id_project', 'id');
    }

    public function image()
    {
        return $this->hasMany(ProjectImage::class, 'id_project', 'id');
    }
}
