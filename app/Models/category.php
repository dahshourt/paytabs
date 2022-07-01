<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_name',
        'parent_id',
        
    ];
    public function childs()
    {
        return $this->hasMany(category::class, 'parent_id', 'id');
    }
}
