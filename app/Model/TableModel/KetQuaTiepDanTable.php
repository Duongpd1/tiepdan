<?php

namespace App\Model\TableModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;
use Illuminate\Support\Facades\Input;

class KetQuaTiepDanTable extends Model
{
    /**************************************************
    Function Name	: GetKetQuaTiepDan
    Description		:
    Argument		:
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetKetQuaTiepDan(){
        $ketqua = DB::table('ketquatiepdan')
            ->orderby('ngaytiep','desc')
            ->paginate(10);
        return $ketqua;
    }

    /**************************************************
    Function Name	: GetKetQuaTiepDanTheoDiaBan
    Description		:
    Argument		:
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetKetQuaTiepDanTheoDiaBan($diaBanIdAllArray,$soLuongHienThi){
        $ketqua = DB::table('ketquatiepdan')
            ->whereIn('diaban',$diaBanIdAllArray)
            ->orderby('ngaytiep','desc')
            ->paginate($soLuongHienThi);
        return $ketqua;
    }

    /**************************************************
    Function Name	: GetKetQuaTiepDanTheoDiaBanAll
    Description		:
    Argument		:
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetKetQuaTiepDanTheoDiaBanAll($diaBanIdAllArray){
        $ketqua = DB::table('ketquatiepdan')
            ->whereIn('diaban',$diaBanIdAllArray)
            ->orderby('ngaytiep','desc')
            ->get();
        return $ketqua;
    }

    /**************************************************
    Function Name	: GetKetQuaTiepDanTheoID
    Description		:
    Argument		:
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetKetQuaTiepDanTheoID($tiepdanid){
        $ketqua = DB::table('ketquatiepdan')
            ->where('tiepdanid',$tiepdanid)
            ->get();
        return $ketqua;
    }

    /**************************************************
    Function Name	: SearchKetQuaTiepDan
    Description		:
    Argument		: $keysearch
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function SearchKetQuaTiepDan($keysearch){

        $result = DB::table('ketquatiepdan')
            ->where('congdan','like','%'.$keysearch.'%')
            ->orwhere('sothuly','like','%'.$keysearch.'%')
            ->get();
        return $result;
    }

    /**************************************************
    Function Name	: StoreDanhSachTiepDan
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreDanhSachTiepDan($request,$diaBanId){

        try {

            $nguoiTiep = '';
            if (null != $request->nguoitiep1){
                $nguoiTiep = mb_strtoupper($request->nguoitiep1,'UTF-8');
            }

            if (null != $request->nguoitiep2){
                $nguoiTiep .= ', '.mb_strtoupper($request->nguoitiep2,'UTF-8');
            }

            if (null != $request->nguoitiep3){
                $nguoiTiep .= ', '.mb_strtoupper($request->nguoitiep3,'UTF-8');
            }

            if (null != $request->nguoitiep4){
                $nguoiTiep .= ', '.mb_strtoupper($request->nguoitiep4,'UTF-8');
            }

            if (null != $request->nguoitiep5){
                $nguoiTiep .= ', '.mb_strtoupper($request->nguoitiep5,'UTF-8');
            }

            $chucvu = '';
            if (null != $request->chucvu1){
                $chucvu = $request->chucvu1;
            }

            if (null != $request->chucvu2){
                $chucvu .= ', '.$request->chucvu2;
            }

            if (null != $request->chucvu3){
                $chucvu .= ', '.$request->chucvu3;
            }

            if (null != $request->chucvu4){
                $chucvu .= ', '.$request->chucvu4;
            }

            if (null != $request->chucvu5){
                $chucvu .= ', '.$request->chucvu5;
            }
            $ngayTiep = DonThuTable::ConvertFormatDate($request->ngaytiep);
            $ngayCap = DonThuTable::ConvertFormatDate($request->ngaycap);

            $tiepDanId =DB::table('ketquatiepdan')
                ->insertGetId([
                    //                    'sothuly' => $request->sothuly,
                    'ngaytiep' => $ngayTiep,
                    'lantiep' => $request->lantiep,
                    'lanhdao' => $nguoiTiep,
                    'chucvu' => $chucvu,
                    'congdan' => mb_strtoupper($request->tencongdan,'UTF-8'),
                    'diachi' => $request->diachi,
//                    'loaihinh' => $request->loaihinh,
                    'chuthe' => $request->chuthe,
                    'linhvuc' => $request->linhvuc,
                    'diaban' => $diaBanId,
                    'noidung' => $request->noidung,
                    'ykienlanhdao' => $request->ykienlanhdao,
                    'ketquagiaiquyet' => $request->ketquagiaiquyet,
//                    'diachilienhe'=>$request->diachilienhe,
                    //'thamquyen'=>$request->thamquyen,
                    'doituong'=>mb_strtoupper($request->doituong,'UTF-8'),
                    'sdt'=>$request->sdt,
                    'cmt'=>$request->cmt,
                    'ngaycap'=>$ngayCap,
                    'noicap'=>$request->noicap,
                    'chutri'=>mb_strtoupper($request->chuTri,'UTF-8'),
                    'chucvuchutri'=>$request->chucVuCT,
                    'coquandagiaiquyet'=>$request->coQuanDaGQ,
                    'noidungdagiaiquyet'=>$request->noiDungDaGQ,
                    'vuongmacdenghi'=>$request->vuongMacDN,
                    'donlienquan'=>$request->luuDonChaValue
                    //'ykientieptheo'=>$request->yKienTieoTheo
                ]);

            //update hinh thuc
//            if(KHIEUNAI == $request->loaihinh) {
//                if (null != $request->hinhthucKN) {
//                    DB::table('ketquatiepdan')
//                        ->where('tiepdanid', $tiepDanId)
//                        ->update(['hinhthuc' => $request->hinhthucKN]);
//                }
//            }elseif(TOCAO == $request->loaihinh) {
//                if (null != $request->hinhthucTC) {
//                    DB::table('ketquatiepdan')
//                        ->where('tiepdanid', $tiepDanId)
//                        ->update(['hinhthuc' => $request->hinhthucTC]);
//                }
//            }else{
//                DB::table('ketquatiepdan')
//                    ->where('tiepdanid', $tiepDanId)
//                    ->update(['hinhthuc' => '']);
//            }

            //update so thu ly
            $year = date("Y");
            $array_sothuly = [$tiepDanId,$year];
            $sothuly = implode("/",$array_sothuly);

            //update cong dan khac
            $dataSave = $request->dataSave;
            if($dataSave!= null)
            {
                $arrayIdSave = explode('.',$dataSave);

                $arrayIdSaveData = array();
                foreach ($arrayIdSave as $row)
                {
                    $arrayIdSaveData[] = (int) $row;
                }

                DB::table('congdankhac')
                    ->where('tiepdanid',$tiepDanId)
                    ->whereIn('id',$arrayIdSaveData)
                    ->update(['enable' => ENABLE]);
            }
            else
            {
                DB::table('congdankhac')
                    ->insert([
                        'tiepdanid'=>$tiepDanId,
                        'sothuly'=>$sothuly,
                        'tencongdan'=>mb_strtoupper($request->tencongdan,'UTF-8'),
                        'diachi'=>$request->diachi,
                        'cmt'=>$request->cmt,
                        'ngaycap'=>$ngayCap,
                        'noicap'=>$request->noicap,
                        'sdt'=>$request->sdt,
                        'enable' => ENABLE
                    ]);
            }


            //delete where not UnEnable
            DB::table('congdankhac')
                ->where('tiepdanid',$tiepDanId)
                ->where('enable',UNENABLE)
                ->delete();

            DB::table('ketquatiepdan')
                ->where('tiepdanid',$tiepDanId)
                ->update(['sothuly'=>$sothuly]);

            $result = $tiepDanId;

        }catch (Exception $e){

            $result = 'fail';
        }
        return $result;
    }

    /**************************************************
    Function Name	: UpdateDanhSachTiepDan
    Description		:
    Argument		: $id,$request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function UpdateDanhSachTiepDan($id,$request){

        try {

            $nguoiTiep = '';
            if (null != $request->nguoitiep1){
                $nguoiTiep = mb_strtoupper($request->nguoitiep1,'UTF-8');
            }

            if (null != $request->nguoitiep2){
                $nguoiTiep .= ', '.mb_strtoupper($request->nguoitiep2,'UTF-8');
            }

            if (null != $request->nguoitiep3){
                $nguoiTiep .= ', '.mb_strtoupper($request->nguoitiep3,'UTF-8');
            }

            if (null != $request->nguoitiep4){
                $nguoiTiep .= ', '.mb_strtoupper($request->nguoitiep4,'UTF-8');
            }

            if (null != $request->nguoitiep5){
                $nguoiTiep .= ', '.mb_strtoupper($request->nguoitiep5,'UTF-8');
            }

            $chucvu = '';
            if (null != $request->chucvu1){
                $chucvu = $request->chucvu1;
            }

            if (null != $request->chucvu2){
                $chucvu .= ', '.$request->chucvu2;
            }

            if (null != $request->chucvu3){
                $chucvu .= ', '.$request->chucvu3;
            }

            if (null != $request->chucvu4){
                $chucvu .= ', '.$request->chucvu4;
            }

            if (null != $request->chucvu5){
                $chucvu .= ', '.$request->chucvu5;
            }

            DB::table('ketquatiepdan')
                ->where('tiepdanid',$id)
                ->update([
                    'sothuly' => $request->sothuly,
                    'ngaytiep' => $request->ngaytiep,
                    'lantiep' => $request->lantiep,
                    'lanhdao' => $nguoiTiep,
                    'chucvu' => $chucvu,
                    'congdan' => mb_strtoupper($request->tencongdan,'UTF-8'),
                    'diachi' => $request->diachi,
//                    'loaihinh' => $request->loaihinh,
                    'chuthe'=>$request->chuthe,
                    'linhvuc' => $request->linhvuc,
//                    'diaban' => $request->diaban,
                    'noidung' => $request->noidung,
                    'ykienlanhdao' => $request->ykienlanhdao,
                    'ketquagiaiquyet' => $request->ketquagiaiquyet,
//                    'diachilienhe'=>$request->diachilienhe,
                    //'thamquyen'=>$request->thamquyen,
                    'doituong'=>mb_strtoupper($request->doituong,'UTF-8'),
                    'sdt'=>$request->sdt,
                    'cmt'=>$request->cmt,
                    'ngaycap'=>$request->ngaycap,
                    'noicap'=>$request->noicap,
                    'chutri'=>mb_strtoupper($request->chuTri,'UTF-8'),
                    'chucvuchutri'=>$request->chucVuCT,
                    'coquandagiaiquyet'=>$request->coQuanDaGQ,
                    'noidungdagiaiquyet'=>$request->noiDungDaGQ,
                    'vuongmacdenghi'=>$request->vuongMacDN
                   // 'ykientieptheo'=>$request->yKienTieoTheo
                ]);

            //update hinh thuc
//            if(KHIEUNAI == $request->loaihinh) {
//                if (null != $request->hinhthucKN) {
//                    DB::table('ketquatiepdan')
//                        ->where('tiepdanid', $id)
//                        ->update(['hinhthuc' => $request->hinhthucKN]);
//                }
//            }elseif(TOCAO == $request->loaihinh) {
//                if (null != $request->hinhthucTC) {
//                    DB::table('ketquatiepdan')
//                        ->where('tiepdanid', $id)
//                        ->update(['hinhthuc' => $request->hinhthucTC]);
//                }
//            }else{
//                DB::table('ketquatiepdan')
//                    ->where('tiepdanid', $id)
//                    ->update(['hinhthuc' => '']);
//            }

            //update cong dan khac
            DB::table('congdankhac')
                ->where('tiepdanid',$id)
                ->where('id',$request->idChuDon)
                ->update([
                        'tencongdan'=>mb_strtoupper($request->tencongdan,'UTF-8'),
                        'diachi'=>$request->diachi,
                        'cmt'=>$request->cmt,
                        'ngaycap'=>$request->ngaycap,
                        'noicap'=>$request->noicap,
                        'sdt'=>$request->sdt
                ]);
            $dataSave = $request->dataSave;
            if($dataSave!= null)
            {
                $arrayIdSave = explode('.',$dataSave);

                $arrayIdSaveData = array();
                foreach ($arrayIdSave as $row)
                {
                    $arrayIdSaveData[] = (int) $row;
                }

                DB::table('congdankhac')
                    ->where('tiepdanid',$id)
                    ->whereIn('id',$arrayIdSaveData)
                    ->update(['enable' => ENABLE]);
            }


            //delete cong dan
            $dataDlete = $request->dataDelete;
            if($dataDlete!= null)
            {
                $arrayIdDelete = explode('.',$dataDlete);

                $arrayIdDeleteData = array();
                foreach ($arrayIdDelete as $row)
                {
                    $arrayIdDeleteData[] = (int) $row;
                }

                DB::table('congdankhac')
                    ->where('tiepdanid',$id)
                    ->whereIn('id',$arrayIdDeleteData)
                    ->delete();
            }

            $result = 'successful';

        }catch (Exception $e){

            $result = 'fail';
        }
        return $result;
    }

    /**************************************************
    Function Name	: XoaDanhSachTiepDan
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function XoaDanhSachTiepDan($id){

        try {
            DB::table('ketquatiepdan')
                ->where('tiepdanid',$id)
                ->delete();

            $result = 'successful';

        }catch (Exception $e){

            $result = 'fail';
        }
        return $result;
    }
    /**************************************************
    Function Name	: getTiepDanID
    Description		:
    Argument		:
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function getTiepDanID()
    {
        $result = DB::table('ketquatiepdan')
            ->orderBy('tiepdanid', 'desc')
            ->first();
        return $result;
    }
    /**************************************************
    Function Name	: BaoCaoTiepDan
    Description		:
    Argument		: $name
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function BaoCaoTiepDan($tu_ngay,$den_ngay,$diaBanIdAllArray)
    {
        //thanh pho
        $tiepdan_tp = DB::table('ketquatiepdan')
            ->whereIn('diaban',$diaBanIdAllArray)
            ->join('diaban', function ($join) {
                $join->on('ketquatiepdan.diaban', '=', 'diaban.id')
                    ->where('diaban.type', '=', THANH_PHO);
            })
            ->whereBetween('ngaytiep',[$tu_ngay,$den_ngay])
            ->select('ketquatiepdan.*')
            ->get();



        //huyen
        $tiepdan_huyen = DB::table('ketquatiepdan')
            ->whereIn('diaban',$diaBanIdAllArray)
            ->join('diaban', function ($join) {
                $join->on('ketquatiepdan.diaban', '=', 'diaban.id')
                    ->where('diaban.type', '=', HUYEN);
            })
            ->whereBetween('ngaytiep',[$tu_ngay,$den_ngay])
            ->select('ketquatiepdan.*')
            ->get();

        //xa
        $tiepdan_xa = DB::table('ketquatiepdan')
            ->whereIn('diaban',$diaBanIdAllArray)
            ->join('diaban', function ($join) {
                $join->on('ketquatiepdan.diaban', '=', 'diaban.id')
                    ->where('diaban.type', '=', XA);
            })
            ->whereBetween('ngaytiep',[$tu_ngay,$den_ngay])
            ->select('ketquatiepdan.*')
            ->get();

        //
        $tiepdan_tong = DB::table('ketquatiepdan')
            ->whereIn('diaban',$diaBanIdAllArray)
            ->whereBetween('ngaytiep',[$tu_ngay,$den_ngay])
            ->select('ketquatiepdan.*')
            ->get();

        $data = array(
            'tiepdan_tp'=>$tiepdan_tp,
            'tiepdan_huyen'=>$tiepdan_huyen,
            'tiepdan_xa'=>$tiepdan_xa,
            'tong'=>$tiepdan_tong
        );

        return $data;
    }
	
	/**************************************************
    Function Name	: GetBaoCaoKetQuaTiepDanTheoDiaBan
    Description		: Get Bao Cao Ket Qua Tiep Dan Theo Dia Ban
    Argument		: $tuNgay,$denNgay,$diaBanIdArray
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetBaoCaoKetQuaTiepDanTheoDiaBan($tuNgay,$denNgay,$diaBanIdArray){
        $ketqua = DB::table('ketquatiepdan')
            ->where('ngaytiep','>=',$tuNgay)
            ->where('ngaytiep','<=',$denNgay)
            ->whereIn('diaban',$diaBanIdArray)
            ->get();
        return $ketqua;
    }
    /**************************************************
    Function Name	: ThongTinCongDanKhac
    Description		:
    Argument		: $delimiters,$string
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function ThongTinCongDanKhac($tiepDanId)
    {
        $result = DB::table('congdankhac')
            ->where('tiepdanid',$tiepDanId)
            ->get();
        return  $result;
    }
    /**************************************************
    Function Name	: AddThongTinCongDanKhac
    Description		:
    Argument		: $delimiters,$string
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function AddThongTinCongDanKhac($request)
    {
        $sothuly = explode('/',$request->sothuly);
        $tiepDanId = $sothuly[0];

        $tenCongDan = mb_strtoupper($request->tenCongDan,'UTF-8');
        $diaChi = $request->diaChi;
        $cmt = $request->cmt;
        $ngayCap = DonThuTable::ConvertFormatDate($request->ngayCap);
        $noiCap = $request->noiCap;
        $soDT = $request->sodt;

       $congDanId = DB::table('congdankhac')
            ->insertGetId([
                'tiepdanid'=>$tiepDanId,
                'sothuly'=>$request->sothuly,
                'tencongdan'=>$tenCongDan,
                'diachi'=>$diaChi,
                'cmt'=>$cmt,
                'ngaycap'=>$ngayCap,
                'noicap'=>$noiCap,
                'sdt'=>$soDT,
                'gioitinh'=>$request->gTinh,
                'enable'=>UNENABLE
            ]);

        $result =[$congDanId,$tenCongDan,$diaChi,$cmt,$soDT];

        return $result;

    }
    /**************************************************
    Function Name	: DeleteThongTinCongDanKhac
    Description		:
    Argument		: $id,$ten
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function DeleteThongTinCongDanKhac($id,$type)
    {
        if($type == 'tiepdan'){
            $xxx= DB::table('congdankhac')
                ->where('id', $id)
                ->delete();
        }
        else{
            $xxx= DB::table('nguoidaidien')
                ->where('id', $id)
                ->delete();
        }

        return $id;
    }
    /**************************************************
    Function Name	: InsertFileDinhKem
    Description		:
    Argument		: $id,$ten
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function InsertFileDinhKem($id,$request)
    {

        $sothuly = DB::table('ketquatiepdan')
            ->where('tiepdanid',$id)
            ->value('sothuly');

        $file_value = null;
        $file_name = ['file1','file2','file3','file4','file5'];

        //create direction
        $input = Input::all();
        if($sothuly!=null)
        {
            $name = explode('/',$sothuly);
            $folder_name ="tiepdan_".$name[0]."_".$name[1];
        }
        else
        {
            $folder_name ="tiepdan_";
        }

        $file_path = FOLDERROOT."/tiepdan/".$folder_name;
        $linkfile = '/tiepdan'.'/'.$folder_name;

        for($i = 0;$i<count($file_name);$i++)
        {
            //create direction
            $filevanban = array_get($input, $file_name[$i]);
            if($filevanban!=null)
            {
                // RENAME THE UPLOAD WITH RANDOM NUMBER
                $filevanbandinhkem = $filevanban->getClientOriginalName();
                // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
                $filevanban->move($file_path, $filevanbandinhkem);
                $file_value[$i] = $filevanbandinhkem;
            }
            else
            {
                $file_value[$i] = "";
            }
        }
        //noi mang
        $array_file = implode("*",$file_value);



        DB::table('ketquatiepdan')
            ->where('tiepdanid', $id)
            ->update([
                'vanban'=>$array_file,
                'filepath'=>$linkfile,
            ]);
    }

    public function GetThongTinTheoDonId($donId)
    {
        $result = DB::table('ketquatiepdan')
            ->where('donlienquan',$donId)
            ->get();

        if (!empty($result)){
            return object_to_array($result);
        }
        else{
            return [];
        }

    }

}
