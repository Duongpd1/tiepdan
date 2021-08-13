<?php

namespace App\Model\PageModel;
use App\Model\TableModel\AccountInfoTable;
use App\Model\TableModel\AccountManagerTable;
use App\Model\TableModel\AccountTable;
use Illuminate\Database\Eloquent\Model;

class DangKyPage extends Model
{

    /**************************************************
    Function Name	: StoreAccountInfo
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreAccountInfo($request){

        $matkhau = $request->matkhau;
        $nhaplaimatkhau = $request->nhaplaimatkhau;

        if ($matkhau == $nhaplaimatkhau) {

            $tendangnhap = $request->tendangnhap;

            $isAccountExist = AccountTable::CheckAccountExist($tendangnhap);

            if($isAccountExist){

                $result = 'Tài Khoản Đã Tồn Tại';
                return $result;
            }

            $email = $request->email;

            $isEmailExist = AccountInfoTable::CheckEmailExist($email);

            if($isEmailExist){

                $result = 'Email Đã Được Đăng Ký Bởi Một Người Dùng Khác';
                return $result;
            }
            $dienthoai = $request->dienthoai;

            $isPhoneExist = AccountInfoTable::CheckPhoneNumberExist($dienthoai);

            if($isPhoneExist){

                $result = 'Số Điện Thoại Đã Được Đăng Ký Bởi Một Người Dùng Khác';
                return $result;
            }

            $cmnd = $request->cmnd;

            $isSocialNumberExist = AccountInfoTable::CheckSocialNumberExist($cmnd);

            if($isSocialNumberExist){

                $result = 'CMND/Hộ Chiếu Đã Được Đăng Ký Bởi Một Người Dùng Khác';
                return $result;
            }

            $account = array(
                'accountname' => $tendangnhap,
                'password' => $matkhau,
                'registertime' => date('Y-m-d H:i:s'),
                'status' => CHUAKICHHOAT
            );

            //Store account information to account table
            AccountTable::StoreAccount($account);
            $accountid = AccountTable::GetAccountID($tendangnhap);

            $hoten = $request->hoten;
            $diachi = $request->diachi;
            $gioitinh = $request->gioitinh;

            $accountinfo = array(

                'socialnumber' => $cmnd,
                'emailaddress' => $email,
                'phonenumber' => $dienthoai,
                'fullname' => $hoten,
                'address' => $diachi,
                'gender' => $gioitinh,
                'accountid' => $accountid
            );

            $accountmanager = array(

                'permission' => CHUYENVIEN,
                'accountid' => $accountid

            );

            AccountInfoTable::StoreAccountInfo($accountinfo);
            AccountManagerTable::StoreAccountManager($accountmanager);

            $result = 'Successful';

        } else {

            $result = 'Nhập Lại Mật Khẩu Không Khớp';
        }

        return $result;
    }
}
