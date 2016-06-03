<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Storage;
use App\Http\Requests;
use App\User;
use Validator;
use Auth;
use Mail;
use App\Post;
use App\Photo;
use Illuminate\Support\Facades\Input;

class PostController extends Controller
{
    public function handleSearch(Request $request)
    {
        if (empty($_POST)) {
            return view('post/search');
        }
        else  {
            $posts = Post::where('title', 'like', '%' . $request->input('search') . '%')->orderBy('created_at', 'desc')->get();
            return view('post/search')->with('posts', $posts);
        }
    }

    public function showSearch()
    {
        return view('post/search');
    }

    public function handleMyPost(Request $request)
    {
        foreach (Input::only('delete', 'update') as $key => $value) {
            if ($value && method_exists(new PostController(), $key)) {
                $this->$key($request, $value);
            }
        }
        return back();
    }

    public function update(Request $request, $id)
    {
        $messages = array(
            'required'  => 'The :attribute field is required.',
            'max'       => 'The :attribute field must be shorter',
        );

        $v = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'price' => 'required|numeric',
            'content' => 'required|max:500',
        ], $messages);

        if ($v->fails())
        {
            $messages = $v->messages();
            return back()->withInput()->withErrors($v);
        }
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->price = $request->input('price');
        $post->save();
        return redirect('post/' . $id);
    }

    protected function delete($request, $id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect('/');
    }

    public function showPost($id)
    {
        $post = Post::with('photos')->where('id', '=', $id)->first();
        return view('post/show')->with('post' ,$post);
    }

    public function showMyposts()
    {
        $posts = Post::with('photos')->where('user_id', '=', Auth::user()->id)->orderby('posts.created_at', 'desc')->get();
        return view('post/my_posts')->with('posts' ,$posts);
    }

    public function create()
    {
        return view('post/create_post');
    }

    public function store(Request $request)
    {
        $messages = array(
            'required'  => 'The :attribute field is required.',
            'max'       => 'The :attribute field must be shorter',
        );

        $v = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'price' => 'required|numeric',
            'photo' => 'required',
            'content' => 'required|max:500',
        ], $messages);

        if ($v->fails())
        {
            $messages = $v->messages();
            return back()->withInput()->withErrors($v);
        }

        $postId = Post::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'content' => $request->input('content'),
            'user_id' => Auth::user()->id,
        ])->id;

        $file = Input::file('photo');
        for ($i = 0; $i < count($file); $i++)
        {
            if ($file[$i] && $file[$i]->isValid())
            {
                if (!is_dir('uploads' . DIRECTORY_SEPARATOR . Auth::user()->id)) {
                    mkdir('uploads' . DIRECTORY_SEPARATOR . Auth::user()->id);
                }
                if (!is_dir('uploads' . DIRECTORY_SEPARATOR . Auth::user()->id . DIRECTORY_SEPARATOR . $postId)) {
                    mkdir('uploads' . DIRECTORY_SEPARATOR . Auth::user()->id . DIRECTORY_SEPARATOR . $postId);
                }
                $extension = $file[$i]->getClientOriginalExtension();
                $file[$i]->move('uploads' . DIRECTORY_SEPARATOR . Auth::user()->id . DIRECTORY_SEPARATOR . $postId, $file[$i]->getFilename() . '.' . $extension);
                $filename = $file[$i]->getFilename();
                $mime = $file[$i]->getClientMimeType();
                $original_filename = $file[$i]->getClientOriginalName();
                Photo::create([
                    'mime' => $mime,
                    'original_filename' => $original_filename,
                    'filename' => $filename . '.' . $extension,
                    'extension' => $extension,
                    'user_id' => Auth::user()->id,
                    'post_id' => $postId,
                ]);
            }
        }
        return redirect('home');
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
