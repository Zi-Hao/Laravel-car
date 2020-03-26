<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Requests\BookingsRequest;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\InvalidRequestException;

class BookingsController extends Controller
{
    //显示预约
    public function index(Request $request)
    {
        $user = Student::query()->where('name',Auth::user()->name)->count();//判断教练通过审核
        if ($user == ''){
            throw new InvalidRequestException('未选择教练！');
        }
        return view('bookings.index',
            ['booking' => $request->user()->booking,],
            ['count' => $request->user()->booking->count()]);
    }

    //新增预约
    public function create()
    {
        $student = Student::query('name',Auth::user()->name)->value('coach');//选当前学员的教练
        return view('bookings.create_and_edit',
            ['bookings' => new Booking(),'students' => $student]);
    }

    //提交预约
    public function store(BookingsRequest $request)
    {
        $request->user()->booking()->create($request->only([
            'name',
            'subject',
            'booking_time',
            'coach',
            'complete'
        ]));

        return redirect()->route('bookings.index');
    }

    //修改预约
    public function edit(Booking $bookings)
    {
        $this->authorize('own', $bookings);
        $student = Student::query('name',Auth::user()->name)->value('coach');//选当前学员的教练
        return view('bookings.create_and_edit', ['bookings' => $bookings,'students' =>$student]);
    }

    //更新预约
    public function update(Booking $bookings, BookingsRequest $request)
    {
        $this->authorize('own', $bookings);
        $bookings->update($request->only([
            'name',
            'subject',
            'booking_time',
            'coach',
            'complete'
        ]));

        return redirect()->route('bookings.index');
    }

    //删除预约
    public function destroy(Booking $bookings)
    {
        $this->authorize('own', $bookings);
        $bookings->delete();

        return redirect()->route('bookings.index');
    }
}
