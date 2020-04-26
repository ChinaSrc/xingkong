$(function(){
  $(document).on('mouseenter', '#global-zeroclipboard-html-bridge', function(){
    $('#toolbar .screen').addClass('toolbar-active');
    $('#J-side-bar').addClass('J-side-bar-acive');
  });
  $(document).on('mouseleave', '#global-zeroclipboard-html-bridge', function(){
    $('#toolbar .screen').removeClass('toolbar-active');
    $('#J-side-bar').removeClass('J-side-bar-acive');
  });
  $(document).on('click', '.refresh', function(){
    //自动刷新
    $.ajax({
      url: 'newgame_play.shtml@tag=getuserbalance',
      dataType: 'json',
      method: 'GET',
      success: function(r) {
          if (Number(r['isSuccess']) == 1) {
             $('.J-balance-show').text(r['availablebalance']);
          }
      }
    });
  });
   // if hideAmt is click, set cookie state to hide || show. Also toggle amount DOM
   var currentState;
   $(".hideAmt").unbind('click').bind('click', function(){
      var allcookies = document.cookie
      var newState;
      cookiearray = allcookies.split(';')
      for(var i=0; i<cookiearray.length; i++){
        if(cookiearray[i].indexOf("state")===1){
          currentState = cookiearray[i].split("=")[1]
          break;
        }
      }
      if(currentState==="hide"){
        newState = "show"
      } else {
        newState = "hide"
      }
      document.cookie = "state=" + newState + ";"
      $('.J-balance-show').toggle();
      $('.J-balance-star').toggle();
      $('.refresh').toggle();
      var src = $(this).attr('src');
      var newsrc = (src== window['CDN'] + '/sy2/images/matt/eye-open-white.png') ? window['CDN'] + '/sy2/images/matt/eye-close-white.png' : window['CDN'] + '/sy2/images/matt/eye-open-white.png';
      $(this).attr('src', newsrc);
    }
  )
  // When web page reload get state value from cookie, if state is show, show amount. If state is hide, hide amount
  if (document.readyState === "interactive"){
    var allcookies = document.cookie
    cookiearray = allcookies.split(';')
    for(var i=0; i<cookiearray.length; i++){
      if(cookiearray[i].indexOf("state")===1){
        currentState = cookiearray[i].split("=")[1]
      }
    }
    if(currentState==="show"){
      $(".hideAmt").attr('src', window['CDN'] + '/sy2/images/matt/eye-open-white.png');
      $('.J-balance-show').show()
      $('.J-balance-star').hide()
      $('.refresh').show()
    } else {
      $(".hideAmt").attr('src', window['CDN'] + '/sy2/images/matt/eye-close-white.png');
      $('.J-balance-show').hide()
      $('.J-balance-star').show()
      $('.refresh').hide()
    }
  }
});
//警告视窗
function styleAlert(message) {
  var height = $(document).height();
  $alert = $(
    '<div class="j-ui-miniwindow pop w-9" style="z-index: 700; position: fixed; display: block; left: 0; top:0; bottom:0; right:0; margin:auto; height:150px;"><div class="hd"><i class="close closeBtn"></i><span class="title">温馨提示</span></div><div class="bd"><div class="bd text-center"><div class="pop-waring"><i class="ico-waring <#=icon-class#>"></i><h4 class="pop-text" style="max-width:310px"><span>' +
    message +
    '</span><br></h4></div></div></div><a style="display: none;" href="javascript:void(0);" class="btn confirm">确 认<b class="btn-inner"></b></a><a style="display: none;" href="javascript:void(0);" class="btn cancel">取 消<b class="btn-inner"></b></a><a href="javascript:void(0);" style="display: inline-block;" class="btn closeTip">关 闭<b class="btn-inner"></b></a></div><div class="j-ui-mask" style="position: absolute; left: 0px; top: 0px; opacity: 0.5; z-index: 600; width: 100%; height: '+height+'px; display: block; background-color: rgb(51, 51, 51);"></div>'
  );
  $(parent.document).find("body").append($alert);
  $(parent.document).find(".closeTip, .closeBtn").click(function() {
    $(parent.document).find($alert).remove();
  })
}
function SetHome(obj,url){
  try{
    obj.style.behavior='url(#default#homepage)';
    obj.setHomePage(url);
  }catch(e){
    if(window.netscape){
      try{
        netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
      }catch(e){
        styleAlert("抱歉，此操作被浏览器拒绝！\n\n请在浏览器地址栏输入“about:config”并回车然后将[signed.applets.codebase_principal_support]设置为'true'");
      }
    }else{
      styleAlert("抱歉，您所使用的浏览器无法完成此操作。\n\n您需要手动将【"+url+"】设置为首页。");
    }
  }
}
// IE11 沒有使用權限...所以這個 function 除了 Mozilla 可以用之外 都只是提示 Ctrl+D
function add_favorite(e) {
    var title = $(e).attr("data-url");
    var url = $(e).attr("data-title");
    var ctrl = navigator.userAgent.toLowerCase().indexOf("mac") != -1 ? "Command/Cmd" : "CTRL";

    // if (window.external && "addFavorite" in window.external) {
    try {
        if (window.external || document.all) {
            // 下面這個沒效囉...無存取權限
            // window.external.AddFavorite(url, title);
            styleAlert(translate.CollectionURL.replace("##CTRL##", ctrl));
        } else if (window.sidebar && window.sidebar.addPanel) {
            // for Mozilla
            window.sidebar.addPanel(url, title);
            // } else if (window.opera && window.print) {
            //   // for opera or mac user ??
            //   styleAlert(translate.CollectionURL.replace('##CTRL##',ctrl));
        } else {
            // mac
            styleAlert(translate.CollectionURL.replace("##CTRL##", ctrl));
            // styleAlert('您可以尝试通过快捷键 ' + ctrl + ' + D 加入到收藏夹~');
            //window.alert("因为IE浏览器存在bug，添加收藏失败！\n解决办法：在注册表中查找\n HKEY_CLASSES_ROOT\\TypeLib\\{EAB22AC0-30C1-11CF-A7EB-0000C05BAE0B}\\1.1\\0\\win32 \n将 C:\\WINDOWS\\system32\\shdocvw.dll 改为 C:../file@//WINDOWS//system32//ieframe.dll ");
            // styleAlert("抱歉，您所使用的浏览器无法完成此操作。请手动添加。")
        }
    } catch (error) {
        styleAlert(translate.CollectionURL.replace("##CTRL##", ctrl));
    }
}
