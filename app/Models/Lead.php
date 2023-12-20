<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lead extends Model
{
    use HasFactory;

    protected $dateFormat = 'U';

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'telephone'
    ];

    public function belgianCompany(): BelongsTo
    {
        return $this->belongsTo(BelgianCompany::class, 'belgian_company_id', 'id' );
    }
}
