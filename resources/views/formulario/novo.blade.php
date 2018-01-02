@extends('layout/principal')

@section('conteudo')
<form action="/produtos/adiciona" method="post">
   <!-- no lavarel, ele envia um token na visualização, e espera receber este token de volta ao enviar, para segurança -->
   <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

   <div class="form-group">
      <label for="">Nome</label>
      <input name="nome" type="text" class="form-control">
   </div>

   <div class="form-group">
      <label for="">Valor</label>
      <input name="valor" type="text" class="form-control">
   </div>

   <div class="form-group">
      <label for="">Quantidade</label>
      <input name="quantidade" type="text" class="form-control">
   </div>

   <div class="form-group">
      <label for="">Descricao</label>
      <input name="descricao" type="text" class="form-control">
   </div>

   <button type="submit" class="btn btn-primary btn-block">Adicionar</button>

</form>

@stop