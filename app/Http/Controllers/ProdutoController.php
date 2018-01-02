<?php namespace estoque\Http\Controllers;

use DB;
use Request;

class ProdutoController extends Controller
{
   public function lista () {
      $resposta = DB::select('select * from produtos');
      $data = [
         'produtos' => $resposta
      ];
      // se eu quiser retornar json, para uma api rest, é assim:
      // return response()->json($data);
      return view('produto/listagem', $data);


   }

   public function mostra () {
      $id = Request::route('id', '0');
      $resposta = DB::select('select * from produtos where id = ?', [$id]);
      
      if(empty($resposta)) {
         return "Esse produto não existe";
      }
      return view('produto/detalhes')->with('p', $resposta[0]);
   }

   public function novo () {
      return view('formulario/novo');
   }

   public function adiciona () {

      $nome = Request::input('nome');
      $valor = Request::input('valor');
      $descricao = Request::input('descricao');
      $quantidade = Request::input('quantidade');

      DB::insert('insert into produtos values (null, ?, ?, ?, ?)', array($nome, $valor, $descricao, $quantidade));

      return redirect()->action('ProdutoController@lista')->withInput(Request::only('nome'));
   }
}
