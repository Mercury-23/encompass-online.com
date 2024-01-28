<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property mixed $instrument_id
 * @property mixed $teacher_id
 * @property mixed $student_id
 * @property mixed $start_time
 * @property mixed $end_time
 * @property mixed $duration
 * @property mixed $rate
 * @property mixed $price
 * @property mixed $id
 */
class Lesson extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $fillable = [
        "invoice_id",

        "teacher_id",
        "student_id",
        "instrument_id",
        "price",
        "duration",
        "start_time",
        "end_time",
    ];

    /*
     * todo - cast these to the correct types
     * */
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];



    public function teacher(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function student(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function instrument(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Instrument::class, 'instrument_id');
    }



    public function invoices(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Invoice::class);
    }

//    public function getDurationAttribute($value)
//    {
//        return $value . ' minutes';
//    }

//    public function getRateAttribute($value)
//    {
//        return '$' . $value;
//    }

//    public function getStartTimeAttribute($value)
//    {
//        return date('g:i A', strtotime($value));
//    }

//    public function getEndTimeAttribute($value)
//    {
//        return date('g:i A', strtotime($value));
//    }

//    public function getCreatedAtAttribute($value)
//    {
//        return date('g:i A', strtotime($value));
//    }


}
