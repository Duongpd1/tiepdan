<?php

namespace App\Model\TableModel;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Mockery\CountValidator\Exception;

class AccountTable extends Model
{
    /**************************************************
    Function Name	: StoreAccount
    Description		:
    Argument		: $account
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreAccount($account){

        DB::table('account')->insert([

            'accountname' => $account['accountname'],
            'password' => $account['password'],
            'registertime' => $account['registertime'],
            'status' => $account['status']

        ]);

    }

    /**************************************************
    Function Name	: StoreNewAccount
    Description		:
    Argument		: $account
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreNewAccount($accountname,$password,$status){

        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $id = DB::table('account')
            ->insertGetId([
            'accountname' => $accountname,
            'password' => $password,
            'registertime' => date('Y-m-d'),
            'status' => $status

        ]);
        return $id;
    }

    /**************************************************
    Function Name	: StoreNewAccount
    Description		:
    Argument		: $account
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function UpdateNguoiSuDung($id,$password,$status){

        DB::table('account')
            ->where('accountid',$id)
            ->update([
                'password' => $password,
                'status' => $status
            ]);
        return $id;
    }

    /**************************************************
    Function Name	: GetAccountID
    Description		:
    Argument		: $accountname
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetAccountID($accountname){

        $accountid = DB::table('account')->where('accountname', $accountname)->value('accountid');

        return $accountid;

    }

    /**************************************************
    Function Name	: CheckAccountExist
    Description		:
    Argument		: $accountname
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function CheckAccountExist($accountname){

        $result = DB::table('account')->where('accountname', $accountname)->get();
        if($result != null){

            return true;

        } else{

            return false;
        }

    }

    /**************************************************
    Function Name	: CheckPassword
    Description		:
    Argument		: $accountname,$password
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function CheckPassword($accountname,$password){

        $verify_password = DB::table('account')
            ->where('accountname', $accountname)
            ->value('password');

        if($verify_password == $password){

            return true;

        } else{

            return false;
        }

    }

    /**************************************************
    Function Name	: checkMatKhau
    Description		:
    Argument		: $accountid,$password
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function checkMatKhau($accountid,$password){

        $verify_password = DB::table('account')
            ->where('accountid', $accountid)
            ->value('password');

        if($verify_password == $password){

            return true;

        } else{

            return false;
        }

    }

    /**************************************************
    Function Name	: GetAccountData
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetAccountData(){

        $result = DB::table('account')
            ->orderby('accountid','desc')
            ->paginate(10);

        return $result;

    }

    /**************************************************
    Function Name	: GetAccountTheoID
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetAccountName($id){

        $result = DB::table('account')
            ->where('accountid', $id)
            ->value('accountname');

        return $result;

    }

    /**************************************************
    Function Name	: GetStatus
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetStatus($id){

        $result = DB::table('account')
            ->where('accountid', $id)
            ->value('status');

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
            DB::table('account')
                ->where('accountid', $id)
                ->delete();
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

        try {
            DB::table('account')
                ->where('accountid', $id)
                ->update([
                    'status' => $newstatus
                ]);
            $result = 'successful';
        }catch (Exception $e){
            $result = 'fail';
        }
        return $result;

    }

    /**************************************************
    Function Name	: CheckStatus
    Description		:
    Argument		: $accountname
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function CheckStatus($accountname){

        $verify_status = DB::table('account')
            ->where('accountname', $accountname)
            ->value('status');

        if($verify_status == 1){

            return true;

        } else{

            return false;
        }

    }

    /**************************************************
    Function Name	: updateMatKhau
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function updateMatKhau($accountid, $password){

        try {
            DB::table('account')
                ->where('accountid', $accountid)
                ->update([
                    'password' => $password
                ]);
            $result = 'successful';

        }catch (Exception $e){

            $result = 'fail';
        }
        return $result;

    }
}
