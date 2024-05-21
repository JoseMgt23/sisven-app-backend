<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = "categorias";
    protected $primaryKey = "id_categorias";
    public $timestamps = false;

    public function products()
{
    return $this->hasMany(Product::class);
}
}
