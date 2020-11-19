<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Photo;
class PhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::all();
        return view('welcome')->with('$photos',$photos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image'=>'required|max:3000',
            'caption'=>'required',
            'tagname'=>'required',
            'location'=>'required'
        ]);

        $image = $request->file('image');
        if (isset($image)) {
            $username = auth()->user()->name;
            $slug = Str::slug($username);
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'.'.$image->getClientOriginalExtension();
            if(!file_exists('images/posts')){
                mkdir('images/posts');
            }
            $image->move('images/posts', $imagename);
        }else{
            $pic = "default.png";
        }


        $post = new Photo();
        $post->user_id = Auth::user()->id;
        $post->photo = $pic;
        $post->caption = $request->caption;
        $post->tagname = $request->tagname;
        $post->location = $request->location;

        $post->save();

        return redirect()->to('/')->with('successMsg','Successfully made a new post');
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
    public function edit($id)
    {
        $photo = Photo::find($id);
        return view('forms.edit')->with('photo',$photo);
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
        $this->validate($request, [
            'photo'=>'required|mimes:png,jpg,jpeg,mp4,gif,bmp',
            'caption'=>'required',
            'tagname'=>'required',
            'location'=>'required'
        ]);

        if(Auth::user()){
            $username = Auth::user()->email;
        }

        if($request->file('photo')){
            $photo = $request->file('photo');
            $currentDate = Carbon::now()->toString();
            $ext = $photo->getClientOriginalExtension();
            $title = Str::slug($username);
            $photoname = $title.$currentDate.'.'.$ext;
            if(!file_exists('images/posts/'.$title)){
                mkdir('images/posts/'.$title);
            }
            $photo->move('images/posts/'.$title);
        }

        $post = Photo::find($id);
        $post->photo = $photoname;
        $post->caption = $request->caption;
        $post->tagname = $request->tagname;
        $post->location = $request->location;

        $post->save();

        return redirect()->back()->with('successMsg','Successfully Updated your Post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = Photo::find($id);
        $photo->delete();
        return redirect()->back()->with('successMsg', 'Successfully Deleted your Post');
    }
}
