<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintResponse extends Model
{
    /** @use HasFactory<\Database\Factories\ComplaintResponseFactory> */
    use HasFactory;

    protected $fillable = [
        'complaint_id',
        'user_id',
        'message'
    ];

    public function complaint()
    {
        return $this->belongsTo(Complaint::class);

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
