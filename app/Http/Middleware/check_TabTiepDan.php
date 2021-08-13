<?php
/**
 * Created by PhpStorm.
 * User: nguye
 * Date: 16/11/26
 * Time: 3:25 PM
 */

namespace App\Http\Middleware;


use Closure;
use Session;

class check_TabTiepDan
{

    public function handle($request, Closure $next)
    {
        if ($loginsuccessful = Session::get('loginstatus')) {

            Session::put('accountid', $loginsuccessful['accountid']);
            Session::put('accountname', $loginsuccessful['fullname']);
            Session::put('accountpermission', $loginsuccessful['permission']);
            Session::put('quyenXoa', $loginsuccessful['quyenXoa']);
        }

        if(Session::has('soLuongHienThi_TabTiepDan')) {

        }else{
            Session::put('soLuongHienThi_TabTiepDan', HIENTHI_10ITEMS);
        }

        if (Session::has('accountid')) {

            $accountname = Session::get('accountname');
            $accountid = Session::get('accountid');
            $accountpermission = Session::get('accountpermission');

            if(($accountpermission != TIEPDAN)&&($accountpermission != QUANLYHETHONG) && ($accountpermission != LANHDAO) && ($accountpermission != CHUYENVIEN)){

                return redirect('/chuyenvien');
            }

        } else {

            return redirect('/dangnhap');
        }

        return $next($request);
    }

}