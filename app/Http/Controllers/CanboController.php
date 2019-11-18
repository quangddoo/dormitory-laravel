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

class CanboController extends Controller
{
    //Trang Chu
    public function trangchu(){
        return view('pages.trangchu');
    }

    #Duyệt ĐK
    public function cbql_duyetdk(){
        $id_khu = canboquanly::where('email',Auth::user()->email)->value('id_khu');
        $ttphong = phong::where('id_khu',$id_khu)->get();
        $max = phong::where('id_khu',$id_khu)->max('id');
        $count = phong::where('id_khu',$id_khu)->count();
        $list = phieudangky::where([
            ['nam',date('Y')],
            ['trangthaidk','registered'],
            ['id_phong','>',($max-$count)],
            ['id_phong','<=',$max]
        ])->get();
        return view('pages.cbql_duyetdk',['list'=>$list,'ttphong'=>$ttphong]);
    }

    #Xem Danh sách phòng


}
