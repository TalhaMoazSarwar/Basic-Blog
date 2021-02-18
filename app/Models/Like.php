<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function likeable() {
        return $this->morphTo();
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public static function is_liked($model) {
        $is_liked = $model->likes()
                    ->where([
                        'user_id' => Auth::id(),
                        'type' => true,
                    ])
                    ->first();
        return !is_null($is_liked);
    }
    
    public static function is_disliked($model) {
        $is_disliked = $model->likes()
                    ->where([
                        'user_id' => Auth::id(),
                        'type' => false,
                    ])
                    ->first();
        return !is_null($is_disliked);
    }

    public static function is_liked_or_disliked($model) {
        return Like::is_liked($model) || Like::is_disliked($model);
    }

    public static function toggle_like($model) {
        if (Like::is_liked($model)) {
            $model->likes()->update([
                'type' => false
            ]);
        } else {
            $model->likes()->update([
                'type' => true
            ]);
        }
    }
}
