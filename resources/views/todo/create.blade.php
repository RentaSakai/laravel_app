@extends ('layouts.app')
@section ('content')

<h2 class="mb-3">ToDo作成</h2>
{!! Form::open (['route' => 'todo.store',]) !!}  <!--formが生成される route名からURL作成する -->
  <div class="form-group">
    {!! Form::input('text', 'title', null, ['required', 'class' => 'form-control', 'placeholder' => 'ToDo内容']) !!} <!--第一引数にtype属性　第二引数にname属性　フィールド名(postで渡す名前) 第3引数がvalueの初期値 第四引数がidやクラスを指定する時 requiredは入力必須を表している-->
  </div>
  {!! Form::submit('追加', ['class' => 'btn-success float-right']) !!}  <!--type submitに切り替えてくれている-->
{!! Form::close() !!}

@endsection