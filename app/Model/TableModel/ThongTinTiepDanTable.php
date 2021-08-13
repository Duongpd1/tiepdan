<?php

namespace App\Model\TableModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;
use Illuminate\Support\Facades\Input;

class ThongTinTiepDanTable extends Model
{
    /**************************************************
    Function Name	: StoreThongTinTiepDan
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreThongTinTiepDan($request){

        try {

            $result = DB::table('thongtintiepdan')
                ->insertGetId([
                    'sohieu' => $request->sohieu,
                    'coquanbanhanh' => $request->coquanbanhanh,
                    'ngaybanhanh' => $request->ngaybanhanh,
                    'trichdan' => $request->trichdan,
                    'noidung' => $request->noidung,
                    'nguoicapnhat' => $request->accountname
                ]);

        } catch (Exception $e){

            $result = 'fail';

        }

        return $result;
    }

    /**************************************************
    Function Name	: StoreFileThongTinTiepDan
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreFileThongTinTiepDan($id){

        try {
            //create direction
            $input = Input::all();

            $fileupload = array_get($input, 'fileupload');

            $file_path = FOLDERROOT."/tiepdan/thongtintiepdan/".$id;

//            if (!is_dir($file_path)) {
//
//                mkdir($file_path, 0700);
//            }

            // RENAME THE UPLOAD WITH RANDOM NUMBER
            $fileName = $fileupload->getClientOriginalName();
            // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
            $fileupload->move($file_path, $fileName);

            DB::table('thongtintiepdan')
                ->where('id', $id)
                ->update([
                    'fileupload' => '/tiepdan/thongtintiepdan/'.$id.'/'.$fileName,
                    'filename' => $fileName
                ]);

            $result = 'successful';

        }catch (Exception $e){

            $result = 'fail';
        }

        return $result;
    }

    /**************************************************
    Function Name	: GetThongTinTiepDan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetThongTinTiepDan($soLuongHienThi){

        $result = DB::table('thongtintiepdan')
            ->orderby('ngaybanhanh','desc')
            ->paginate($soLuongHienThi);
        return $result;
    }

    /**************************************************
    Function Name	: XoaThongTinTiepDan
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function XoaThongTinTiepDan($id){
        try {
            DB::table('thongtintiepdan')
                ->where('id', $id)
                ->delete();

            $result = 'successful';

        }catch (Exception $e){

            $result = 'fail';
        }
        return $result;
    }

    /**************************************************
    Function Name	: ChangeTrangThaiThongTinTiepDan
    Description		:
    Argument		: $id, $newtrangthai
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function ChangeTrangThaiThongTinTiepDan($id, $newtrangthai){

        try {
            DB::table('thongtintiepdan')
                ->where('id', $id)
                ->update([
                    'trangthai' => $newtrangthai
                ]);

            $result = 'successful';

        }catch (Exception $e){

            $result = 'fail';
        }

        return $result;
    }

    /**************************************************
    Function Name	: GetThongTinTiepDanTheoID
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetThongTinTiepDanTheoID($id){

        $result = DB::table('thongtintiepdan')
            ->where('id',$id)
            ->get();
        return $result;
    }

    /**************************************************
    Function Name	: UpdateThongTinTiepDan
    Description		:
    Argument		: $id, $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function UpdateThongTinTiepDan($id, $request){

        try {

            DB::table('thongtintiepdan')
                ->where('id', $id)
                ->update([
                    'sohieu' => $request->sohieu,
                    'coquanbanhanh' => $request->coquanbanhanh,
                    'ngaybanhanh' => $request->ngaybanhanh,
                    'trichdan' => $request->trichdan,
                    'noidung' => $request->noidung,
                    'nguoicapnhat' => $request->accountname
                ]);

            $result = 'successful';

        } catch (Exception $e){

            $result = 'fail';

        }

        return $result;
    }

}
