<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortLink extends Model
{
    use HasFactory;

    protected $fillable = ['manual_id', 'code'];

    public function manual()
    {
        return $this->belongsTo(Manual::class);
    }

    public static function generateUniqueCode()
    {
        do {
            $code = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz0123456789'), 0, 4);
        } while (self::where('code', $code)->exists());

        return $code;
    }
}
