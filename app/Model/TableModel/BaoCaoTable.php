<?php

namespace App\Model\TableModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;
use Illuminate\Support\Facades\Input;
use App\Model\TableModel\DonThuTable;

class BaoCaoTable extends Model
{
    /**************************************************
    Function Name	: BaoCaoTheoTTXL
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function DataDonThuTheoKy($tu_ngay,$den_ngay,$donthu)
    {

        $tuNgay = DonThuTable::ConvertFormatDate($tu_ngay);
        $denNgay = DonThuTable::ConvertFormatDate($den_ngay);

        $donthu_theoky = array();

        for($i = 0;$i <count($donthu);$i++)
        {
            if($tuNgay <= $donthu[$i]->ngaynhan && $donthu[$i]->ngaynhan <= $denNgay)
            {
                array_push($donthu_theoky,$donthu[$i]);
            }
        }
        return $donthu_theoky;
    }
    /**************************************************
    Function Name	: BaoCaoTheoTTXL
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function BaoCaoTheoTTXL($tu_ngay,$den_ngay,$donthu)
    {
        $array_dangxuly = array();
        $array_danggiaiquyet = array();
        $array_dagiaiquyet = array();

        $tuNgay = DonThuTable::ConvertFormatDate($tu_ngay);
        $denNgay = DonThuTable::ConvertFormatDate($den_ngay);

        //cho xu ly
        if($donthu!=null)
        {
            for($i = 0;$i <count($donthu);$i++)
            {
                if($tuNgay <= $donthu[$i]->ngaynhan && $donthu[$i]->ngaynhan <= $denNgay)
                {
                    if($donthu[$i]->trangthaixuly == CHOXULY)
                    {
                        array_push($array_dangxuly,$donthu[$i]);
                    }
                    elseif($donthu[$i]->trangthaixuly == DANGXULY)
                    {
                        array_push($array_danggiaiquyet,$donthu[$i]);
                    }
                    elseif($donthu[$i]->trangthaixuly == DAGIAIQUYET)
                    {
                        array_push($array_dagiaiquyet,$donthu[$i]);
                    }

                }
            }
        }


        $data_TTXL = array(
            'TTXL_ChoXL'=>$array_dangxuly,
            'TTXL_DangXL'=>$array_danggiaiquyet,
            'TTXL_DaGQ'=>$array_dagiaiquyet
        );

        return $data_TTXL;


    }
    /**************************************************
    Function Name	: BaoCaoTheoLoaiDon
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function BaoCaoTheoLoaiDon($tu_ngay,$den_ngay,$diaBanIdAllArray,$donthu)
    {
        $tuNgay = DonThuTable::ConvertFormatDate($tu_ngay);
        $denNgay = DonThuTable::ConvertFormatDate($den_ngay);

        $phanloai = DB::table('phanloaidonthu')
            ->whereIn('diaban',$diaBanIdAllArray)
            ->get();

        $loaidon = DB::table('loaidon')->get();

        $bao_cao_theo_loai_don = array();
        for($i = 0;$i <count($loaidon);$i++)
        {
            $loaidon_id = $loaidon[$i]->loaidonid;
            $loaidon_name = $loaidon[$i]->tenloaidon;

            $count_have =0;
            $count_dif =0;
            $bao_cao_da_phan_loai = array();
            $bao_cao_chua_phan_loai = array();
             for($j = 0;$j<count($phanloai);$j++)
             {
                 $ngaynhan = $donthu[$j]->ngaynhan;
                 if($tuNgay<=$ngaynhan && $ngaynhan<=$denNgay)
                 {
                     if($phanloai[$j]->loaidon == $loaidon_id)
                     {
                         $bao_cao_da_phan_loai[$count_have] = $donthu[$j];
                         $count_have++;
                     }
                     elseif($phanloai[$j]->loaidon == null)
                     {
                         $bao_cao_chua_phan_loai[$count_dif] = $donthu[$j];
                         $count_dif++;
                     }
                 }
             }
            $bao_cao_theo_loai_don[$i] = array(
                'loaidon_id'=>$loaidon_id,
                'ten_loaidon'=>$loaidon_name,
                'sodon_co_loaidon'=>$count_have,
                'sodon_chua_co_loaidon'=>$count_dif,
                'donthu_co_loaidon'=>$bao_cao_da_phan_loai,
                'donthu_chua_co_loaidon'=>$bao_cao_chua_phan_loai
            );
        }

        return $bao_cao_theo_loai_don;
    }
    /**************************************************
    Function Name	: BaoCaoTheoLinhVuc
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function BaoCaoTheoLinhVuc($tu_ngay,$den_ngay,$diaBanIdAllArray,$donthu)
    {
        $tuNgay = DonThuTable::ConvertFormatDate($tu_ngay);
        $denNgay = DonThuTable::ConvertFormatDate($den_ngay);


        $phanloai = DB::table('phanloaidonthu')
            ->whereIn('diaban',$diaBanIdAllArray)
            ->get();
        $linhvuc = DB::table('linhvuc')->get();

        $bao_cao_theo_linh_vuc =array();
        for($i = 0;$i<count($linhvuc);$i++)
        {
            $linhvuc_id = $linhvuc[$i]->linhvucid;
            $linhvuc_name = $linhvuc[$i]->tenlinhvuc;

            $count_lv=0;
            $baocao_linhvuc = array();
            for($j = 0;$j<count($phanloai);$j++)
            {
                $ngaynhan = $donthu[$j]->ngaynhan;
                if($tuNgay<=$ngaynhan && $ngaynhan<=$denNgay)
                {
                    if($phanloai[$j]->linhvuc == $linhvuc_id)
                    {
                        $baocao_linhvuc[$count_lv] = $donthu[$j];
                        $count_lv++;
                    }

                }
            }
            $bao_cao_theo_linh_vuc[$i] = array(
                'linhvuc_id'=>$linhvuc_id,
                'linhvuc_name'=>$linhvuc_name,
                'solinhvuc'=>$count_lv,
                'baocao_linhvuc'=>$baocao_linhvuc
            );
        }

        return $bao_cao_theo_linh_vuc;

    }
    /**************************************************
    Function Name	: BaoCaoTheoDiaBan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function BaoCaoSoNganhTheoDiaBan($tu_ngay,$den_ngay,$diaBanIdAllArray)
    {
        // cap so nganh

        $tuNgay = DonThuTable::ConvertFormatDate($tu_ngay);
        $denNgay = DonThuTable::ConvertFormatDate($den_ngay);

        $so_nganh_1 = DB::table('phanloaidonthu')
            ->whereIn('diaban',$diaBanIdAllArray)
            ->where('loaidon',1)
            ->pluck('donthuid');

        $so_nganh_2 = DB::table('phanloaidonthu')
            ->whereIn('diaban',$diaBanIdAllArray)
            ->where('loaidon',2)
            ->pluck('donthuid');

        $so_nganh_kn = DB::table('donthu')
            ->whereIn('donthuid',$so_nganh_1)
            ->whereBetween('ngaynhan',[$tuNgay,$denNgay])
            ->get();

        $so_nganh_tc = DB::table('donthu')
            ->whereIn('donthuid',$so_nganh_2)
            ->whereBetween('ngaynhan',[$tuNgay,$denNgay])
            ->get();


        $songanh_detail_diaban = array(
            'so_nganh_kn'=>$so_nganh_kn,
            'so_nganh_tc'=>$so_nganh_tc
        );


        return $songanh_detail_diaban;

    }
    /**************************************************
    Function Name	: BaoCaoTheoDanhSach
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function BaoCaoTheoDanhSach($tu_ngay,$den_ngay,$diaBanIdAllArray,$donthu)
    {

        $tuNgay = DonThuTable::ConvertFormatDate($tu_ngay);
        $denNgay = DonThuTable::ConvertFormatDate($den_ngay);

        $phanloai = DB::table('phanloaidonthu')
            ->whereIn('diaban',$diaBanIdAllArray)
            ->get();
        $loaidon = DB::table('loaidon')->get();
        $linhvuc = DB::table('linhvuc')->get();

        $bao_cao_danh_sach = array();
        $baocao_danhsach = array();
        $ten_linhvuc ="";
        $ten_loaidon ="";
        $count_ds =0;


        for($i = 0;$i<count($phanloai);$i++)
        {
            $sothuly = explode('/',$donthu[$i]->sothuly);
            $so_thuly =$sothuly[0];

            $ngay_nhan = $donthu[$i]->ngaynhan;
            $linhvuc_id = $phanloai[$i]->linhvuc;
            $loaidon_id = $phanloai[$i]->loaidon;

            if($tuNgay<=$ngay_nhan && $ngay_nhan<=$denNgay)
            {
                for($j = 0;$j<count($linhvuc);$j++)
                {
                    if($linhvuc[$j]->linhvucid == $linhvuc_id)
                    {
                        $ten_linhvuc = $linhvuc[$j]->tenlinhvuc;
                    }
                }
                for($l = 0;$l<count($loaidon);$l++)
                {
                    if($loaidon[$l]->loaidonid == $loaidon_id)
                    {
                        $ten_loaidon = $loaidon[$l]->tenloaidon;
                    }
                }
                $baocao_danhsach=$donthu[$i];

                $bao_cao_danh_sach[$count_ds]= array(
                    'sothuly'=>$donthu[$i]->sothuly,
                    'tenlinhvuc'=>$ten_linhvuc,
                    'tenloaidon'=>$ten_loaidon,
                    'donthu'=>$baocao_danhsach

                );
                $count_ds++;
            }


        }

        return $bao_cao_danh_sach;

    }
    /**************************************************
    Function Name	: TongHopDonThuKhieuNaiTheDiaBan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function TongHopDonThuKhieuNaiTheDiaBan($tu_ngay,$den_ngay,$diaBanIdAllArray)
    {
        $tuNgay = DonThuTable::ConvertFormatDate($tu_ngay);
        $denNgay = DonThuTable::ConvertFormatDate($den_ngay);

        //don thu tp
        $donthu_tp_1 = DB::table('phanloaidonthu')
            ->whereIn('diaban',$diaBanIdAllArray)
            ->join('diaban', function ($join) {
                $join->on('phanloaidonthu.diaban', '=', 'diaban.id')
                    ->where('diaban.type', '=', THANH_PHO);
            })
            ->where('loaidon',1)
            ->select('phanloaidonthu.*')
            ->pluck('donthuid');


        $donthu_tp_kn = DB::table('donthu')
            ->whereIn('donthuid',$donthu_tp_1)
            ->whereBetween('ngaynhan',[$tuNgay,$denNgay])
            ->get();


        //don thu huyen
        $donthu_huyen_1 = DB::table('phanloaidonthu')
            ->whereIn('diaban',$diaBanIdAllArray)
            ->join('diaban', function ($join) {
                $join->on('phanloaidonthu.diaban', '=', 'diaban.id')
                    ->where('diaban.type', '=', HUYEN);
            })
            ->where('loaidon',1)
            ->select('phanloaidonthu.*')
            ->pluck('donthuid');


        $donthu_huyen_kn = DB::table('donthu')
            ->whereIn('donthuid',$donthu_huyen_1)
            ->whereBetween('ngaynhan',[$tuNgay,$denNgay])
            ->get();


        //don thu xa

        $donthu_xa_1 = DB::table('phanloaidonthu')
            ->whereIn('diaban',$diaBanIdAllArray)
            ->join('diaban', function ($join) {
                $join->on('phanloaidonthu.diaban', '=', 'diaban.id')
                    ->where('diaban.type', '=', XA);
            })
            ->where('loaidon',1)
            ->select('phanloaidonthu.*')
            ->pluck('donthuid');


        $donthu_xa_kn = DB::table('donthu')
            ->whereIn('donthuid',$donthu_xa_1)
            ->whereBetween('ngaynhan',[$tuNgay,$denNgay])
            ->get();



        $khieunai_detail_diaban = array(
            'kn_tp'=>$donthu_tp_kn,
            'kn_huyen'=>$donthu_huyen_kn,
            'kn_xa'=>$donthu_xa_kn
        );

        return $khieunai_detail_diaban;
    }
    /**************************************************
    Function Name	: TongHopDonThuToCaoTheDiaBan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function TongHopDonThuToCaoTheDiaBan($tu_ngay,$den_ngay,$diaBanIdAllArray)
    {
        $tuNgay = DonThuTable::ConvertFormatDate($tu_ngay);
        $denNgay = DonThuTable::ConvertFormatDate($den_ngay);
        //don thu tp
        $donthu_tp_2 = DB::table('phanloaidonthu')
            ->whereIn('diaban',$diaBanIdAllArray)
            ->join('diaban', function ($join) {
                $join->on('phanloaidonthu.diaban', '=', 'diaban.id')
                    ->where('diaban.type', '=', THANH_PHO);
            })
            ->Where('loaidon',2)
            ->select('phanloaidonthu.*')
            ->pluck('donthuid');

        $donthu_tp_tc = DB::table('donthu')
            ->whereIn('donthuid',$donthu_tp_2)
            ->whereBetween('ngaynhan',[$tuNgay,$denNgay])
            ->get();


        //don thu huyen
        $donthu_huyen_2 = DB::table('phanloaidonthu')
            ->whereIn('diaban',$diaBanIdAllArray)
            ->join('diaban', function ($join) {
                $join->on('phanloaidonthu.diaban', '=', 'diaban.id')
                    ->where('diaban.type', '=', HUYEN);
            })
            ->where('loaidon',2)
            ->select('phanloaidonthu.*')
            ->pluck('donthuid');


        $donthu_huyen_tc = DB::table('donthu')
            ->whereIn('donthuid',$donthu_huyen_2)
            ->whereBetween('ngaynhan',[$tuNgay,$denNgay])
            ->get();


        //don thu xa
        $donthu_xa_2 = DB::table('phanloaidonthu')
            ->whereIn('diaban',$diaBanIdAllArray)
            ->join('diaban', function ($join) {
                $join->on('phanloaidonthu.diaban', '=', 'diaban.id')
                    ->where('diaban.type', '=', XA);
            })
            ->Where('loaidon',2)
            ->select('phanloaidonthu.*')
            ->pluck('donthuid');


        $donthu_xa_tc = DB::table('donthu')
            ->whereIn('donthuid',$donthu_xa_2)
            ->whereBetween('ngaynhan',[$tuNgay,$denNgay])
            ->get();



        $tocao_detail_diaban = array(
            'tc_tp'=>$donthu_tp_tc,
            'tc_huyen'=>$donthu_huyen_tc,
            'tc_xa'=>$donthu_xa_tc

        );


        return $tocao_detail_diaban;

    }
    /**************************************************
    Function Name	: BaoCaoTheoDanhGia
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function BaoCaoTheoDanhGia($tu_ngay,$den_ngay,$diaBanIdAllArray,$loai_baocao)
    {
        $tuNgay = DonThuTable::ConvertFormatDate($tu_ngay);
        $denNgay = DonThuTable::ConvertFormatDate($den_ngay);

        if($loai_baocao =="KhieuNai")
        {
            $donthu_id =  DB::table('phanloaidonthu')
                ->whereIn('diaban',$diaBanIdAllArray)
                ->where('loaidon',1)
                ->pluck('donthuid');
        }
        else
        {
            $donthu_id =  DB::table('phanloaidonthu')
                ->whereIn('diaban',$diaBanIdAllArray)
                ->where('loaidon',2)
                ->pluck('donthuid');
        }


        //data dung

        $data_dung_id = DB::table('ketquagiaiquyet')
            ->whereIn('donthuid',$donthu_id)
            ->where('danhgiadonthu',DUNG)
            ->pluck('donthuid');

        $data_dung = DB::table('donthu')
            ->whereIn('donthuid',$data_dung_id)
            ->whereBetween('ngaynhan',[$tuNgay,$denNgay])
            ->whereBetween('ketqua',[KETTHUCDONTHU,RUTDONTHU])
            ->get();

        //dung mot phan
        $data_motphan_id = DB::table('ketquagiaiquyet')
            ->whereIn('donthuid',$donthu_id)
            ->where('danhgiadonthu',DUNG_MOT_PHAN)
            ->pluck('donthuid');

        $dung_mot_phan =  DB::table('donthu')
            ->whereIn('donthuid',$data_motphan_id)
            ->whereBetween('ngaynhan',[$tuNgay,$denNgay])
            ->whereBetween('ketqua',[KETTHUCDONTHU,RUTDONTHU])
            ->get();

        //data sai
        $data_sai_id =  DB::table('ketquagiaiquyet')
            ->whereIn('donthuid',$donthu_id)
            ->where('danhgiadonthu',SAI)
            ->pluck('donthuid');

        $data_sai =  DB::table('donthu')
            ->whereIn('donthuid',$data_sai_id)
            ->whereBetween('ngaynhan',[$tuNgay,$denNgay])
            ->whereBetween('ketqua',[KETTHUCDONTHU,RUTDONTHU])
            ->get();

        $array_danhgia = array(
            'dung'=>$data_dung,
            'dung_mot_phan'=>$dung_mot_phan,
            'sai'=>$data_sai
        );

        return $array_danhgia;
    }
    /**************************************************
    Function Name	: BaoCaoKetQuaKhieuNai
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function BaoCaoKetQuaKhieuNai($tu_ngay,$den_ngay,$diaBanIdAllArray)
    {
        $tuNgay = DonThuTable::ConvertFormatDate($tu_ngay);
        $denNgay = DonThuTable::ConvertFormatDate($den_ngay);

        //don thu tp
        $donthu_tp_1 = DB::table('phanloaidonthu')
            ->whereIn('diaban',$diaBanIdAllArray)
            ->join('diaban', function ($join) {
                $join->on('phanloaidonthu.diaban', '=', 'diaban.id')
                    ->where('diaban.type', '=', THANH_PHO);
            })
            ->where('loaidon',1)
            ->select('phanloaidonthu.*')
            ->pluck('donthuid');

        $theoky_tp = DB::table('donthu')
            ->whereIn('donthuid',$donthu_tp_1)
            ->whereBetween('ngaynhan',[$tuNgay,$denNgay])
            ->pluck('donthuid');

        $donthu_tp_kn = DB::table('donthu')
            ->whereIn('donthuid',$theoky_tp)
            ->whereBetween('ketqua',[KETTHUCDONTHU,RUTDONTHU])
            ->get();



        //don thu huyen
        $donthu_huyen_1 = DB::table('phanloaidonthu')
            ->whereIn('diaban',$diaBanIdAllArray)
            ->join('diaban', function ($join) {
                $join->on('phanloaidonthu.diaban', '=', 'diaban.id')
                    ->where('diaban.type', '=', HUYEN);
            })
            ->where('loaidon',1)
            ->select('phanloaidonthu.*')
            ->pluck('donthuid');

        $theoky_huyen = DB::table('donthu')
            ->whereIn('donthuid',$donthu_huyen_1)
            ->whereBetween('ngaynhan',[$tuNgay,$denNgay])
            ->pluck('donthuid');

        $donthu_huyen_kn = DB::table('donthu')
            ->whereIn('donthuid',$theoky_huyen)
            ->whereBetween('ketqua',[KETTHUCDONTHU,RUTDONTHU])
            ->get();


        //don thu xa

        $donthu_xa_1 = DB::table('phanloaidonthu')
            ->whereIn('diaban',$diaBanIdAllArray)
            ->join('diaban', function ($join) {
                $join->on('phanloaidonthu.diaban', '=', 'diaban.id')
                    ->where('diaban.type', '=', XA);
            })
            ->where('loaidon',1)
            ->select('phanloaidonthu.*')
            ->pluck('donthuid');

        $theoky_xa = DB::table('donthu')
            ->whereIn('donthuid',$donthu_xa_1)
            ->whereBetween('ngaynhan',[$tuNgay,$denNgay])
            ->pluck('donthuid');

        $donthu_xa_kn = DB::table('donthu')
            ->whereIn('donthuid',$theoky_xa)
            ->whereBetween('ketqua',[KETTHUCDONTHU,RUTDONTHU])
            ->get();

        //tong don khieu nai
        $tongdon_id = DB::table('phanloaidonthu')
            ->whereIn('diaban',$diaBanIdAllArray)
            ->where('loaidon',1)
            ->pluck('donthuid');



        $tong_donthu_kn =  DB::table('donthu')
            ->whereIn('donthuid',$tongdon_id)
            ->whereBetween('ngaynhan',[$tu_ngay,$denNgay])
            ->pluck('donthuid');



        $tongdon_gq = DB::table('donthu')
            ->whereIn('donthuid',$tong_donthu_kn)
            ->whereBetween('ketqua',[KETTHUCDONTHU,RUTDONTHU])
//            ->orWhere('ketqua',RUTDONTHU)
            ->get();


        $ketqua_khieunai = array(
            'kq_tp'=>$theoky_tp,
            'kn_tp'=>$donthu_tp_kn,
            'kq_huyen'=>$theoky_huyen,
            'kn_huyen'=>$donthu_huyen_kn,
            'kq_xa'=>$theoky_xa,
            'kn_xa'=>$donthu_xa_kn,
            'tongdon'=>$tong_donthu_kn,
            'tongdon_gq'=>$tongdon_gq
        );

        return $ketqua_khieunai;
    }

    /**************************************************
    Function Name	: BaoCaoKetQuaToCao
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function BaoCaoKetQuaToCao($tu_ngay,$den_ngay,$diaBanIdAllArray)
    {
        $tuNgay = DonThuTable::ConvertFormatDate($tu_ngay);
        $denNgay = DonThuTable::ConvertFormatDate($den_ngay);

        //don thu tp
        $donthu_tp_1 = DB::table('phanloaidonthu')
            ->whereIn('diaban',$diaBanIdAllArray)
            ->join('diaban', function ($join) {
                $join->on('phanloaidonthu.diaban', '=', 'diaban.id')
                    ->where('diaban.type', '=', THANH_PHO);
            })
            ->where('loaidon',2)
            ->select('phanloaidonthu.*')
            ->pluck('donthuid');

        $theoky_tp = DB::table('donthu')
            ->whereIn('donthuid',$donthu_tp_1)
            ->whereBetween('ngaynhan',[$tuNgay,$denNgay])
            ->pluck('donthuid');

        $donthu_tp_tc = DB::table('donthu')
            ->whereIn('donthuid',$theoky_tp)
            ->whereBetween('ketqua',[KETTHUCDONTHU,RUTDONTHU])
            ->get();



        //don thu huyen
        $donthu_huyen_1 = DB::table('phanloaidonthu')
            ->whereIn('diaban',$diaBanIdAllArray)
            ->join('diaban', function ($join) {
                $join->on('phanloaidonthu.diaban', '=', 'diaban.id')
                    ->where('diaban.type', '=', HUYEN);
            })
            ->where('loaidon',2)
            ->select('phanloaidonthu.*')
            ->pluck('donthuid');

        $theoky_huyen = DB::table('donthu')
            ->whereIn('donthuid',$donthu_huyen_1)
            ->whereBetween('ngaynhan',[$tuNgay,$denNgay])
            ->pluck('donthuid');

        $donthu_huyen_tc = DB::table('donthu')
            ->whereIn('donthuid',$theoky_huyen)
            ->whereBetween('ketqua',[KETTHUCDONTHU,RUTDONTHU])
            ->get();


        //don thu xa

        $donthu_xa_1 = DB::table('phanloaidonthu')
            ->whereIn('diaban',$diaBanIdAllArray)
            ->join('diaban', function ($join) {
                $join->on('phanloaidonthu.diaban', '=', 'diaban.id')
                    ->where('diaban.type', '=', XA);
            })
            ->where('loaidon',2)
            ->select('phanloaidonthu.*')
            ->pluck('donthuid');

        $theoky_xa = DB::table('donthu')
            ->whereIn('donthuid',$donthu_xa_1)
            ->whereBetween('ngaynhan',[$tuNgay,$denNgay])
            ->pluck('donthuid');

        $donthu_xa_tc = DB::table('donthu')
            ->whereIn('donthuid',$theoky_xa)
            ->whereBetween('ketqua',[KETTHUCDONTHU,RUTDONTHU])
            ->get();

        //tong don khieu nai
        $tongdon_id = DB::table('phanloaidonthu')
            ->whereIn('diaban',$diaBanIdAllArray)
            ->where('loaidon',2)
            ->pluck('donthuid');



        $tong_donthu_tc =  DB::table('donthu')
            ->whereIn('donthuid',$tongdon_id)
            ->whereBetween('ngaynhan',[$tuNgay,$denNgay])
            ->pluck('donthuid');



        $tongdon_gq = DB::table('donthu')
            ->whereIn('donthuid',$tong_donthu_tc)
            ->whereBetween('ketqua',[KETTHUCDONTHU,RUTDONTHU])
//            ->orWhere('ketqua',RUTDONTHU)
            ->get();


        $ketqua_tocao = array(
            'kq_tp'=>$theoky_tp,
            'tc_tp'=>$donthu_tp_tc,
            'kq_huyen'=>$theoky_huyen,
            'tc_huyen'=>$donthu_huyen_tc,
            'kq_xa'=>$theoky_xa,
            'tc_xa'=>$donthu_xa_tc,
            'tongdon'=>$tong_donthu_tc,
            'tongdon_gq'=>$tongdon_gq
        );

        return $ketqua_tocao;
    }
}
