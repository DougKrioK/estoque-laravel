@extends('layout/principal')

@section('conteudo')
<form action="{{action('ProdutoController@altera', $produto->id)}}" method="post">
   <!-- no lavarel, ele envia um token na visualização, e espera receber este token de volta ao enviar, para segurança -->
   <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

   <div class="form-group">
      <label for="">Nome</label>
      <input name="nome" type="text" class="form-control" value="{{ $produto->nome }}">
   </div>

   <div class="form-group">
      <label for="">Valor</label>
      <input name="valor" type="text" class="form-control" value="{{ $produto->valor }}">
   </div>

   <div class="form-group">
      <label for="">Quantidade</label>
      <input name="quantidade" type="text" class="form-control" value="{{ $produto->quantidade }}">
   </div>

   <div class="form-group">
      <label for="">Descricao</label>
      <input name="descricao" type="text" class="form-control" value="{{ $produto->descricao }}">
   </div>

   <div class="form-group">
      <label for="">Tamanho</label>
      <input name="tamanho" type="text" class="form-control" value="{{ $produto->tamanho }}">
   </div>

   <div class="form-group">
      <label>Categoria</label>
      <select name="categoria_id" class="form-control">
          @foreach($categorias as $c)
          <option value="{{$c->id}}">{{$c->nome}}</option>
          @endforeach
      </select>
  </div>

   <button type="submit" class="btn btn-primary btn-block">Alterar</button>

</form>

@stop