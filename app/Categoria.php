<?php
// para criar modelo pelo cli: php artisan make:model Categoria
namespace estoque;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';
    protected $fillable = array('nome');
    protected $guarded = ['id'];

    public function produtos(){
        return $this->hasMany('estoque\Produto');
    }
}


