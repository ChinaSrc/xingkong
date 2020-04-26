<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $system['sitename']; ?>管理后台</title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
  <meta charset="UTF-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1"/>
  <meta name="renderer" content="webkit" title="360浏览器强制开启急速模式-webkit内核"/>


  <link href="style/static/css/main.css" rel="stylesheet" type="text/css"/>

  <link href="images/style.css" rel="stylesheet" type="text/css"/>

  <link rel="stylesheet" type="text/css" href="../template/default/style/fontello.css" media="all"/>

</head>
<body>


<div id="header" <?php $admin_color = $_COOKIE['admin_color'];
if ($admin_color) echo "style='background-color:{$admin_color}'"; ?>>
  <div id="logo"><a class="tabMenu" data-href="welcome.aspx" title="起始页"><?php echo $system['sitename']; ?>管理后台</a>
  </div>

  <div id="top_nav">
		<?php
		$sql          = "SELECT count(*) as num from user_funds where  status='0' and cate='recharge' and userid in (select userid from user where admin=0 and   `virtual`='0' ) order by creatdate desc";
		$row          = $db->exec($sql);
		$recharge_num = $row['num'];

		$sql          = "SELECT count(*) as num from user_funds where  status='0' and cate='platform' and userid in (select userid from user where admin=0 and   `virtual`='0' ) order by creatdate desc";
		$row          = $db->exec($sql);
		$platform_num = $row['num'];

		$sql     = "SELECT count(*) as num from user_msg where  userid='0' and read1='0'";
		$row     = $db->exec($sql);
		$msg_num = $row['num'];
		?>
    <a class="tabMenu refresh" data-href="index.aspx?controller=user&action=index"><i class="icon-users"></i>用户管理</a>
    <a class="menuPay">快捷充值</a>
    <a class="tabMenu refresh" data-href="index.aspx?controller=user&action=recharge">充值记录<span id="recharge_num"
                                                                                        class="num"><?php echo $recharge_num ?></span></a>

    <a class="tabMenu refresh" data-href="index.aspx?controller=user&action=platform">提现记录<span id="platform_num"
                                                                                        class="num"><?php echo $platform_num ?></span></a>
    <a class="tabMenu refresh" data-href="index.aspx?controller=user&action=msg&type=to">收件箱<span id="msg_num"
                                                                                          class="num"><?php echo $msg_num ?></span></a>
    <a class="tabMenu refresh" data-href="index.aspx?controller=lottery&action=plan">预设开奖</a>
    <a  href="index.aspx?controller=system&action=UnsetSession"><i class="icon-recycle"></i>清除缓存</a>

    <a href="../" target="_blank"><i class="icon-squares"></i>浏览首页</a>

    <a class="tabMenu" data-href="index.aspx?controller=user&action=info"><i
              class="icon-user"></i><?php echo $_SESSION['admin_name']; ?></a>

    <a href="index.aspx?controller=default&action=logout"><i class="icon-logout"></i>退出</a>

    <a> <i class="icon-t-shirt"></i>皮肤
      <ul class="item_menu">
				<?php
				$arr_color = array('#000' => '黑色', '#2d6dcc' => '蓝色', '#19a97b' => '绿色', '#cb1623' => '红色');

				foreach ($arr_color as $key => $value) {
					?>
          <li onclick="set_color('<?php echo $key; ?>');">

						<?php echo $value; ?>
          </li>
					<?php
				}
				?>


      </ul>

    </a>

  </div>

</div>

