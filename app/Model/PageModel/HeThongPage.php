<?php

namespace App\Model\PageModel;

use App\Model\TableModel\AccountInfoTable;
use App\Model\TableModel\AccountManagerTable;
use App\Model\TableModel\AccountTable;
use App\Model\TableModel\CauHinhHeThongTable;
use App\Model\TableModel\DiaBanTable;
use App\Model\TableModel\DonViTable;
use App\Model\TableModel\NhomNguoiSuDungTable;
use Illuminate\Database\Eloquent\Model;
use Mockery\CountValidator\Exception;

class HeThongPage extends Model
{
    /**************************************************
    Function Name	: GetThongTinNguoiSuDung
    Description		:
    Argument		:
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetThongTinNguoiSuDung(){

        $result1 = AccountTable::GetAccountData();
        $result2 = AccountInfoTable::GetAccountInfoData();
        $result3 = AccountManagerTable::GetAccountManagerData();
        $count = 0;
        $donvi = array();
        foreach($result2 as $temp){

            $donvi[$count] = DonViTable::GetTenDonVi($temp->donvi);
            $count++;
        }

        $result = array([
           'accountdata' =>  $result1,
           'accountinfodata' =>  $result2,
           'accountmanagerdata' =>  $result3,
           'tendonvidata' =>  $donvi,
        ]);

        return $result;
    }

    /**************************************************
    Function Name	: GetThongTinNguoiSuDung
    Description		:
    Argument		:
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetThongTinNguoiSuDungTheoID($id){

        $accountname = AccountTable::GetAccountName($id);
        $trangthai = AccountTable::GetStatus($id);
        $result2 = AccountInfoTable::GetAccountInfoTheoID($id);
        $result3 = AccountManagerTable::GetAccountManagerTheoID($id);
        $tendonvi = DonViTable::GetTenDonVi($result2[0]->donvi);
        $tendiaban = DiaBanTable::GetTenDiaBan($result2[0]->diaban);

        $result = array([
            'accountname' =>  $accountname,
            'trangthai' =>  $trangthai,
            'accountinfodata' =>  $result2,
            'accountmanagerdata' =>  $result3,
            'tendonvi' =>  $tendonvi,
            'tendiaban' =>  $tendiaban,
            'accountid' =>  $id,
        ]);

        return $result;
    }

    /**************************************************
    Function Name	: GetTenNhomQuyen
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetTenNhomQuyen($id){

        $result = NhomNguoiSuDungTable::GetTenNhomQuyen($id);
        return $result;
    }

    /**************************************************
    Function Name	: StoreNguoiSuDung
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreNguoiSuDung($request){

        //check password
        if($request->password == $request->repassword) {

            $IsAccountExist = AccountTable::CheckAccountExist($request->accountname);

            if ($IsAccountExist) {

                return 'fail2';

            }else{

                $accountid = AccountTable::StoreNewAccount($request->accountname, $request->password, $request->trangthai);


                $accountinfo = array(
                    'fullname' => $request->fullname,
                    'skypeaccount' => $request->skypeaccount,
                    'chucvu' => $request->chucvu,
                    'donvi' => $request->donvi,
                    'diaban' => $request->diaban,
                    'thutu' => $request->thutu,
                    'accountid' => $accountid
                );
                $result1 = AccountInfoTable::StoreNewAccountInfo($accountinfo);

                $quyenxoadonthu = 0;
                $quyenxoadanhmuc = 0;
                $quyenxoatiepdan = 0;
                $quyenxoacongthongtin = 0;
                $quyenxemtheodiaban = 0;

                if($request->nhomquyen == 0){
                    $quyenxoadonthu = 1;
                }else if($request->nhomquyen != 0 && $request->nhomquyen != 6){
                    $quyenxoadanhmuc = 1;
                }

                if($request->quyenxoadonthu == 'on'){
                    $quyenxoadonthu = 1;
                }
                if($request->quyenxoadanhmuc == 'on'){

                    $quyenxoadanhmuc = 1;
                }
                if($request->quyenxoatiepdan == 'on'){
                    $quyenxoatiepdan = 1;
                }
                if($request->quyenxoacongthongtin == 'on'){
                    $quyenxoacongthongtin = 1;
                }
                if($request->quyenxemtheodiaban == 'on'){
                    $quyenxemtheodiaban = 1;
                }

                if($request->loaitaikhoan == CHUYENVIEN){

                    $permission = CHUYENVIEN;

                }elseif($request->loaitaikhoan == LANHDAO){

                    $permission = LANHDAO;
                }elseif($request->loaitaikhoan == QUANLYHETHONG){

                    $permission = QUANLYHETHONG;
                }elseif($request->loaitaikhoan == THONGTIN){

                    $permission = THONGTIN;
                }elseif($request->loaitaikhoan == TIEPDAN){

                    $permission = TIEPDAN;
                }elseif($request->loaitaikhoan == VANTHU){

                    $permission = VANTHU;
                } else{

                    $permission = CONGDAN;
                }

                $accountmanager = array(
                    'permission' => $permission,
                    'nhomquyen' => $request->nhomquyen,
                    'quyenxoadonthu' => $quyenxoadonthu,
                    'quyenxoadanhmuc' => $quyenxoadanhmuc,
                    'quyenxoatiepdan' => $quyenxoatiepdan,
                    'quyenxoacongthongtin' => $quyenxoacongthongtin,
                    'quyenxemtheodiaban' => $quyenxemtheodiaban,
                    'accountid' => $accountid
                );
                $result2 = AccountManagerTable::StoreNewAccountManager($accountmanager);

                return 'successful';
            }

        }else{

            return 'fail1';
        }

    }

    /**************************************************
    Function Name	: XoaNguoiSuDung
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function XoaNguoiSuDung($id){

        try {

            $result1 = AccountManagerTable::XoaNguoiSuDung($id);
            $result2 = AccountInfoTable::XoaNguoiSuDung($id);
            $result3 = AccountTable::XoaNguoiSuDung($id);
            $result = 'successful';
        }catch (Exception $e){
            $result = 'fail';
        }
        return $result;
    }

    /**************************************************
    Function Name	: DoiTrangThaiNguoiSuDung
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function DoiTrangThaiNguoiSuDung($id,$newstatus){

        $result = AccountTable::DoiTrangThaiNguoiSuDung($id,$newstatus);

        return $result;
    }

    /**************************************************
    Function Name	: UpdateNguoiSuDung
    Description		:
    Argument		: $request,$id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function UpdateNguoiSuDung($request,$id){


        $result3 = AccountTable::UpdateNguoiSuDung($id, $request->password, $request->trangthai);

        $accountinfo = array(
            'fullname' => $request->fullname,
            'skypeaccount' => $request->skypeaccount,
            'chucvu' => $request->chucvu,
            'donvi' => $request->donvi,
            'diaban' => $request->diaban,
            'thutu' => $request->thutu
        );
        $result1 = AccountInfoTable::UpdateNguoiSuDung($id,$accountinfo);

        $quyenxoadonthu = 0;
        $quyenxoadanhmuc = 0;
        $quyenxoatiepdan = 0;
        $quyenxoacongthongtin = 0;
        $quyenxemtheodiaban = 0;

        if($request->nhomquyen == 0){
            $quyenxoadonthu = 1;
        }else{
            $quyenxoadanhmuc = 1;
        }

        if($request->quyenxoadonthu == 'on'){
            $quyenxoadonthu = 1;
        }
        if($request->quyenxoadanhmuc == 'on'){
            $quyenxoadanhmuc = 1;
        }
        if($request->quyenxoatiepdan == 'on'){
            $quyenxoatiepdan = 1;
        }
        if($request->quyenxoacongthongtin == 'on'){
            $quyenxoacongthongtin = 1;
        }
        if($request->quyenxemtheodiaban == 'on'){
            $quyenxemtheodiaban = 1;
        }

        if($request->loaitaikhoan == CHUYENVIEN){
            $permission = CHUYENVIEN;
        }elseif($request->loaitaikhoan == LANHDAO){
            $permission = LANHDAO;
        }elseif($request->loaitaikhoan == QUANLYHETHONG){
            $permission = QUANLYHETHONG;
        }elseif($request->loaitaikhoan == THONGTIN){
            $permission = THONGTIN;
        }elseif($request->loaitaikhoan == TIEPDAN){
            $permission = TIEPDAN;
        }elseif($request->loaitaikhoan == VANTHU){
            $permission = VANTHU;
        } else{
            $permission = CONGDAN;
        }

        $accountmanager = array(
            'permission' => $permission,
            'nhomquyen' => $request->nhomquyen,
            'quyenxoadonthu' => $quyenxoadonthu,
            'quyenxoadanhmuc' => $quyenxoadanhmuc,
            'quyenxoatiepdan' => $quyenxoatiepdan,
            'quyenxoacongthongtin' => $quyenxoacongthongtin,
            'quyenxemtheodiaban' => $quyenxemtheodiaban
        );
        $result2 = AccountManagerTable::UpdateNguoiSuDung($id,$accountmanager);

        return 'successful';
    }

    /**************************************************
    Function Name	: GetNhomNguoiSuDung
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetNhomNguoiSuDung(){

        $result = NhomNguoiSuDungTable::GetNhomNguoiSuDung();

        return $result;
    }

    /**************************************************
    Function Name	: GetNhomNguoiSuDung
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetNhomNguoiSuDungTheoType($type){

        $result = NhomNguoiSuDungTable::GetNhomNguoiSuDungTheoType($type);

        return $result;
    }

    /**************************************************
    Function Name	: GetNhomNguoiSuDungTheoID
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetNhomNguoiSuDungTheoID($id){

        $result = NhomNguoiSuDungTable::GetNhomNguoiSuDungTheoID($id);

        return $result;
    }

    /**************************************************
    Function Name	: GetNhomNguoiSuDungTheoTypeAndID
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetNhomNguoiSuDungTheoTypeAndID($type,$id){

        $result = NhomNguoiSuDungTable::GetNhomNguoiSuDungTheoTypeAndID($type,$id);

        return $result;
    }

    /**************************************************
    Function Name	: XoaNguoiSuDung
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function XoaNhomNguoiSuDung($id){

        $result = NhomNguoiSuDungTable::XoaNhomNguoiSuDung($id);

        return $result;
    }

    /**************************************************
    Function Name	: DoiTrangThaiNguoiSuDung
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function DoiTrangThaiNhomNguoiSuDung($id,$newstatus){

        $result = NhomNguoiSuDungTable::DoiTrangThaiNhomNguoiSuDung($id,$newstatus);

        return $result;
    }

    /**************************************************
    Function Name	: StoreNhomNguoiSuDung
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreNhomNguoiSuDung($request)
    {
        $result = NhomNguoiSuDungTable::StoreNhomNguoiSuDung($request);

        return $result;
    }

    /**************************************************
    Function Name	: UpdateNhomNguoiSuDung
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function UpdateNhomNguoiSuDung($request,$id)
    {
        $result = NhomNguoiSuDungTable::UpdateNhomNguoiSuDung($request,$id);

        return $result;
    }

    /**************************************************
    Function Name	: getCauHinhHeThong
    Description		:
    Argument		:
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function getCauHinhHeThong(){

        $result = CauHinhHeThongTable::getCauHinhHeThong();

        return $result;
    }

    /**************************************************
    Function Name	: submitChinhSuaCauHinhHeThong
    Description		:
    Argument		:
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function submitChinhSuaCauHinhHeThong($request){

        $result = CauHinhHeThongTable::submitChinhSuaCauHinhHeThong($request);

        return $result;
    }
    /**************************************************
    Function Name	: GetLanhDaoTheoDiaBan
    Description		:
    Argument		:
    Creation Date	: 2017/05/30
    Author			: DuongpD1
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetLanhDaoTheoDiaBan($diaBanId)
    {
        $results = AccountInfoTable::GetAccountLanhDaoTheoDiaBan($diaBanId);

        return $results;
    }

}
