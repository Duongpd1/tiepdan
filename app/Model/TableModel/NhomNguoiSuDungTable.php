<?php

namespace App\Model\TableModel;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Mockery\CountValidator\Exception;

class NhomNguoiSuDungTable extends Model
{
    /**************************************************
    Function Name	: GetNhomNguoiSuDung
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetNhomNguoiSuDung(){

        $result = DB::table('nhomnguoisudung')
            ->paginate(10);

        return $result;
    }

    /**************************************************
    Function Name	: GetNhomNguoiSuDungTheoType
    Description		:
    Argument		: $type
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetNhomNguoiSuDungTheoType($type){

        $result = DB::table('nhomnguoisudung')
            ->where('trangthai',$type)
            ->get();

        return $result;
    }

    /**************************************************
    Function Name	: GetNhomNguoiSuDungTheoID
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetNhomNguoiSuDungTheoID($id){

        $result = DB::table('nhomnguoisudung')
            ->where('trangthai',1)
            ->where('id',$id)
            ->get();

        return $result;
    }

    /**************************************************
    Function Name	: GetNhomNguoiSuDungTheoTypeAndID
    Description		:
    Argument		: $type,$id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetNhomNguoiSuDungTheoTypeAndID($type,$id){

        $result = DB::table('nhomnguoisudung')
            ->where('trangthai',$type)
            ->where('id',$id)
            ->get();

        return $result;
    }

    /**************************************************
    Function Name	: XoaNhomNguoiSuDung
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function XoaNhomNguoiSuDung($id){

        try {
            DB::table('nhomnguoisudung')
                ->where('id', $id)
                ->delete();
            $result = 'successful';
        }catch (Exception $e){
            $result = 'fail';
        }
        return $result;

    }

    /**************************************************
    Function Name	: DoiTrangThaiNhomNguoiSuDung
    Description		:
    Argument		: $id,$newstatus
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function DoiTrangThaiNhomNguoiSuDung($id,$newstatus){

        try {
            DB::table('nhomnguoisudung')
                ->where('id', $id)
                ->update([
                    'trangthai' => $newstatus
                ]);
            $result = 'successful';
        }catch (Exception $e){
            $result = 'fail';
        }
        return $result;

    }

    /**************************************************
    Function Name	: StoreNhomNguoiSuDung
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreNhomNguoiSuDung($request){

        $quyenxoadonthu = 0;
        $quyenxoadanhmuc = 0;
        $quyenxoatiepdan = 0;
        $quyenxoacongthongtin = 0;
        $quyenxemtheodiaban = 0;
        $donthu = 0;
        $danhsachdonthu = 0;
        $danhsachxacminh = 0;
        $xacminh = 0;
        $datdai = 0;
        $danhsachdonthuvedatdai = 0;
        $ketluanthanhtra = 0;
        $danhsachtheodoiketluanthanhtra = 0;
        $baocao = 0;
        $tracuudonthu = 0;
        $tracuutiepdan = 0;
        $tintuc = 0;
        $gioithieu = 0;
        $gopy = 0;
        $phapluat = 0;
        $thongbao = 0;
        $vanban = 0;
        $linhvuc = 0;
        $loaidon = 0;
        $diaban = 0;
        $donvi = 0;
        $thamquyen = 0;
        $nguoisudung = 0;
        $nhomnguoisudung = 0;
        $danhsachtiepcongdan = 0;
        $thongtintiepdan = 0;
        $lichtiepdan = 0;

        if($request->quyenxoadonthu == 'on'){
            $quyenxoadonthu = 1;
        }
        if($request->quyenxoadanhmuc == 'on'){
            $quyenxoadanhmuc = 1;
        }
        if($request->quyenxoatiepdan == 'on'){
            $quyenxoatiepdan = 1;
        }
        if($request->quyenxoacongthongtin == 'on'){
            $quyenxoacongthongtin = 1;
        }
        if($request->quyenxemtheodiaban == 'on'){
            $quyenxemtheodiaban = 1;
        }
        if($request->donthu == 'on'){
            $donthu = 1;
        }
        if($request->danhsachdonthu == 'on'){
            $danhsachdonthu = 1;
        }
        if($request->danhsachxacminh == 'on'){
            $danhsachxacminh = 1;
        }
        if($request->xacminh == 'on'){
            $xacminh = 1;
        }
        if($request->datdai == 'on'){
            $datdai = 1;
        }
        if($request->danhsachdonthuvedatdai == 'on'){
            $danhsachdonthuvedatdai = 1;
        }
        if($request->ketluanthanhtra == 'on'){
            $ketluanthanhtra = 1;
        }

        if($request->danhsachtheodoiketluanthanhtra == 'on'){
            $danhsachtheodoiketluanthanhtra = 1;
        }

        if($request->baocao == 'on'){
            $baocao = 1;
        }
        if($request->tracuudonthu == 'on'){
            $tracuudonthu = 1;
        }

        if($request->tracuutiepdan == 'on'){
            $tracuutiepdan = 1;
        }
        if($request->tintuc == 'on'){
            $tintuc = 1;
        }
        if($request->gioithieu == 'on'){
            $gioithieu = 1;
        }
        if($request->gopy == 'on'){
            $gopy = 1;
        }
        if($request->phapluat == 'on'){
            $phapluat = 1;
        }

        if($request->thongbao == 'on'){
            $thongbao = 1;
        }
        if($request->vanban == 'on'){
            $vanban = 1;
        }

        if($request->linhvuc == 'on'){
            $linhvuc = 1;
        }
        if($request->loaidon == 'on'){
            $loaidon = 1;
        }
        if($request->diaban == 'on'){
            $diaban = 1;
        }
        if($request->donvi == 'on'){
            $donvi = 1;
        }
        if($request->thamquyen == 'on'){
            $thamquyen = 1;
        }
        if($request->nguoisudung == 'on'){
            $nguoisudung = 1;
        }
        if($request->nhomnguoisudung == 'on'){
            $nhomnguoisudung = 1;
        }
        if($request->danhsachtiepcongdan == 'on'){
            $danhsachtiepcongdan = 1;
        }
        if($request->thongtintiepdan == 'on'){
            $thongtintiepdan = 1;
        }
        if($request->lichtiepdan == 'on'){
            $lichtiepdan = 1;
        }


        try {
            DB::table('nhomnguoisudung')
                ->insert([
                    'tennhom' => $request->tennhom,
                    'mota' => $request->mota,
                    'quyenxoadonthu' => $quyenxoadonthu,
                    'quyenxoatiepdan' => $quyenxoatiepdan,
                    'quyenxemtheodiaban' => $quyenxemtheodiaban,
                    'quyenxoadanhmuc' => $quyenxoadanhmuc,
                    'quyenxoacongthongtin' => $quyenxoacongthongtin,
                    'donthu' => $donthu,
                    'danhsachdonthu' => $danhsachdonthu,
                    'danhsachxacminh' => $danhsachxacminh,
                    'xacminh' => $xacminh,
                    'datdai' => $datdai,
                    'danhsachdonthuvedatdai' => $danhsachdonthuvedatdai,
                    'ketluanthanhtra' => $ketluanthanhtra,
                    'danhsachtheodoiketluanthanhtra' => $danhsachtheodoiketluanthanhtra,
                    'baocao' => $baocao,
                    'tracuudonthu' => $tracuudonthu,
                    'tracuutiepdan' => $tracuutiepdan,
                    'tintuc' => $tintuc,
                    'gioithieu' => $gioithieu,
                    'gopy' => $gopy,
                    'phapluat' => $phapluat,
                    'thongbao' => $thongbao,
                    'vanban' => $vanban,
                    'linhvuc' => $linhvuc,
                    'loaidon' => $loaidon,
                    'diaban' => $diaban,
                    'donvi' => $donvi,
                    'thamquyen' => $thamquyen,
                    'nguoisudung' => $nguoisudung,
                    'nhomnguoisudung' => $nhomnguoisudung,
                    'danhsachtiepcongdan' => $danhsachtiepcongdan,
                    'thongtintiepdan' => $thongtintiepdan,
                    'lichtiepdan' => $lichtiepdan,
                    'trangthai' => $request->trangthai
                ]);
            $result = 'successful';
        }catch (Exception $e){
            $result = 'fail';
        }
        return $result;

    }

    /**************************************************
    Function Name	: UpdateNhomNguoiSuDung
    Description		:
    Argument		: $request,$id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function UpdateNhomNguoiSuDung($request,$id){

        $quyenxoadonthu = 0;
        $quyenxoadanhmuc = 0;
        $quyenxoatiepdan = 0;
        $quyenxoacongthongtin = 0;
        $quyenxemtheodiaban = 0;
        $donthu = 0;
        $danhsachdonthu = 0;
        $danhsachxacminh = 0;
        $xacminh = 0;
        $datdai = 0;
        $danhsachdonthuvedatdai = 0;
        $ketluanthanhtra = 0;
        $danhsachtheodoiketluanthanhtra = 0;
        $baocao = 0;
        $tracuudonthu = 0;
        $tracuutiepdan = 0;
        $tintuc = 0;
        $gioithieu = 0;
        $gopy = 0;
        $phapluat = 0;
        $thongbao = 0;
        $vanban = 0;
        $linhvuc = 0;
        $loaidon = 0;
        $diaban = 0;
        $donvi = 0;
        $thamquyen = 0;
        $nguoisudung = 0;
        $nhomnguoisudung = 0;
        $danhsachtiepcongdan = 0;
        $thongtintiepdan = 0;
        $lichtiepdan = 0;

        if($request->quyenxoadonthu == 'on'){
            $quyenxoadonthu = 1;
        }
        if($request->quyenxoadanhmuc == 'on'){
            $quyenxoadanhmuc = 1;
        }
        if($request->quyenxoatiepdan == 'on'){
            $quyenxoatiepdan = 1;
        }
        if($request->quyenxoacongthongtin == 'on'){
            $quyenxoacongthongtin = 1;
        }
        if($request->quyenxemtheodiaban == 'on'){
            $quyenxemtheodiaban = 1;
        }
        if($request->donthu == 'on'){
            $donthu = 1;
        }
        if($request->danhsachdonthu == 'on'){
            $danhsachdonthu = 1;
        }
        if($request->danhsachxacminh == 'on'){
            $danhsachxacminh = 1;
        }
        if($request->xacminh == 'on'){
            $xacminh = 1;
        }
        if($request->datdai == 'on'){
            $datdai = 1;
        }
        if($request->danhsachdonthuvedatdai == 'on'){
            $danhsachdonthuvedatdai = 1;
        }
        if($request->ketluanthanhtra == 'on'){
            $ketluanthanhtra = 1;
        }

        if($request->danhsachtheodoiketluanthanhtra == 'on'){
            $danhsachtheodoiketluanthanhtra = 1;
        }

        if($request->baocao == 'on'){
            $baocao = 1;
        }
        if($request->tracuudonthu == 'on'){
            $tracuudonthu = 1;
        }

        if($request->tracuutiepdan == 'on'){
            $tracuutiepdan = 1;
        }
        if($request->tintuc == 'on'){
            $tintuc = 1;
        }
        if($request->gioithieu == 'on'){
            $gioithieu = 1;
        }
        if($request->gopy == 'on'){
            $gopy = 1;
        }
        if($request->phapluat == 'on'){
            $phapluat = 1;
        }

        if($request->thongbao == 'on'){
            $thongbao = 1;
        }
        if($request->vanban == 'on'){
            $vanban = 1;
        }

        if($request->linhvuc == 'on'){
            $linhvuc = 1;
        }
        if($request->loaidon == 'on'){
            $loaidon = 1;
        }
        if($request->diaban == 'on'){
            $diaban = 1;
        }
        if($request->donvi == 'on'){
            $donvi = 1;
        }
        if($request->thamquyen == 'on'){
            $thamquyen = 1;
        }
        if($request->nguoisudung == 'on'){
            $nguoisudung = 1;
        }
        if($request->nhomnguoisudung == 'on'){
            $nhomnguoisudung = 1;
        }
        if($request->danhsachtiepcongdan == 'on'){
            $danhsachtiepcongdan = 1;
        }
        if($request->thongtintiepdan == 'on'){
            $thongtintiepdan = 1;
        }
        if($request->lichtiepdan == 'on'){
            $lichtiepdan = 1;
        }


        try {
            DB::table('nhomnguoisudung')
                ->where('id',$id)
                ->update([
                    'tennhom' => $request->tennhom,
                    'mota' => $request->mota,
                    'quyenxoadonthu' => $quyenxoadonthu,
                    'quyenxoatiepdan' => $quyenxoatiepdan,
                    'quyenxemtheodiaban' => $quyenxemtheodiaban,
                    'quyenxoadanhmuc' => $quyenxoadanhmuc,
                    'quyenxoacongthongtin' => $quyenxoacongthongtin,
                    'donthu' => $donthu,
                    'danhsachdonthu' => $danhsachdonthu,
                    'danhsachxacminh' => $danhsachxacminh,
                    'xacminh' => $xacminh,
                    'datdai' => $datdai,
                    'danhsachdonthuvedatdai' => $danhsachdonthuvedatdai,
                    'ketluanthanhtra' => $ketluanthanhtra,
                    'danhsachtheodoiketluanthanhtra' => $danhsachtheodoiketluanthanhtra,
                    'baocao' => $baocao,
                    'tracuudonthu' => $tracuudonthu,
                    'tracuutiepdan' => $tracuutiepdan,
                    'tintuc' => $tintuc,
                    'gioithieu' => $gioithieu,
                    'gopy' => $gopy,
                    'phapluat' => $phapluat,
                    'thongbao' => $thongbao,
                    'vanban' => $vanban,
                    'linhvuc' => $linhvuc,
                    'loaidon' => $loaidon,
                    'diaban' => $diaban,
                    'donvi' => $donvi,
                    'thamquyen' => $thamquyen,
                    'nguoisudung' => $nguoisudung,
                    'nhomnguoisudung' => $nhomnguoisudung,
                    'danhsachtiepcongdan' => $danhsachtiepcongdan,
                    'thongtintiepdan' => $thongtintiepdan,
                    'lichtiepdan' => $lichtiepdan,
                    'trangthai' => $request->trangthai
                ]);
            $result = 'successful';
        }catch (Exception $e){
            $result = 'fail';
        }
        return $result;

    }

    /**************************************************
    Function Name	: GetTenNhomQuyen
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetTenNhomQuyen($id){

        $result = DB::table('nhomnguoisudung')
            ->where('id', $id)
            ->value('tennhom');

        return $result;
    }
}
