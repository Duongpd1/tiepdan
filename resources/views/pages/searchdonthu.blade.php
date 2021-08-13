<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <script type="text/javascript" src="{{url('/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/liveclock.js')}}"></script>

    {{--<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">--}}
    <script type="text/javascript" src="{{url('/js/ie-emulation-modes-warning.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/ie10-viewport-bug-workaround.js')}}"></script>

    <link rel="stylesheet" href="{{url('/css/jdNewsScroll.css')}}" />
    {{--<script type="text/javascript" src="{{url('/js/jquery.dimensions.html')}}"></script>--}}
    <script type="text/javascript" src="{{url('/js/jquery.jdNewsScroll.js')}}"></script>

    <script type="text/javascript" src="{{url('/js/donthuview.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/validatorForm.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/backToTop.js')}}"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>
        Chọn đơn lần 1
    </title>
    <style type="text/css">
        body { font-size: 12px; font-family: Arial,Verdana, 'Times New Roman'; overflow-x: hidden; overflow-y:scroll }
        .item { width: 550px; padding-bottom: 10px; border-bottom: 1px solid #000; overflow:hidden; }
        .item:hover { background: #e2dcdc }
        .left { float: left; width: 50px; padding: 3px 5px; }
        .right { float: left; width: 490px; text-align: justify;  }
        .right p { margin: 0px; padding: 3px 5px; }
        .right p span { font-weight: bold; }
    </style>
</head>
<body>

    <div>
        <div id="UpdatePanel1">

            <div style="margin-bottom: 5px;">
                <input name="txtTimKiem" type="text" id="txtTimKiem" placeholder="Nhập tên người viết đơn..." style="width:200px;">
                <button  name="btnTimKiem" value="Tìm kiếm"  onclick="FindNameDonThu()">Tìm kiếm</button>
            </div>

            <div style="border: 1px solid #000000; width: 550px; border-bottom: 0px;" id="table">
                <?php
                    if($data!= null)
                    {
                        for($i = 0;$i<count($data);$i++)
                        {
                            echo '<div class="item">';
                                echo '<div class="left">';
                                echo '<input type="button" data-key="'.$data[$i]->donthuid.'" data-value="'.$data[$i]->tennguoivietdon.'" value="Chọn">';
                               // echo '<input name= "donthuid" type="hidden" value="'.$data[$i]->donthuid.'">';
                                echo '</div>';
                                echo '<div class="right">';
                                    echo '<p><span>Số thụ lý: </span>'.$data[$i]->sothuly.'</p>';
                                    echo '<p><span>Họ tên người viết đơn: </span>'.mb_strtoupper($data[$i]->tennguoivietdon).'</p>';
                                    echo '<p><span>Nội dung đơn: </span>'.$data[$i]->noidung.'</p>';
                                echo '</div>';
                            echo '</div>';
                        }
                    }
                    else
                    {
                        echo "Không có đơn nào!";
                    }
                ?>


            </div>



        </div>
    </div>
<script type="text/javascript">
    $(document).on('click', "input[type='button']", function () {
        var dtid = $(this).attr('data-key');
        var dtvalue = $(this).attr('data-value');
        SetDonThu(dtid, dtvalue);

    });

    function SetDonThu(donthuId, donthuValue)
    {
        console.log(donthuId);
        console.log(donthuValue);
        parentWindow = window.opener;

        var hidId = parentWindow.document.getElementById("ctl00_hidIdDT");
        var txtId = parentWindow.document.getElementById("donlan01");
        hidId.value = donthuId;
        console.log(hidId);
        txtId.value = donthuValue;
        window.close();
    }
    //

    function FindNameDonThu()
    {
        var text = $('#txtTimKiem').val();

        $.ajax({
            type: 'get',
            url: '{{URL::to('timkiem')}}',
            data: {
                value:text
            },
            success: function (data) {
                $('#table').remove();
                $('#UpdatePanel1').append('<div style="border: 1px solid #000000; width: 550px; border-bottom: 0px;" id="table"></div>');
                if (data!="")
                {
                    for (var i = 0;i<data.length;i++)
                    {
                        DrawTable(data[i]);
                    }
                }
                else
                {
                    console.log("sadasdasd");
                    $('#table').append('Không có đơn nào!');
                }
            }
        });
    }

    function DrawTable (donthu)
    {
        $(function(){
            $('#table').append('<div class="item">'
                    +'<div class="left">'
                    +'<input type="button" data-key="'+donthu['donthuid']+'" data-value="'+donthu['tennguoivietdon']+'" value="Chọn">'
                    +'</div>'
                    +'<div class="right">'
                    +'<p><span>Số thụ lý: </span>'+donthu['sothuly']+'</p>'
                    +'<p><span>Họ tên người viết đơn: </span>'+donthu['tennguoivietdon']+'</p>'
                    +'<p><span>Nội dung đơn: </span>'+donthu['noidung']+'</p>'
                    +'</div>'
                    +'</div>');
        });
    }
</script>

</body>
</html>