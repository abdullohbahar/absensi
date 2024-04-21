<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Siswa extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [];

    public function hasOneKelas(): HasOne
    {
        return $this->hasOne(Kelas::class, 'id', 'kelas_id');
    }

    public function hasOneAbsensi(): HasOne
    {
        return $this->hasOne(Absensi::class);
    }
}
