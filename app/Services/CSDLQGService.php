<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 7/4/2018
 * Time: 3:49 PM
 */

namespace App\Services;


use Symfony\Component\EventDispatcher\Tests\Service;

class CSDLQGService
{
    const USER = "kntc_phutho";
    const PASSWORD = "secret";

    /*Loai Danh Muc*/
    const DIA_DIOI_HANH_CHINH = 1;
    const CO_QUAN_HANH_CHINH = 2;
    const QUOC_GIA_HANH_CHINH = 3;
    const DAN_TOC = 4;
    const NGUON_DON = 5;
    const LOAI_KHIEU_TO = 6;
    const DON_VI_TRUC_THUOC = 7;
    const LOAI_QDGQ_HANH_CHINH = 8;
    const THAM_QUYEN_GQ = 9;
    const LOAI_KET_QUA_GQ = 10;
    const LOAI_GIAY_TO = 11;
    const LOAI_RA_SOAT_DON = 12;
    const HUONG_XU_LY = 13;
    const BUOC_GQ = 14;

    public static $arrLoaiDanhMuc = [
        self::DIA_DIOI_HANH_CHINH =>'Địa giới hành chính',
        self::CO_QUAN_HANH_CHINH =>'Cơ quan hành chính',
        self::QUOC_GIA_HANH_CHINH =>'Quốc gia',
        self::DAN_TOC =>'Dân tộc',
        self::NGUON_DON =>'Nguồn đơn',
        self::LOAI_KHIEU_TO =>'Loại khiếu tố',
        self::DON_VI_TRUC_THUOC =>'Đơn vị trực thuộc',
        self::LOAI_QDGQ_HANH_CHINH =>'Loại quyết định giải quyết',
        self::THAM_QUYEN_GQ =>'Thẩm quyền giải quyết',
        self::LOAI_KET_QUA_GQ =>'Loại kết quả giải quyết',
        self::LOAI_GIAY_TO =>'Loại giấy tờ',
        self::LOAI_RA_SOAT_DON =>'Loại rà soát đơn',
        self::HUONG_XU_LY =>'Hướng xử lý',
        self::BUOC_GQ =>'Bước giải quyết',
    ];

    const TRA_DANH_MUC = 1;
    const TRA_TT_DON = 2;

    /*API*/

    const TRADANHMUC_API = 'http://dichvucsdlqgkntc.egov.net.vn/KNTC/TraDanhMuc';
    const TRATHONGTINDON_API = 'http://dichvucsdlqgkntc.egov.net.vn/KNTC/TraThongTinDon';
    const CAPNHATVUVIEC_API = 'http://dichvucsdlqgkntc.egov.net.vn/KNTC/CapNhatVuViec';
    const CAPNHATKQXULY_API = 'http://dichvucsdlqgkntc.egov.net.vn/KNTC/CapNhatKQXuLy';
    const CAPNHATGQ_API = 'http://dichvucsdlqgkntc.egov.net.vn/KNTC/CapNhatGiaiQuyet';
    const CAPNHATKETQUAGQ_API = 'http://dichvucsdlqgkntc.egov.net.vn/KNTC/CapNhatKQGiaiQuyet';
    const CAPNHATTHIHANH_API = 'http://dichvucsdlqgkntc.egov.net.vn/KNTC/CapNhatThiHanh';

    private $arrAPI = [
        self::TRADANHMUC_API => 'Tra Danh Muc',
        self::TRATHONGTINDON_API => 'Tra Thong Tin Don',
        self::CAPNHATVUVIEC_API => 'Cap nhat vu viec',
        self::CAPNHATGQ_API => 'cap nhat giai quyet',
        self::CAPNHATKETQUAGQ_API => 'cap nhat ket qua giai quyet',
        self::CAPNHATTHIHANH_API => 'cap nhat thi hanh',

    ];

    /**************
     * @return \GuzzleHttp\Client
     */
    private function _login()
    {
        $client = new \GuzzleHttp\Client([
            'headers' => [
                'User-Agent' => 'testing/1.0',
                'Accept' => 'application/json',
                'X-Foo' => ['Bar', 'Baz'],
                'Authorization' => 'Basic ' . base64_encode(self::USER . ":" . self::PASSWORD)
            ]
        ]);
        return $client;
    }

    /*********************
     * @param array $arg
     * @return mixed
     */
    public function TraDanhMuc($arg = [])
    {
        $client_tra = $this->_login();

        $resDanhMuc = $client_tra->request('POST', self::TRADANHMUC_API, [
            'form_params' =>$arg

        ]);
        //$resDanhMuc->getStatusCode();

        //$resDanhMuc->getHeaderLine('content-type');
        $body = $resDanhMuc->getBody();
        return json_decode($body, true);
    }

    /*********************
     * @param array $argTraTT
     * @return mixed
     */
    public function TraThongTinDon($argTraTT = [])
    {
        $client_ttDon = $this->_login();

        $resTTTDon = $client_ttDon->request('POST', self::TRATHONGTINDON_API, [
            'form_params' => $argTraTT

        ]);

        $body_ttDon = $resTTTDon->getBody();

        return json_decode($body_ttDon, true);
    }


    /****************
     * @param array $arg_CNVV
     * @return mixed
     */
    public function CapNhatVuViec($arg_CNVV = [])
    {
        $client_CapNhatVV = $this->_login();
        $resCNVV = $client_CapNhatVV->request('POST', self::CAPNHATVUVIEC_API, [
            'form_params' => $arg_CNVV

        ]);

        $body_CNVV = $resCNVV->getBody();

        return json_decode($body_CNVV, true);
    }

    /*************
     * @param array $arg_KQXL
     * @return mixed
     */
    public function CapNhatKQXuLy($arg_KQXL = [])
    {
        $client_CapNhatKQXL = $this->_login();
        $resCNKQXL = $client_CapNhatKQXL->request('POST', self::CAPNHATKQXULY_API, [
            'form_params' => $arg_KQXL

        ]);

        $body_CNKQXL = $resCNKQXL->getBody();

        return json_decode($body_CNKQXL, true);
    }

    /************
     * @param array $arg_GQ
     * @return mixed
     */
    public function CapNhatGiaiQuyet($arg_GQ = [])
    {
        $client_GQ = $this->_login();
        $resGQ = $client_GQ->request('POST', self::CAPNHATGQ_API, [
            'form_params' => $arg_GQ

        ]);

        $body_GQ = $resGQ->getBody();

        return json_decode($body_GQ, true);
    }

    /***********************
     * @param array $arg_KQGQ
     * @return mixed
     */
    public function CapNhatKQGiaiQuyet($arg_KQGQ = [])
    {
        $client_KQGQ = $this->_login();
        $resKQGQ = $client_KQGQ->request('POST', self::CAPNHATKETQUAGQ_API, [
            'form_params' => $arg_KQGQ

        ]);

        $body_KQGQ = $resKQGQ->getBody();

        return json_decode($body_KQGQ, true);
    }

    /**********************
     * @param array $arg_THIHANH
     * @return mixed
     */
    public function CapNhatThiHanh($arg_THIHANH = [])
    {
        $client_THIHANH = $this->_login();
        $resTHIHANH = $client_THIHANH->request('POST', self::CAPNHATTHIHANH_API, [
            'form_params' => $arg_THIHANH

        ]);

        $body_THIHANH = $resTHIHANH->getBody();

        return json_decode($body_THIHANH, true);
    }
}