<?php

namespace Modules\Kelas\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KelasMurid extends Model
{
    use HasFactory;

    protected $fillable = [];

    public function murid()
    {
        return $this->BelongsTo(User::class, 'murid_id', 'id');
    }

    public function kelas()
    {
        return $this->BelongsTo(Kelas::class, 'kelas_id', 'id');
    }
}
