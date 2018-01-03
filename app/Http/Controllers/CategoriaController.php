<?php namespace estoque\Http\Controllers;

use Request;
use estoque\Categoria;
use estoque\Http\Requests\CategoriasRequest;

class CategoriaController extends Controller
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
      $categorias = DB::select('select * from categorias');
      */

      // usando o Eloquent ( framework ORM, para manipular as consultas ao banco)
      // metodo all(), faz uma busca por tudo da tabela.
      $categorias = Categoria::all();
      return view('categoria.listagem')->with('categorias', $categorias);
   }
   
   public function listaJson(){
      $categorias = Categoria::all();
      // se eu quiser retornar json, para uma api rest, é assim:
      return response()->json($categorias);
   }

   // se eu passar a variavel no metodo, o framework entende que é pra pegar do request
   public function mostra ($id) {
      // $id = Request::route('id', '0');
      // $categoria = DB::select('select * from categorias where id = ?', [$id]);
      $categoria = Categoria::find($id);
      
      if(empty($categoria)) {
         return "Esse categoria não existe";
      }
      // como agora estou usando o Eloquent, ele ja entende que no find() quero somente um item, entao nao me retorna mais um array
      //return view('categoria/detalhes')->with('p', $categoria[0]);
      return view('categoria/detalhes')->with('categoria', $categoria);

      
   }

   public function novo () {
      return view('categoria/novo')->with('categorias', Categoria::all());
   }

   public function adiciona (CategoriasRequest $request) {

      /* forma manual
      $nome = Request::input('nome');
      $valor = Request::input('valor');
      $descricao = Request::input('descricao');
      $quantidade = Request::input('quantidade');
      // DB::insert('insert into categorias values (null, ?, ?, ?, ?)', array($nome, $valor, $descricao, $quantidade));
      */
      
      /* instanciando um objeto
      $categoria = new Categoria();
      $categoria->nome = Request::input('nome');
      $categoria->valor = Request::input('valor');
      $categoria->descricao = Request::input('descricao');
      $categoria->quantidade = Request::input('quantidade');
      */
      
      // forma via mass-assignable ( pego tudo que vem no params, exceto o que eu especificar na classe)
      // $params = Request::all();


      //$categoria = new Categoria($params);
      //$categoria->save();
      // dessa forma eu posso resolver tudo em uma linha, o framework instancia o objeto e ja envia pro banco
      // Categoria::create($params);

      // estou tirando o request e colocando o validador
      // Categoria::create(Request::all());

      // solução final, com tudo junto
      Categoria::create($request->all());
      


      return redirect()->action('CategoriaController@lista')->withInput(Request::only('nome'));
   }

   public function altera ($id) {
      $categoria = Categoria::find($id);
      if(empty($categoria)) {
         return "Esse categoria não existe";
      }
      $categoria->nome = Request::input('nome');
      $categoria->valor = Request::input('valor');
      $categoria->descricao = Request::input('descricao');
      $categoria->quantidade = Request::input('quantidade');
      $categoria->tamanho = Request::input('tamanho');
      $categoria->save();
      return redirect()->action('CategoriaController@lista')->withInput(Request::only('nome'));
   }

   public function remove($id){
      $categoria = Categoria::find($id);
      $categoria->delete();
      return redirect()->action('CategoriaController@lista');
   }

}
