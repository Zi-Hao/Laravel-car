<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;


class LinksController extends Controller
{
    public function footer()
    {
        $links = Link::query()->where('status',1)->where('release',1)->get();
        return view('layouts._footer',['links' =>$links]);
    }
}
