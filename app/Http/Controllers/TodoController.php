<?php

namespace App\Http\Controllers; //名前空間を使用することにより違う空間なら同じ名前の関数を定義できる

use Illuminate\Http\Request; //中で使うクラスの宣言
use App\Todo; //MODELを継承しているのでDB操作を可能にする
use Auth;  //ログインしているユーザーをAuth::id()という形で取得する

class TodoController extends Controller //extendsでコントローラーの継承をしている
{

    private $todo;  //privateはclass内でしか使えない変数 $instanceClassがはいる
    protected $dates = ['deleted_at'];

    public function __construct(Todo $instanceClass) //インスタンス作成をする ublicはどこからでもアクセスできる
    {
        //返り値はmiddlewereOptionsクラス options: $id[]が帰ってくる
        $this->middleware('auth');  //ログインしていない場合はtodoの一覧は表示されないミドルウェアはアプリケーションが送信されたHTTPリクエストをフィルタリングするメカニズムを提供
        $this->todo = $instanceClass;  //thisはクラスを指している(プロパティやメソッドを使う時に)
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     //model -> eroquent -> collection
    public function index()
    {
        //複数の結果を取得するall()やget()などはcollectionインスタンスを返す
        // $todos = $this->todo->all(); //eroquentメソッドのall()を使ったタイミングでSELECT * FROM todos;が発行されている all()の返り値はcollectionクラス
        $todos = $this->todo->getByUserId(Auth::id());
        // dd(compact('todos'))['todlists' => $todos]);  //この形になる　カラムが増えた際に可読性が上がる
        return view('todo.index', compact('todos')); //view(.bladeより前の値を指定,ビューで使用するデータ) keyが$todos valueがall()で取得
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo.create');  //新規作成画面に遷移

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //DBにデータを格納するメソッド
    //requestとはブラウザを通してユーザーから送られてくる情報をすべて含んでいるオブジェククト
    public function store(Request $request) //引数でファイルの上部にあるRequestを$requestに代入　これを使うことでフォームで送信したPOSTを受け取れる
    {
        $input = $request->all(); //全入力を連想配列取得
        $input['user_id'] = Auth::id();
        $this->todo->fill($input)->save(); //$fillableにしたtitleカラムを指定する fill($input)の返り値はインスタンスされたtodo ave()でデータを更新 save()の返り値はtrue
        return redirect()->route('todo.index');  //Redirectorインスタンスが返り値 to()でパスを指定 URIはtodoで methodはgetをcontentsプロパティの中の<a>で指定している
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) //routeで見るとtodo/{todo}/editとなっている }{todo}の箇所がパラメーター扱いになる
    {
        $todo = $this->todo->find($id); //find()パラメーターで渡ってきた値をもとにDBから値を取得を行なっている 返り値は取得してきた値とTodoインスタンス
        return view('todo.edit', compact('todo'));  //viewインスタンスが返り値 compactには todoインスタンスが配列として入ってる
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)  // $requestを使うことでフォームで送信したPOSTを受け取れる それからルートパラメーターのidへアクセスします。
    {
        $input = $request->all(); //Requestインスタンスのall()メソッドでformからの入力を連想配列取得  メソッド　トークン　タイトルを取得
        //all()でformからの入力情報を取得して,find()でfindで主キーに当てはまるものをDBから値を取得を行なっている fillで余分なカラムを排除　saveで保存
        $this->todo->find($id)->fill($input)->save(); //findで主キーに当てはまるものをDBから値を取得を行なっている fillでfillableのカラムの確認　 save()の返り値はtrue
        return redirect()->route('todo.index');   //Redirectorインスタンスが返り値 to()でパスを指定
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->todo->find($id)->delete();  //パラメーターで渡ってきた値をもとにDBから値を取得を行なっている　delte()で複数削除 delete()の返り値は影響を受けたレコードの件数

        return redirect()->route('todo.index'); //Redirectorインスタンスが返り値 to()でパスを指定
    }

    // public function hoge()
    // {
    //    $todos =  $this->todo->all();
    //    return view('todo.index', compact('todos'));
    // }
}
