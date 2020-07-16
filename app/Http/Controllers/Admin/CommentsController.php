<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Comment;
use App\Specie;
use App\Language;
use Gate;
use App\Tour;
use App\User;
use App\CommentPlus;
use App\ComsComtPlus;

class CommentsController extends Controller
{
    public function index() {

        $language_id = Language::select('id')->where('locale', session('language'))->first()->id;
        $languages = Language::all();
        $species = Specie::where(['public' => true, 'language_id' => $language_id])->get(); 

        $comments = Comment::all();
        $tours = Tour::all();
        $users = User::all();
        $commentpluses = CommentPlus::all();

        return view('admin.comments.comments-view')->with([
            'languages' => $languages,
            'species' => $species,
            'comments' => $comments,
            'tours' => $tours,
            'users' => $users,
            'commentpluses' => $commentpluses

        ]);
    }


    public function view_comment_plus(Request $request) {

        $comment = Comment::where(['id' => $request->id])->first();
        $language_id = Language::select('id')->where('locale', session('language'))->first()->id;

        $commentpluses_selected_true = $comment->coms_comt_pluses_true->where();
        

        //dd($commentpluses_selected_true);
        if(count($commentpluses_selected_true) > 0 ){
            foreach ($commentpluses_selected_true as $key => $commentpluses) {
                $comments_id_true[$key] = $commentpluses->id;
            }      
            $commentpluses_true = CommentPlus::where(['public' => 1, 'position' => 1])->whereNotIn('id', $comments_id_true)->get();
        } else {
            $commentpluses_true = CommentPlus::where(['public' => 1, 'position' => 1])->get();
        }

        $commentpluses_selected_false = $comment->coms_comt_pluses_false;
        if(count($commentpluses_selected_false) > 0 ){
            foreach ($commentpluses_selected_false as $key => $commentpluses) {
                $comments_id_false[$key] = $commentpluses->id;
            }
            $commentpluses_false = CommentPlus::where(['public' => 1, 'position' => 0])->whereNotIn('id', $comments_id_false)->get();
        } else {
           $commentpluses_false = CommentPlus::where(['public' => 1, 'position' => 0])->get(); 
        }

        return view('admin.comments.comment_plus')->with([
            'comment' => $comment,
            'commentpluses_selected_true' => $commentpluses_selected_true,
            'commentpluses_true' => $commentpluses_true,
            'commentpluses_selected_false' => $commentpluses_selected_false,
            'commentpluses_false' => $commentpluses_false
        ])->render();
    }

    public function create()
    {
        //
    }

    public function store(Request $request) {
        // if(Gate::denies('create', new Permission)) {
        //     abort(403, 'Немає прав на додавання видів турів!!!');
        // }

        $data['text'] = $request->text;
        $data['country'] = $request->country;
        $data['rating'] = $request->rating;
        if($request->public){
            $data['public'] = true;
        }
        $data['tour_id'] = $request->tour_id;
        $data['user_id'] = $request->user_id;
        
        $comment = new Comment;
        $comment->fill($data);

        if($comment->save()) {

            if($request->comment_pluses_true){
                foreach ($request->comment_pluses_true as $comment_plus) {
                    $item['comment_id'] = $comment->id;
                    $item['comment_plus_id'] = $comment_plus;

                    $coms_comt_plus = new ComsComtPlus;
                    $coms_comt_plus->fill($item);
                    $coms_comt_plus->save();
                }
            }

            if($request->comment_pluses_false){
                foreach ($request->comment_pluses_false as $comment_plus) {
                    $item['comment_id'] = $comment->id;
                    $item['comment_plus_id'] = $comment_plus;

                    $coms_comt_plus = new ComsComtPlus;
                    $coms_comt_plus->fill($item);
                    $coms_comt_plus->save();
                }
            }
            
            
            $comments = Comment::all();
            $tours = Tour::all();
            $users = User::all();
            $languages = Language::all();

            return view('admin.comments.comments_table')->with([
                'comments' => $comments,
                'tours' => $tours,
                'users' => $users,
                'languages' => $languages,
                'success_message' => 'Добавлено!!'
            ])->render();

        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $data['text'] = $request->text;
        $data['country'] = $request->country;
        $data['rating'] = $request->rating;
        if($request->public){
            $data['public'] = true;
        }
        $data['tour_id'] = $request->tour_id;
        $data['user_id'] = $request->user_id;

        $comment = Comment::where(['id' => $id])->first();
        $comment->fill($data);

        if($comment->update()) {
            if($comment->commentplus){   
                foreach ($comment->commentplus as $i) {
                    $i->delete();
                }
            }

            //dd($comment->id);
            if($request->comment_pluses_true){
                //dd($request->comment_pluses_true);
                foreach ($request->comment_pluses_true as $comment_plus) {
                    $item['comment_id'] = $comment->id;
                    $item['comment_plus_id'] = $comment_plus;

                    $coms_comt_plus = new ComsComtPlus;
                    $coms_comt_plus->fill($item);
                    $coms_comt_plus->save();
                }
            }

            if($request->comment_pluses_false){
                //dd($request->comment_pluses_false);
                foreach ($request->comment_pluses_false as $comment_plus) {
                    $item['comment_id'] = $comment->id;
                    $item['comment_plus_id'] = $comment_plus;

                    $coms_comt_plus = new ComsComtPlus;
                    $coms_comt_plus->fill($item);
                    $coms_comt_plus->save();
                }
            }
            
            $comments = Comment::all();
            $tours = Tour::all();
            $users = User::all();
            $languages = Language::all();

            return view('admin.comments.comments_table')->with([
                'comments' => $comments,
                'tours' => $tours,
                'users' => $users,
                'languages' => $languages
            ])->render();

        } else {
            return 'Помилка';  
        }
    }


    public function destroy($id) {
 
        $comment = Comment::where(['id' => $id])->first();

        foreach ($comment->commentplus as $i) {
            $i->delete();
        }

        if($comment->delete()) {

            $comments = Comment::all();
            $tours = Tour::all();
            $users = User::all();
            $languages = Language::all();

            return view('admin.comments.comments_table')->with([
                'comments' => $comments,
                'tours' => $tours,
                'users' => $users,
                'languages' => $languages
            ])->render();

        } else {
            return 'Помилка';  
        }
    }

    public function public(Request $request) {
        $comment = Comment::where(['id' => $request->id])->first();

        if($comment->public == false){
            $status = 'yes';
            $comment['public'] = true;
        } else {
            $status = 'no';
            $comment['public'] = false; 
        }

        if($comment->update()) {
            return $status;
        }
    }
}
