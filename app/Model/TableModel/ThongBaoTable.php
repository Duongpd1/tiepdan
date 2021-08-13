<?php

namespace App\Model\TableModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;
use Illuminate\Support\Facades\Input;

class ThongBaoTable extends Model
{
    /**************************************************
    Function Name	: GetThongBao
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetThongBao($soLuongHienThi){

        $result = DB::table('thongbao')
            ->orderby('ngaybanhanh','desc')
            ->paginate($soLuongHienThi);
        return $result;
    }

    /**************************************************
    Function Name	: StoreThongBao
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreThongBao($request){

        try {

            $result = DB::table('thongbao')
                ->insertGetId([
                    'tenthongbao' => $request->tenthongbao,
                    'ngaybanhanh' => $request->ngaybanhanh,
                    'noidung' => $request->noidung,
                    'nguoicapnhat' => $request->accountname
                ]);

        } catch (Exception $e){

            $result = 'fail';

        }

        return $result;
    }

    /**************************************************
    Function Name	: StoreFileUpload
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreFileUpload($id){

        try {
            //create direction
            $input = Input::all();

            $file = array_get($input, 'fileupload');

            $file_path = FOLDERROOT."/congthongtin/thongbao/" . $id;

//            if (!is_dir($file_path)) {
//
//                mkdir($file_path, 0700);
//            }

            // RENAME THE UPLOAD WITH RANDOM NUMBER
            $fileName = $file->getClientOriginalName();
            // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
            $file->move($file_path, $fileName);

            DB::table('thongbao')
                ->where('id', $id)
                ->update([
                    'fileupload' => '/congthongtin/thongbao/'.$id.'/'.$fileName,
                    'filename' => $fileName
                ]);

            $result = 'successful';

        }catch (Exception $e){

            $result = 'fail';
        }

        return $result;
    }

    /**************************************************
    Function Name	: XoaThongBao
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function XoaThongBao($id){

        try {
            DB::table('thongbao')
                ->where('id', $id)
                ->delete();

            $result = 'successful';

        }catch (Exception $e){

            $result = 'fail';
        }

        return $result;
    }

    /**************************************************
    Function Name	: GetThongBaoTheoID
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetThongBaoTheoID($id){

        $result = DB::table('thongbao')
            ->where('id',$id)
            ->get();
        return $result;
    }

    /**************************************************
    Function Name	: UpdateThongBao
    Description		:
    Argument		: $id,$request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function UpdateThongBao($id, $request){

        try {

            DB::table('thongbao')
                ->where('id', $id)
                ->update([
                    'tenthongbao' => $request->tenthongbao,
                    'ngaybanhanh' => $request->ngaybanhanh,
                    'noidung' => $request->noidung,
                    'nguoicapnhat' => $request->accountname
                ]);

            $result = 'successful';

        } catch (Exception $e){

            $result = 'fail';

        }

        return $result;
    }

    /**************************************************
    Function Name	: GetThongBaoTrangChu
    Description		:
    Argument		: $id,$request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetThongBaoTrangChu(){

        $result = DB::table('thongbao')
            ->orderby('ngaybanhanh','desc')
            ->paginate(10);
        return $result;
    }
}
