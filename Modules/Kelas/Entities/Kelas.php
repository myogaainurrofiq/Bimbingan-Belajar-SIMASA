<?php

namespace Modules\Kelas\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [];

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id', 'id');
    }
}
