<?php

namespace App\Model\TableModel;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Mockery\CountValidator\Exception;
use Illuminate\Support\Facades\Input;

class MailboxTable extends Model
{
    /**************************************************
    Function Name	: countMailbox
    Description		:
    Argument		: $accountid
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function countMailbox($accountid){

        $result = DB::table('mailbox')
            ->where('loaithu',THUGUIDEN)
            ->where('sohuu',$accountid)
            ->where('trangthai',CHUADOC)
            ->get();
        return count($result);
    }

    /**************************************************
    Function Name	: countHopThu
    Description		:
    Argument		: $accountid
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function countHopThu($accountid,$loaithu){

        $result = DB::table('mailbox')
            ->where('loaithu',$loaithu)
            ->where('sohuu',$accountid)
            ->get();
        return count($result);
    }

    /**************************************************
    Function Name	: getMailbox
    Description		:
    Argument		: $accountid, $type
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function getMailbox($accountid, $type, $chonHienThiSoLuong){

        $result = DB::table('mailbox')
            ->where('loaithu',$type)
            ->where('sohuu',$accountid)
            ->orderby('ngaygui','desc')
            ->paginate($chonHienThiSoLuong);
        return $result;
    }

    /**************************************************
    Function Name	: xoaMailboxTheoID
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function xoaMailboxTheoID($id){
        try {
            DB::table('mailbox')
                ->where('id', $id)
                ->delete();

            $result = 'successful';

        }catch (Exception $e){

            $result = 'fail';
        }
        return $result;
    }

    /**************************************************
    Function Name	: getEmailTheoID
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function getEmailTheoID($id)
    {
        $result = DB::table('mailbox')
            ->where('id',$id)
            ->get();
        return $result;
    }

    /**************************************************
    Function Name	: updateStatusEmail
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function updateStatusEmail($id)
    {
        try {
            DB::table('mailbox')
                ->where('id', $id)
                ->update([
                    'trangthai' => DADOC
                ]);
            $result = 'successful';
        }catch (Exception $e){
            $result = 'fail';
        }

        return $result;
    }

    /**************************************************
    Function Name	: sendEmail
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function sendEmail($request, $tennguoigui, $tennguoinhan)
    {
        try {
            date_default_timezone_set('Asia/Ho_Chi_Minh');

            $thuguidiid = DB::table('mailbox')
                ->insertGetId([
                    'nguoigui' => $tennguoigui,
                    'nguoinhan' => $tennguoinhan,
                    'tieude' => $request->tieude,
                    'noidung' => $request->noidung,
                    'ngaygui' => date('Y-m-d H:i:s'),
                    'loaithu' => THUGUIDI,
                    'sohuu' => $request->nguoigui
                ]);

            $thuguidenid = DB::table('mailbox')
                ->insertGetId([
                    'nguoigui' => $tennguoigui,
                    'nguoinhan' => $tennguoinhan,
                    'tieude' => $request->tieude,
                    'noidung' => $request->noidung,
                    'ngaygui' => date('Y-m-d H:i:s'),
                    'loaithu' => THUGUIDEN,
                    'sohuu' => $request->nguoinhan
                ]);

            if($request->filedinhkem != null){
                //create direction
                $input = Input::all();

                $filevanban = array_get($input, 'filedinhkem');

                $file_path = FOLDERROOT."/Maibox/".$thuguidiid;
                $linkfile = '/Maibox'.'/'.$thuguidiid;

                // RENAME THE UPLOAD WITH RANDOM NUMBER
                $fileName = $filevanban->getClientOriginalName();
                // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
                $filevanban->move($file_path, $fileName);

                DB::table('mailbox')
                    ->where('id',$thuguidiid)
                    ->update([
                        'filedinhkem' => $fileName,
                        'filepath' => $linkfile
                    ]);

                DB::table('mailbox')
                    ->where('id',$thuguidenid)
                    ->update([
                        'filedinhkem' => $fileName,
                        'filepath' => $linkfile
                    ]);
            }

            $result = 'successful';

        }catch (Exception $e){

            $result = 'fail';

        }

        return $result;
    }

    /**************************************************
    Function Name	: assigneeNguoiXuLy
    Description		:
    Argument		: $noidung
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function assigneeNguoiXuLy($noidung)
    {
        try {
            date_default_timezone_set('Asia/Ho_Chi_Minh');

            $thuguidiid = DB::table('mailbox')
                ->insertGetId([
                    'nguoigui' => $noidung['tennguoigui'],
                    'nguoinhan' => $noidung['tennguoinhan'],
                    'tieude' => $noidung['tieude'],
                    'noidung' => $noidung['noidung'],
                    'ngaygui' => date('Y-m-d H:i:s'),
                    'loaithu' => THUGUIDI,
                    'sohuu' => $noidung['nguoiguiid'],
                ]);

            $thuguidenid = DB::table('mailbox')
                ->insertGetId([
                    'nguoigui' => $noidung['tennguoigui'],
                    'nguoinhan' => $noidung['tennguoinhan'],
                    'tieude' => $noidung['tieude'],
                    'noidung' => $noidung['noidung'],
                    'ngaygui' => date('Y-m-d H:i:s'),
                    'loaithu' => THUGUIDEN,
                    'sohuu' => $noidung['nguoinhanid'],
                ]);

            $result = 'successful';

        }catch (Exception $e){

            $result = 'fail';

        }

        return $result;
    }

}
