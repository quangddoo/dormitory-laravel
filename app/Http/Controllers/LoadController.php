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
    #----------Đăng_kí_phòng_ở------------------------------------------------------------------------------------------

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

    #----------Thay đổi thông tin cá nhân-------------------------------------------------------------------------------
    public function getStudent_chinhsua(){
        return view('pages.Student_chinhsua');
    }

    public function student_suatt(Request $request){
        $nssv = $request->input('birthday');
        $gtsv = $request->input('gtsv');
        $lop = $request->input('lop');
        $khoa = $request->input('khoa');
        $qqsv = $request->input('qqsv');
        $sdt = $request->input('phone');
        $mssv = sinhvien::where('email',Auth::user()->email)->value('mssv');
        $count = phieudangky::where('mssv',$mssv)->count();
        if($count!=0){
            sinhvien::where('email',Auth::user()->email)->update(['nssv'=>$nssv,'lop'=>$lop,'khoa'=>$khoa,'qqsv'=>$qqsv,'sdt'=>$sdt]);
            return redirect()->back()->with(['flag2'=>'danger','message'=>'Cập nhật thông tin thành công']);
        }
        else{
            sinhvien::where('email',Auth::user()->email)->update(['nssv'=>$nssv,'gtsv'=>$gtsv,'lop'=>$lop,'khoa'=>$khoa,'qqsv'=>$qqsv,'sdt'=>$sdt]);
            return redirect()->back()->with(['flag2'=>'danger','message'=>'Cập nhật thông tin thành công']);
        }
    }

    #----------Thay đổi mật khẩu----------------------------------------------------------------------------------------
    public function changePassword(Request $request){
        $rules = [
            'password' => 'required|min:6|confirmed'
        ];
        $messages = [
            'password.min' => 'Mật khẩu mới phải chứa ít nhất 6 ký tự',
            'password.confirmed' => 'Xác nhận mật khẩu không đúng'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else {
            $email = Auth::user()->email;
            $password = $request->input('password_cur');
            $password_new = $request->input('password');

            if( Auth::attempt(['email' => $email, 'password' =>$password])) {
                users::where('email',$email)->update(['password'=>bcrypt($password_new)]);
                return redirect()->back()->with(['flag'=>'success','message'=>'Đổi mật khẩu thành công']);;
            }
            else {
                return redirect()->back()->with(['flag'=>'danger','message'=>'Mật khẩu không chính xác']);
            }
        }
    }
  #-------------CBQL-------------

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
#------------------------------------------------------------------------
}

