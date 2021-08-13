<?php

namespace App\Model\TableModel;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Mockery\CountValidator\Exception;

class AccountManagerTable extends Model
{
    protected $table = 'accountmanager';
    public $timestamps = false;
    /**************************************************
    Function Name	: StoreAccountManager
    Description		:
    Argument		: $accountmanager
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreAccountManager($accountmanager){

        DB::table('accountmanager')->insert([

            'permission' => $accountmanager['permission'],
            'accountid' => $accountmanager['accountid']

        ]);

    }

    /**************************************************
    Function Name	: StoreAccountManager
    Description		:
    Argument		: $accountmanager
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreNewAccountManager($accountmanager){

        try {
            DB::table('accountmanager')->insert([

                'permission' => $accountmanager['permission'],
                'nhomquyen' => $accountmanager['nhomquyen'],
                'quyenxoadonthu' => $accountmanager['quyenxoadonthu'],
                'quyenxoadanhmuc' => $accountmanager['quyenxoadanhmuc'],
                'quyenxoatiepdan' => $accountmanager['quyenxoatiepdan'],
                'quyenxoacongthongtin' => $accountmanager['quyenxoacongthongtin'],
                'quyenxemtheodiaban' => $accountmanager['quyenxemtheodiaban'],
                'accountid' => $accountmanager['accountid']

            ]);

            $result = 'successful';
        }catch (Exception $e){

            $result = 'fail';
        }

        return $result;
    }

    /**************************************************
    Function Name	: UpdateNguoiSuDung
    Description		:
    Argument		: $accountmanager
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function UpdateNguoiSuDung($id,$accountmanager){

        try {
            DB::table('accountmanager')
                ->where('accountid',$id)
                ->update([
                'permission' => $accountmanager['permission'],
                'nhomquyen' => $accountmanager['nhomquyen'],
                'quyenxoadonthu' => $accountmanager['quyenxoadonthu'],
                'quyenxoadanhmuc' => $accountmanager['quyenxoadanhmuc'],
                'quyenxoatiepdan' => $accountmanager['quyenxoatiepdan'],
                'quyenxoacongthongtin' => $accountmanager['quyenxoacongthongtin'],
                'quyenxemtheodiaban' => $accountmanager['quyenxemtheodiaban'],
            ]);

            $result = 'successful';
        }catch (Exception $e){

            $result = 'fail';
        }

        return $result;
    }

    /**************************************************
    Function Name	: GetPermission
    Description		:
    Argument		: $accountid
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetPermission($accountid){

        $permission = DB::table('accountmanager')->where('accountid', $accountid)->value('permission');
        return $permission;
    }

    /**************************************************
    Function Name	: GetQuyenXoaDonThu
    Description		:
    Argument		: $accountid
    Creation Date	: 2016/11/26
    Author			: TungNM6
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetQuyenXoaDonThu($accountid){

        $quyenxoadonthu = DB::table('accountmanager')->where('accountid', $accountid)->value('quyenxoadonthu');
        return $quyenxoadonthu;
    }

    /**************************************************
    Function Name	: GetQuyenXoaDanhMuc
    Description		:
    Argument		: $accountid
    Creation Date	: 2016/11/26
    Author			: TungNM6
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetQuyenXoaDanhMuc($accountid){

        $quyenxoadanhmuc = DB::table('accountmanager')->where('accountid', $accountid)->value('quyenxoadanhmuc');
        return $quyenxoadanhmuc;
    }

    /**************************************************
    Function Name	: GetQuyenXoaTiepDan
    Description		:
    Argument		: $accountid
    Creation Date	: 2016/11/26
    Author			: TungNM6
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetQuyenXoaTiepDan($accountid){

        $quyenxoatiepdan = DB::table('accountmanager')->where('accountid', $accountid)->value('quyenxoatiepdan');
        return $quyenxoatiepdan;
    }

    /**************************************************
    Function Name	: GetQuyenXoaCongThongTin
    Description		:
    Argument		: $accountid
    Creation Date	: 2016/11/26
    Author			: TungNM6
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetQuyenXoaCongThongTin($accountid){

        $quyenxoacongthongtin = DB::table('accountmanager')->where('accountid', $accountid)->value('quyenxoacongthongtin');
        return $quyenxoacongthongtin;
    }

    /**************************************************
    Function Name	: GetQuyenXemTheoDiaBan
    Description		:
    Argument		: $accountid
    Creation Date	: 2016/11/26
    Author			: TungNM6
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetQuyenXemTheoDiaBan($accountid){

        $quyenxemtheodiaban = DB::table('accountmanager')->where('accountid', $accountid)->value('quyenxemtheodiaban');
        return $quyenxemtheodiaban;
    }

    /**************************************************
    Function Name	: GetAccountManagerData
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetAccountManagerData(){

        $result = DB::table('accountmanager')
            ->orderby('accountid','desc')
            ->paginate(10);
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
    public static function XoaNguoiSuDung($id){

        try {
            DB::table('accountmanager')
                ->where('accountid', $id)
                ->delete();
            $result = 'successful';
        }catch (Exception $e){
            $result = 'fail';
        }
        return $result;

    }

    /**************************************************
    Function Name	: GetAccountManagerTheoID
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetAccountManagerTheoID($id){

        $result = DB::table('accountmanager')
            ->where('accountid', $id)
            ->get();

        return $result;
    }

}
