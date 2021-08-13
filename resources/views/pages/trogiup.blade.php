<?php
/****************************************************************
File Name       : home.blade.php
Description     : Header of home page
Creation Date   : 2016/06/10
Author          : FPT/KhanhTH
Change History  :
 ****************************************************************/
?>
@extends('layouts.quantrihethonglayout')
@section('content')
    <div class="container-fluid" style="margin-bottom: 40px; padding: 10px 15px">

        <div class="col-background">
            <div class="panel panel-default">
                <div class="panel-heading text-center" style="font-size: 14px;">Hướng dẫn sử dụng Phần mềm TIẾP CÔNG DÂN VÀ QUẢN LÝ ĐƠN KHIẾU NẠI, TỐ CÁO</div>
                <div class="panel-body" style="text-align: justify">
                    <p>Phần mềm Tiếp công dân & Quản lý đơn khiếu nại, tố cáo được xây dựng nhằm hỗ trợ cán bộ chuyên môn, cán bộ quản lý trong việc cập nhật, theo dõi tình hình tiếp công dân và tình hình cập nhật, xử lý đơn khiếu nại tố cáo của công dân. Phần mềm có thể được sử dụng hiệu quả tại Văn phòng Ủy ban nhân dân các cấp cơ quan Thanh tra các cấp, Thanh tra các sở, ngành và Trụ sở tiếp công dân của tỉnh. Để sử dụng được phần mềm, mỗi thành viên phải có tài khoản hoạt động trong hệ thống, thành viên được cấp (tài khoản\mật khẩu) mới được phép đăng nhập vào phần mềm để tác nghiệp. Một số tính năng của phần mềm được sử dụng như sau:</p>
                    <p>
                        <b>1. Hệ thống.</b><br />
                        Tính năng này được dành cho người quản trị (admin) để thiết lập, đổi mật khẩu; khai báo nhóm sử dụng; cấp tài khoản cho cán bộ nghiệp vụ để được đăng nhập và tác nghiệp trên phần mềm.
                    </p>
                    <p>
                        <b>2. Danh mục.</b><br />
                        Đây là tính năng dành cho người quản trị và những thành viên được cấp tài khoản để chỉnh sửa một số tiêu chí trong phần mềm như: lĩnh vực, loại đơn, địa bàn .v.v. Đồng thời cấp cho người quản trị có quyền upload các tài liệu, bài viết vào trang thông tin. Thí dụ cụ thể:
                        Lĩnh vực: Là thông tin danh sách các lĩnh vực liên quan tới tiếp công dân và đơn khiếu nại tố cáo. Người sử dụng có thể thêm mới, cập nhật, xóa tùy theo quyền của người dùng.
                        Loại đơn: Cập nhật thông tin danh sách các loại đơn liên quan tới tiếp công dân và khiếu nại tố cáo. Người dùng có thể thêm mới, cập nhật, xóa tùy theo quyền của người dùng.
                        Địa bàn: Là thông tin danh sách các xã, phường thị trấn, thành phố, các huyện của tỉnh Lào Cai, người được cấp quyền chỉnh sửa có thể thêm bớt các địa bàn để tiện cho việc cập nhật đơn, cập nhật tình hình tiếp công dân.
                    </p>
                    <p>
                        <b>3. Nghiệp vụ.</b><br />
                        Đây là tính năng chuyên môn của phần mềm dùng để cập nhật đơn, cập nhật tình hình tiếp công dân, đồng thời là phần để xem trước danh sách các đơn, danh sách công dân hiện đang được quản lý trong phần mềm. Tính năng cụ thể của các tác nghiệp như sau:<br />
                        <b><i>3.1. Danh sách đơn:</i></b> Thông tin các đơn đã được cán bộ nghiệp vụ cập nhật trong thời gian nhất định. Người dùng có thể thêm mới, hiệu chỉnh, xóa đơn trong quyền hạn của mình.<br />
                        <b><i>3.2. Cập nhật đơn:</i></b> Là phần dùng để cho cán bộ nghiệp vụ cập nhật đơn vào hệ thống. Các tiêu chí được cập nhật được xây dựng phù hợp với yêu cầu quản lý đơn của Thanh tra Chính phủ và của cán bộ chuyên môn trong lĩnh vực xử lý đơn.<br />
                        <b><i>3.3. Các chức năng:</i></b> In phiếu trình, in phiếu chuyển, công văn giải quyết cho phép cán bộ nghiệp vụ sau khi cập nhật các tiêu chí của một đơn vào hệ thống sẽ in các văn bản để trình người có thẩm quyền cho ý kiến chỉ đạo xử lý. Các văn bản đã được mẫu hóa cùng với việc cập nhật tự động một số tiêu chí; cán bộ nghiệp vụ có thể chỉnh sửa trước cho phù hợp trước khi in. Tính năng này được sử dụng có hiệu quả sẽ tiết kiệm tối đa công sức, thao tác cho cán bộ chuyên môn nghiệp vụ.<br />
                        <b><i>3.4. Danh sách tiếp công dân:</i></b> Là nơi hiện thị thông tin các công dân  đã được tiếp tại cơ quan, đơn vị trong thời gian nhất định. Người dùng có thể thêm mới, hiệu chỉnh các nội dung trong danh sách theo quyền hạn của mình.<br />
                        <b><i>3.5. Cập nhật Tiếp công dân:</i></b> Là tính năng dùng để cho cán bộ nghiệp vụ cập nhật danh sách các công dân đã được tiếp vào hệ thống. Các tiêu chí được cập nhật được xây dựng phù hợp với yêu cầu quản lý tiếp công dân của Thanh tra Chính phủ và của cán bộ chuyên môn trong lĩnh vực tiếp công dân.<br />
                        <b><i>3.6. Các chức năng như:</i></b> In phiếu hướng dẫn, in phiếu chuyển đơn, biên bản tiếp công dân là tính năng rất thuận tiện cho cán bộ tiếp dân sau khi cập nhật các tiêu chí quản lý tiếp công dân vào hệ thống. Các văn bản trên đã được mẫu hóa cùng với việc cập nhật tự động một số tiêu chí khi tiếp công dân; cán bộ tiếp công dân hoàn toàn có thể chỉnh sửa trước khi in cho phù hợp. Tính năng này được sử dụng có hiệu quả sẽ tiết kiệm tối đa công sức, thao tác cho cán bộ trong quá trình tiếp công dân tại trụ sở.
                    </p>
                    <p>
                        <b>4. Báo cáo:</b><br />
                        Đây là tính năng đáp ứng yêu cầu của công tác lãnh đạo, quản lý. Phần mềm được xây dựng cho 2 hệ thống báo cáo là Báo cáo tình hình đơn và Báo cáo tình hình tiếp công dân.<br />
                        <b><i>4.1. Báo cáo tình hình đơn:</i></b> Các tiêu thức yêu cầu báo cáo bao gồm Toàn bộ hoặc một trong các tiêu chí Theo địa bàn, Theo lĩnh vực, Theo loại đơn. Sau khi nhập các tiêu chí báo cáo và thời gian báo cáo, người dùng chọn nút “Xem kết quả”. Hệ thống sẽ hiện thị các hồ sơ tương ứng với các tiêu chí để báo cáo. Tiện ích của tính năng này đó là báo cáo đã được mẫu hóa đồng thời người sử dụng có thể chỉnh sửa báo cáo theo ý muốn trước khi in. Báo cáo đưa ra 2 nội dung chính đó là phần tổng hợp số liệu (có tính tỷ lệ %) và danh sách các đơn trong tiêu chí yêu cầu báo cáo với đầy đủ các chỉ tiêu cần thiết.<br />
                        <b><i>4.2. Báo cáo tình hình tiếp dân:</i></b> Các tiêu thức báo cáo gồm toàn bộ công dân, hoặc một trong những tiêu chí Theo địa bàn, Theo loại hình (tập thể hay cá nhân), Theo lĩnh vực. Sau khi nhập các tiêu chí báo cáo và thời gian báo cáo, người dùng chọn nút “Xem kết quả”. Hệ thống sẽ hiện thị các hồ sơ tương ứng với các tiêu chí để báo cáo. Tiện ích của tính năng này đó là báo cáo đã được mẫu hóa đồng thời người sử dụng có thể chỉnh sửa báo cáo theo ý muốn trước khi in. Báo cáo đưa ra danh sách các công dân đã được tiếp trong thời gian yêu cầu với đầy đủ các chỉ tiêu cần thiết.<br />
                    </p>
                    <p>
                        <b>5. Tra cứu:</b><br />
                        Chức năng này cho phép tìm kiếm các đơn khiếu nại tố cáo, tìm kiếm công dân đã được tiếp theo một trong số các điều kiện cho phép hoặc theo tất cả các điều kiện được lựa chọn thông qua 2 radio button “tất cả” hoặc “một trong các điều kiện sau đây”.
                        Các thuộc tính(trường) dữ liệu được chia thành ba loại: chữ, số và ngày. Trước hết bạn phải xác định câu hỏi tìm kiếm thuộc loại nào, sau đó nhập điều kiện tìm kiếm vào các vùng tương ứng.
                    </p>
                    <p>
                        <b>6. Trợ giúp:</b> Là chức năng người dùng truy cập vào để tìm hiểu giới thiệu trang thông tin và hướng dẫn sử dụng phần mềm.
                    </p>
                    <p>
                        <b>7. Văn bản AD:</b> Trong quá trình tác nghiệp, cán bộ chuyên môn có thể truy cập vào đây để xem, tải xuống các văn bản quy phạm pháp luật để áp dụng vào quá trình xử lý. Phần mềm đã tích hợp sẵn các văn bản quy định công tác tiếp công dân, xử lý khiếu nại tố cáo như Luật khiếu nại, tố cáo; Nghị định, Thông tư hướng dẫn v.v. đồng thời tạo đường link đến trang văn bản pháp luật của Chính phủ để người dùng tiện tìm hiểu các văn bản khác./.
                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection