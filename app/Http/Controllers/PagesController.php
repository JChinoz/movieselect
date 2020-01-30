<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome to MovieSelect!';
        $client = new \GuzzleHttp\Client();
        $request = $client->get('http://www.omdbapi.com/?apikey=dbb02d95&s=dead&page=1');
        $response = json_decode($request->getBody());
        
        return view('pages.index')->with('data', $response);
    }
}
