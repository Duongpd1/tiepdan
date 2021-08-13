<?php
/**
 * Created by PhpStorm.
 * User: TungNM6
 * Date: 11/26/2016
 * Time: 3:26 PM
 */
namespace App\Http\Middleware;


use Closure;
use Session;

class Permission2TabCongThongTin
{

    public function handle($request, Closure $next)
    {
        if ($loginsuccessful = Session::get('loginstatus')) {

            Session::put('accountid', $loginsuccessful['accountid']);
            Session::put('accountname', $loginsuccessful['fullname']);
            Session::put('accountpermission', $loginsuccessful['permission']);
            Session::put('quyenXoa', $loginsuccessful['quyenXoa']);
        }

        if(Session::has('soLuongHienThi_TabCongThongTin')) {

        }else{
            Session::put('soLuongHienThi_TabCongThongTin', HIENTHI_10ITEMS);
        }

        if (Session::has('accountid')) {

            $accountname = Session::get('accountname');
            $accountid = Session::get('accountid');
            $accountpermission = Session::get('accountpermission');

            if(($accountpermission ==20)){

                return redirect('/chuyenvien');
            }
        } else {

            return redirect('/dangnhap');
        }

        return $next($request);
    }

}