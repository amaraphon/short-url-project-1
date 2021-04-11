<?php

namespace App\Http\Controllers;

use App\Item;
use App\ShortUrl;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    //
    public function index() {
        $urls = ShortUrl::all();
        return view('index',compact('urls'));
    }

    public function create() {
        $count = ShortUrl::count();
        //dd($count);

        if ($count >= 15) {
            return ('You have a limit quota');
        }

        return view('create');
    }

    public function store(Request $request) {
        //dd($request->all());
        //dd($this->randString());
        $long_url = $request->get('long_url');
        $short_url = $this->randString();
        ShortUrl::create([
            'long_url'=>$long_url,
            'short_url'=>$short_url
        ]);
        return redirect('/')->with('success','SAVE SUCCESSFULLY');
    }

    public function randString() {
        $characters = 'abcdefghijklmnopqrstuvwxyz';
        $numbers = '0123456789';
        //dd(rand(0,5));
        //dd(strlen($characters));
        //dd($characters[1]);

        $charLength = strlen($characters);
        $numLength = strlen($numbers);
        $string = '344';
        for ($i=0 ; $i<3 ; $i++) {
            $string.= $characters[rand(0,$charLength-1)];
        }
        for ($i=0 ; $i<2 ; $i++) {
            $string.= $numbers[rand(0,$numLength-1)];
        }

        return $string;
    }

    public function check($code) {
        //dd($code);
        $result = ShortUrl::Where('short_url',$code)->first();
        //dd($result);

        if ($result) {
            return redirect()->away($result->long_url);
        }
        return ('ไม่พบรหัส Short URL นี้');
    }

    public function delete($id)
    {
        //
        $url = ShortUrl::findOrFail($id);
        $url->delete();

        return  response()->json(['status'=>'ลบข้อมูลเรียบร้อยแล้ว']);
    }
}
