<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $primaryKey = "id_product";
    public $timestamps = false;
    protected $fillable = [
        'name',
        'price',
        'stock',
        'id_categorias',
    ];

    public function category()
    {
        return $this->belongsTo(Categoria::class);
    }
}
