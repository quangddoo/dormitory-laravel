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
    //
    public function get_student_dkphong($id){
        $ttsv = sinhvien::where('email',Auth::user()->email)->first();
        $ttphong = phong::where('id',$id)->first();
        $id_khu = $ttphong->id_khu;
        $giaphong = khuktx::where('id',$id_khu)->value('giaphong');
        $mssv = $ttsv->mssv;
        $gtsv = $ttsv->gtsv;
        $sncur = $ttphong->sncur;
        $snmax = $ttphong->snmax;
        $gioitinh = $ttphong->gioitinh;
        $count = phieudangky::where([
            ['mssv',$mssv],
            ['nam',date('Y')],
            ['trangthaidk','!=','cancelled']
        ])->count();
        $count1 = phieudangky::where([
            ['mssv',$mssv],
            ['nam',date('Y')],
            ['trangthaidk','=','cancelled']
        ])->count();
        if($gtsv==""){
            return redirect()->back()->with(['flag'=>'danger','message'=>'Vui lòng cập nhật thông tin cá nhân  ']);
        }
        else{
            if($count!=0){
                return redirect()->back()->with(['flag'=>'danger','message'=>'Sinh viên đã đăng ký ở năm nay']);
            }
            elseif($gtsv!=$gioitinh){
                return redirect()->back()->with(['flag'=>'danger','message'=>'Giới tính không đúng']);
            }
            elseif ($sncur>=$snmax) {
                return redirect()->back()->with(['flag'=>'danger','message'=>'Phòng đã đầy']);
            }
            else{
                if($count1==0){
                    phieudangky::insert(['id_phong'=>$id,'mssv'=>$mssv,'nam'=>date('Y'),'trangthaidk'=>'registered','ngaydk'=>date('Y-m-d'),'lephi'=>$giaphong*(13-date('m')),'name'=>Auth::user()->name]);
                    $sncur=$sncur+1;
                    DB::table('phong')->where('id',$id)->update(['sncur'=>$sncur]);
                    return redirect('student_xemdk');
                }
                else{
                    phieudangky::where([
                        ['mssv',$mssv],
                        ['nam',date('Y')]
                    ])->update(['trangthaidk'=>'registered']);
                    $sncur=$sncur+1;
                    DB::table('phong')->where('id',$id)->update(['sncur'=>$sncur]);
                    return redirect('student_xemdk');
                }
            }}
    }
}
