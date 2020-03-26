<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coach;
use App\Models\Student;
use App\Exceptions\InvalidRequestException;
use Illuminate\Support\Facades\Auth;

//use Illuminate\Support\Facades\Request;

class CoachsController extends Controller
{
    public function index(Request $request)
    {
        $builder = Coach::query()->where('status', 1);

        // 判断是否有提交 search 参数，如果有就赋值给 $search 变量
        // search 参数用来模糊搜索教练
        if ($search = $request->input('search', '')) {
            $like = '%'.$search.'%';
            // 模糊搜索教练
            $builder->where(function ($query) use ($like) {
                $query->where('name', 'like', $like);
                    });
            };
        $coachs = $builder->paginate(5);

        return view('coach.index', ['coachs' => $coachs]);
    }

    public function show(Coach $coach)
    {
        $user = Coach::query()->where('name',Auth::user()->name)->count();//判断是否已选教练
        // 判断教练是否审核通过，如果没有通过则抛出异常。
        if ($coach->status == 1) {
            return view('coach.show', ['coach' => $coach,'users' => $user]);
        }
        else{
            throw new InvalidRequestException('教练员未通过审核');
        }

    }

    public function store()
    {
        $input = \Illuminate\Support\Facades\Request::all();
        Student::create($input);

        return redirect('coach');
    }
}


