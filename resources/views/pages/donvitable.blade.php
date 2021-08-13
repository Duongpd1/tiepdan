<?php
/****************************************************************
File Name       : donvitable.blade.php
Description     : Header of home page
Creation Date   : 2016/06/10
Author          : FPT/KhanhTH
Change History  :
 ****************************************************************/
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>© Đơn vị</title>
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


<?php
    function createTreeView($array, $currentParent){

        $currLevel = 0;
        $prevLevel = -1;
        foreach ($array as $categoryId => $category){

            if ($currentParent == $category['tructhuoc']){
                if ($currLevel > $prevLevel){

                    echo " <ol class='tree'>";
                }

                if ($currLevel == $prevLevel){

                    echo " </li> ";
                }
                $id = $category['id'];
                $tendonvi = $category['tendonvi'];

                if($id == 1){
                    echo '<li> <label>'.$tendonvi.'</label>';
                }else{

                    echo '<li> <label for="donvi'.$id.'"><a id="'.$id.'" onclick="chooseDonVi(this)">'.$tendonvi.'</a></label><input id="donvi'.$id.'" type="checkbox" />';
                }
                if ($currLevel > $prevLevel){

                    $prevLevel = $currLevel;
                }
                $currLevel++;
                createTreeView ($array, $id);
                $currLevel--;
            }
        }
        if ($currLevel == $prevLevel){

            echo "</li></ol>";
        }

    }

    $arrayCategorie = array();
    if(count($getdonvi)==0){
        echo "Not found Database";
    }else{
        $var = 0;
        while($var < count($getdonvi)){
            $arrayCategorie[$var+1]['tendonvi'] = $getdonvi[$var]->tendonvi;
            $arrayCategorie[$var+1]['tructhuoc'] = $getdonvi[$var]->tructhuoc;
            $arrayCategorie[$var+1]['id'] = $getdonvi[$var]->id;
            $var++;
        }
    }
    ?>

	</head>
	<body>

        <div id="listdonvi" style="overflow-y: auto; height: 380px; border: 1px solid #ccc">
            <?php

                createTreeView($arrayCategorie, 0);
            ?>
        </div>

    </body>

    <script>

        function chooseDonVi(obj)
        {
            opener.document.xacminh.donvidisplay.value =  obj.innerHTML;
            opener.document.xacminh.donvi.value =  obj.id;
            window.close();
        }

    </script>

</html>