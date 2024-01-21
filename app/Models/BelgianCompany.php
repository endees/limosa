<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BelgianCompany extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $dateFormat = 'U';

    protected $fillable = [
        'identifier',
        'business_name',
        'valid'
    ];

    public function lead(): HasOne
    {
        return $this->hasOne(Lead::class, 'belgian_company_id', 'id');
    }
}
