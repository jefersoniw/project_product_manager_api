<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';

    protected $fillable = [
        'name',
        'cpf',
        'address',
        'photo',
        'sex'
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'client_id', 'id');
    }
}
