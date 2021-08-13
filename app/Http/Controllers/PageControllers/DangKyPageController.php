<?php

namespace App\Http\Controllers\PageControllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Model\PageModel\DangKyPage;

class DangKyPageController extends Controller
{
    public static function page_dangky(){

        return view('pages.dangky');
    }

    public static function page_submitdangky(Request $request){

        //store account information to database
        $result = DangKyPage::StoreAccountInfo($request);

        if($result == 'Successful') {

            return redirect('/dangnhap')->with('dangkysuccessful', 'Bạn Đã Tạo Tài Khoản Thành Công ! Mời Bạn Đăng Nhập Để Vào Hệ Thống !');

        } else {
            return redirect('/dangky')->with('dangkyerror', $result);
        }

    }

}
