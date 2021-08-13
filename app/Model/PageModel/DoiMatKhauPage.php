<?php

namespace App\Model\PageModel;

use App\Model\TableModel\AccountInfoTable;
use App\Model\TableModel\AccountManagerTable;
use App\Model\TableModel\AccountTable;
use Illuminate\Database\Eloquent\Model;

class DoiMatKhauPage extends Model
{
    /**************************************************
    Function Name	: checkMatKhau
    Description		:
    Argument		: $accountid,$password
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function checkMatKhau($accountid,$password){

        $result = AccountTable::checkMatKhau($accountid,$password);

        return $result;
    }

    /**************************************************
    Function Name	: checkMatKhau
    Description		:
    Argument		: $accountid,$password
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function updateMatKhau($accountid,$password){

        $result = AccountTable::updateMatKhau($accountid,$password);

        return $result;
    }
}
