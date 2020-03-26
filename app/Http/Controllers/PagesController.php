<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use App\Models\student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Booking;
use App\Models\Article;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function root()
    {
        $image1 = Image::query()->where('release' ,1)->where('id',1)->value('image');
        $image2 = Image::query()->where('release' ,1)->where('id',2)->value('image');
        $image3 = Image::query()->where('release' ,1)->where('id',3)->value('image');
        $car = Article::query()->where('release', 1)->where('status',1)->where('sort','驾校简介')->limit(1)->get();
        $article = Article::query()->where('release', 1)->where('status',1)->where('sort','驾校文章')->limit(7)->get();
        $coach =Coach::query()->where('status',1)->limit(3)->get();
        return view('pages.root',['image1' =>$image1,'image2' =>$image2,'image3' =>$image3,'car_content'=>$car,'article'=>$article,'coaches'=>$coach]);
    }
    public function welcome()
    {
        $complete = student::query()->where('name' ,Auth::user()->name)->value('complete');
        $booking = Booking::query()->where('complete',2)->where('name',Auth::user()->name)->value('subject');
        $create = Booking::query()->where('name' ,Auth::user()->name)->where('subject','理论学习阶段')->value('created_at');
        $int = (new Carbon)->diffInDays($create, true);
        return view('pages.welcome',['complete' => $complete,'time' =>$int,'bookings'=>$booking]);
    }
}
