@extends ('layouts.app') <!--テンプレートを継承-->
@section ('content')

<h1 class="page-header">ToDo一覧</h1>
<p class="text-right">
  <a class="btn btn-success" href="/todo/create">ToDoを追加</a>
</p>
<table class="table">
  <thead class="thead-light">
    <tr>
      <th>ID</th>
      <th>やること</th>
      <th>作成日時</th>
      <th>更新日時</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($todos as $todo)
    <tr>
        <td class="align-middle">{{ $todo->id }}</td>  <!--エスケープ処理している-->
        <td class="align-middle">{{ $todo->title }}</td>  <!--エスケープ処理している-->
        <td class="align-middle">{{ $todo->created_at }}</td><!--colectionを使っているからforeachも使える-->
        <td class="align-middle">{{ $todo->updated_at }}</td>
        <td><a class="btn btn-primary" href="{{ route('todo.edit', $todo->id) }}">編集</a></td>
        <td>
          {!! Form::open(['route' => ['todo.destroy', $todo->id], 'method' => 'DELETE']) !!}  <!--form::openメソッド POSTやPUTやDDLETEで使用すると隠しフィールドとして自動的にCSRFトークンを追加-->
            {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
          {!! Form::close() !!}  <!--form::modelを使用するとform::closeを使う-->
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

@endsection