<?php
/****************************************************************
File Name       : diabantable.blade.php
Description     : Header of home page
Creation Date   : 2016/06/10
Author          : FPT/KhanhTH
Change History  :
 ****************************************************************/
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>© Danh Sách Nhân Viên</title>
    {{--Declare *.css library--}}
    <link rel="stylesheet" type="text/css" href="{{url('/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('/css/bootstrap-theme.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('/css/_styles.css')}}" media="screen">
    <link rel="stylesheet" type="text/css" href="{{url('/css/font-awesome.min.css')}}" media="screen">
    <link rel="stylesheet" type="text/css" href="{{url('/css/ketquagq.css')}}"/>


    {{--Declare *.js library--}}
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
    <link rel="stylesheet" href="{{url('/css/bootstrap-datepicker3.min.css')}}">
    <link rel="stylesheet" href="{{url('/css/admin.css')}}">

    <script type="text/javascript" src="{{url('/js/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/bootstrap-datepicker.vi.min.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/jquery.validate.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/jquery.validate.unobtrusive.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/bootbox.min.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/bootboxExtension.js')}}"></script>

    <script type="text/javascript" src="{{url('/ckeditor/ckeditor.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{url('/css/jquery.treeview.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('/css/treestyle.css')}}">

    <script src="{{url('/js/jquery.cookie.js')}}"></script>
    <script src="{{url('/js/jquery.treeview.js')}}"></script>
    <script src="{{url('/js/demo.js')}}"></script>
    <style>
        body{

            background: url("{{url('/img/background-img.png')}}") no-repeat center center fixed;
            background-size: cover;
        }
    </style>

    <script type="text/javascript" src="https://secure.skypeassets.com/i/scom/js/skype-uri.js"></script>


</head>
<body>

<div id="listnhanvien" style="overflow-y: auto; height: 600px; border: 1px solid #ccc">
    <h4 class="text-center" style="color: red">Danh Sách Nhân Viên</h4>
    <table style="margin-top: 10px">
        <thead>
        <tr>
            <th class="text-center col-md-3"></th>
            <th class="text-center col-md-3"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($danhsachnhanvien as $nhanvien)
            @if($nhanvien->skypeaccount != null)
                @if($nhanvien->accountid != $id)
                <tr>
                    <td style="padding-left: 10px">
                        {{$nhanvien->fullname}}
                    </td>
                    <td class="text-center">
                        <a href="skype:{{$nhanvien->skypeaccount}}?chat"><img src="{{url('/img/skype.png')}}" width="30" height="30" /></a>
                    </td>
                </tr>
                @endif
            @endif
        @endforeach
        </tbody>
    </table>
</div>

</body>

<script>

    function chooseDiaBan(obj)
    {
        opener.document.xacminh.diabandisplay.value =  obj.innerHTML;
        opener.document.xacminh.diaban.value =  obj.id;
        window.close();
    }

</script>

</html>