<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\phong;
use App\khuktx;
use App\sinhvien;
use App\phieudangky;
use App\canboquanly;
use App\users;
use DB;

use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    //
    #----------Đăng_kí_phòng_ở------------------------------------------------------------------------------------------
    public function student_dkphong()
    {
        $ttkhu = khuktx::ALL();
        return view('pages.Student_dkphong', ['ttkhu' => $ttkhu]);
    }

    public function student_chonphong($id)
    {
        $ttphong = phong::where('id_khu', '=', $id)->paginate(7);
        return view('pages.Student_dkphong', ['ttphong' => $ttphong]);
    }
    #----------Xem_đăng_kí----------------------------------------------------------------------------------------------
    public function student_xemdk(){
        $mssv = sinhvien::where('email',Auth::user()->email)->value('mssv');
        $lsdk = phieudangky::where('mssv','=',$mssv)->get();
        $ttphong = phong::all();
        $ttkhu = khuktx::all();
        return view('pages.Student_xemdk',['lsdk'=>$lsdk,'ttphong'=>$ttphong,'ttkhu'=>$ttkhu]);
    }

}
