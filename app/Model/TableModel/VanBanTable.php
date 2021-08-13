<?php

namespace App\Model\TableModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;
use Illuminate\Support\Facades\Input;
use App\Model\TableModel\DonThuTable;

class VanBanTable extends Model
{
    protected $table = 'vanban';
    public $timestamps = false;
    /**************************************************
    Function Name	: GetVanBan
    Description		:
    Argument		: $type
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetVanBan($type){

        $result = DB::table('vanban')
            //->where('loaivanban',$type)
            ->orderby('create_at','desc')
            ->paginate(10);
        return $result;
    }

    /**************************************************
    Function Name	: StoreVanBanPhapLuat
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreVanBanPhapLuat($request,$accountId,$diabanId){

        try {

            if($request->VBAD == 'on'){

                $loaivanban = VBAD;

            }elseif($request->VBCD == 'on'){

                $loaivanban = VBCD;

            }else{

                $loaivanban = VBPL;

            }

            $ngayPhatHanh = DonThuTable::ConvertFormatDate($request->ngaybanhanh);
            $ngayNhan = DonThuTable::ConvertFormatDate($request->ngayNhan);

            $result = DB::table('vanban')
                ->insertGetId([
                    'loaivanban' => $loaivanban,
                    'tenvanban' => $request->tenvanban,
                    'sohieu' => $request->sohieu,
                    'trichdan' => $request->trichdan,
                    'coquanbanhanh' => $request->coquanbanhanh,
                    'nguoiky' => $request->nguoiky,
                    'ngaybanhanh' => $ngayPhatHanh,
                    'nguoicapnhat' => $request->accountname,
                    'accountId'=>$accountId,
                    'ngayNhan'=>$ngayNhan,
                    'diaBanId'=>$diabanId,
                    'canBoNhan'=>$request->chuyenCanBo,
                    'doiTuongLienQuan1'=>($request->doiTuong1 != null)?$request->doiTuong1:'',
                    'doiTuongLienQuan2'=>($request->doiTuong2 != null)?$request->doiTuong2:'',
                    'doiTuongLienQuan3'=>($request->doiTuong3 != null)?$request->doiTuong3:'',
                    'doiTuongLienQuan4'=>($request->doiTuong4 != null)?$request->doiTuong4:'',
                    'doiTuongLienQuan5'=>($request->doiTuong5 != null)?$request->doiTuong5:'',
                    'donLienQuan'=>$request->donLienQuanHide
                ]);

        } catch (Exception $e){

            $result = 'fail';

        }

        return $result;
    }

    /**************************************************
    Function Name	: StoreFileVanBan
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreFileVanBan($id){

        try {
            //create direction
            $input = Input::all();

            $filevanban = array_get($input, 'filevanban');

            $file_path = FOLDERROOT."/congthongtin/vanban/".$id;

//            if (!is_dir($file_path)) {
//
//                mkdir($file_path, 0700);
//            }

            // RENAME THE UPLOAD WITH RANDOM NUMBER
            $fileName = $filevanban->getClientOriginalName();
            // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
            $filevanban->move($file_path, $fileName);

            DB::table('vanban')
                ->where('id', $id)
                ->update([
                    'filevanban' => '/congthongtin/vanban/'.$id.'/'.$fileName,
                    'filename' => $fileName
                ]);

            $result = 'successful';

        }catch (Exception $e){

            $result = 'fail';
        }

        return $result;
    }

    /**************************************************
    Function Name	: XoaVanBan
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function XoaVanBan($id){

        try {
            DB::table('vanban')
                ->where('id', $id)
                ->delete();

            $result = 'successful';

        }catch (Exception $e){

            $result = 'fail';
        }

        return $result;
    }

    /**************************************************
    Function Name	: GetVanBanTheoID
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetVanBanTheoID($id){

        $result = DB::table('vanban')
            ->where('id',$id)
            ->get();
        return $result;
    }

    /**************************************************
    Function Name	: UpdateVanBan
    Description		:
    Argument		: $id, $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function UpdateVanBan($id, $request,$accountId){

        try {

            if($request->VBAD == 'on'){

                $loaivanban = VBAD;

            }elseif($request->VBCD == 'on'){

                $loaivanban = VBCD;

            }else{

                $loaivanban = VBPL;

            }

            $ngayBanHanh = DonThuTable::ConvertFormatDate($request->ngaybanhanh);
            $ngayNhan = DonThuTable::ConvertFormatDate($request->ngayNhan);

            DB::table('vanban')
                ->where('id', $id)
                ->update([
                    'loaivanban' => $loaivanban,
                    'tenvanban' => $request->tenvanban,
                    'sohieu' => $request->sohieu,
                    'trichdan' => $request->trichdan,
                    'coquanbanhanh' => $request->coquanbanhanh,
                    'nguoiky' => $request->nguoiky,
                    'ngaybanhanh' => $ngayBanHanh,
                    'ngayNhan'=>$ngayNhan,
                    'nguoicapnhat' => $request->accountname,
                    'accountId'=>$accountId,
                    'diaBanId'=>$request->diaBanId,
                    'canBoNhan'=>$request->chuyenCanBo,
                    'doiTuongLienQuan1'=>($request->doiTuong1 != null)?$request->doiTuong1:'',
                    'doiTuongLienQuan2'=>($request->doiTuong2 != null)?$request->doiTuong2:'',
                    'doiTuongLienQuan3'=>($request->doiTuong3 != null)?$request->doiTuong3:'',
                    'doiTuongLienQuan4'=>($request->doiTuong4 != null)?$request->doiTuong4:'',
                    'doiTuongLienQuan5'=>($request->doiTuong5 != null)?$request->doiTuong5:'',
                    'donLienQuan'=>$request->donLienQuanHide

                ]);

            $result = 'successful';

        } catch (Exception $e){

            $result = 'fail';

        }

        return $result;
    }

    /**************************************************
    Function Name	: GetVanBanTrangChu
    Description		:
    Argument		: $type
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetVanBanTrangChu($type){

        $result = DB::table('vanban')
            ->where('loaivanban',$type)
            ->orderby('ngaybanhanh','desc')
            ->get();
        return $result;
    }

    /**************************************************
    Function Name	: SearchVanBan
    Description		:
    Argument		: $keysearch
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function SearchVanBan($keysearch){

        $result = DB::table('vanban')
            ->where('sohieu','like','%'.$keysearch.'%')
            ->get();
        return $result;
    }

    /**************************************************
    Function Name	: StoreVanBanDon
    Description		:
    Argument		: $donId
    Creation Date	: 2017/05/28
    Author			: Duongpd1
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreVanBanDon($donId)
    {

        if(!is_array($donId)){
            $donId = [$donId];
        }

        $data = DB::table('donthu')
            ->join('phanloaidonthu', 'donthu.donthuid', '=', 'phanloaidonthu.donthuid')
            ->join('donvi', 'phanloaidonthu.donvi', '=', 'donvi.id')
            ->join('quanlyvanban', 'donthu.donthuid', '=', 'quanlyvanban.donthuid')
            ->join('accountinfo', 'quanlyvanban.account', '=', 'accountinfo.accountid')
            ->whereIn('donthu.donthuid',$donId)
            ->select('quanlyvanban.*', 'donvi.tendonvi','accountinfo.fullname','phanloaidonthu.donvi')
            ->get();
         collect($data);

        $group = collect($data)->groupBy('tendonvi')->toArray();

        return $group;
    }

    /**************************************************
    Function Name	: getDataVanBanOfVanThu
    Description		:
    Argument		: $accountId
    Creation Date	: 2017/05/28
    Author			: Duongpd1
    Reviewer		: PhucHM
     ***************************************************/
    public static function getDataVanBanOfVanThu($accountId,$diabanId)
    {
        if(!$accountId )
        {
            $accountId = Session::get('accountid');
        }
        if(!$accountId )
        {
            return false;
        }

        $data = VanBanTable::where('diaBanId', $diabanId)->orderby('create_at','desc')->get()->groupBy('loaivanban');



        $result = (object) array(
            'vanBanDen' => isset($data[0]) ? $data[0] : array(),
            'vanBanPhatHanh' => isset($data[1]) ? $data[1] : array(),
            'vanBanPhapLuat' => isset($data[2]) ? $data[2] : array(),
        );

        return $result;
    }
    /**************************************************
    Function Name	: UpdateCommentTheoId
    Description		:
    Argument		: $accountId
    Creation Date	: 2017/05/28
    Author			: Duongpd1
    Reviewer		: PhucHM
     ***************************************************/
    public static function UpdateCommentTheoId($request)
    {
        DB::table('quanlyvanban')
            ->where('id',$request->commentId)
            ->update(['ykienCV'=>$request->comment]);

        return 'successful';
    }
}
