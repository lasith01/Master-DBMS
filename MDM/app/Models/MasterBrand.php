<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Model;

class MasterBrand extends Model{
    use HasFactory;

    protected $fillable = ['code', 'name', 'status', 'user_id'];

    public function user(){
        return $this->belongsTo(User::clsss);
    }
    
    public function items(){
        return $this->hasMany(MasterItem::clsss);
    }
}