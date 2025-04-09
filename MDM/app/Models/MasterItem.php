<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id', 'category_id', 'code', 'name', 
        'attachment', 'status', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function brand()
    {
        return $this->belongsTo(MasterBrand::class);
    }

    public function category()
    {
        return $this->belongsTo(MasterCategory::class);
    }
}