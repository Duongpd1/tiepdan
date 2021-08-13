<?php

namespace App\Model\PageModel;

use App\Model\TableModel\AccountInfoTable;
use App\Model\TableModel\AccountManagerTable;
use App\Model\TableModel\AccountTable;
use App\Model\TableModel\PhanLoaiDonThuTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DangNhapPage extends Model
{
    /**************************************************
    Function Name	: GetAccountInfo
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetAccountInfo($request){

        $result = array(
            'loginstatus' => '',
            'accountid' =>'',
            'fullname' => '',
            'permission' =>'',
            'quyenXoa' =>'',
            'soDonThuMoiDuocGiao' =>'',
            'diaban'=>''
        );
        $tendangnhap = $request->tendangnhap;
        $matkhau = $request->matkhau;

        $isAccountExist = AccountTable::CheckAccountExist($tendangnhap);

        if(!$isAccountExist){

            $result['loginstatus'] = 'Tài Khoản Không Tồn Tại';

        } else {

            $isPasswordRight = AccountTable::CheckPassword($tendangnhap,$matkhau);

            if($isPasswordRight){

                $isenable = AccountTable::CheckStatus($tendangnhap);

                if($isenable) {

                    $accountId = AccountTable::GetAccountID($tendangnhap);
                    $soDonThuDuocGiao = PhanLoaiDonThuTable::countSoDonThuDuocGiaoTheoId($accountId);

//                    echo '<pre>';
//                    print_r(count($donThuDuocGiao));
//                    die;

                    $result['loginstatus'] = 'successful';
                    $result['accountid'] = AccountTable::GetAccountID($tendangnhap);
                    $result['fullname'] = AccountInfoTable::GetFullName($result['accountid']);
                    $result['permission'] = AccountManagerTable::GetPermission($result['accountid']);
                    $result['quyenXoa'] = 0;
                    $result['quyenXoa'] |= AccountManagerTable::GetQuyenXoaDonThu($result['accountid']);
                    $result['quyenXoa'] |= (AccountManagerTable::GetQuyenXoaDanhMuc($result['accountid']) << 1);
                    $result['quyenXoa'] |= (AccountManagerTable::GetQuyenXoaTiepDan($result['accountid']) << 2);
                    $result['quyenXoa'] |= (AccountManagerTable::GetQuyenXoaCongThongTin($result['accountid']) << 3);
                    $result['quyenXoa'] |= (AccountManagerTable::GetQuyenXemTheoDiaBan($result['accountid']) << 4);
                    $result['soDonThuMoiDuocGiao'] = $soDonThuDuocGiao;
                    $inforAcc = AccountInfoTable::GetAccountInfoTheoID($result['accountid']);
                    $result['diaban'] = $inforAcc[0]->diaban;
                }else{

                    $result['loginstatus'] = 'Tài khoản chưa được cấp quyền';
                }

            }else{

                $result['loginstatus'] = 'Sai Mật Khẩu';
            }
        }

        return $result;
    }
    /**************************************************
    Function Name	: GetDiaBanTheoAccountId
    Description		:
    Argument		: $accountId
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetDiaBanTheoAccountId($accountId)
    {
        $accountInfo = DB::table('accountinfo')
            ->where('accountid',$accountId)
            ->get();

        return $accountInfo;
    }
}
