<?php

namespace App\Model\TableModel;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Mockery\CountValidator\Exception;

class AccountInfoTable extends Model
{
    protected $table = 'accountinfo';
    public $timestamps = false;
    /**************************************************
    Function Name	: StoreAccountInfo
    Description		:
    Argument		: $accountinfo
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreAccountInfo($accountinfo){

        DB::table('accountinfo')->insert([

            'socialnumber' => $accountinfo['socialnumber'],
            'emailaddress' => $accountinfo['emailaddress'],
            'phonenumber' => $accountinfo['phonenumber'],
            'fullname' => $accountinfo['fullname'],
            'address' => $accountinfo['address'],
            'gender' => $accountinfo['gender'],
            'accountid' => $accountinfo['accountid']

        ]);

    }

    /**************************************************
    Function Name	: StoreAccountInfo
    Description		:
    Argument		: $fullname,$chucvu,$donvi,$diaban,$thutu,$accountid
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreNewAccountInfo($accountinfo){

        try {
            DB::table('accountinfo')->insert([

                'fullname' => $accountinfo['fullname'],
                'skypeaccount' => $accountinfo['skypeaccount'],
                'chucvu' => $accountinfo['chucvu'],
                'donvi' => $accountinfo['donvi'],
                'diaban' => $accountinfo['diaban'],
                'thutu' => $accountinfo['thutu'],
                'accountid' => $accountinfo['accountid'],

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
    Argument		: $accountinfo
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function UpdateNguoiSuDung($id,$accountinfo){

        try {
            DB::table('accountinfo')
                ->where('accountid',$id)
                ->update([
                'fullname' => $accountinfo['fullname'],
                'skypeaccount' => $accountinfo['skypeaccount'],
                'chucvu' => $accountinfo['chucvu'],
                'donvi' => $accountinfo['donvi'],
                'diaban' => $accountinfo['diaban'],
                'thutu' => $accountinfo['thutu'],
            ]);

            $result = 'successful';
        }catch (Exception $e){

            $result = 'fail';
        }

        return $result;
    }

    /**************************************************
    Function Name	: CheckEmailExist
    Description		:
    Argument		: $email
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function CheckEmailExist($email){

        $result = DB::table('accountinfo')->where('emailaddress', $email)->get();
        if($result != null){

            return true;

        } else{

            return false;
        }

    }

    /**************************************************
    Function Name	: CheckSocialNumberExist
    Description		:
    Argument		: $cmnd
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function CheckSocialNumberExist($cmnd){

        $result = DB::table('accountinfo')->where('socialnumber', $cmnd)->get();
        if($result != null){

            return true;

        } else{

            return false;
        }

    }

    /**************************************************
    Function Name	: CheckPhoneNumberExist
    Description		:
    Argument		: $dienthoai
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function CheckPhoneNumberExist($dienthoai){

        $result = DB::table('accountinfo')->where('phonenumber', $dienthoai)->get();
        if($result != null){

            return true;

        } else{

            return false;
        }

    }

    /**************************************************
    Function Name	: GetFullName
    Description		:
    Argument		: $accountid
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetFullName($accountid){

        $fullname = DB::table('accountinfo')
            ->where('accountid', $accountid)
            ->value('fullname');
        return $fullname;

    }

    /**************************************************
    Function Name	: GetDataUserInfo
    Description		:
    Argument		: $donvi
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetDataUserInfo($donvi)
    {
        $arrayAcc = DB::table('accountinfo')
            /*->where('donvi', $donvi)*/
            ->get();
        return $arrayAcc;
    }

    /**************************************************
    Function Name	: GetAccountInfoData
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetAccountInfoData()
    {
        $result = DB::table('accountinfo')
            ->orderby('accountid','desc')
            ->paginate(10);
        return $result;
    }

    /**************************************************
    Function Name	: getDanhSachNhanVien
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function getDanhSachNhanVien()
    {
        $result = DB::table('accountinfo')
            ->get();
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
            DB::table('accountinfo')
                ->where('accountid', $id)
                ->delete();
            $result = 'successful';
        }catch (Exception $e){
            $result = 'fail';
        }
        return $result;

    }

    /**************************************************
    Function Name	: GetAccountInfoTheoID
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetAccountInfoTheoID($id){

        $result = DB::table('accountinfo')
            ->where('accountid', $id)
            ->get();

        return $result;
    }
    /**************************************************
    Function Name	: GetAccountInfoTheoDonVi
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetAccountInfoTheoDonVi($donviId,$diaBanIdAllArray)
    {
        $result = DB::table('accountinfo')
            //->whereIn('diaban',$diaBanIdAllArray)
            ->where('donvi', $donviId)
            ->get();

        return $result;
    }
    /**************************************************
    Function Name	: GetAccountLanhDaoTheoDiaBan
    Description		:
    Argument		: $id
    Creation Date	: 2017/05/30
    Author			: duongpd1
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetAccountLanhDaoTheoDiaBan($diaBanId)
    {
        $result = AccountInfoTable::join('accountmanager', 'accountinfo.accountid', '=', 'accountmanager.accountid')
            ->where('accountinfo.diaban', $diaBanId)
            ->where('accountmanager.permission', TIEPDAN)
            ->where('accountmanager.nhomquyen', 1)
            ->get();

        return $result;
    }

    public function donvi()
    {
        return $this->belongsTo(\App\Model\TableModel\DonViTable::class,'donvi','id');
    }
}
