<?php

namespace App\Model\TableModel;

use Illuminate\Database\Eloquent\Model;
use DB;
use Mockery\CountValidator\Exception;
use Illuminate\Support\Facades\Input;

class BaoCaoDotXuat extends Model
{
    public static function GetBaoCaoDotXuatInfo(){
        $ketqua = DB::table('baocaodotxuat')
            ->orderby('tenloaidon','asc')
            ->paginate(10);
        return $ketqua;
    }

    /**************************************************
    Function Name	: StoreBaoCao
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreBaoCao($request){

        $date = date('Y-m-d');
        try {
            DB::table('baocaodotxuat')
                ->insert([
                    'tenloaidon' => $request->tenloaidon,
                    'mota' => $request->mota,
                    'ngaytao' => $date
                ]);

            $result = 'successful';
        }catch (Exception $e){

            $result = 'fail';

        }

        $dataID = DB::table('baocaodotxuat')
            ->pluck('id');
        $id = $dataID[count($dataID) - 1];

        $input = Input::all();
        $file_path = FOLDERROOT."/file/baocaodotxuat";
        $filevanban = array_get($input, 'filebaocao');
        $filevanbandinhkem = $filevanban->getClientOriginalName();
        // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
        $filevanban->move($file_path, $id."_".$filevanbandinhkem);

        DB::table('baocaodotxuat')
            ->where('id',$id )
            ->update([
                'filename' => $id."_".$filevanbandinhkem
            ]);
        return $result;
    }
    /**************************************************
    Function Name	: XoaBaoCao
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function XoaBaoCao($request){

        $id = $request->baocaoid;
        $filename = DB::table('baocaodotxuat')
                        ->where('id',$id)
                        ->value('filename');
        try {
            DB::table('baocaodotxuat')
                ->where('id',$id)
                ->delete();
            $result = "success";
            unlink(FOLDERROOT.'/file/baocaodotxuat/'.$filename);
        }catch (Exception $e){

            $result = 'fail';

        }
        return $result;
    }

    /**************************************************
    Function Name	: ChinhSuaBaoCao
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function page_ChinhSuaBaoCaoDotXuat($baoCaoID){
        $result = DB::table('baocaodotxuat')
                    ->where('id',$baoCaoID)
                    ->get();
        return $result;
    }
    /**************************************************
    Function Name	: SuaBaoCaoDotXuat
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function SuaBaoCaoDotXuat($request, $baoCaoID){
        $filename = DB::table('baocaodotxuat')
            ->where('id',$baoCaoID)
            ->value('filename');

        $input = Input::all();

        $file_path = FOLDERROOT . "/file/baocaodotxuat";
        $filevanban = array_get($input, 'filebaocao');
        if($filevanban != "" || $filevanban != null) {
            unlink(FOLDERROOT.'/file/baocaodotxuat/'.$filename);
            $filevanbandinhkem = $filevanban->getClientOriginalName();
            // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
            $filevanban->move($file_path, $baoCaoID . "_" . $filevanbandinhkem);
            $filenameupdate = $baoCaoID . "_" . $filevanbandinhkem;
        }
        else {
            $filenameupdate = $filename;
        }

        DB::table('baocaodotxuat')
            ->where('id', $baoCaoID)
            ->update([
                'tenloaidon' => $request->tenloaidon,
                'mota' => $request->mota,
                'filename' => $filenameupdate
            ]);

    }
}
