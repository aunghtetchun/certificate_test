<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::latest()->get();
        return view('post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "nrc" => "required",
            "photo" => "required",
        ]);

        $post = new Post();
        $post->name = $request->name;
        $post->nrc=$request->nrc;

        $previewOriginalDir = 'user_photo/';
        $certificateDir='certificate_photo/';
        $user_thumbnail='user_thumbnail/';

        if ($request->hasFile('photo')){
            $user_photo='user_'.uniqid().'.'.$request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move($previewOriginalDir, $user_photo);
            $photo = $previewOriginalDir.$user_photo;

            $certificate = Image::make(public_path('certificate/certificate.png'));
            $certificate_name = 'certificate_'.uniqid().'.'.pathinfo(public_path('certificate/certificate.jpg'), PATHINFO_EXTENSION);
            $certificate->orientate();
//            $certificate->resize(4960, 7016,  function($constraint){
//                $constraint->upsize();
//                $constraint->aspectRatio();
//            });
            $certificate->text($request->name, 550, 830, function($font) {
                $font->file(public_path('fonts/Futura-Medium.ttf'));
                $font->size(75);
                $font->color('#000000');
                $font->align('left');
                $font->valign('top');
                $font->angle(0);
            });
            $text="NRC No            -  ".$request->nrc;
            $certificate->text( $text, 550, 915, function($font) {
                $font->file(public_path('fonts/Lato-light.ttf'));
                $font->size(45);
                $font->color('#000000');
                $font->align('left');
                $font->valign('top');
                $font->angle(0);
            });
            $text="Verify Code      -  ".base64_encode(openssl_random_pseudo_bytes(15));;
            $certificate->text( $text, 550, 975, function($font) {
                $font->file(public_path('fonts/Lato-light.ttf'));
                $font->size(45);
                $font->color('#000000');
                $font->align('left');
                $font->valign('top');
                $font->angle(0);
            });
            $text="for successfully completing a course of studies in,";
            $certificate->text( $text, 550, 1040, function($font) {
                $font->file(public_path('fonts/Lato-light.ttf'));
                $font->size(45);
                $font->color('#000000');
                $font->align('left');
                $font->valign('top');
                $font->angle(0);
            });
            $from='4';
            $to='5';

            $text="From $from May To $to Aug 2019";
            $certificate->text( $text, 260, 1500, function($font) {
                $font->file(public_path('fonts/Lato-light.ttf'));
                $font->size(65);
                $font->color('#000000');
                $font->align('left');
                $font->valign('top');
                $font->angle(0);
            });

            $user_thumb = $user_thumbnail.$user_photo;
            $user = Image::make(public_path($photo));
            $user->save(public_path($user_thumb));
            $user->fit(250,250)->orientate();
            $width = $user->getWidth();
            $height = $user->getHeight();
            $mask = Image::canvas($width, $height);
            // draw a white circle
            $mask->circle($width, $width/2, $height/2, function ($draw) {
                $draw->background('#fff');
            });

            $user->mask($mask, false);
            $certificate->insert($user, 'top-left', 241, 833);
            $certificate_store=$certificateDir.$certificate_name;
            $certificate->save(public_path($certificate_store));
            return $certificate->response('png');
            $post->photo=$user_photo;
            $post->certificate = $certificate_store;

        }
