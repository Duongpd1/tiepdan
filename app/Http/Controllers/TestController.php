<?php

namespace App\Http\Controllers;

use App\Model\PageModel\MauDon;
use App\Model\PageModel\NghiepVuPage;
use App\Model\TableModel\DiaBanTable;
use App\Model\TableModel\DonThuTable;
use App\Model\TableModel\KetQuaTiepDanTable;
use App\Services\CSDLQGService;
use App\Services\SysCSDLQGArgService;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Style\Font;
use DB;

class TestController extends Controller
{
    private function object_to_array($data)
    {
        if (is_array($data) || is_object($data)) {
            $result = array();
            foreach ($data as $key => $value) {
                $result[$key] = $this->object_to_array($value);
            }
            return $result;
        }
        return $data;
    }

    public function page_test()
    {

        $result = (new KetQuaTiepDanTable())->GetThongTinTheoDonId(203);

        pd($result);


        $test = (new DonThuTable())->getAllInforDon(201);

        $aaa = date('d/m/Y',strtotime($test[0]['ngaynhan']));

        pd($aaa);
        $result = (new MauDon())->readTemplateTxt(201,3);

        pd($result);
//        $str_1 = "Đề nghị bồi thường do thi công đường gây sạt lở vào đất ruộng của người dân";
//        $str_2 = "Dự án Hô Chí Minh demo Đề nghị bồi thường do thi công đường gây sạt lở vào đất ruộng ";
//
//        similar_text($str_2,$str_1,$percent);
//
//        pd($percent);
        $data = DB::table('donthu')->groupBy('diachinguoiviet')->orderBy('ngaynhan', 'desc')->get();

        $arResult = $this->object_to_array($data);



        pd($arResult);

//        $data = (new SysCSDLQGArgService())->SysArgToCreate(193);
//        $aa = (new NghiepVuPage())->postDonThuToCSDLQG(193);
//        pd($aa);
//        $donTable = DB::table('donthu')->update(['nguondon'=>1]);a7fc14f0-7931-4a74-8192-241c6fbfd0cc
//
//        pd($donTable);
        $arg2 = [
            'MaVuViec' => "",
            'TenNguoiKhieuNai' => "CAA AH AH",
            'MaTinh' => "217",
            'MaHuyen' => "",
            'MaXa' => "",
            'SoDinhDanhCaNhan' => "",
            'NoiDung' => ""];

        $arg_dm = [
            'LoaiDanhMuc' => CSDLQGService::NGUON_DON,
            'MaTinh' => '',
            'MaBoNganh' => '',
            'MaLoaiKhieuTo' => ''
        ];
        $serCSDL = new CSDLQGService();
        $result = $serCSDL->TraDanhMuc($arg_dm);
//        $result = $serCSDL->TraThongTinDon($arg2);
//        $result = $serCSDL->CapNhatVuViec($data);
        $output = json_decode($result, true);


        pd($output);
        $i = 1;
//        foreach ($output as $dv)
//        {
//            DB::table('donvi')
//                ->insert([
//                    'tendonvi' => $dv['Ten'],
//                    'tructhuoc' => 1,
//                    'diaban' => 2,
//                    'thutu' => $i,
//                    'viettat' => "",
//                    'nguoidaidien' => 17,
//                    'diachi' => "",
//                    'dienthoai' => "",
//                    'fax' => "",
//                    'email' => "",
//                    'website' =>"" ,
//                    'trangthai' => 1,
//                    'madonvi'=>$dv['Ma']
//                ]);
//            $i++;
//        }
        $data_diaban = DB::table('diaban')->orderby('mahanhchinh', 'asc')->select('id', 'tendiaban')->get();
        pd($data_diaban);
        $newArrDv = [];

        foreach ($output as $itemDV) {
            $newArrDv[] = array(
                'Ma' => str_replace('H', '', $itemDV['Ma']),
                'Ten' => $itemDV['Ten']
            );

        }

        $arrDV_DB = [];

//        foreach ($data_diaban as $data)
//        {
//            foreach ($newArrDv as $aa)
//            {
//
//                $strPos = strpos($aa["Ma"], '.');
//                $subStr = substr($aa["Ma"],0,strlen($data->mahanhchinh));
//
//                if ($strPos != false && strlen($aa["Ma"]) == 3)
//                {
//                    if(intval($subStr) == intval($data->mahanhchinh))
//                    {
//                        $arrDV_DB[$data->id][] = $aa;
//                    }
//                }
//                else
//                {
//                    if(intval($subStr) == intval($data->mahanhchinh))
//                    {
//                        $arrDV_DB[$data->id][] = $aa;
//                    }
//                }
//
//            }
//        }


        pd($arrDV_DB);

//        die;
//        $client = new \GuzzleHttp\Client([
//            'headers' => [
//                'User-Agent' => 'testing/1.0',
//                'Accept'     => 'application/json',
//                'X-Foo'      => ['Bar', 'Baz'],
//                'Authorization'=>'Basic '.base64_encode('kntc_phutho:secret')
//            ]
//        ]);
//        //dd(base64_encode('kntc_ldtbxh:secret'));
//        $url = 'http://dichvucsdlqgkntc.egov.net.vn/KNTC/TraDanhMuc';
//        $url_1 = 'http://dichvucsdlqgkntc.egov.net.vn/KNTC/CapNhatVuViec';
//        $url_2 = 'http://dichvucsdlqgkntc.egov.net.vn/KNTC/TraThongTinDon';


//        $response = $client->request('POST', $url,
//            ['form_params'=> [
//                'LoaiDanhMuc'=>2,
//                'MaTinh'=>217,
//                'MaBoNganh'=>'',
//                'MaLoaiKhieuTo'=>''
//
//            ]
//            ]);


        $arg =
            [
                'VuViec' => [
                    'Id' => "d5caddc4-29f7-4851-b1fd-5658f1564f89",
                    'NgayNhapDon' => "27/06/2018",
                    'GanVuViec' => 0,
                    'LanhDaoTiep' => "",
                    'TiepDinhKy' => 0,
                    'UyQuyen' => 0,
                    'LanhDaoUyQuyen' => ""
                ],
                'NguonDonDen' => [
                    'MaNguonDonDen' => "1",
                    'MaCoQuanChuyenDon' => "",
                    'SoVanBanDen' => "",
                    'NgayVanBan' => ""
                ],
                'NguoiKNTC' => [
                    'LoaiNguoiKNTC' => 1,
                    'SoNguoiKNTC' => 1,
                    'SoNguoiDaiDien' => 1,
                    'DiaChiCoQuanToChuc' => "",
                    'TenCoQuanToChuc' => "",
                    'DataNguoiKNTC' => [
                        [
                            'HoTen' => "Han Bao Quan",
                            'SoDinhDanhCaNhan' => "11093048",
                            'GioiTinh' => 1,
                            'NgayCapSoDinhDanh' => "12/02/2012",
                            'NoiCapSoDinhDanh' => "Hà Nội",
                            'MaTinh' => "217",
                            'MaHuyen' => "21701",
                            'MaXa' => "",
                            'DiaChiChiTiet' => "Số 22",
                            'MaQuocTich' => "VN",
                            'MaDanToc' => "1"
                        ]
                    ]
                ],
                'NguoiBiKNTCT' => [
                    'LoaiNguoiBiKNTC' => 1,
                    'HoTen' => "Nguyễn Văn B",
                    'SoDinhDanhCaNhan' => "029485798",
                    'GioiTinh' => 1,
                    'NgayCapSoDinhDanh' => "13/03/2013",
                    'NoiCapSoDinhDanh' => "Hà Nội",
                    'MaTinh' => "101",
                    'MaHuyen' => "10101",
                    'MaXa' => "1010101",
                    'DiaChiChiTiet' => "Số 3",
                    'MaQuocTich' => "VN",
                    'MaDanToc' => "1",
                    'ChucVu' => "",
                    'TenCoQuanToChuc' => "",
                    'MaTinhCoQuan' => "",
                    'MaHuyenCoQuan' => "",
                    'MaXaCoQuan' => "",
                    'DiaChiChiTietCoQuan' => ""
                ],
                'NguoiUyQuyen' => [
                    'LoaiNguoiUyQuyen' => 1,
                    'HoTen' => "Nguyễn Văn C",
                    'SoDinhDanhCaNhan' => "0948557484",
                    'GioiTinh' => 1,
                    'NgayCapSoDinhDanh' => "14/04/2014",
                    'NoiCapSoDinhDanh' => "Hà Nội",
                    'MaTinh' => "101",
                    'MaHuyen' => "10101",
                    'MaXa' => "1010101",
                    'DiaChiChiTiet' => ""
                ],
                'CoQuanDaGiaiQuyet' => [
                    'MaCoQuan' => "H217.01",
                    'LanGiaiQuyet' => "1",
                    'NgayBanHanh' => "13/05/2018",
                    'MaLoaiQuyetDinh' => "2",
                    'KetQuaGiaiQuyet' => ""
                ],
                'PhanLoaiDon' => [
                    [
                        'MaLoaiDon' => "KN",
                        'MaLoaiDon1' => "KN.01",
                        'MaLoaiDon2' => "",
                        'MaLoaiDon3' => "",
                    ]
                ],
                'Attachment' => [],
                'NoiDungDon' => "Khiếu nại admin",
                'CoQuanTiepNhan' => "H217.01"
            ];
        $arg2 = [
            'MaVuViec' => "",
            'TenNguoiKhieuNai' => "Han Bao Quan",
            'MaTinh' => "217",
            'MaHuyen' => "21701",
            'MaXa' => "",
            'SoDinhDanhCaNhan' => "",
            'NoiDung' => ""];
        $arg_dm = [
            'LoaiDanhMuc' => 1,
            'MaTinh' => "",
            'MaBoNganh' => '',
            'MaLoaiKhieuTo' => ''
        ];
        $serCSDL = new CSDLQGService();
        $result = $serCSDL->TraDanhMuc($arg_dm);
//        $result = $serCSDL->CapNhatVuViec($arg);
        $output = json_decode($result, true);

        $newArr = [];

        foreach ($output as $item) {
            $subStr = substr($item["Ma"], 0, 3);
            $subStr = intval($subStr);
            if ($subStr == 217) {
                $newArr[] = $item;
            } else {

            }
        }

        $arrHuyen = [];
        $arrXa = [];
        foreach ($newArr as $newItem) {
            if (strlen($newItem["Ma"]) == 5) {
                $arrHuyen[] = $newItem;
            } else if (strlen($newItem["Ma"]) > 5) {
                foreach ($arrHuyen as $value) {

                    $subStr_1 = substr($newItem["Ma"], 0, 5);
                    $subStr_1 = intval($subStr_1);
                    $aa = $value["Ma"];
                    $itvhuy = intval($aa);
                    if ($itvhuy == $subStr_1) {
                        $arrXa[$value["Ma"]][] = $newItem;
                    }
                }
            }
        }

//        $i = 1;
//        foreach ($arrHuyen as $huyen)
//        {
//
//            DB::table('diaban')
//                ->insert([
//                    'tendiaban' => $huyen["Ten"],
//                    'tructhuoc' => 2,
//                    'thutu' => $i,
//                    'trangthai' => 1,
//                    'type' => 3,
//                    'mahanhchinh'=>$huyen["Ma"]
//                ]);
//            $i++;
//        }


        $data_diaban = DB::table('diaban')->orderby('mahanhchinh', 'asc')->get();
//        pd([$data_diaban,$arrXa]);
        foreach ($data_diaban as $item) {

            if ($item->mahanhchinh != "" && isset($arrXa[$item->mahanhchinh])) {
                $i = 1;
                foreach ($arrXa[$item->mahanhchinh] as $xa) {
                    DB::table('diaban')
                        ->insert([
                            'tendiaban' => $xa["Ten"],
                            'tructhuoc' => $item->id,
                            'thutu' => $i,
                            'trangthai' => 1,
                            'type' => 4,
                            'mahanhchinh' => $xa["Ma"]
                        ]);
                    $i++;
                }
            }


        }

        pd([$arrHuyen, $arrXa]);

//        $vuviec = $client->request('post',$url_2,[
//            'form_params'=>[
//                'MaVuViec'=>"d5caddc4-29f7-4851-b1fd-5658f1564f89",
//                'TenNguoiKhieuNai'=>"Nguyễn Văn A",
//                'MaTinh'=>"101",
//                'MaHuyen'=>"10101",
//                'MaXa'=>"",
//                'SoDinhDanhCaNhan'=>" ",
//                'NoiDung'=>""
//            ]
//        ]);
//        //$res = $client->request('GET', 'http://dichvucsdlqgkntc.egov.net.vn/KNTC/TraThongTinDon');
//
//        echo $vuviec->getStatusCode();
//
//        echo $vuviec->getHeaderLine('content-type');
//
//        echo $vuviec->getBody();
//
//        die;

        $phpWord = new PhpWord();

        // Every element you want to append to the word document is placed in a section.
        // To create a basic section:
        $section = $phpWord->addSection();

//        // After creating a section, you can append elements:
//        $section->addText('Hello world!');
//
//        // You can directly style your text by giving the addText function an array:
//        $section->addText('Hello world! I am formatted.',
//            array('name'=>'Tahoma', 'size'=>16, 'bold'=>true));
//
//        // If you often need the same style again you can create a user defined style
//        // to the word document and give the addText function the name of the style:
//        $phpWord->addFontStyle('myOwnStyle',
//            array('name'=>'Verdana', 'size'=>14, 'color'=>'1B2232'));
//        $section->addText('Hello world! I am formatted by a user defined style',
//            'myOwnStyle');
//
//        // You can also put the appended element to local object like this:
//        $fontStyle = new Font();
//        $fontStyle->setBold(true);
//        $fontStyle->setName('Verdana');
//        $fontStyle->setSize(22);
//        $myTextElement = $section->addText('Hello World!');
//        $myTextElement->setFontStyle($fontStyle);

        //Input
        $banNganh = 'Ban tiếp dân Tỉnh Phú Thọ';
        $lanKhieuNai = 'Lần 1';
        $nguoiKhieuNai = 'Trần Huy Khánh';
        $diaChiNguoiKhieuNai = 'Phú Thọ';
        $cmndNguoiKhieuNai = '123456789';
        $tomTatNoiDungKhieuNai = 'Nội dung khiếu nại';
        $nguoiGiaiQuyetKhieuNai = 'Hoàng Minh Phúc';
        $fileName = 'MauDonSo1';

        //Font style
        $f_Style1 = array('name' => 'Times New Roman', 'bold' => true);
        $f_Style2 = array('name' => 'Times New Roman', 'bold' => false);
        $p_Style1 = array('align' => 'center');
        $p_Style2 = array('align' => 'right');

        //Add Table
        $table = $section->addTable();

        //Add row 1
        $table->addRow(500);
        // Add cells

        //Row 1 Cell 1
        $row1_cell1 = $table->addCell(5000);
        $row1_cell1->addText('(1).....................................', $f_Style2, $p_Style1);
        $row1_cell1->addText($banNganh, $f_Style1, $p_Style1);
        $row1_cell1->addText('------', $f_Style1, $p_Style1);

        //Row 1 Cell 2
        $row1_cell2 = $table->addCell(10000);
        $row1_cell2->addText('CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM', $f_Style1, $p_Style1);
        $row1_cell2->addText('Độc lập - Tự do - Hạnh phúc', $f_Style1, $p_Style1);
        $row1_cell2->addText('-------------', $f_Style1, $p_Style1);

        //Add row 2
        $table->addRow(500);

        //Row 2 Cell 1
        $row2_cell1 = $table->addCell(5000);
        $row2_cell1->addText('Số: .../TB-...', $f_Style2, $p_Style1);

        //Row 2 Cell 2
        $getDate = getdate();
        $ngay = $getDate['mday'];
        $thang = $getDate['mon'];
        $nam = $getDate['year'];
        $row2_cell2 = $table->addCell(10000);
        $row2_cell2->addText('..., Ngày ' . $ngay . ' Tháng ' . $thang . ' Năm ' . $nam, $f_Style2, $p_Style1);

        //Add text
        $section->addText('THÔNG BÁO', $f_Style1, $p_Style1);
        $section->addText('Về việc thụ lý giải quyết khiếu nại ' . $lanKhieuNai, $f_Style1, $p_Style1);
        $section->addText('Kính gửi:  ' . $nguoiKhieuNai, $f_Style1, $p_Style1);
        $section->addText('Ngày ' . $ngay . ' tháng ' . $thang . ' năm ' . $nam . ' ' . $banNganh . ' đã nhận được đơn khiếu nại của ' . $nguoiKhieuNai, $f_Style2);
        $section->addText('Địa chỉ: ' . $diaChiNguoiKhieuNai, $f_Style2);
        $section->addText('Số CMND/Hộ chiếu, ngày cấp, nơi cấp: ' . $cmndNguoiKhieuNai, $f_Style2);
        $section->addText('Khiếu nại về việc ' . $tomTatNoiDungKhieuNai, $f_Style2);
        $section->addText('Sau khi xem xét nội dung đơn khiếu nại, căn cứ Luật khiếu nại năm 2011, đơn khiếu nại đủ điều kiện thụ lý và thuộc thẩm quyền giải quyết của ' . $nguoiGiaiQuyetKhieuNai, $f_Style2);
        $section->addText('Đơn khiếu nại đã được thụ lý giải quyết kể từ ngày ' . $ngay . ' tháng ' . $thang . ' năm ' . $nam, $f_Style2);
        $section->addText('Vậy thông báo để ' . $nguoiKhieuNai . ' được biết.', $f_Style2);


        //Add Table
        $table = $section->addTable();

        //Add row 1
        $table->addRow(500);
        // Add cells

        //Row 1 Cell 1
        $row1_cell1 = $table->addCell(5000);
        $row1_cell1->addText('');
        $row1_cell1->addText('Nơi nhận:', $f_Style1);
        $row1_cell1->addText('- Như trên;', $f_Style2);
        $row1_cell1->addText('- (8)...........', $f_Style2);
        $row1_cell1->addText('- (9)...........', $f_Style2);

        //Row 1 Cell 2
        $row1_cell2 = $table->addCell(10000);
        $row1_cell2->addText('Người đứng đầu cơ quan, tổ chức, đơn vị', $f_Style1, $p_Style1);
        $row1_cell2->addText('(Ký, ghi rõ họ tên và đóng dấu)', $f_Style2, $p_Style1);

        //Add text
        $section->addText('____________', $f_Style2);
        $section->addText('(1) Tên cơ quan, tổ chức, đơn vị cấp trên trực tiếp (nếu có).', $f_Style2);
        $section->addText('(8) Tên cơ quan, tổ chức, đơn vị, cá nhân có thẩm quyền chuyển khiếu nại đến (nếu có).', $f_Style2);
        $section->addText('(9) Tên cơ quan thanh tra nhà nước cùng cấp (trừ trường hợp giải quyết khiếu nại quyết định kỷ luật cán bộ, công chức).', $f_Style2);


        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');

        // Finally, write the document:
        // The files will be in your public folder
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=" . $fileName . ".doc");
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');

//        echo '<pre>';
//        print_r($getDate);
//        die;
    }

}