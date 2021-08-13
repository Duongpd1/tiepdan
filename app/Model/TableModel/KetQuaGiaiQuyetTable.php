<?php

namespace App\Model\TableModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;
use Illuminate\Support\Facades\Input;

class KetQuaGiaiQuyetTable extends Model
{

    /**************************************************
    Function Name	: GetKetQuaGiaiQuyetTheoID
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetKetQuaGiaiQuyetTheoID($donthuid){
        $ketqua = DB::table('ketquagiaiquyet')
            ->where('donthuid',$donthuid)
            ->get();
        return $ketqua;
    }

    /**************************************************
    Function Name	: updateGiaiQuyetDonThu
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function updateGiaiQuyetDonThu($request)
    {
        try {
            $donthuid = $request->donthuid;
            $soquyetdinh = $request->soquyetdinh;
            $ngayquyetdinh =  DonThuTable::ConvertFormatDate($request->ngayquyetdinh);
            $tieude = $request->tieude;
            $ketquanoidung = $request->ketquanoidung;
            $danhgiadonthu = $request->danhgiadonthu;


            $ketthucdonthu = $request->ketthucdonthu;
            $ngaynhan =  DonThuTable::ConvertFormatDate($request->ngaynhan);
            $ngaytrendon =  DonThuTable::ConvertFormatDate($request->ngaytrendon);
            $lydorutdon = $request->lydorutdon;
            $dexuat = $request->dexuat;

            DB::table('ketquagiaiquyet')
                ->where('donthuid', $donthuid)
                ->update([
                    'soquyetdinh' => $soquyetdinh,
                    'ngayquyetdinh' => $ngayquyetdinh,
                    'tieude' => $tieude,
                    'tomtatketqua' => $ketquanoidung,
//                    'thutien' => $phaithutien,
//                    'tratien' => $phaitratien,
//                    'thudat' => $phaithudat,
//                    'tradat' => $phaitradat,
                    'danhgiadonthu' => $danhgiadonthu,
                    'trangthai' => 1
                ]);

            if($ketthucdonthu == "kt")
            {
                DB::table('donthu')
                    ->where('donthuid',$donthuid)
                    ->update(['ketqua'=>KETTHUCDONTHU]);
            }
            elseif($ketthucdonthu == "rd")
            {
                DB::table('donthu')
                    ->where('donthuid',$donthuid)
                    ->update(['ketqua'=>RUTDONTHU]);

                DB::table('thongtinrutdonthu')
                    ->where('donthuid',$donthuid)
                    ->update([
                        'ngaynhan'=>$ngaynhan,
                        'ngaytrendon'=>$ngaytrendon,
                        'lydo'=>$lydorutdon,
                        'dexuat'=>$dexuat
                    ]);
            }
            else
            {
                DB::table('donthu')
                    ->where('donthuid',$donthuid)
                    ->update(['ketqua'=>CHUAKETTHUC]);
            }

            //status
            DB::table('donthu')
                ->where('donthuid', $donthuid)
                ->update(['trangthaixuly' => DAGIAIQUYET]);

            $result = 'successful';

        } catch (Exception $e) {

            $result = 'fail';

        }
        return $result;
    }

    /**************************************************
    Function Name	: updateVanBanGiaiQuyet
    Description		:
    Argument		: $id, $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function updateVanBanGiaiQuyet($id, $request)
    {
        $sothuly = $request->sothuly;

        //create direction
        $input = Input::all();

        $name = explode('/',$sothuly);
        $folder_name ="vbgiaiquyet_".$name[0]."_".$name[1];

        $file_path = FOLDERROOT."/file/".$folder_name;
        $linkfile = '/file'.'/'.$folder_name;

        //create direction
        $filevanbanyeucauxuly = array_get($input, 'vbgiaiquyet');
        // RENAME THE UPLOAD WITH RANDOM NUMBER
        $filevanbanyeucauxulydinhkem = $filevanbanyeucauxuly->getClientOriginalName();
        // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
        $filevanbanyeucauxuly->move($file_path, $filevanbanyeucauxulydinhkem);

        DB::table('ketquagiaiquyet')
            ->where('donthuid',$id)
            ->update([
                'vanbangiaiquyet'=>$filevanbanyeucauxulydinhkem,
                'linkfile'=>$linkfile,
            ]);
    }

    /**************************************************
    Function Name	: getKetQuaGiaiQuyetDonThu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function getKetQuaGiaiQuyetDonThu($phanloaidonthudata)
    {

        $result = DB::table('theodoidonthu')
            ->get();

        $array_donthu = array();
        $no = 0;

        for($i = 0;$i<count($result);$i++)
        {
            for($j = 0;$j<count($phanloaidonthudata);$j++)
            {
                if($result[$i]->donthuid == $phanloaidonthudata[$j]->donthuid)
                {
                    $array_donthu[$no] = $result[$i];
                    $no++;
                }
            }
        }

        return $array_donthu;


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
            DB::table('ketquagiaiquyet')
                ->where('donthuid', $donthuid)
                ->delete();

            $result = 'successful';

        }catch (Exception $e){

            $result = 'fail';
        }
        return $result;
    }
}
