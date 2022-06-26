<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use APP\Models\Answer;
use APP\Models\Question;
// use APP\Models\User;
use Auth;



class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('answer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // バリデーション
      $validator = Validator::make($request->all(), [
        'body' => 'required',
      ]);
      // バリデーション:エラー
      if ($validator->fails()) {
        return redirect()
          ->route('question.show')
          ->withInput()
          ->withErrors($validator);
      }
    //   ddd($question);
      
      // 編集フォームから送信されてきたデータとユーザーIDをマージし、DBにinsertする
      $data = $request->merge(['user_id' => Auth::user()->id])->all();
      // create()は最初から用意されている関数
      // 戻り値は挿入されたレコードの情報
    //   $question_id = \App\Models\Question::find('1')->questionAnswers;
    //   ddd($data);
      $result = \App\Models\Answer::create($data);
      // ddd($result);
      $question_id = $result->question_id;
      // ddd($question_id);
      // $answer = \App\Models\Answer::find($id);
    //   ddd($result);
      // ルーティング「question.show」にリクエスト送信.詳細画面へ移動
      return redirect()->route('question.show',['question' => $question_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return view('question.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    
}