<div id="nav">

  <ul>

    <li class="level_1"><p><a data-href="welcome.aspx" class="level_1 tabMenu" title="起始页">起始页</a></p></li>


		<?php
		$admin_group = $_SESSION['admin_group'];
		$role        = $db->exec("select * from `role` where id='{$admin_group}'");

		$role_list = $role['content'];;

		foreach ($arr_menu as $key => $value) {
			foreach ($arr_item[$key] as $key1 => $value1) {


				$group = explode(',', $value1[2]);

				if (strpos($role_list, $value1[1]) !== false) {

					$arr_item1[$key][] = $value1;


				}

				if (count($arr_item1[$key]) > 0) $arr_menu1[$key] = $value;


			}


		}

		$i = 0;
		foreach ($arr_menu1 as $key => $value) {

			?>


      <li class="level_1" id="menu_<?php echo $i ?>">

        <p onclick="show_tabs(<?php echo $i ?>);"><em><?php echo $value[0] ?></em>

          <span class="triangle"></span>
        </p>


        <ul class="level_2">


					<?php foreach ($arr_item1[$key] as $key1 => $value1) {

						$value1[1] = str_replace('controller=', "index.aspx?controller=", $value1[1]);
						?>

            <li data-href="<?php echo $value1[1] ?>" class="tabMenu"
                name="menuli"><?php echo $value1[0] ?></li>

						<?php

					} ?>


        </ul>


      </li>


			<?php $i++;
		} ?>


  </ul>


</div>
<div class="dislpayArrow" onclick="show_navs();">
  <div class="icon"></div>

</div>

<div class="ifm_container">
  <div class="content_wrapper">
    
	<div class="tags-view-wrap">
      <div class="tags-view-content">
        <div class="tag active">
          <span class="tag-dot-inner"></span>
          起始页
        </div>
      </div>
      <div class="tags-view-btn">
        <div class="button">标签选项</div>
        <ul>
          <li class="closeOther">关闭其他</li>
          <li class="closeAll">关闭所有</li>
        </ul>
      </div>
      <div class="tags-view-reload">
        <div class="button">刷新</div>
      </div>
    </div>
    <style>
      #iframe-main { position: relative; }
      #iframe-main div.active { position: relative; z-index: 1 }
      #iframe-main div { position: absolute;z-index: -1;width: 100%; height: 100% }
      .tags-view-btn { z-index: 10 }
      
    </style>
	<div id="iframe-main">
      <div class="iframe active"><iframe src="welcome.aspx" name="iframe-main" frameborder='0'></iframe></div>
    </div>


    <div style="height:2px;width:100%;display:block;clear:both"></div>

  </div>
</div>

