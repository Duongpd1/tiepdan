<?php

namespace App\Http\Controllers\PageControllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Model\PageModel\DangNhapPage;
use App\Model\PageModel\TrangChuPage;
use Session;

class DangNhapPageController extends Controller
{
    /**************************************************
    Function Name	: page_dangnhap
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function page_dangnhap(){

        $trangchudata = TrangChuPage::GetBaiVietTrangChu();
        return view('pages.dangnhap',compact('trangchudata'));

    }
    /**************************************************
    Function Name	: submitdangnhap
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function submitdangnhap(Request $request){

        $result = DangNhapPage::GetAccountInfo($request);

        if($result['loginstatus'] == 'successful'){

            if ($result['permission'] != CONGDAN) {

                Session::put('accountid', $result['accountid']);
                Session::put('accountname', $result['fullname']);
                Session::put('accountpermission', $result['permission']);
                Session::put('quyenXoa', $result['quyenXoa']);
                Session::put('diaban', $result['diaban']);

                if($result['permission'] == THONGTIN) {
                    return redirect('/baiviet')->with('loginstatus', $result);
                }else{
                    return redirect('/chuyenvien')->with('loginstatus', $result);
                }

            } else {

                return redirect('/dangnhap')->with('loginerror', 'Bạn chưa được cấp quyền để vào !!!');

            }

        } else {

            return redirect('/dangnhap')->with('loginerror', $result['loginstatus']);
        }

    }

}
