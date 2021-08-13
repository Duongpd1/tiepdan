<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 8/6/2018
 * Time: 10:53 AM
 */

namespace App\Services;


use App\Model\TableModel\DonThuTable;
use App\Model\TableModel\NguoiDaiDienTable;

class SysCSDLQGArgService
{
    public function SysArgToCreate($donId)
    {
        $data = (new DonThuTable())->getDataToBuildArg($donId);

        $arg = [];
        if (!empty($data)) {
            $arrNguoiKNTC = $this->dataNguoiBiKNTC($data);
            $arg =
                [
                    'VuViec' => [
                        'Id' => $data[0]->id_csdlqg,
                        'NgayNhapDon' => date('d/m/Y', strtotime($data[0]->ngaynhan)),
                        'GanVuViec' => 0,
                        'LanhDaoTiep' => "",
                        'TiepDinhKy' => 0,
                        'UyQuyen' => 0,
                        'LanhDaoUyQuyen' => ""
                    ],
                    'NguonDonDen' => [
                        'MaNguonDonDen' => $data[0]->nguondon,
                        'MaCoQuanChuyenDon' => "",
                        'SoVanBanDen' => "",
                        'NgayVanBan' => date('d/m/Y', strtotime($data[0]->ngayviet))
                    ],
                    'NguoiKNTC' => [
                        'LoaiNguoiKNTC' => (count($arrNguoiKNTC) <= 5)?DonThuTable::CA_NHAN:$data[0]->songuoi,
                        'SoNguoiKNTC' => count($arrNguoiKNTC),
                        'SoNguoiDaiDien' => 1,
                        'DiaChiCoQuanToChuc' => "",
                        'TenCoQuanToChuc' => "",
                        'DataNguoiKNTC' => $arrNguoiKNTC
                    ],
                    'NguoiBiKNTCT' => [
                        'LoaiNguoiBiKNTC' => 1,
                        'HoTen' => $data[0]->doituongkhieunai,
                        'SoDinhDanhCaNhan' => "",
                        'GioiTinh' => "",
                        'NgayCapSoDinhDanh' => "",
                        'NoiCapSoDinhDanh' => "",
                        'MaTinh' => "",
                        'MaHuyen' => "",
                        'MaXa' => "",
                        'DiaChiChiTiet' => "",
                        'MaQuocTich' => "VN",
                        'MaDanToc' => "1",
                        'ChucVu' => "",
                        'TenCoQuanToChuc' => "",
                        'MaTinhCoQuan' => "",
                        'MaHuyenCoQuan' => "",
                        'MaXaCoQuan' => "",
                        'DiaChiChiTietCoQuan' => $data[0]->diachidoituongbikhieunai
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
                        'MaCoQuan' => $data[0]->madonvi,
                        'LanGiaiQuyet' => "",
                        'NgayBanHanh' => "",
                        'MaLoaiQuyetDinh' => "",
                        'KetQuaGiaiQuyet' => ""
                    ],
                    'PhanLoaiDon' => [
                        [
                            'MaLoaiDon' => $data[0]->maloaidon,
                            'MaLoaiDon1' => $data[0]->maloaidon.".01",
                            'MaLoaiDon2' => "",
                            'MaLoaiDon3' => "",
                        ]
                    ],
                    'Attachment' => [],
                    'NoiDungDon' => $data[0]->noidung,
                    'CoQuanTiepNhan' => $data[0]->madonvi
                ];
        }

        return $arg;

    }

    /********************************
     * @param $data
     * @return array
     */
    private function dataNguoiBiKNTC($data)
    {
        $arrData = [];
        if ($data[0]->songuoi == DonThuTable::TAP_THE) {
            $arrNDD = (new NguoiDaiDienTable())->getDataNDDfromId($data[0]->donthuid);

            if (!empty($arrNDD) )
            {
                foreach ($arrNDD as $val)
                {
                    $arrData[] = [
                        'HoTen' => $val->tennguoidaidien,
                        'SoDinhDanhCaNhan' => $val->cmt,
                        'GioiTinh' => $val->gioitinh,
                        'NgayCapSoDinhDanh' => date('d/m/Y', strtotime($val->ngaycap)),
                        'NoiCapSoDinhDanh' => $val->noicap,
                        'MaTinh' => "217",
                        'MaHuyen' => "",
                        'MaXa' => "",
                        'DiaChiChiTiet' => $val->diachinguoidaidien,
                        'MaQuocTich' => "VN",
                        'MaDanToc' => "1"
                    ];
                }
            }else{
                //do no thing
            }

        } else {
            $arrData[] = [
                'HoTen' => $data[0]->tennguoivietdon,
                'SoDinhDanhCaNhan' => $data[0]->cmnd_hc,
                'GioiTinh' => $data[0]->gioitinh,
                'NgayCapSoDinhDanh' => date('d/m/Y', strtotime($data[0]->ngaycap)),
                'NoiCapSoDinhDanh' => $data[0]->noicap,
                'MaTinh' => "217",
                'MaHuyen' => "",
                'MaXa' => "",
                'DiaChiChiTiet' => $data[0]->diachinguoiviet,
                'MaQuocTich' => "VN",
                'MaDanToc' => "1"
            ];
        }

        return $arrData;
    }

    public function CapNhatKQXuLyArg($donId)
    {
        $arg =[
            'Id'=>"93b20232-37d1-4406-82599b20a284192d",
            'NoiDungXuLy'=>  [
                'DonNacDanh'=>0,
                'DonDuDKXuLy'=>0,
                'TomTatNoiDungXuLy'=>"Thụ lý giải quyết",
                'NgayXuLy'=>"27/03/2018",
                'CanBoXuLy'=>"",
                'CanBoDuyetKQXL'=>"",
                'HuongXuLy'=>   [
                    'MaCoQuanXuLy'=>"H101.02",
                    'MaHuongXuLy'=>"4",
                    'MaCoQuanXuLyTiep'=>"",
                    'NoiDungXuLy'=>"Xử lý",
                    'FileDinhKem'=>"",
                    'TenFileDinhKem'=>""
                ]
            ]
        ];
    }

}