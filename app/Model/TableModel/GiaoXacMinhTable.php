<?php

namespace App\Model\TableModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;
use Illuminate\Support\Facades\Input;

class GiaoXacMinhTable extends Model
{
    /**************************************************
    Function Name	: updateGiaoXacMinh
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function updateGiaoXacMinh($request)
    {
        try {

            $donthuid = $request->donthuid;
            $ngaybatdau = $request->ngaybatdau;
            $ngayketthuc = $request->ngayketthuc;
            $donvi = $request->donvi;
            $noidunggiaoXM = $request->noidunggiaoXM;

            DB::table('giaoxacminh')
                ->where('donthuid',$donthuid)
                ->update(['ngaybatdau'=>$ngaybatdau,
                    'ngayketthuc'=>$ngayketthuc,
                    'donvi'=>$donvi,
                    'noidung' => $noidunggiaoXM,
                    'trangthaitheodoi' => DATHEODOI
                ]);
            //check status
            $status = DB::table('donthu')->where('donthuid',$donthuid)->value('trangthaixuly');

            if($status<DANGGIAIQUYET)
            {
                DB::table('donthu')
                    ->where('donthuid',$donthuid)
                    ->update([
                        'trangthaixuly'=> DANGGIAIQUYET
                    ]);
            }


            $result = 'successful';

        }catch (Exception $e){

            $result = 'fail';

        }
        return $result;
    }

    /**************************************************
    Function Name	: updateFileTBGQCD
    Description		:
    Argument		: $id, $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function updateFileQDXM($id, $request)
    {
        $sothuly = $request->sothuly;

        //create direction
        $input = Input::all();

        $name = explode('/',$sothuly);
        $folder_name ="donthuxacminh_".$name[0]."_".$name[1];

        $file_path = FOLDERROOT."/file/".$folder_name;
        $linkfile = '/file'.'/'.$folder_name;

        //create direction
        $filevanbanyeucauxuly = array_get($input, 'fileQDXM');
        // RENAME THE UPLOAD WITH RANDOM NUMBER
        $filevanbanyeucauxulydinhkem = $filevanbanyeucauxuly->getClientOriginalName();
        // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
        $filevanbanyeucauxuly->move($file_path, $filevanbanyeucauxulydinhkem);

        DB::table('giaoxacminh')
            ->where('donthuid',$id)
            ->update([
                'filexacminh'=>$filevanbanyeucauxulydinhkem,
                'linkfile'=>$linkfile,
            ]);
    }

    /**************************************************
    Function Name	: getGiaoXacMinhDonThu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function getGiaoXacMinhDonThu()
    {
        $result = DB::table('giaoxacminh')
            ->get();
        return $result;
    }

    /**************************************************
    Function Name	: xoaDonThu
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function xoaDonThu($donthuid)
    {
        try {
            DB::table('giaoxacminh')
                ->where('donthuid', $donthuid)
                ->delete();

            $result = 'successful';

        }catch (Exception $e){

            $result = 'fail';
        }
        return $result;
    }

}
