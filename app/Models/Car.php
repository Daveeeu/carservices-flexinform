<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'car_id', 'type', 'registered', 'ownbrand', 'accidents'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function latestService()
    {
        return $this->hasOne(Service::class, 'car_id')->orderBy('log_number', 'desc');
    }
}
