<html xmlns="http://www.w3.org/1999/xhtml"><head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css?v=2123" type="text/css" rel="stylesheet">
    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/xssc.css" type="text/css" rel="stylesheet" />
 <style>
 .avatar-list{overflow:hidden;}
.avatar-list>.item{position:relative;width:90px;height:90px;float:left;display:table-cell;margin:5px;border:3px solid #fff;}
.avatar-list>.item>img{width:100%;height:100%;}
.avatar-list>.item:hover{border:3px solid #56ace5;}
.avatar-list>.item.selected{border:3px solid #56ace5;}
.avatar-list>.item>i{position:absolute;bottom:4px;right:4px;color:#56ace5;font-size:22px;}

.fa {
    display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
 </style>
 </head>
 <body style='background-color:#fff;'>
  <div id="mod-avatar" data-jbox-content-appended="1" style="display: block;">
   <form class="form-horizontal" novalidate="novalidate"   action='home_safe_avatar.html?type=<!--{$smarty.get.type}-->' method='post' enctype="multipart/form-data">
   <input type='hidden' value='<!--{$avatar}-->' name='avatar' id='avatar'>

    <div class="newTab">
     <a href="home_safe_avatar.html" <!--{if $smarty.get.type neq 'upload'}-->class="curr " <!--{/if}-->>选择头像</a>
     <!-- <a href="home_safe_avatar.html?type=upload" <!--{if $smarty.get.type eq 'upload'}-->class="curr " <!--{/if}-->>上传头像</a> -->
    </div>



     <div class="home_rec" style="min-height: 350px">
      <div class="form-body">

       <!--{if $smarty.get.type neq 'upload'}-->
       <div class="avatar-list">
        <!--{assign var=j value=0}-->
        <!--{section name=total1 loop=19}-->

        <div class="item  <!--{if $j==$avatar}-->selected<!--{/if}-->" id="avatar_<!--{$j}-->"  onclick="click_ava('<!--{$j}-->');">
         <img src="<!--{$file_uri}-->/static/images/avatar/<!--{$j}-->.jpg" />
        </div>
        <!--{assign var=j value=$j+1}-->

        <!--{/section}-->




       </div>
<!--{else}-->
       <div style="padding: 30px 0px;text-align: center">

        上传头像：<input type="file" name="avatar" required>

       </div>






       <!--{/if}-->


     </div>


    <div class="form-actions">
     <div class="form-group"  style='text-align:center;'>


       <input type='submit'  class="button"  value="确认修改">

     <input type='button'  class="button"  value="取消" onclick="parent.Dialog.close();">

     </div>
    </div>
     </div>
   </form>
  </div>

  <script>
  function click_ava(num){

  for(var i=0;i<=19;i++){

  if(i==num){
  document.getElementById('avatar').value=num;
  document.getElementById('avatar_'+i).className='item selected';
  }
else {
  document.getElementById('avatar_'+i).className='item';

}
}
  }






  </script>





 </body>
</html>