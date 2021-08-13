<?php
/**
 * Created by PhpStorm.
 * User: E222471
 * Date: 23/08/2016
 * Time: 9:07 PM
 */
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <link rel="stylesheet" type="text/css" href="{{url('/css/jquery.treeview.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('/css/screen.css')}}">

	<script src="{{url('/js/jquery.min.js')}}"></script>
	<script src="{{url('/js/jquery.cookie.js')}}"></script>
	<script src="{{url('/js/jquery.treeview.js')}}"></script>
	<script src="{{url('/js/demo.js')}}"></script>

	</head>
	<body>
    <?php //print_r($donvi)?>
        <div style="padding-left: 5%">
            <ul id="browser" class="filetree">
                <li><span class="folder">Tỉnh Phú Thọ</span>
                    <ul>

                        @for($i = 1;$i<count($donvi);$i++)
                            <li><span class="file"><a id="q{{$i}}" onclick="chooseDonVi(this)">{{$donvi[$i]->tendonvi}}</a></span></li>
                        @endfor
                    </ul>
                </li>
            </ul>
        </div>

    </body>

    <script>

        function chooseDonVi(obj)
        {
//            parentWindow = null;
//            if (window.opener) {
//                parentWindow = window.opener;
//            } else {
//                parentWindow = window.dialogArguments;
//            }
            opener.document.xacminh.donvi.value =  obj.innerHTML;
            opener.document.xacminh.donvi1.value =  obj.innerHTML;
           // console.log(window.opener.document.getElementById('diaban').value);
            //hidId.value = obj.innerHTML;
            window.close();
        }

    </script>
</html>