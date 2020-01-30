<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Welcome to MovieSelect!';
        $client = new \GuzzleHttp\Client();
        $request = $client->get('http://www.omdbapi.com/?apikey=dbb02d95&s=dead&page=1');
        $response = json_decode($request->getBody());
        if(Auth::guest()){
            $like = "";
        } else {
            $like = Like::where('user_id', auth()->user()->id)->get();
        }
        $data = array(
            'response' => $response,
            'like' => $like
        );
        // return $like;
        return view('pages.index')->with($data);
        // return view('/')->with('like', $like);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
        // Create Posts

        // if(Like::where('movieId', $id)->exists()){
        //     $like = Like::where([
        //         ['movieId', '=', $id],
        //         ['user_id', '=', auth()->user()->id],
        //     ])->get();
        // } else{
            $like = new Like;
            $like->movieId = $id;
            $like->user_id = auth()->user()->id;
        // }
        $like->likeFlag = 1;
        $like->save();

        return redirect('/')->with('success', 'Liked');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $disLike = Like::where('movieId', $id);
        $disLike->delete();

        return redirect('/')->with('danger', 'Disliked');
    }
}
