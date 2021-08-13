<?php

namespace App\Model\TableModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;
use Illuminate\Support\Facades\Input;

class PhanLoaiDonThuTable extends Model
{
    const DON_NAC_DANH_TRUE = 1;
    const DON_NAC_DANH_FALSE = 0;

    const DON_DU_DK_XL = 1;
    const DON_KO_DU_DK_XL = 0;

    public $arrDonNacDanh = [
        self::DON_NAC_DANH_FALSE => 'Không phải đơn nặc danh',
        self::DON_NAC_DANH_TRUE => 'Đơn nặc danh'
    ];

    public $arrDonDuDKXL = [
        self::DON_KO_DU_DK_XL =>'Đơn không đủ điều kiện xử lý',
        self::DON_DU_DK_XL =>'Đơn đủ điều kiện xử lý'
    ];

    protected $table = 'phanloaidonthu';
    public $timestamps = false;

    /**************************************************
    Function Name	: updateScanPhieuHuongDan
    Description		:
    Argument		: $id, $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function updateScanPhieuHuongDan($id, $request,$accountId)
    {
        $sothuly = DB::table('donthu')
            ->where('donthuid',$id)
            ->value('sothuly');

        //create direction
        $input = Input::all();
        if($sothuly!=null)
        {
            $name = explode('/',$sothuly);
            $folder_name ="phanloai_".$name[0]."_".$name[1];
        }
        else
        {
            $folder_name ="phanloai_";
        }

        $file_path = FOLDERROOT."/file/".$folder_name;
        $linkfile = '/file'.'/'.$folder_name;

        //create direction
        $filescanphieuhd = array_get($input, 'scanphieuhd');
        // RENAME THE UPLOAD WITH RANDOM NUMBER
        $filescanphieuhddinhkem = $filescanphieuhd->getClientOriginalName();
        // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
        $filescanphieuhd->move($file_path, $filescanphieuhddinhkem);

        DB::table('quanlyvanban')
            ->insert([
                'donthuid'=>$id,
                'tenvanban'=>$filescanphieuhddinhkem,
                'linkfile'=>$linkfile,
                'type'=>DAPHANLOAI,
                'account'=>$accountId
            ]);
    }

    /**************************************************
    Function Name	: updateCongVanChuyenDon
    Description		:
    Argument		: $id, $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function updateCongVanChuyenDon($id, $request,$accountId)
    {
        $sothuly = $request->sothuly;

        //create direction
        $input = Input::all();
        if($sothuly!=null)
        {
            $name = explode('/',$sothuly);
            $folder_name ="phanloai_".$name[0]."_".$name[1];
        }
        else
        {
            $folder_name ="phanloai_";
        }

        $file_path = FOLDERROOT."/file/".$folder_name;
        $linkfile = '/file'.'/'.$folder_name;

        //create direction
        $filecongvanchuyendon = array_get($input, 'cvchuyendon');
        // RENAME THE UPLOAD WITH RANDOM NUMBER
        $filecongvanchuyendondinhkem = $filecongvanchuyendon->getClientOriginalName();
        // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
        $filecongvanchuyendon->move($file_path, $filecongvanchuyendondinhkem);


        DB::table('quanlyvanban')
            ->insert([
                'donthuid'=>$id,
                'tenvanban'=>$filecongvanchuyendondinhkem,
                'linkfile'=>$linkfile,
                'type'=>DAPHANLOAI,
                'account'=>$accountId
            ]);
    }

    /**************************************************
    Function Name	: updateThongBaoChuyenDon
    Description		:
    Argument		: $id, $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function updateThongBaoChuyenDon($id, $request,$accountId)
    {
        $sothuly = $request->sothuly;

        //create direction
        $input = Input::all();
        if($sothuly!=null)
        {
            $name = explode('/',$sothuly);
            $folder_name ="phanloai_".$name[0]."_".$name[1];
        }
        else
        {
            $folder_name ="phanloai_";
        }

        $file_path = FOLDERROOT."/file/".$folder_name;
        $linkfile = '/file'.'/'.$folder_name;

        //create direction
        $filethongbaochuyendon = array_get($input, 'tbchuyendon');
        // RENAME THE UPLOAD WITH RANDOM NUMBER
        $filethongbaochuyendondinhkem = $filethongbaochuyendon->getClientOriginalName();
        // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
        $filethongbaochuyendon->move($file_path, $filethongbaochuyendondinhkem);

        DB::table('quanlyvanban')
            ->insert([
                'donthuid'=>$id,
                'tenvanban'=>$filethongbaochuyendondinhkem,
                'linkfile'=>$linkfile,
                'type'=>DAPHANLOAI,
                'account'=>$accountId
            ]);
    }

    /**************************************************
    Function Name	: updateVanBanYeuCauXuLy
    Description		:
    Argument		: $id, $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function updateVanBanYeuCauXuLy($id, $request,$accountId)
    {
        $sothuly = $request->sothuly;

        //create direction
        $input = Input::all();
        if($sothuly!=null)
        {
            $name = explode('/',$sothuly);
            $folder_name ="phanloai_".$name[0]."_".$name[1];
        }
        else
        {
            $folder_name ="phanloai_";
        }

        $file_path = FOLDERROOT."/file/".$folder_name;
        $linkfile = '/file'.'/'.$folder_name;

        //create direction
        $filevanbanyeucauxuly = array_get($input, 'yeucauxl');
        // RENAME THE UPLOAD WITH RANDOM NUMBER
        $filevanbanyeucauxulydinhkem = $filevanbanyeucauxuly->getClientOriginalName();
        // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
        $filevanbanyeucauxuly->move($file_path, $filevanbanyeucauxulydinhkem);


        DB::table('quanlyvanban')
            ->insert([
                'donthuid'=>$id,
                'tenvanban'=>$filevanbanyeucauxulydinhkem,
                'linkfile'=>$linkfile,
                'trangthai'=>DAPHANLOAI,
                'account'=>$accountId
            ]);
    }

    /**************************************************
    Function Name	: updateHuongGiaiQuyet
    Description		:
    Argument		: $id, $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function updateHuongGiaiQuyet($id, $request)
    {
        DB::table('phanloaidonthu')
            ->where('donthuid', $id)
            ->update([
                'socongvanchuyendi'=>$request->chuyendi,
                'donvichuyenden'=>$request->donvichuyendon
            ]);
    }

    /**************************************************
    Function Name	: updatePhanLoaiDonThu
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function updatePhanLoaiDonThu($request)
    {
        try {
            $donthuid = $request->donthuid;
            $loaidon = $request->loaidon;
            $linhvuc = $request->linhvuc;
            $diaban = $request->diaban;
            $huonggiaiquyet = $request->huonggiaiquyet;
            $dexuatphieutrinh = $request->dexuatphieutrinh;
            $nguoixuly = $request->nguoixuly;


            DB::table('phanloaidonthu')
                ->where('donthuid', $donthuid)
                ->update([
                    'loaidon' => $loaidon,
                    'linhvuc' => $linhvuc,
                    'diaban' => $diaban,
                    'huonggiaiquyet' => $huonggiaiquyet,
                    'dexuat' => $dexuatphieutrinh,
                    'nguoixuly' => $nguoixuly,
                    'trangthai' => DAPHANLOAI,
                ]);

            //check trang thai
            $status = DB::table('donthu')->where('donthuid',$donthuid)->value('trangthaixuly');
            if($status< DANGXULY)
            {
                DB::table('donthu')
                    ->where('donthuid', $donthuid)
                    ->update(['trangthaixuly' => DANGXULY]);

            }

            $result = 'successful';

        }catch (Exception $e){

            $result = 'fail';

        }
        return $result;
    }

    /**************************************************
    Function Name	: getPhanLoaiDonThu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function getPhanLoaiDonThu($diaBanIdAllArray)
    {

        $result = DB::table('phanloaidonthu')
            ->whereIn('diaban',$diaBanIdAllArray)
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
            DB::table('phanloaidonthu')
                ->where('donthuid', $donthuid)
                ->delete();

            $result = 'successful';

        }catch (Exception $e){

            $result = 'fail';
        }
        return $result;
    }

    /**************************************************
    Function Name	: getSoThuLyDonThu
    Description		:
    Argument		: None
    Creation Date	: 2016/11/26
    Author			: NamNH31
    Reviewer		: PhucHM
     ***************************************************/
    public static function getSoThuLyDonThu($diabanid)
    {
        $result = DB::table('phanloaidonthu')
            ->whereIn('diaban',$diabanid)
            ->pluck('donthuid');
        return $result;
    }

    /**************************************************
    Function Name	: getNguoiXuLyDonThuTheoDonThuId
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function getNguoiXuLyDonThuTheoDonThuId($donThuId)
    {
        $result= DB::table('phanloaidonthu')
            ->where('donthuid', $donThuId)
            ->first();

        return $result;
    }

    /**************************************************
    Function Name	: countSoDonThuDuocGiaoTheoId
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function countSoDonThuDuocGiaoTheoId($accountId)
    {
        $result= DB::table('phanloaidonthu')
            ->where('nguoixuly', $accountId)
            ->join('donthu', 'donthu.donthuid', '=', 'phanloaidonthu.donthuid')
            ->where('donthu.trangthaixuly','<', DAGIAIQUYET)
            ->count();

        return $result;
    }

    /**************************************************
    Function Name	: getDonThuDuocGiaoTheoId
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function getDonThuDuocGiaoTheoIdPagination($accountId)
    {
        $result= DB::table('phanloaidonthu')
            ->where('nguoixuly', $accountId)
            ->join('donthu', 'donthu.donthuid', '=', 'phanloaidonthu.donthuid')
            ->where('donthu.trangthaixuly','<', DAGIAIQUYET)
            ->paginate(10);

        return $result;
    }

}
