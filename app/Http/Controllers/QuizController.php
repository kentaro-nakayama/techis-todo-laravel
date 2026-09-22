<?php
// 他ファイルからこのファイル内のクラスを呼び出すときには，
// namespaceとクラス名を組み合わせてパスを記述するので，この2つが大切
// 毎回パスを記述するのは大変なので，use宣言をしておく．
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Company;
use App\Models\Sale;

class QuizController extends Controller
{
    // quiz2.blade.phpを表示
    public function index() {
        return view('question.quiz2');
    }

    public function show() {
        // Quizzesテーブルの全データを取得
        $quizzes = Quiz::all();
        return view('question.quiz3', compact('quizzes'));
    }

    public function quiz4_show() {
        $fruits = 'apple';
        return view('question.quiz4', compact('fruits'));
    }

    public function login(Request $request) {
        // セッションの削除
        $request->session()->flush();
        // ログインユーザーの情報
        $user_info = [
            'email' => 'techis@test',
            'password'=> '1234',
        ];
        // ログインチェック
        if (Auth::attempt($user_info)) {
            // ログインに成功
            return view('question.quiz5');
        };

        // ログインに失敗
        return view('question.quiz5');
    }

    public function quiz6_show() {
        // Quizzesテーブルから取得したデータ
        $quizzes = Quiz::all();
        // $quizzes = [
        //     // 1行目のデータ（オブジェクト）
        //     0 => QuizModel {
        //         'id' => 1,
        //         'name' => 'sample_name_1',
        //         'type' => 1,
        //         'created_at' => '2026-01-01 00:00:00',
        //         'updated_at' => '2026-01-01 00:00:00',
        //     },
        //     // 2行目のデータ（オブジェクト）
        //     1 => QuizModel {
        //         'id' => 2,
        //         'name' => 'sample_name_2',
        //         'type' => 2,
        //         'created_at' => '2026-01-02 00:00:00',
        //         'updated_at' => '2026-01-02 00:00:00',
        //     }, ...
        // ];
        return view('question.quiz6', compact('quizzes'));
    }

    public function quiz7_show() {
        // Quizモデルを呼び出し，quizzesテーブルから1件抽出
        $quiz = Quiz::first();
        return view('question.quiz7', compact('quiz'));
    }

    public function quiz8_redirect() {
        return redirect('quiz7');
    }

    public function quiz9_show($id) {
        $quiz = Quiz::find($id);
        return view('question.quiz9', compact('quiz'));
    }

    public function quiz10_show() {
        // view関数の引数には，viewフォルダの中のファイルパスを指定する．
        return view('question.quiz10');
    }

    public function quiz10_store(Request $request) {
        // バリデーション
        $request->validate([
            'name'=> 'required|max: 30',
            'type'=> 'required',
        ]);

        // 登録処理
        Quiz::create([
            'name' => $request->name,
            'type' => $request->type,
        ]);

        // redirect関数の引数には，urlを指定する．
        return redirect('quiz10');
    }

    public function quiz11_show_all() {
        // companiesテーブルから全件取得
        $companies = Company::all();
        // salesテーブルから全件取得
        $sales = Sale::all();
        return view('question/quiz11', compact('companies','sales'));
    }

    public function quiz11_show_get() {
        // companiesテーブルから条件付きで取得
        $companies = Company::where('founding_date', 'LIKE', '%-03-%')
                            ->where('address', 'LIKE', 'テスト2%')
                            ->get();
        // companiesテーブルから条件付きで取得
        $sales = Sale::where('company_id', '2')
                        ->orWhere('sales', '>', '8000')
                        ->orderBy('sales','DESC')
                        ->get();
        return view('question.quiz11', compact('companies','sales'));
    }

    public function quiz12_show($id) {
        $quiz = Quiz::findOrFail($id);
        return view('question.quiz12', compact('quiz'));
    }

    public function quiz12_update($id, Request $request) {
        $quiz = Quiz::findOrFail($id);
        $quiz->update([
            'name' => $request->name,
            'type'=> $request->type,
        ]);
        return redirect('quiz3');
    }

    public function quiz12_delete($id) {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();
        return redirect('quiz3');
    }
}
