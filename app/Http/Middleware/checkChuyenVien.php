<?php
/**
 * Created by PhpStorm.
 * User: Green
 * Date: 11/26/2016
 * Time: 2:43 PM
 */

namespace App\Http\Middleware;


use Closure;
use Session;

class checkChuyenVien
{

    public function handle($request, Closure $next)
    {
        if ($loginsuccessful = Session::get('loginstatus')) {

            Session::put('accountid', $loginsuccessful['accountid']);
            Session::put('accountname', $loginsuccessful['fullname']);
            Session::put('accountpermission', $loginsuccessful['permission']);
            Session::put('quyenXoa', $loginsuccessful['quyenXoa']);
        }

        if (Session::has('accountid')) {

            $accountname = Session::get('accountname');
            $accountid = Session::get('accountid');
            $accountpermission = Session::get('accountpermission');

            if($accountpermission == CHUYENVIEN){

                return redirect('/chuyenvien');
            }

        } else {

            return redirect('/dangnhap');
        }

        return $next($request);
    }

}