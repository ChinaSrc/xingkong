var iframes = [],
  players = [];
$(function() {
  $(".videoDialog")
    .dialog({ autoOpen: !1, modal: !0, width: "685", height: "450" })
    .prev(".ui-dialog-titlebar")
    .css("color", "#93d20d", "font-size", "16px");
}), $(function() {
  $('a[id^="opener"]').each(function() {
    var i = $(this).prop("id").match(/\d+/g)[0];
    (iframes[i] = $("#dialog" + i + " iframe")), $(
      this
    ).on("click", function() {
      iframes[i].attr("src") ||
        iframes[i].attr("src", function() {
          return $(this).data("src");
        }), (players[i] = new Vimeo.Player(
        iframes[i]
      )), $("#dialog" + i).dialog("open"), players[i].l || (players[i].play(), (players[i].l = !0));
    });
  }), $(".ui-dialog-titlebar-close").click(function() {
    var i = $(this)
        .parent("div.ui-dialog-titlebar")
        .next("div.videoDialog:eq(0)"),
      a = i.prop("id").match(/\d+/g)[0];
    players[a].pause();
  });
});
