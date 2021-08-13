<?php

namespace App\Model\TableModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;
use Illuminate\Support\Facades\Input;

class TinTucSuKienTable extends Model
{
    /**************************************************
    Function Name	: GetBaiVietTinTucSuKien
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetBaiVietTinTucSuKien($soLuongHienThi){

        $result = DB::table('tintucsukien')
            ->whereIn('theloai',[HOIDAP,MAUDONKNTC,QDPLVEKNTC,KNTC,TIEPCD,TTHOATDONG])
            ->orderby('ngaydang','desc')
            ->paginate($soLuongHienThi);
        return $result;
    }

    /**************************************************
    Function Name	: StoreBaiVietTinTucSuKien
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreBaiVietTinTucSuKien($request){

        try {

            if($request->trangthai == 'on'){

                $trangthai = DADUYET;
            }else{

                $trangthai = CHUADUYET;
            }

            $result = DB::table('tintucsukien')
                ->insertGetId([
                    'theloai' => $request->theloai,
                    'ngaydang' => $request->ngaydang,
                    'tieude' => $request->tieude,
                    'chuthichanh' => $request->chuthichanh,
                    'nguontin' => $request->nguontin,
                    'trangthai' => $trangthai,
                    'tomtat' => $request->tomtat,
                    'noidung' => $request->noidung,
                    'nguoicapnhat' => $request->accountname
                ]);

        } catch (Exception $e){

            $result = 'fail';

        }

        return $result;
    }

    /**************************************************
    Function Name	: StoreAnhBaiViet
    Description		:
    Argument		: $id, $chuthichanh
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreAnhBaiViet($id, $chuthichanh){

        try {
            //create direction
            $input = Input::all();

            $hinhanhfile = array_get($input, 'hinhanh');

            $file_path = FOLDERROOT."/congthongtin/tintucsukien/" . $id;

//            if (!is_dir($file_path)) {
//
//                mkdir($file_path, 0700);
//            }

            // RENAME THE UPLOAD WITH RANDOM NUMBER
            $fileName = $hinhanhfile->getClientOriginalName();
            // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
            $hinhanhfile->move($file_path, $fileName);

            DB::table('tintucsukien')
                ->where('id', $id)
                ->update([
                    'hinhanh' => '/congthongtin/tintucsukien/'.$id.'/'.$fileName,
                    'chuthichanh' => $chuthichanh
                ]);

            $result = 'successful';

        }catch (Exception $e){

            $result = 'fail';
        }

        return $result;
    }

    /**************************************************
    Function Name	: ChangeTrangThaiBaiViet
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function ChangeTrangThaiBaiViet($request){
        try {
            DB::table('tintucsukien')
                ->where('id', $request->baivietid)
                ->update([
                    'trangthai' => $request->newtrangthai
                ]);

            $result = 'successful';

        }catch (Exception $e){

            $result = 'fail';
        }
        return $result;
    }

    /**************************************************
    Function Name	: XoaBaiViet
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function XoaBaiViet($request){
        try {
            DB::table('tintucsukien')
                ->where('id', $request->baivietid)
                ->delete();

            $result = 'successful';

        }catch (Exception $e){

            $result = 'fail';
        }
        return $result;
    }

    /**************************************************
    Function Name	: GetBaiVietTheoID
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetBaiVietTheoID($id){

        $result = DB::table('tintucsukien')
            ->where('id',$id)
            ->get();
        return $result;
    }

    /**************************************************
    Function Name	: GetThongTinGioiThieu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetThongTinGioiThieu($soLuongHienThi){

        $result = DB::table('tintucsukien')
            ->whereIn('theloai',[CNNHIEMVU,GTCHUNG,LANHDAOPHUTHO])
            ->orderby('ngaydang','desc')
            ->paginate($soLuongHienThi);
        return $result;
    }

    /**************************************************
    Function Name	: UpdateBaiViet
    Description		:
    Argument		: $id, $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function UpdateBaiViet($id, $request){

        try {

            if($request->trangthai == 'on'){

                $trangthai = DADUYET;
            }else{

                $trangthai = CHUADUYET;
            }

            DB::table('tintucsukien')
                ->where('id', $id)
                ->update([
                    'theloai' => $request->theloai,
                    'ngaydang' => $request->ngaydang,
                    'tieude' => $request->tieude,
                    'nguontin' => $request->nguontin,
                    'trangthai' => $trangthai,
                    'tomtat' => $request->tomtat,
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
    Function Name	: GetBaiVietTheoTheLoai
    Description		:
    Argument		: $theloai
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetBaiVietTheoTheLoai($theloai){

        $result = DB::table('tintucsukien')
            ->where('theloai',$theloai)
            ->orderby('ngaydang','desc')
            ->get();
        return $result;
    }

    /**************************************************
    Function Name	: GetBaiVietTinTucHoatDong
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetBaiVietTinTucHoatDong(){

        $result = DB::table('tintucsukien')
            ->where('theloai',TTHOATDONG)
            ->orderby('ngaydang','desc')
            ->paginate(10);
        return $result;
    }

    /**************************************************
    Function Name	: GetBaiVietTheoTheLoaiTrangChu
    Description		:
    Argument		: $theloai
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetBaiVietTheoTheLoaiTrangChu($theloai){

        $result = DB::table('tintucsukien')
            ->where('theloai',$theloai)
            ->where('trangthai',DADUYET)
            ->orderby('ngaydang','desc')
            ->paginate(10);
        return $result;
    }
}