//        return "how are you";
        $post->save();
        return redirect()->route("post.index")->with("toast","<b>$post->name</b> is successfully created 😊");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $request->validate([
            "name" => "required",
            "nrc" => "required",
        ]);

        $post->name = $request->name;
        $post->nrc=$request->nrc;

        $previewOriginalDir = 'user_photo/';
        $certificateDir='certificate_photo/';
        $user_thumbnail='user_thumbnail/';

        if ($request->hasFile('photo')) {
            $user_photo = 'user_' . uniqid() . '.' . $request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move($previewOriginalDir, $user_photo);
            $photo = $previewOriginalDir . $user_photo;

            $certificate = Image::make(public_path('certificate/certificate.png'));
            $certificate_name = 'certificate_' . uniqid() . '.' . pathinfo(public_path('certificate/certificate.jpg'), PATHINFO_EXTENSION);
            $certificate->orientate();
            $certificate->resize(4960, 7016, function ($constraint) {
                $constraint->upsize();
                $constraint->aspectRatio();
            });
            $c_name=$request->name;
            $certificate->text($c_name, 500, 500, function ($font) {
                $font->file(public_path('fonts/Futura-Medium.ttf'));
                $font->size(50);
                $font->color('#000000');
                $font->align('left');
                $font->valign('top');
                $font->angle(0);
            });
            $c_nrc=$request->nrc;
            $text = "NRC No            -  ".$c_nrc;
            $certificate->text($text, 500, 570, function ($font) {
                $font->file(public_path('fonts/Lato-light.ttf'));
                $font->size(30);
                $font->color('#000000');
                $font->align('left');
                $font->valign('top');
                $font->angle(0);
            });
            $text = "Verify Code     -  ".base64_encode(openssl_random_pseudo_bytes(13));;
            $certificate->text($text, 500, 620, function ($font) {
                $font->file(public_path('fonts/Lato-light.ttf'));
                $font->size(30);
                $font->color('#000000');
                $font->align('left');
                $font->valign('top');
                $font->angle(0);
            });
            $text = "for successfully completing a course of studies in,";
            $certificate->text($text, 500, 670, function ($font) {
                $font->file(public_path('fonts/Lato-light.ttf'));
                $font->size(30);
                $font->color('#000000');
                $font->align('left');
                $font->valign('top');
                $font->angle(0);
            });

            $user_thumb = $user_thumbnail . $user_photo;
            $user = Image::make(public_path($photo));
            $user->save(public_path($user_thumb));
            $user->resize(200, 200)->orientate();
            $width = $user->getWidth();
            $height = $user->getHeight();
            $mask = Image::canvas($width, $height);
            // draw a white circle
            $mask->circle($width, $width / 2, $height / 2, function ($draw) {
                $draw->background('#fff');
            });

            $user->mask($mask, false);
            $certificate->insert($user, 'top-left', 150, 500);
            $certificate_store = $certificateDir . $certificate_name;
            $certificate->save(public_path($certificate_store));

            $post->photo = $user_photo;
            $post->certificate = $certificate_store;
        }
        else{
            $certificate = Image::make(public_path('certificate/certificate.png'));
            $certificate_name = 'certificate_' . uniqid() . '.' . pathinfo(public_path('certificate/certificate.jpg'), PATHINFO_EXTENSION);
            $certificate->orientate();
            $certificate->resize(4960, 7016, function ($constraint) {
                $constraint->upsize();
                $constraint->aspectRatio();
            });
            $c_name=$request->name;
            $certificate->text($c_name, 500, 500, function ($font) {
                $font->file(public_path('fonts/Futura-Medium.ttf'));
                $font->size(50);
                $font->color('#000000');
                $font->align('left');
                $font->valign('top');
                $font->angle(0);
            });
            $c_nrc=$request->nrc;
            $text = "NRC No            -  ".$c_nrc;
            $certificate->text($text, 500, 570, function ($font) {
                $font->file(public_path('fonts/Lato-light.ttf'));
                $font->size(30);
                $font->color('#000000');
                $font->align('left');
                $font->valign('top');
                $font->angle(0);
            });
            $text = "Verify Code     -  ".base64_encode(openssl_random_pseudo_bytes(13));;
            $certificate->text($text, 500, 620, function ($font) {
                $font->file(public_path('fonts/Lato-light.ttf'));
                $font->size(30);
                $font->color('#000000');
                $font->align('left');
                $font->valign('top');
                $font->angle(0);
            });
            $text = "for successfully completing a course of studies in,";
            $certificate->text($text, 500, 670, function ($font) {
                $font->file(public_path('fonts/Lato-light.ttf'));
                $font->size(30);
                $font->color('#000000');
                $font->align('left');
                $font->valign('top');
                $font->angle(0);
            });

            $user_thumb = $user_thumbnail . $request->original_user_photo;
            $user = Image::make(public_path($user_thumb));
            $user->resize(200, 200)->orientate();
            $user->save(public_path($user_thumb));
            $width = $user->getWidth();
            $height = $user->getHeight();
            $mask = Image::canvas($width, $height);
            // draw a white circle
            $mask->circle($width, $width / 2, $height / 2, function ($draw) {
                $draw->background('#fff');
            });

            $user->mask($mask, false);
            $certificate->insert($user, 'top-left', 150, 500);
            $certificate_store = $certificateDir . $certificate_name;
            $certificate->save(public_path($certificate_store));

            $post->photo = $request->original_user_photo;
            $post->certificate = $certificate_store;
        }
        $post->update();
        return redirect()->route("post.index")->with("toast","<b>$post->name</b> is successfully updated 😊");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $name = $post->name;
        $post->delete();
        return redirect()->route("post.index")->with("toast","<b>$name</b> is successfully deleted 😊");
    }
}
