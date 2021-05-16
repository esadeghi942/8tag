<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\Leavement;
use App\Models\Worktime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\Jalalian;
use DateTime;

class HomeController extends Controller
{
    public function redirectUser(){
        if (Auth::user()->type == 2)
            return redirect()->route('admin');
        else {
            $user_id=Auth::id();
            $month=Jalalian::now()->getMonth();
            $year=Jalalian::now()->getYear();
            $worktimes=Worktime::all()->where('user_id',$user_id);
            $sumworktime=strtotime("00:00:00");
            foreach ($worktimes as $wt) {
                $date=explode(',',$wt->date)[1];
                $date=Jalalian::fromFormat('Y/n/j', $date);
                if($date->getMonth()== $month && $date->getYear()== $year) {
                    $time2=strtotime($wt->total);
                    $sumworktime +=$time2;
                }
            }
            $sumworktime=new Carbon($sumworktime);
            $sumworktime=$sumworktime->format('H:i');
            $leavements=Leavement::all()->where('user_id',$user_id);
            $restleavement=strtotime("20:00:00");
            foreach ($leavements as $leavement) {
                $date=Jalalian::fromFormat('Y/n/j', $leavement->date);
                if($leavement->status==2 && $date->getMonth()== $month && $date->getYear()== $year) {
                    $time=strtotime($leavement->date_count);
                    $restleavement -= $time;
                }
            }
            $restleavement=new Carbon($restleavement);
            $restleavement=$restleavement->format('H:i');
            return view('user.index',compact('sumworktime','restleavement'));
        }
    }

    public function reloadCaptcha(){
        return response()->json(['captcha'=> captcha_img()]);
    }

}
