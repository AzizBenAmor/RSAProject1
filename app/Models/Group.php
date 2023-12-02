<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable=[
        "name",
        "user_id",
        'privateKey',
        'publicKey'
    ];
    protected $casts = [
        'privateKey' => 'encrypted',
        'publicKey' => 'encrypted',
    ];

    public function expenses(){
        return $this->hasMany(Expense::class);
    }

    public function users(){
        return $this->belongsToMany(User::class,'user_group')->withTimestamps();
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function scopeSearch($query,$value)  {
        
        $query->where('name','like',"%{$value}%");
    }
}
