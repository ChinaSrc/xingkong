function DialogAlert(title)
{
	Dialog.alert(title);
}
function DialogConfirm(title)
{
	Dialog.confirm('您确认要'+title+'吗？',function(){});
}
function DialogResetWindow(title,url,width,height)
{
	var diag = new Dialog();
	diag.Width = parseInt(width,10);
	diag.Height = parseInt(height,10);
	diag.Title = title;
	diag.URL = url;
	diag.show();
}