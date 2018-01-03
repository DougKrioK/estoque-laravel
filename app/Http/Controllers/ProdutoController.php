<?php namespace estoque\Http\Controllers;

use Request;
use estoque\Produto;
use estoque\Categoria;
use estoque\Http\Requests\ProdutosRequest;

class ProdutoController extends Controller
{  
   public function __construct()
   {  
      // declarando o middleware padrao auth, para sempre conferir se esta logado 
      // somente para os metodos adiciona e remove
      $this->middleware('auth', ['only' => ['adiciona', 'remove']]);
   }


   public function lista () {
      // de forma manual, consultando o banco e fazendo as querys
      /*
      $produtos = DB::select('select * from produtos');
      */

      // usando o Eloquent ( framework ORM, para manipular as consultas ao banco)
      // metodo all(), faz uma busca por tudo da tabela.
      $produtos = Produto::all();
      return view('produto.listagem')->with('produtos', $produtos);
   }
   
   public function listaJson(){
      $produtos = Produto::all();
      // se eu quiser retornar json, para uma api rest, é assim:
      return response()->json($produtos);
   }

   // se eu passar a variavel no metodo, o framework entende que é pra pegar do request
   public function mostra ($id) {
      // $id = Request::route('id', '0');
      // $produto = DB::select('select * from produtos where id = ?', [$id]);
      $produto = Produto::find($id);
      
      if(empty($produto)) {
         return "Esse produto não existe";
      }
      // como agora estou usando o Eloquent, ele ja entende que no find() quero somente um item, entao nao me retorna mais um array
      //return view('produto/detalhes')->with('p', $produto[0]);
      return view('produto/detalhes')->with('produto', $produto);

      
   }

   public function novo () {
      return view('produto/novo')->with('categorias', Categoria::all());
   }

   public function adiciona (ProdutosRequest $request) {

      /* forma manual
      $nome = Request::input('nome');
      $valor = Request::input('valor');
      $descricao = Request::input('descricao');
      $quantidade = Request::input('quantidade');
      // DB::insert('insert into produtos values (null, ?, ?, ?, ?)', array($nome, $valor, $descricao, $quantidade));
      */
      
      /* instanciando um objeto
      $produto = new Produto();
      $produto->nome = Request::input('nome');
      $produto->valor = Request::input('valor');
      $produto->descricao = Request::input('descricao');
      $produto->quantidade = Request::input('quantidade');
      */
      
      // forma via mass-assignable ( pego tudo que vem no params, exceto o que eu especificar na classe)
      // $params = Request::all();


      //$produto = new Produto($params);
      //$produto->save();
      // dessa forma eu posso resolver tudo em uma linha, o framework instancia o objeto e ja envia pro banco
      // Produto::create($params);

      // estou tirando o request e colocando o validador
      // Produto::create(Request::all());

      // solução final, com tudo junto
      Produto::create($request->all());
      


      return redirect()->action('ProdutoController@lista')->withInput(Request::only('nome'));
   }

   public function altera ($id) {
      $produto = Produto::find($id);
      if(empty($produto)) {
         return "Esse produto não existe";
      }
      $produto->nome = Request::input('nome');
      $produto->valor = Request::input('valor');
      $produto->descricao = Request::input('descricao');
      $produto->quantidade = Request::input('quantidade');
      $produto->tamanho = Request::input('tamanho');
      $produto->save();
      return redirect()->action('ProdutoController@lista')->withInput(Request::only('nome'));
   }

   public function remove($id){
      $produto = Produto::find($id);
      $produto->delete();
      return redirect()->action('ProdutoController@lista');
   }

}