<script type="text/javascript">

  function show_navs() {
	var pos = '170px';
	var nav = document.getElementById('nav');
	var content = document.querySelector('.ifm_container');
	var dislpayArrow = document.querySelector('.dislpayArrow');

	if (nav.style.width == '0px') {
	  nav.style.width = pos;
	  content.style.left = pos;
	  dislpayArrow.style.left = pos;
	  dislpayArrow.querySelector('.icon1').className = 'icon';
	}
	else {

	  nav.style.width = '0px';
	  content.style.left = '0px';
	  dislpayArrow.style.left = '0px';
	  dislpayArrow.querySelector('.icon').className = 'icon1';
	}


  }


  function show_tabs(num) {
	var list = document.querySelector('#nav').querySelectorAll('.level_1');
	for (var i = 0; i < list.length; i++) {
	  if (i == num) {


		if (document.getElementById('menu_' + i).className == 'level_1 current')
		  document.getElementById('menu_' + i).className = 'level_1';
		else
		  document.getElementById('menu_' + i).className = 'level_1 current'


	  }
	  else {
		document.getElementById('menu_' + i).className = 'level_1';

	  }
	}
  }

  function set_li(div) {
	var li = document.getElementsByName('menuli');
	for (var i = 0; i < li.length; i++) {
	  li[i].className = '';

	}
	div.className = 'cur';

  }

  function tips_pop(show, content) {

	var MsgPop = document.getElementById("winpop1");//获取窗口这个对象,即ID为winpop的对象
	document.getElementById('msg_con').innerHTML = content;
	if (show == 'up') {         //如果窗口的高度是0
	  MsgPop.style.display = "block";//那么将隐藏的窗口显示出来

	}
	else {         //否则
	  MsgPop.style.display = "none";

	}

  }

  function tips_pop2(show, content) {

	var MsgPop = document.getElementById("winpop2");//获取窗口这个对象,即ID为winpop的对象
	document.getElementById('msg_con2').innerHTML = content;
	if (show == 'up') {         //如果窗口的高度是0
	  MsgPop.style.display = "block";//那么将隐藏的窗口显示出来

	}
	else {         //否则
	  MsgPop.style.display = "none";

	}

  }

  function tips_pop3(show, content) {

	var MsgPop = document.getElementById("winpop3");//获取窗口这个对象,即ID为winpop的对象
	document.getElementById('msg_con3').innerHTML = content;
	if (show == 'up') {         //如果窗口的高度是0
	  MsgPop.style.display = "block";//那么将隐藏的窗口显示出来

	}
	else {         //否则
	  MsgPop.style.display = "none";

	}

  }

  function changeH(str) {
	var MsgPop = document.getElementById("winpop");
	var popH = parseInt(MsgPop.style.height);
	if (str == "up") {     //如果这个参数是UP
	  if (popH <= 150) {    //如果转化为数值的高度小于等于100
		MsgPop.style.height = (popH + 4).toString() + "px";//高度增加4个象素
	  }
	  else {
		clearInterval(show);//否则就取消这个函数调用,意思就是如果高度超过100象度了,就不再增长了
	  }
	}
	if (str == "down") {
	  if (popH >= 4) {       //如果这个参数是down
		MsgPop.style.height = (popH - 4).toString() + "px";//那么窗口的高度减少4个象素
	  }
	  else {        //否则
		clearInterval(hide);    //否则就取消这个函数调用,意思就是如果高度小于4个象度的时候,就不再减了
		MsgPop.style.display = "none";  //因为窗口有边框,所以还是可以看见1~2象素没缩进去,这时候就把DIV隐藏掉
	  }
	}
  }

  function sound(file) {

	var str = "<embed src='" + file + "' style='display:none;' id='sound_mp3'>";
	return str;
  }

  var showsound = true;

  function set_sound() {

	document.getElementById('sound_bg').innerHTML = '';
	document.getElementById('msg_con').className = 'mp32';
	showsound = false;
  }

  function cheeck_recharge() {
	if (window.ActiveXObject) {
	  xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
	}
	else if (window.XMLHttpRequest) {
	  xmlHttp = new XMLHttpRequest();
	}

	xmlHttp.open('GET','index.aspx?flag=yes&no_task=1&controller=do&action=GetPopup&paths=adminxp&cate=recharge',true);
	xmlHttp.onreadystatechange = function () {
	  if (xmlHttp.readyState == 4) {
		var response = xmlHttp.responseText;
		var innerHTML = '';
		var nexturl = '';
		var sounds = "";

		var arr = response.split("|");
		if (arr[0] > 0) {
		  var loop = 1;
		  nexturl = "./?controller=user&action=recharge";
		  sounds = "chongzhi.mp3";
		  loop = 2;
		  var title = '充值记录';
		  innerHTML = "<a onclick=\"window.open('" + nexturl + "','iframe-main');\"  ><span id='popupid'>提示：你有<span style='color:#ff0000;'>" + arr[0] + "</span>条未处理的充值";
		  innerHTML += "<br><br><span style='text-decoration:underline;padding-left:50px;'>点击查看</span></span></a>";


		  document.getElementById('recharge_num').innerHTML = arr[0];
		  document.getElementById('sound_bg').style.display = 'block';
		  document.getElementById('sound_bg').innerHTML = "<video controls=\"controls\" src='../static/sound/" + sounds + "' autoplay style='display:none '></vedio>";

		  if (arr[2] > 0) {

			// tips_pop('up', innerHTML);
		  } else {

			tips_pop('down', '');

		  }


		  document.getElementById('winpop1').style.bottom = '0px';

          // tips_pop('up',innerHTML);

		}
		else {

		  tips_pop('down', '');
		  document.getElementById('recharge_num').innerHTML = 0;
		  document.getElementById('sound_bg').innerHTML = '';
		}


		if (arr[1] > 0) {
		  var loop = 1;
		  nexturl = "./?controller=user&action=platform";
		  sounds = "tikuan.mp3";
		  loop = 2;
		  var title = '提现记录';
		  innerHTML = "<a onclick=\"window.open('" + nexturl + "','iframe-main');\"  style='clear:both;cursor:pointer;'><span id='popupid'>提示：你有<span style='color:#ff0000;'>" + arr[1] + "</span>条未处理的提现";
		  innerHTML += "<br><br><span style='text-decoration:underline;padding-left:50px;'>点击查看</span></span></a>";
		  document.getElementById('platform_num').innerHTML = arr[1];

		  document.getElementById('sound_bg').style.display = 'block';
		  document.getElementById('sound_bg').innerHTML = "<video controls=\"controls\" src='../static/sound/" + sounds + "' autoplay style='display:none '></vedio>";
		  if (arr[3] > 0) {

			// tips_pop2('up', innerHTML);
			document.getElementById('winpop1').style.bottom = '0px';
			if (arr[2] > 0)
			  document.getElementById('winpop1').style.bottom = '155px';


		  } else {
			// tips_pop2('down', innerHTML);

		  }


		}
		else {

		  tips_pop2('down', '');
		  document.getElementById('platform_num').innerHTML = 0;
		  if (arr[0] == 0) document.getElementById('sound_bg').innerHTML = '';
		}

		if (arr[4] > 0) {

		  var loop = 1;

		  nexturl = "./?controller=user&action=msg&type=to";
		  sounds = "charge.wav";
		  loop = 2;
		  var title = '收件箱';
		  innerHTML = "<a onclick=\"window.open('" + nexturl + "','iframe-main');\"  style='clear:both;cursor:pointer;'><span id='popupid'>提示：你有<span style='color:#ff0000;'>" + arr[4] + "</span>条未读消息";
		  innerHTML += "<br><br><span style='text-decoration:underline;padding-left:50px;'>点击查看</span></span></a>";
		  document.getElementById('msg_num').innerHTML = arr[4];

		  document.getElementById('sound_bg').style.display = 'block';
		  document.getElementById('sound_bg').innerHTML = "<video controls=\"controls\" src='../static/sound/" + sounds + "' autoplay style='display:none '></vedio>";
		  if (arr[5] > 0) {

			// tips_pop3('up', innerHTML);
			document.getElementById('winpop3').style.bottom = '0px';
			if (arr[2] > 0 || arr[3] > 0)
			  document.getElementById('winpop3').style.bottom = '155px';
			if (arr[2] > 0 && arr[3] > 0)
			  document.getElementById('winpop3').style.bottom = '310px';


		  } else {
			tips_pop3('down', innerHTML);

		  }


		}
		else {

		  tips_pop3('down', '');
		  document.getElementById('msg_num').innerHTML = 0;
		  if (arr[0] == 0 && arr[1] == 0) document.getElementById('sound_bg').innerHTML = '';
		}


	  }

	};
	xmlHttp.send(null);


  }

  function check_online() {

	cheeck_recharge();

  }


  check_online();
  setInterval("check_online()", 6000);

  function setCookie(name, value) {
	var Days = 30;
	var exp = new Date();
	exp.setTime(exp.getTime() + Days * 24 * 60 * 60 * 1000);
	document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString();
  }

  function set_color(color) {
	document.getElementById('header').style.background = color;
	setCookie('admin_color', color);
  }


