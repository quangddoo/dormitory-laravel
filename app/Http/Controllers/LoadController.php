<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\phieudangky;
use App\canboquanly;
use App\sinhvien;
use Illuminate\Support\Facades\Auth;
use App\phong;
use App\khuktx;
use App\users;
use DB;
use Validator;

use Illuminate\Support\MessageBag;

class LoadController extends Controller
{
	
    #-------------CBQL------

    public function get_cbql_duyetdk($mssv){
         $mscb = canboquanly::where('email',Auth::user()->email)->value('mscb');
         phieudangky::where([
            ['mssv',$mssv],
            ['nam',date('Y')],
         ])->update(['trangthaidk'=>"success",'mscb'=>$mscb]);
         return redirect()->back();
      }
      public function get_cbql_huydk($mssv){
         $mscb = canboquanly::where('email',Auth::user()->email)->value('mscb');
         $id_phong = phieudangky::where([
            ['mssv',$mssv],
            ['nam',date('Y')],
         ])->value('id_phong');
         $sncur = phong::where('id',$id_phong)->value('sncur');
         $sncur = $sncur-1;
         phieudangky::where([
            ['mssv',$mssv],
            ['nam',date('Y')],
         ])->update(['trangthaidk'=>"cancelled",'mscb'=>$mscb]);
         phong::where('id',$id_phong)->update(['sncur'=>$sncur]);
         return redirect()->back();
      }
      public function get_cbql_ttsv($mssv){
         $id_khu = canboquanly::where('email',Auth::user()->email)->value('id_khu');
         $max = phong::where('id_khu',$id_khu)->max('id');
         $count = phong::where('id_khu',$id_khu)->count();
         $ttsv = sinhvien::where('mssv',$mssv)->first();
         $name = users::where('email',$ttsv->email)->value('name');
         $lsdk = phieudangky::where([
            ['mssv',$mssv],
            ['trangthaidk','!=','cancelled'],
            ['id_phong','>',($max-$count)],
            ['id_phong','<=',$max]
         ])->orderBy('nam','desc')->get();
         $ttphong = phong::all();
         return view('pages.cbql_ttsv',['ttsv'=>$ttsv,'name'=>$name,'ttphong'=>$ttphong,'lsdk'=>$lsdk]);
      }

}