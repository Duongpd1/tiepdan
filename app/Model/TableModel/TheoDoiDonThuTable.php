<?php

namespace App\Model\TableModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;
use Illuminate\Support\Facades\Input;
use App\Model\TableModel\AccountInfoTable;

class TheoDoiDonThuTable extends Model
{
    protected $table = 'theodoidonthu';
    public $timestamps = false;
    /**************************************************
    Function Name	: GetTheoDoiDonThuTheoID
    Description		:
    Argument		: $donthuid
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetTheoDoiDonThuTheoID($donthuid){

        $result = DB::table('theodoidonthu')
            ->where('donthuid',$donthuid)
            ->get();
        return $result;
    }

    /**************************************************
    Function Name	: updateTheoDoiDonThu
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function updateTheoDoiDonThu($request,$accountId)
    {
        try {

            $donthuid = $request->donthuid;

            $bao_cao_len_dv = $request->baocaoDV;
            $de_xuat_tw = $request->deXuatTW;
            $y_kien_ld = $request->yKienCD;
            $cvDen = $request->cvDen;

            //check trang thai
            $status = DB::table('donthu')->where('donthuid',$donthuid)->value('trangthaixuly');
            if($status< DANGGIAIQUYET)
            {
                DB::table('donthu')
                    ->where('donthuid', $donthuid)
                    ->update(['trangthaixuly' => DANGGIAIQUYET]);

            }

            DB::table('theodoidonthu')
                ->where('donthuid',$donthuid)
                ->update([
                    'dexuatdonvi'=>$bao_cao_len_dv,
                    'dexuatlentrunguong'=>$de_xuat_tw,
                    'ykienchidao'=>$y_kien_ld
                ]);

            //
            DB::table('quanlyvanban')
                ->insert([
                    'donthuid'=>$donthuid,
                    'soCV'=>$cvDen,
                    'giaoxulycualanhdao'=>$bao_cao_len_dv,
                    'ykienCV'=>$y_kien_ld,
                    'ghichu'=>$de_xuat_tw,
                    'type'=>COMMENT,
                    'trangthai'=>DANGTHEODOI,
                    'account'=>$accountId
                ]);

            $result = 'successful';

        }catch (Exception $e){

            $result = 'fail';

        }
        return $result;
    }
	
    /**************************************************
    Function Name	: updateFilePhieuTrinh
    Description		:
    Argument		: $id, $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function updateFilePhieuTrinh($id, $request,$accountId)
    {
        $sothuly = DB::table('donthu')
            ->where('donthuid',$id)
            ->value('sothuly');

        //create direction
        $input = Input::all();
        $name = explode('/',$sothuly);
        $folder_name ="theodoidonthu_".$name[0]."_".$name[1];

        $file_path = FOLDERROOT."/file/".$folder_name;
        $linkfile = '/file'.'/'.$folder_name;

        //create direction
        $filevanbanyeucauxuly = array_get($input, 'vanBanXL');
        // RENAME THE UPLOAD WITH RANDOM NUMBER
        $filevanbanyeucauxulydinhkem = $filevanbanyeucauxuly->getClientOriginalName();
        // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
        $filevanbanyeucauxuly->move($file_path, $filevanbanyeucauxulydinhkem);

        DB::table('quanlyvanban')
            ->insert([
                'donthuid'=>$id,
                'tenvanban'=>$filevanbanyeucauxulydinhkem,
                'linkfile'=>$linkfile,
                'type'=>INSERTFILE,
                'account'=>$accountId,
                'trangthai'=>DANGTHEODOI
            ]);
    }

    /**************************************************
    Function Name	: updateFileTBTL
    Description		:
    Argument		: $id, $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function updateFileTBTL($id, $request,$accountId)
    {
        $sothuly = DB::table('donthu')->where('donthuid',$id)->value('sothuly');

        //create direction
        $input = Input::all();

        $name = explode('/',$sothuly);
        $folder_name ="theodoidonthu_".$name[0]."_".$name[1];

        $file_path = FOLDERROOT."/file/".$folder_name;
        $linkfile = '/file'.'/'.$folder_name;

        //create direction
        $filevanbanyeucauxuly = array_get($input, 'vanBanBS');
        // RENAME THE UPLOAD WITH RANDOM NUMBER
        $filevanbanyeucauxulydinhkem = $filevanbanyeucauxuly->getClientOriginalName();
        // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
        $filevanbanyeucauxuly->move($file_path, $filevanbanyeucauxulydinhkem);


        DB::table('quanlyvanban')
            ->insert([
                'donthuid'=>$id,
                'tenvanban'=>$filevanbanyeucauxulydinhkem,
                'linkfile'=>$linkfile,
                'type'=>INSERTFILE,
                'account'=>$accountId,
                'trangthai'=>DANGTHEODOI
            ]);
    }

    /**************************************************
    Function Name	: updateFileTBGQCD
    Description		:
    Argument		: $id, $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function updateFileTBGQCD($id, $request)
    {
        $sothuly = DB::table('donthu')
            ->where('donthuid',$id)
            ->value('sothuly');

        //create direction
        $input = Input::all();

        $name = explode('/',$sothuly);
        $folder_name ="theodoidonthu_".$name[0]."_".$name[1];

        $file_path = FOLDERROOT."/file/".$folder_name;
        $linkfile = '/file'.'/'.$folder_name;

        //create direction
        $filevanbanyeucauxuly = array_get($input, 'fileTBGQCD');
        // RENAME THE UPLOAD WITH RANDOM NUMBER
        $filevanbanyeucauxulydinhkem = $filevanbanyeucauxuly->getClientOriginalName();
        // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
        $filevanbanyeucauxuly->move($file_path, $filevanbanyeucauxulydinhkem);

        DB::table('theodoidonthu')
            ->where('donthuid',$id)
            ->update([
                'filecoquankhac'=>$filevanbanyeucauxulydinhkem,
                'linkfile'=>$linkfile,
            ]);
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
            DB::table('theodoidonthu')
                ->where('donthuid', $donthuid)
                ->delete();

            $result = 'successful';

        }catch (Exception $e){

            $result = 'fail';
        }
        return $result;
    }
	
	    /**************************************************
    Function Name	: fileBaoCaoLenDonVi
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function fileBaoCaoLenDonVi($id, $request)
    {
        $sothuly = DB::table('donthu')
            ->where('donthuid',$id)
            ->value('sothuly');

        //create direction
        $input = Input::all();

        $name = explode('/',$sothuly);
        $folder_name ="theodoidonthu_".$name[0]."_".$name[1];

        $file_path = FOLDERROOT."/file/".$folder_name;
        $linkfile = '/file'.'/'.$folder_name;

        //create direction
        $file_bao_cao_dv = array_get($input, 'filebaocaodv');
        // RENAME THE UPLOAD WITH RANDOM NUMBER
        $filedinhkem = $file_bao_cao_dv->getClientOriginalName();
        // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
        $file_bao_cao_dv->move($file_path, $filedinhkem);

        DB::table('theodoidonthu')
            ->where('donthuid',$id)
            ->update([
                'filebaocaodonvi'=>$filedinhkem,
                'linkfile'=>$linkfile
            ]);
    }
    /**************************************************
    Function Name	: fileBaoCaoLenDonVi
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function fileBaoCaoLenTW($id, $request)
    {
        $sothuly = DB::table('donthu')
            ->where('donthuid',$id)
            ->value('sothuly');

        //create direction
        $input = Input::all();

        $name = explode('/',$sothuly);
        $folder_name ="theodoidonthu_".$name[0]."_".$name[1];

        $file_path = FOLDERROOT."/file/".$folder_name;
        $linkfile = '/file'.'/'.$folder_name;

        //create direction
        $file_bao_cao_tw = array_get($input, 'filedexuattw');
        // RENAME THE UPLOAD WITH RANDOM NUMBER
        $filedinhkem = $file_bao_cao_tw->getClientOriginalName();
        // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
        $file_bao_cao_tw->move($file_path, $filedinhkem);

        DB::table('theodoidonthu')
            ->where('donthuid',$id)
            ->update([
                'filedexuattw'=>$filedinhkem,
                'linkfile'=>$linkfile
            ]);
    }
    /**************************************************
    Function Name	: fileBaoCaoLenDonVi
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function fileyKienLanhDao($id, $request)
    {
        $sothuly = DB::table('donthu')
            ->where('donthuid',$id)
            ->value('sothuly');

        //create direction
        $input = Input::all();

        $name = explode('/',$sothuly);
        $folder_name ="theodoidonthu_".$name[0]."_".$name[1];

        $file_path = FOLDERROOT."/file/".$folder_name;
        $linkfile = '/file'.'/'.$folder_name;

        //create direction
        $file_ykien_ld = array_get($input, 'fileykien');
        // RENAME THE UPLOAD WITH RANDOM NUMBER
        $filedinhkem = $file_ykien_ld->getClientOriginalName();
        // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
        $file_ykien_ld->move($file_path, $filedinhkem);

        DB::table('theodoidonthu')
            ->where('donthuid',$id)
            ->update([
                'fileykienlanhdao'=>$filedinhkem,
                'linkfile'=>$linkfile
            ]);
    }

    /**************************************************
    Function Name	: InsertLichSuXuLy
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function InsertLichSuXuLy($results)
    {
        $donthuId = $results->donthuid;
        $nguoiGiaoXL = $results->accountid;
        $huongGiaiQuyet = $results->huonggiaiquyet;
        $nguoiXL = $results->nguoixuly;
        $yKienCV = $results->yKienCD;
        //$trangThai = $results->optradio;

        if($nguoiGiaoXL != $nguoiXL)
        {
            DB::table('lichsugiaoxuly')
                ->insert([
                    'donthuid'=>$donthuId,
                    'nguoiGiaoXuLy'=>$nguoiGiaoXL,
                    'nguoiXuLy'=>$nguoiXL,
                    'noi_dung_chuyen_tiep'=>$yKienCV
                ]);
        }


        if($yKienCV !="")
        {
            DB::table('quanlyvanban')
                ->insert([
                    'donthuid'=>$donthuId,
                    'account'=>$nguoiGiaoXL,
                    'ykienCV'=>$yKienCV,
                    'type'=>COMMENT,
                ]);
        }


        DB::table('phanloaidonthu')
            ->where('donthuid',$donthuId)
            ->update([
                'huonggiaiquyet'=>$huongGiaiQuyet,
                'nguoixuly'=>$nguoiXL

            ]);
        $status = DB::table('donthu')->where('donthuid',$donthuId)->value('trangthaixuly');
        if($status < DANGXULY)
        {
            DB::table('donthu')
                ->where('donthuid',$donthuId)
                ->update([
                    'trangthaixuly'=>DANGXULY
                ]);
        }



        return $donthuId;
    }
    /**************************************************
    Function Name	: GetLichSuXuLy
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetLichSuXuLy($donthuId)
    {

        $results = DB::table('lichsugiaoxuly')
            ->where('donthuid',$donthuId)
            ->get();



        return $results;
    }

    /**************************************************
    Function Name	: InsertComment
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function InsertComment($request)
    {
        $donthuId = $request->donthuId;
        $accountId = $request->accountId;
        $comment = $request->comment;
        DB::table('quanlyvanban')
            ->insert([
                'donthuid'=>$donthuId,
                'account'=>$accountId,
                'ykienCV'=>$comment,
                'type'=>COMMENT,
            ]);

        return 'success';
    }
    /**************************************************
    Function Name	: InsertNguoiTheoDoi
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function InsertNguoiTheoDoi($request)
    {
        $infor = null;
        if($request->accountId != "")
        {
            $infor = AccountInfoTable::GetAccountInfoTheoID($request->accountId);
            DB::table('nguoitheodoi')
                ->insert([
                    'donthuid'=>$request->donthuId,
                    'accountid'=>$request->accountId,
                    //'permission'=>$infor[0]->
                ]);
        }



        return $infor;
    }
    /**************************************************
    Function Name	: GetNguoiTheodoiTheoDonThu
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetNguoiTheodoiTheoDonThu($donthuId)
    {
        $result = DB::table('nguoitheodoi')
            ->where('donthuid',$donthuId)
            ->get();

        return $result;
    }
    /**************************************************
    Function Name	: InsertNguoiTheoDoi
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function DeleteNguoiTheoDoi($request)
    {
        $result = DB::table('nguoitheodoi')
            ->where('donthuid',$request->donthuId)
            ->where('accountid',$request->accountId)
            ->delete();

        return 'successful';
    }

}
