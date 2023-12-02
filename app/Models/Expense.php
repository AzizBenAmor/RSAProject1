<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'date',
        'user_id',
        'amount',
        'desc',
    ];

    protected $hidden = [
        'title',
        'date',
        'amount',
        'desc',
    ];

    protected $casts = [
        'title' => 'encrypted',
        'date' => 'encrypted',
        'amount' => 'encrypted',
        'desc' => 'encrypted',
    ];

    public function users(){
        return $this->belongsToMany(User::class)->withPivot(['related','balance'])->withTimestamps();
    }

    public function group(){
        return $this->belongsTo(Group::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function scopeSearch($query,$value)  {
        
        $query->where('title','like',"%{$value}%");
    }
}
