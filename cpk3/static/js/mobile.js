function show_game_codes(){
if(document.querySelector('.navbar_header_bg').style.display=='none'){
    document.querySelector('.navbar_header_bg').style.display='block';
    document.getElementById('wanfabg').style.display='block';
    document.querySelector('.wf_info').querySelector('i').className='icon-up-open';
}
else{
    document.querySelector('.navbar_header_bg').style.display='none'
    document.getElementById('wanfabg').style.display='none';
    document.querySelector('.wf_info').querySelector('i').className='icon-down-open';

}



}


function set_nav_position(){

var div=document.getElementById('code_'+G('code_item').innerHTML);

// var left=div.offsetLeft
// var top=parseInt(div.offsetTop)+85;

//G('lt_samll_label').style.top=top+'px';


}


function set_mode11(){

var arr=Array('元','角');
var arr1=Array('yuan','jiao');
var a=document.querySelector('.moneyUnit').querySelectorAll('a');
var md=arr[0];
for(var i=0;i<a.length;i++){
    if(a[i].className=='curr')  {md=a[i].innerHTML;}


}

for(var i=0;i<arr.length;i++){
if(arr[i]==md){

if(i+1>=arr.length)  var temp=0;
else var temp=i+1;
    for(var j=0;j<a.length;j++){
        if(a[j].innerHTML==arr[temp]) {
            a[j].className='curr'
        }
        else a[j].className='';
    }

select_mode(arr1[temp]);
break;
}

}

}



function show_shopcar(){

if(document.getElementById('shopcar').style.display=='none'){

document.getElementById('shopcar').style.display='block';
}
else document.getElementById('shopcar').style.display='none';


}


function game_showmore(){

if(document.getElementById('game_bottom').className=='game_hide'){

	document.getElementById('BgDiv').style.display='block';
	document.getElementById('game_bottom').className='game_show';
}
else {

	document.getElementById('BgDiv').style.display='none';
	document.getElementById('game_bottom').className='game_hide';

}
    if(document.getElementById('gameToggle').style.display=='block'){

        document.getElementById('gameToggle').style.display='none'
        document.getElementById('arrow-down2').className='xia';
    }
}

function show_help(){

if(document.getElementById('lt_desc').style.display=='block'){

document.getElementById('help_bg').style.display='none';
document.getElementById('lt_desc').style.display='none';
}
else{

document.getElementById('help_bg').style.display='block';
document.getElementById('lt_desc').style.display='block';



}

}

function show_nextgame() {
    var body = document.getElementById('bg-base');
    body.style.overflow = 'hidden';
    var gameToggle = document.getElementById('gameToggle');
    var arrowDdown2 =  document.getElementById('arrow-down2');
	if(gameToggle.style.display=='none'){
        gameToggle.style.display='block'
        gameToggle.style.height='100%';
        gameToggle.style.overflow='scroll';
        arrowDdown2.className='shang';

	}
	else{
        body.style.overflow = 'auto';
        gameToggle.style.display='none'
        document.getElementById('arrow-down2').className='xia';
	}
}

function show_history() {

	if(document.querySelector('.lottery-order').style.display=='block'){
        document.querySelector('.lottery-order').style.display='none';

	}
	else{
        document.querySelector('.lottery-order').style.display='block'	;

	}
	
}