<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
  protected $fillable = [
          "name","content"
      ];
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    //use HasFactory;


    /**
     * 「名前」検索スコープ
     */
     /*
    public function scopeFuzzyName($query, $search)
    {
        if (empty($search)) {
            return;
        }
        return $query->where(function ($query) use($search) {
        $query->orWhere('name', 'like', "%{$search}%")
              ->orWhere('content', 'like', "%{$search}%");
    });
    }
    */
}
