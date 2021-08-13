<?php

namespace App\Http\Controllers\PageControllers;

use App\Model\PageModel\DoiMatKhauPage;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DoiMatKhauController extends Controller
{
    /**************************************************
    Function Name	: page_doimatkhau
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_doimatkhau()
    {
        return view('pages.doimatkhau');
    }

    /**************************************************
    Function Name	: page_submitdoimatkhau
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_submitdoimatkhau(Request $request)
    {
        if($request->matkhaumoi == $request->nhaplaimatkhaumoi) {

            $isPasswordCorrect = DoiMatKhauPage::checkMatKhau($request->accountid,$request->matkhaucu);

            if ($isPasswordCorrect) {

                $result = DoiMatKhauPage::updateMatKhau($request->accountid,$request->matkhaumoi);

                if($result == 'successful'){

                    return redirect('thoat')->with('doi_mat_khau_successful', 'Đổi mật khẩu thành công. Vui lòng đăng nhập lại !!!');

                }else{
                    return redirect('doimatkhau')->with('doi_mat_khau_error', 'Đổi mật khẩu thất bại');
                }

            } else {

                return redirect('doimatkhau')->with('doi_mat_khau_error', 'Nhập sai mật khẩu cũ');
            }
        }else{

            return redirect('doimatkhau')->with('doi_mat_khau_error', 'Nhập mật khẩu mới không khớp');
        }

    }
}
