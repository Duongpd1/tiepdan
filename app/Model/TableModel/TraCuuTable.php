<?php

namespace App\Model\TableModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;
use Illuminate\Support\Facades\Input;

use App\Model\TableModel\DonThuTable;

class TraCuuTable extends Model
{
    /**************************************************
    Function Name	: DataTraCuuTheoTatCa
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function DataTraCuuTheoTatCa($request,$loaidon,$linhvuc)
    {
        $linh_vuc = $request->linhvuc;
        $loai_don = $request->LoaiDon;
        $diaban = $request->diaban;
        $chonngay_1 = $request->ChonNgay1;
        $chonngay_2 = $request->ChonNgay2;
        $sosanh_1 = $request->SoSanh1;
        $sosanh_2 = $request->SoSanh2;
        $ngay_1 = $request->Ngay1;
        $ngay_2 = $request->Ngay2;
        //dieu kien 1
        $dieukien_1 = $request->chon_dieukien;
        $giatri_1 =$request->giatritimkiem;
        //dieu kien 2
        $dieukien_2 = $request->ChonDK2;
        $giatri_2 =$request->dieukien_2;
        //dieu kien 3
        $dieukien_3 = $request->ChonDK3;
        $giatri_3 =$request->dieukien_3;
        //dieu kien 4
        $dieukien_4 = $request->ChonDK4;
        $giatri_4 =$request->dieukien_4;
        //array
        $dieukien = [$dieukien_1,$dieukien_2,$dieukien_3,$dieukien_4];
        $value = ['REGEXP','REGEXP','REGEXP','REGEXP'];
        $giatri = [$giatri_1,$giatri_2,$giatri_3,$giatri_4];

        $array = null;
        $y = 0;
        for($count = 0; $count < count($giatri); $count++)
        {
            if($giatri[$count] != null)
            {
                $array[$y][0] = $dieukien[$count];
                $array[$y][1] = $value[$count];
                $array[$y][2] = $giatri[$count];
                $y++;
            }
        }

        //year
        $year = date('Y');
        $stl_tu = explode('/',$request->sothulytu);
        $stl_den = explode('/',$request->sothulyden);
        $sothuly_tu = $stl_tu[0];
        $sothuly_den = $stl_den[0];

        $donthu_id= array();
        $donthu_phanloai = DB::table('phanloaidonthu')
            ->where('linhvuc',$linh_vuc)
            ->where('loaidon',$loai_don)
            ->where('diaban',$diaban)
            ->get();

        $data_tracuu = array();
        $ten_linhvuc ="";
        $ten_loaidon = "";
        if($donthu_phanloai!=null)
        {
           for($i = 0;$i<count($donthu_phanloai);$i++)
           {
               for($j = 0;$j<count($loaidon);$j++)
               {
                   if($loaidon[$j]->loaidonid == $donthu_phanloai[$i]->loaidon)
                   {
                       $ten_loaidon = $loaidon[$j]->tenloaidon;
                   }
               }

               for($no = 0;$no<count($linhvuc);$no++)
               {
                   if($linhvuc[$no]->linhvucid == $donthu_phanloai[$i]->linhvuc)
                   {
                       $ten_linhvuc = $linhvuc[$no]->tenlinhvuc;
                   }
               }
               $donthu_id=DB::table('donthu')
                   ->where('donthuid',$donthu_phanloai[$i]->donthuid)
                   ->where([
                       [$chonngay_1,$sosanh_1,$ngay_1],
                       [$chonngay_2,$sosanh_2,$ngay_2],
//                       [$dieukien_1,$giatri_1],
                        [$array]
                   ])
                   //->whereBetween('sothuly',[$sothuly_tu,$sothuly_den])
                   ->first();

               $data_tracuu[$i] = array(
                   'tenloaidon'=>$ten_loaidon,
                   'tenlinhvuc'=>$ten_linhvuc,
                   'donthu'=>$donthu_id
               );
           }
        }

        //ket qua
        $ket_qua_tra_cuu = array();
        $no_ketqua = 0;
        if($data_tracuu!=null)
        {
            for($i = 0; $i<count($data_tracuu);$i++)
            {
                $so_thu_ly = explode('/',$data_tracuu[$i]['donthu']->sothuly);
                $so_thu_ly = $so_thu_ly[0];
                if($sothuly_tu<= $so_thu_ly && $so_thu_ly <= $sothuly_den)
                {
                    $ket_qua_tra_cuu[$no_ketqua]= $data_tracuu[$i];
                    $no_ketqua++;
                }
            }
        }


        return $ket_qua_tra_cuu;

    }

    /**************************************************
    Function Name	: DataTraCuuTheoMot
    Description		:
    Argument		:
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function DataTraCuuTheoMot($request,$diaBanIdAllArray)
    {
        $value =$request->value;
        $convertToInt = intval($value);
        $data = DB::table('donthu')
            ->join('phanloaidonthu', 'donthu.donthuid', '=', 'phanloaidonthu.donthuid')
            ->join('theodoidonthu', 'donthu.donthuid','=', 'theodoidonthu.donthuid')
            ->where('donthu.sothuly','like','%'.$value.'%')
            ->orWhere('donthu.noidung','like','%'.$value.'%')
            ->orWhere('donthu.tennguoivietdon','like','%'.$value.'%')
            ->orWhere('donthu.diachinguoiviet','like','%'.$value.'%')
            ->orWhere('donthu.cmnd_hc',$convertToInt)
            ->whereIn('phanloaidonthu.diaban', $diaBanIdAllArray)
            ->get();

        $ketQuaTD = DB::table('ketquatiepdan')
            ->where('sothuly','like','%'.$value.'%')
            ->orWhere('noidung','like','%'.$value.'%')
            ->orWhere('lanhdao','like','%'.$value.'%')
            ->orWhere('chutri','like','%'.$value.'%')
            ->orWhere('congdan','like','%'.$value.'%')
            ->orWhere('diachi','like','%'.$value.'%')
            ->orWhere('cmt',$convertToInt)
            ->whereIn('diaban', $diaBanIdAllArray)
            ->get();

        $arrayData =  array(
            'don'=>$data,
            'tiepdan'=>$ketQuaTD
        );

        return $arrayData;

    }

    public static function DataTraCuuTheoFilter($request,$diaBanIdAllArray)
    {

        $listDonThuId = DB::table('donthu')
            ->join('phanloaidonthu', 'donthu.donthuid', '=', 'phanloaidonthu.donthuid')
            ->join('theodoidonthu', 'donthu.donthuid','=', 'theodoidonthu.donthuid')
            ->whereIn('phanloaidonthu.diaban', $diaBanIdAllArray)
            ->select('donthu.donthuid')->pluck('donthu.donthuid');

        if(trim($request->tenChuDon != ''))
        {
            $listDonThuId = DB::table('donthu')->whereIn('donthuid', $listDonThuId)->where('tennguoivietdon','like','%'.$request->tenChuDon.'%')->pluck('donthuid');
        }
        if(trim($request->cmt != ''))
        {
            $listDonThuId = DB::table('donthu')->whereIn('donthuid', $listDonThuId)->where('cmnd_hc','like','%'.$request->cmt.'%')->pluck('donthuid');
        }
        if(trim($request->sdtID != ''))
        {
            $listDonThuId = DB::table('donthu')->whereIn('donthuid', $listDonThuId)->where('sdt','like','%'.$request->sdtID.'%')->pluck('donthuid');
        }
        if(trim($request->diachi != ''))
        {
            $listDonThuId = DB::table('donthu')->whereIn('donthuid', $listDonThuId)->where('diachinguoiviet','like','%'.$request->diachi.'%')->pluck('donthuid');
        }
        if(trim($request->noidung != ''))
        {
            $listDonThuId = DB::table('donthu')->whereIn('donthuid', $listDonThuId)->where('noidung','like','%'.$request->noidung.'%')->pluck('donthuid');
        }
        if(trim($request->Diaban != ''))
        {
//            $listDonThuId = DB::table('donthu')
//                ->whereIn('donthuid', $listDonThuId)
//                ->where('phanloaidonthu.diaban','like','%'.$request->Diaban.'%');
        }

        $data = DonThuTable::whereIn('donthuid', $listDonThuId)->get();


        $arrayData =  array(
            'don'=>$data
        );

        return $arrayData;

    }
    /**************************************************
    Function Name	: DataTraCuuLichTiepDanAll
    Description		:
    Argument		:
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function DataTraCuuLichTiepDanAll($request,$linhvuc)
    {
        $so_thu_ly_tu = $request->sothulytu;
        $so_thu_ly_den = $request->sothulyden;
        $ngay_tu = $request->ngaytu;
        $ngay_den = $request->ngayden;
        $phanloai =$request->loai;
        $phan_loai_gt = $request->loaigt;
        $select_loai = $request->select;
        $reg = $request->regexp;
        $select_value = $request->value;
//        $select_value1 = $request->select_gt1;
//        $select_value2 = $request->select_gt2;
//        $select_value3 = $request->select_gt3;
//        $select_value4 = $request->select_gt4;

        //$array = ["%'.$select_value1.'%","%'.$select_value2.'%","%'.$select_value3.'%","%'.$select_value4.'%"];


        //phan loai gia tri
        $data_phanloai = null;
        for($i = 0;$i<count($phanloai);$i++)
        {
            $data_phanloai[$i][0] = $phanloai[$i];
            $data_phanloai[$i][1] = $phan_loai_gt[$i];
        }
        //select
        $data_select = null;
        $no = 0;
        for($i = 0;$i<count($select_loai);$i++)
        {
            if($select_value[$i]!=null)
            {
                $data_select[$no][0] = $select_loai[$i];
                $data_select[$no][1] = $reg[$i];
                $data_select[$no][2] = $select_value[$i];
                $no++;
            }

        }

        //ket qua tiep dan
        $tiepdan_id = DB::table('ketquatiepdan')
            ->where([
                [$data_phanloai],
                [$data_select]
            ])
            ->whereDate('ngaytiep','>=',$ngay_tu)
            ->whereDate('ngaytiep','<=',$ngay_den)
            ->get();
        //ket qua tra cuu
        $result_tracuu = null;
        $num =0;
        if($tiepdan_id!=null)
        {
            for($j = 0;$j<count($tiepdan_id);$j++)
            {
                $sothuly = explode('/',$tiepdan_id[$j]->sothuly);
                $sothuly = $sothuly[0];
                if($so_thu_ly_tu <= $sothuly && $sothuly <= $so_thu_ly_den)
                {
                    $result_tracuu[$num] = $tiepdan_id[$j];
                    $num++;
                }
            }
        }

        //add name linh vuc
        $tra_cuu_linh_vuc=null;
        $ten_linh_vuc ="";
       // $no = 0;
        if($result_tracuu!=null)
        {
            for($j = 0;$j<count($result_tracuu);$j++)
            {
                for($i = 0;$i<count($linhvuc);$i++)
                {
                    if($linhvuc[$i]->linhvucid == $result_tracuu[$j]->linhvuc)
                    {
                        $ten_linh_vuc =$linhvuc[$i]->tenlinhvuc;
                    }
                }

                $tra_cuu_linh_vuc[$j] = array(
                    'tenlinhvuc'=>$ten_linh_vuc,
                    'lichtiep'=>$result_tracuu[$j]
                );
            }
        }


        return $tra_cuu_linh_vuc;
    }
    /**************************************************
    Function Name	: DataTraCuuLichTiepDanOne
    Description		:
    Argument		:
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function DataTraCuuLichTiepDanOne($request,$linhvuc)
    {
        $stl_tu = null;
//        $stl_den = null;
        $stl_first = null;
        $stl_second = null;

        if($request->sothulytu !=null )
        {
//            $stl_tu = explode('/',$request->sothulytu);
            $stl_tu = trim($request->sothulytu);
        }

        $date_tu = $request->ngaytu;
        $date_den = $request->ngayden;
        $kind =$request->loai;
        $kind_gt = $request->loaigt;
        $chon_loai = $request->select;
        $reg = $request->regexp;
        $chon_value = $request->value;

        //data phan loai
        $data_kind =null;
        $no =0;

        for($i = 0;$i<count($kind_gt);$i++)
        {
            if($kind_gt[$i]!=null)
            {
                $data_kind[$no][0] =$kind[$i];
                $data_kind[$no][1] =$kind_gt[$i];
                $no++;
            }

        }


        //data chon
        $data_chon = null;
        $num = 0;

        for($j = 0;$j<count($chon_value);$j++)
        {
            if($chon_value[$j]!=null)
            {
                $data_chon[$num][0] = $chon_loai[$j];
                $data_chon[$num][1] = $reg[$j];
                $data_chon[$num][2] = $chon_value[$j];
                $num++;
            }
        }

        //tiep dan id
        $lichtiep_tracuu = null;
        if($data_kind!=null || $data_chon !=null || $date_tu !=null || $date_den !=null || $stl_tu !=null)
        {
            $tiepdan_id = null;
            if($data_kind!=null && $data_chon == null)
            {
                $tiepdan_id = DB::table('ketquatiepdan')
                    ->where([
                        [$data_kind]
                    ])
                    ->get();
            }
            elseif($data_kind==null && $data_chon != null)
            {
                $tiepdan_id = DB::table('ketquatiepdan')
                    ->where([
                        [$data_chon]
                    ])
                    ->get();
            }
            elseif($data_kind!=null && $data_chon != null)
            {
                $tiepdan_id = DB::table('ketquatiepdan')
                    ->where([
                        [$data_kind],
                        [$data_chon]
                    ])
                    ->get();
            }
            else
            {
                $tiepdan_id = DB::table('ketquatiepdan')->get();
            }

            //check date
            $tiepdan_date = null;
            $a =0;
            if($date_tu!=null && $date_den !=null)
            {
                if($date_tu <= $date_den)
                {
                    if($tiepdan_id!=null)
                    {
                        for($j = 0; $j<count($tiepdan_id);$j++)
                        {
                            if($date_tu <= $tiepdan_id[$j]->ngaytiep && $tiepdan_id[$j]->ngaytiep <= $date_den)
                            {
                                $tiepdan_date[$a]=$tiepdan_id[$j];
                                $a++;
                            }
                        }
                    }
                }

            }
            else
            {
                $tiepdan_date =  $tiepdan_id;
            }

            //check so thu ly
            $lichtiep_array = null;
            $b =0;
//            if($stl_tu!=null )
//            {
//                if($stl_tu <= $stl_den)
//                {
//                    if($tiepdan_date!=null)
//                    {
//                        for($i = 0;$i<count($tiepdan_date);$i++)
//                        {
//                            $tiepdan_stl = explode('/',$tiepdan_date[$i]->sothuly);
//                            $tiepdan_stl = $tiepdan_stl[0];
//                            if($stl_tu<= $tiepdan_stl && $tiepdan_stl <= $stl_den)
//                            {
//                                $lichtiep_array[$b] = $tiepdan_date[$i];
//                                $b++;
//                            }
//                        }
//                    }
//                }
//
//            }
            if($stl_tu!=null)
            {
                if($tiepdan_date!=null)
                {
                    for($i = 0;$i<count($tiepdan_date);$i++)
                    {
                        $tiepdan_stl = explode('/',$tiepdan_date[$i]->sothuly);
                        $tiepdan_stl = $tiepdan_stl[0];
                        if($stl_tu == $tiepdan_stl)
                        {
                            $lichtiep_array[$b] = $tiepdan_date[$i];
                            $b++;
                        }
                    }
                }
            }
//            elseif($stl_tu==null && $stl_den!=null)
//            {
//                if($tiepdan_date!=null)
//                {
//                    for($i = 0;$i<count($tiepdan_date);$i++)
//                    {
//                        $tiepdan_stl = explode('/',$tiepdan_date[$i]->sothuly);
//                        $tiepdan_stl = $tiepdan_stl[0];
//                        if( $tiepdan_stl <= $stl_den)
//                        {
//                            $lichtiep_array[$b] = $tiepdan_date[$i];
//                            $b++;
//                        }
//                    }
//                }
//            }
            else
            {
                $lichtiep_array = $tiepdan_date;
            }
            //data

            $ten_linhvuc = "";
            $c =0;
            if($lichtiep_array!=null)
            {
                for($j = 0;$j<count($lichtiep_array);$j++)
                {
                    for($i = 0;$i<count($linhvuc);$i++)
                    {
                        if($linhvuc[$i]->linhvucid == $lichtiep_array[$j]->linhvuc)
                        {
                            $ten_linhvuc = $linhvuc[$i]->tenlinhvuc;
                        }
                    }

                    $lichtiep_tracuu[$j] = array(
                        'tenlinhvuc'=>$ten_linhvuc,
                        'lichtiep'=>$lichtiep_array[$j]
                    );
                }
            }
        }

        return $lichtiep_tracuu;

    }
    /**************************************************
    Function Name	: LocDonThuGiongNhau
    Description		:
    Argument		:
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function LocDonThuGiongNhau($soCMT,$filed,$table)
    {
        if($filed == 'cmt' || $filed == 'cmnd_hc')
        {
            $data = DB::table($table)
                ->where($filed,$soCMT)
                ->get();
        }
        else
        {
            $data = DB::table($table)
                ->where($filed,'like','%'.$soCMT.'%')
                ->get();
        }

        return $data;
    }
    /**************************************************
    Function Name	: DataLichTiepDan
    Description		:
    Argument		:
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function DataLichTiepDan($cmt,$tenNguoiVD,$tiepDanLoai,$diaBanArray)
    {
        $tiepDanData = array();
        if(count($tiepDanLoai)>0 && count($diaBanArray)>0){

            $tiepDanData = DB::table('ketquatiepdan')
                ->where('cmt',$cmt)
                ->where('congdan','like','%'.$tenNguoiVD.'%')
                ->join('loaidon', 'ketquatiepdan.loaihinh', '=', 'loaidon.loaidonid')
                ->join('linhvuc', 'ketquatiepdan.linhvuc', '=', 'linhvuc.linhvucid')
                ->join('diaban', 'ketquatiepdan.diaban', '=', 'diaban.id')
                ->select('ketquatiepdan.*', 'loaidon.tenloaidon', 'linhvuc.tenlinhvuc','diaban.tendiaban')
                ->where([
                    [$tiepDanLoai]
                ])
                ->whereIn('ketquatiepdan.diaban',$diaBanArray)
                ->get();

        }
        else if(count($tiepDanLoai)>0 && count($diaBanArray)==0){
            $tiepDanData = DB::table('ketquatiepdan')
                ->where('cmt',$cmt)
                ->where('congdan','like','%'.$tenNguoiVD.'%')
                ->join('loaidon', 'ketquatiepdan.loaihinh', '=', 'loaidon.loaidonid')
                ->join('linhvuc', 'ketquatiepdan.linhvuc', '=', 'linhvuc.linhvucid')
                ->join('diaban', 'ketquatiepdan.diaban', '=', 'diaban.id')
                ->select('ketquatiepdan.*', 'loaidon.tenloaidon', 'linhvuc.tenlinhvuc','diaban.tendiaban')
                ->where([
                    [$tiepDanLoai]
                ])
                ->get();

        }
        elseif(count($tiepDanLoai)==0 && count($diaBanArray)>0)
        {
            $tiepDanData = DB::table('ketquatiepdan')
                ->where('cmt',$cmt)
                ->where('congdan','like','%'.$tenNguoiVD.'%')
                ->join('loaidon', 'ketquatiepdan.loaihinh', '=', 'loaidon.loaidonid')
                ->join('linhvuc', 'ketquatiepdan.linhvuc', '=', 'linhvuc.linhvucid')
                ->join('diaban', 'ketquatiepdan.diaban', '=', 'diaban.id')
                ->select('ketquatiepdan.*', 'loaidon.tenloaidon', 'linhvuc.tenlinhvuc','diaban.tendiaban')
                ->whereIn('ketquatiepdan.diaban',$diaBanArray)
                ->get();
        }
        else
        {
            $tiepDanData = DB::table('ketquatiepdan')
                ->where('cmt',$cmt)
                ->where('congdan','like','%'.$tenNguoiVD.'%')
                ->join('loaidon', 'ketquatiepdan.loaihinh', '=', 'loaidon.loaidonid')
                ->join('linhvuc', 'ketquatiepdan.linhvuc', '=', 'linhvuc.linhvucid')
                ->join('diaban', 'ketquatiepdan.diaban', '=', 'diaban.id')
                ->select('ketquatiepdan.*', 'loaidon.tenloaidon', 'linhvuc.tenlinhvuc','diaban.tendiaban')
                ->get();

        }


        return $tiepDanData;
    }
    /**************************************************
    Function Name	: DataDonThuTraCuu
    Description		:
    Argument		:
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function DataDonThuTraCuu($cmt,$tenNguoiVD,$arrayLoai,$diaBanArray)
    {
        $donthuData = array();
        if(count($arrayLoai)>0 && count($diaBanArray)>0){

            $donthuData = DB::table('donthu')
                ->where('cmnd_hc',$cmt)
                ->where('tennguoivietdon','like','%'.$tenNguoiVD.'%')
                ->join('phanloaidonthu', 'donthu.donthuid', '=', 'phanloaidonthu.donthuid')
                ->join('loaidon', 'phanloaidonthu.loaidon', '=', 'loaidon.loaidonid')
                ->join('linhvuc', 'phanloaidonthu.linhvuc', '=', 'linhvuc.linhvucid')
                ->join('diaban', 'phanloaidonthu.diaban', '=', 'diaban.id')
                ->select('donthu.*', 'loaidon.tenloaidon', 'linhvuc.tenlinhvuc','diaban.tendiaban','phanloaidonthu.huonggiaiquyet')
                ->where([
                    [$arrayLoai]
                ])
                ->whereIn('phanloaidonthu.diaban',$diaBanArray)
                ->get();

        }
        else if(count($arrayLoai)>0 && count($diaBanArray)==0){
            $donthuData = DB::table('donthu')
                ->where('cmnd_hc',$cmt)
                ->where('tennguoivietdon','like','%'.$tenNguoiVD.'%')
                ->join('phanloaidonthu', 'donthu.donthuid', '=', 'phanloaidonthu.donthuid')
                ->join('loaidon', 'phanloaidonthu.loaidon', '=', 'loaidon.loaidonid')
                ->join('linhvuc', 'phanloaidonthu.linhvuc', '=', 'linhvuc.linhvucid')
                ->join('diaban', 'phanloaidonthu.diaban', '=', 'diaban.id')
                ->select('donthu.*', 'loaidon.tenloaidon', 'linhvuc.tenlinhvuc','diaban.tendiaban','phanloaidonthu.huonggiaiquyet')
                ->where([
                    [$arrayLoai]
                ])
                ->get();

        }
        elseif(count($arrayLoai)==0 && count($diaBanArray)>0)
        {
            $donthuData = DB::table('donthu')
                ->where('cmnd_hc',$cmt)
                ->where('tennguoivietdon','like','%'.$tenNguoiVD.'%')
                ->join('phanloaidonthu', 'donthu.donthuid', '=', 'phanloaidonthu.donthuid')
                ->join('loaidon', 'phanloaidonthu.loaidon', '=', 'loaidon.loaidonid')
                ->join('linhvuc', 'phanloaidonthu.linhvuc', '=', 'linhvuc.linhvucid')
                ->join('diaban', 'phanloaidonthu.diaban', '=', 'diaban.id')
                ->select('donthu.*', 'loaidon.tenloaidon', 'linhvuc.tenlinhvuc','diaban.tendiaban','phanloaidonthu.huonggiaiquyet')
                ->whereIn('phanloaidonthu.diaban',$diaBanArray)
                ->get();
        }
        else
        {
            $donthuData = DB::table('donthu')
                ->where('cmnd_hc',$cmt)
                ->where('tennguoivietdon','like','%'.$tenNguoiVD.'%')
                ->join('phanloaidonthu', 'donthu.donthuid', '=', 'phanloaidonthu.donthuid')
                ->join('loaidon', 'phanloaidonthu.loaidon', '=', 'loaidon.loaidonid')
                ->join('linhvuc', 'phanloaidonthu.linhvuc', '=', 'linhvuc.linhvucid')
                ->join('diaban', 'phanloaidonthu.diaban', '=', 'diaban.id')
                ->select('donthu.*', 'loaidon.tenloaidon', 'linhvuc.tenlinhvuc','diaban.tendiaban','phanloaidonthu.huonggiaiquyet')
                ->get();

        }


        return $donthuData;
    }
}
