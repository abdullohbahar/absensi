<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Absensi extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [];

    public function hasOneSiswa(): HasOne
    {
        return $this->hasOne(Siswa::class);
    }
}
