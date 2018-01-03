<?php
// para criar modelo pelo cli: php artisan make:model Produto
namespace estoque;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{   
    /**
     * Tudo pronto, já podemos fazer operações em nosso banco de dados. Mas em qual tabela? 
     * Quando não definimos explicitamente, o framework assume que a tabela terá o nome da classe com letra minúscula e no plural. 
     * Nesse caso, a classe Produto será vinculada à tabela produtos. Bem conveniente, não acha? 
     * Esse é exatamente o nome de nossa tabela, portanto não precisamos fazer nada.
     * Mas se você preferir, ou mesmo precisar, também é possível configurar isso explicitamente. 
     * Basta adicionar em nosso modelo uma propriedade com visibilidade protected, chamada table:
     *     
     */

    protected $table = 'produtos';

    /**
     * Além disso, o framework assume que sua tabela tem duas colunas, chamadas updated_at e created_at.
     * Como você deve imaginar, essas colunas são utilizadas para registrar a data e hora de quando a tabela foi criada e atualizada pela ultima vez.
     * Se em seu projeto você não quiser utilizar esses campos, basta adicionar uma propriedade chamada $timestamps com valor false:
     */

    public $timestamps = false;

    /**
     * Sempre que quisermos fazer a atribuição dessa forma, via mass-assignable, para nos proteger, 
     * precisamos adicionar uma propriedade chamada $fillable em nosso modelo especificando exatamente 
     * quais atributos podem ser populados, caso contrário receberemos uma MassAssignmentException. 
     * No caso do produto, serão o nome, descrição, valor e quantidade: 
     */
    protected $fillable = array('nome', 'descricao', 'valor', 'quantidade','tamanho','categoria_id');

    /**
     * O inverso do mass-assignable, eu posso dizer exatamente o que eu nao quero, exemplo o id que eu ja tenho
     * 
     */
    protected $guarded = ['id'];

    public function categoria(){
        return $this->belongsTo('estoque\Categoria');
    }
}


