<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $table = 'house';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'descricao',
        'valor',
        'quartos',
        'banheiros',
        'area',
        'disponivel',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
