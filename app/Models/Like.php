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

    private static function is_liked($model) {
        $is_liked = $model->likes()
                    ->where([
                        'user_id' => Auth::id(),
                        'type' => true,
                    ])
                    ->first();
        return !is_null($is_liked);
    }
    
    private static function is_disliked($model) {
        $is_disliked = $model->likes()
                    ->where([
                        'user_id' => Auth::id(),
                        'type' => false,
                    ])
                    ->first();
        return !is_null($is_disliked);
    }

    private static function is_liked_or_disliked($model) {
        return self::is_liked($model) || self::is_disliked($model);
    }

    private static function toggle_like($model) {
        if (self::is_liked($model)) {
            $model->likes()->update([
                'type' => false
            ]);
        } else {
            $model->likes()->update([
                'type' => true
            ]);
        }
    }

    public static function like_or_dislike($model, $type) {
        if (self::is_liked_or_disliked($model)) {
            if (self::is_liked($model) == $type) {
                $model->likes()
                    ->where([
                        'user_id' => Auth::id(),
                        'type' => $type,
                    ])
                    ->first()
                    ->delete();
                dd('Deleted');
            } else {
                self::toggle_like($model);
                dd('Toggled');
            }
        } else {
            $model->likes()->create([
                'user_id' => Auth::id(),
                'type' => $type,
                ]);
            }
            dd('Added');
    }
}
