<?php
if($_GET['from']!='parent'){

    ?>
    <div style="height:45px;color:#444;line-height:45px;text-align:center;">

        &nbsp;强烈建议使用chrome内核浏览器

    </div>

    <style>


        #tips{
            position: fixed;top:45%;
            left:calc(50% - 110px);
            z-index: 9999;
            background-color: rgba(0,0,0,0.8);
            width: 200px;height:100px;color: #fff;
            padding: 5px 10px;
            border-radius: 5px;font-size: 16px;
            line-height: 100px;
            text-align: center;
            border: 1px #000 solid;
            display: none;
        }
    </style>

    <div id="tips" >

    </div>

    <script>
        var tiptime='';
        function   add_tips(str,time) {

            document.getElementById('tips').innerHTML=str;
            document.getElementById('tips').style.display='block';

            if(time=='') time=1;
            clearTimeout(tiptime);
            tiptime=   setTimeout(function () {
                document.getElementById('tips').style.display='none';
            },time*1000)

        }


    </script>
<?php

}
?>

<div style="clear: both;height:40px;line-height: 40px"></div>