</script>

<div id="winpop1" class='winpop' style='height:150px;bottom:155px;'>
  <div class="title">充值提醒</div>


  <div id="msg_con" class='msg_con'></div>
</div>


<div id="winpop2" class='winpop' style='height:150px;'>
  <div class="title">提现提醒</div>


  <div id="msg_con2" class='msg_con'></div>
</div>
<div id="winpop3" class='winpop' style='height:150px;'>
  <div class="title">消息提醒</div>


  <div id="msg_con3" class='msg_con'></div>
</div>


<div id="sound_bg" style='display:none;'></div>

<!--end-main-container-part-->


<script src="style/mar-admin/js/jquery.min.js"></script>


<script type="text/javascript">

  //初始化相关元素高度
  function init() {
	$("body").height($(window).height() - 80);
	$("#iframe-main").height($(window).height() - 100);

  }

  $(function () {
	init();
	$(window).resize(function () {
	  init();
	});
    $('.tabMenu').click(function() {
      var href = $(this).attr('data-href');
      var i = -1;
      $('#iframe-main div').each(function(index) {
      	if ($(this).find('iframe').attr('src') == href) {
          i = index;
          return false;
        }
      });
      $('.tags-view-content .tag').removeClass('active');
      $("#iframe-main div").removeClass('active');
      if (i == -1) {
      	$('#iframe-main').append('<div class="iframe active"><iframe src="'+ href +'" frameborder="0"></iframe></div>');
        var name = $(this).contents().filter(function(){ return this.nodeType == 3; }).text();
        if ($(this).contents()[0].className == 'icon-user') {
          name = '编辑个人信息';
        }
      	$('.tags-view-content').append('<div class="tag active"> <span class="tag-dot-inner"></span>'+ name +' <span class="tag-close">x</span></div>');
        return;
      }
      if ($(this).hasClass('refresh')) {
        var iframeSrc = $('#iframe-main iframe').eq(i).attr('src');
        $('#iframe-main div').eq(i).find('iframe').attr('src', iframeSrc);
      	// $('#iframe-main iframe').eq(i)[0].contentWindow.location.reload(true);
      }
      $('#iframe-main div').eq(i).addClass('active');
      $('.tags-view-content .tag').eq(i).addClass('active');
    });
    
    
    $('.tags-view-content').on('click', '.tag', function() {
   	  var index = $('.tags-view-content .tag').index(this);
      $("#iframe-main .iframe").removeClass('active');
      $('.tag').removeClass('active').eq(index).addClass('active');
      $('#iframe-main .iframe').eq(index).addClass('active');
    });
    
    $('.tags-view-content').on('click', '.tag-close', function(e) {
      e.stopPropagation(); 
   	  var index = $('.tags-view-content .tag-close').index(this) + 1;
      $('.tag').eq(index).remove();
      $('#iframe-main .iframe').eq(index).remove();
      if ($(this).parent().hasClass('active')) {
        $('.tag').removeClass('active').eq(index - 1).addClass('active');
        $('#iframe-main .iframe').removeClass('active').eq(index - 1).addClass('active');
      }
    });
    
    $('.closeAll').click(function() {
      // $('#iframe-main .iframe').removeClass('active').eq(0).addClass('active');
      $('#iframe-main .iframe iframe').not('[name=iframe-main]').parent().remove();
      $('#iframe-main .iframe').eq(0).addClass('active')
      $('.tag').removeClass('active').eq(0).addClass('active');
      $('.tag').not('.active').remove();
      $('.tags-view-content').scrollLeft(0);
    });
    
    $('.closeOther').click(function() {
      $('.tags-view-content').scrollLeft(0);
      $('.tag').each(function(index) {
        if (index != 0 && !$(this).hasClass('active')) {
          $(this).remove();
          $('#iframe-main div').eq(index).remove();
        }
      })
    });
    
    $('.menuPay').click(function() {
      $('#iframe-main .iframe.active iframe')[0].contentWindow.winPop({title:'用户充值',width:'700',drag:'true',height:'300',url:'index.aspx?controller=user&action=pay'})
    });
    
    $('.tags-view-reload').click(function() {
      $('#iframe-main .iframe.active iframe')[0].contentWindow.location.reload(true);
    });
    
  });

  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage(newURL) {
	// if url is empty, skip the menu dividers and reset the menu selection to default
	if (newURL != "") {
	  // if url is "-", it is this page -- reset the menu:
	  if (newURL == "-") {
		resetMenu();
	  }
	  // else, send page to designated URL
	  else {
		document.location.href = newURL;
	  }
	}
  }

  // resets the menu selection upon entry to this page:
  function resetMenu() {
	document.gomenu.selector.selectedIndex = 2;
  }


  // uniform使用示例：
  // $.uniform.update($(this).attr("checked", true));
</script>
</body>
</html>
