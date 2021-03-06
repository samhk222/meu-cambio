<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //
    protected $guarded = ['id'];
    
    public function categoria()
    {
        return $this->hasOne('App\Feed', 'id', 'feeds_id');
    }

    protected $dates = ['created_at', 'updated_at', 'pubDate'];

    public function scopeActive($query)
    {
        return $query->where('active', '=', 1);
    }


}
