@extends ('layouts.app')
@section ('content')

<h2 class="mb-3">ToDo編集</h2>
{!! Form::open(['route' => ['todo.update', $todo->id], 'method' => 'PUT']) !!} <!--fillopenはタグを生成している method指定している-->
  <div class="form-group">
    {!! Form::input('text', 'title', $todo->title, ['required', 'class' => 'form-control']) !!} <!--第一引数にtype属性　第二引数 name属性 //第3引数がvalue初期値 第四引数がidやクラスを指定する時 requiredは入力必須を表している-->
  </div>
  {!! Form::submit('更新', ['class' => 'btn btn-success float-right']) !!}
{!! Form::close() !!}

@endsection