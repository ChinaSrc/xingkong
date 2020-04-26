//var id=arrPlayList['5X_ds'].content;

function combination(arr/*n需要组合的一维数组*/, num/*m需要取几个元素来组合*/, fun/*对组合后的元素的处理函数，如全排列permutate*/) {
    /*这里假设num最大值为10 一般A(n,m)中的m应该不会太大 */
    if (arr.length < num || num > 10) {
        return [];
    }
    var variable = ["a", "b", "c", "d", "e", "f", "g", "h", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u"];
    var replaceStr = "#$#";
    var str = " var arr=arguments[0]; var fun=arguments[1];  var ret=[]; for (var a = 0; a < arr.length; a++) { " + replaceStr + " } return ret;"
    for (var i = 1; i < num; i++) {
        str = str.replace(replaceStr, " for (var " + variable[i] + " =" + variable[i - 1] + "+ 1; " + variable[i] + " < arr.length; " + variable[i] + "++) { " + replaceStr + "  }")
    }
    var temp = " var temp= []; ";
    for (var i = 0; i < num; i++) {
        temp += "temp.push(arr[" + variable[i] + "]); ";
    }
    if (fun) {
        temp += " ret.push(fun(temp)); ";
    }
    else {
        temp += " ret.push(temp); ";
    }
    str = str.replace(replaceStr, temp);
    //console.log(str);
    return (new Function(str)).apply(null, [arr, fun]);
}

// var a = combination([1, 2, 3, 2,2], 3);

//alert(a.length);
var arr = [["0", "1", "2"], "0", ["0", "1"], ["0", "1", "2", "3"], ["1", '3']];
var arr2 = [];


function choose(arr, size) {
    var num = 0;
    var arr1 = Array();

    if (arr.length >= size) {


        for (var i = 0; i < arr.length; i++) {

            arr1[i] = arr[i].length;

        }

        var arr2 = combination(arr1, size);


        for (var i = 0; i < arr2.length; i++) {
            var c = 1;
            for (var j = 0; j < size; j++) {

                c = arr2[i][j] * c;
            }

            num = num + c;
        }

        return num;
    }
    else return 0;


}


var wei_check_value = '';
var lastlotTimer;

var buylist = '';
var buylist1 = '';
var quick_buy = '0';

var buyarr = new Array();

function set_buylist(str) {


    if (buylist == '') buylist = str;
    else buylist += "#" + str;


}

var sel_num = 0;
var sel_money = 0;

function message_top() {

    var sTop = document.body.scrollTop + document.documentElement.scrollTop;
    if (mobile == 1) sTop = 0;
    if (mobile == 1) {
        document.getElementById('messageDiv').style.top = '150px';
    }
    else {

        if (sTop > 120) {

            document.getElementById('gametipstime').style.display = 'block';
        }
        else {
            document.getElementById('gametipstime').style.display = 'none';
        }

    }

    document.getElementById('BgDiv').style.height = document.body.clientHeight + 'px';
    document.getElementById('buy_area').style.top = sTop + 140 + 'px';

//document.getElementById('lt_trace_box1').style.top=sTop+100+'px';
//document.getElementById('lt_trace_box2').style.top=sTop+100+'px';


}

function message_top1() {

    var sTop = document.body.scrollTop + document.documentElement.scrollTop;


    if (mobile != 1) {
        document.getElementById('BgDiv').style.height = document.body.clientHeight + 'px';
        //document.getElementById('messageDiv1').style.top=sTop+200+'px';
    }
    else
        document.getElementById('messageDiv1').style.top = 150 + 'px';
    document.getElementById('buy_area').style.top = 140 + 'px';


}


function add_code() {
    var title;
    var mode;
    var codekey;
    codeHTML = "";
    var currentcode = arrGameSet['firstcode'];


    try {
        //data=onparse[conf.name](data);
        var currentmode = arrCodes[currentcode].mode;
    } catch (err) {
        var currentmode = 'default';
    }
    //DialogAlert(currentmode);


    for (i = 0; i < arrGameCodes.length; i++) {


        if (currentcode == "") {
            currentcode = arrGameCodes[0];
            currentmode = arrCodes[currentcode].mode;
        }
        title = "";
        mode = "";
        codekey = "";
        codekey = arrGameCodes[i];
        var PrizeMax = prize_max(codekey);
        if (arrCodes[codekey]) {
            title = arrCodes[codekey].title;
            mode = arrCodes[codekey].mode;
            if (arrCodes[codekey].pid == 0) {

                if (mobile == 1) {

                    if (gametype == 'k3') {
                        var PrizeMin = prize_min(codekey);
                        if (PrizeMax == PrizeMin) {

                            var pri = PrizeMax;
                        } else {

                            var pri = PrizeMin + '-' + PrizeMax;
                        }
                        if (codekey.indexOf('2TH') > -1)

                            var img = "<img class='pd'src='static/images/ico/num-1.png'><img src='static/images/ico/num-1.png' class='pd'><img class='pd' src='static/images/ico/num-3.png'>";

                        else if (codekey.indexOf('3TH') > -1)
                            var img = "<img class='pd'src='static/images/ico/num-1.png'><img src='static/images/ico/num-1.png' class='pd'><img class='pd' src='static/images/ico/num-1.png'>";
                        else if (codekey.indexOf('2BT') > -1)
                            var img = "<img class='pd'src='static/images/ico/num-1.png'><img src='static/images/ico/num-4.png' class='pd'><img class='pd' src='static/images/ico/num-4.png'>";
                        else if (codekey.indexOf('3BT') > -1)
                            var img = "<img class='pd'src='static/images/ico/num-2.png'><img src='static/images/ico/num-3.png' class='pd'><img class='pd' src='static/images/ico/num-5.png'>";

                        else if (codekey == 'HZ-k3')
                            var img = "<img src='static/images/ico/num-1.png'>+<img src='static/images/ico/num-2.png' >+<img src='static/images/ico/num-3.png'>";

                        else
                            var img = "<img class='pd'src='static/images/ico/num-1.png'><img src='static/images/ico/num-2.png' class='pd'><img class='pd' src='static/images/ico/num-3.png'>";
                        codeHTML += "<a id='code_" + codekey + "' onclick=\"add_plays('" + codekey + "','" + mode + "','')   \" ><div class='title'>" + title + "</div><div class='prize'>" + pri + "倍</div><div class='img'>" + img + "</div></a>";

                    }


                    else
                        codeHTML += "<a id='code_" + codekey + "' onclick=\"add_plays('" + codekey + "','" + mode + "','')\"><div class='title'>" + title + "</div></a>";

                }
                else {


                    if (gametype != 'k3') var danwei = '元';
                    else var danwei = '';
                    codeHTML += "<a id='code_" + codekey + "' onclick=\"add_plays('" + codekey + "','" + mode + "','')\"><div class='title'>" + title + "</div><div class='prize'>最高<br>" + PrizeMax + danwei + "</div></a>";
                }

            }
        }
    }


    if (arrGameCodes.length == 1) {

//	G('game_codes').style.display='none';
    }
    if (mobile == 1 && gametype == 'k3') {
        G('game_codes').className = 'k3code';

    }
    G('game_codes').innerHTML = codeHTML;
    add_plays(currentcode, currentmode, '');
}

function prize_max(code) {
    //console.log(arrPlays[code]);

    var sum = 0;
    for (var p in arrPlays[code]) {
        var num = arrPlayList[p].prize;

        if (num.indexOf('|') > 0) {
            num = num.split('|');
            for (var i = 0; i < num.length; i++) {
                if (parseFloat(num[i]) > sum) sum = parseFloat(num[i]);
            }

        }
        else {

            if (parseFloat(num) > sum) sum = parseFloat(num);
        }


    }
    if (sum.toString().indexOf('.') > 0) sum = sum.toFixed(2);

    return sum;

}

function prize_min(code) {
    //console.log(arrPlays[code]);

    var sum = 9999999999;
    for (var p in arrPlays[code]) {
        var num = arrPlayList[p].prize;

        if (num.indexOf('|') > 0) {
            num = num.split('|');
            for (var i = 0; i < num.length; i++) {
                if (parseFloat(num[i]) < sum) sum = parseFloat(num[i]);
            }

        }
        else {

            if (parseFloat(num) < sum) sum = parseFloat(num);
        }


    }
    if (sum.toString().indexOf('.') > 0) sum = sum.toFixed(2);

    return sum;

}

var play_item = '';

var play_len = 0;
var play_num = 0;


var play_top = 0;
var play_left = 0;

function add_plays(item, modes, next) {

    var next_arr = '';
    var next_type = '';
    var next_old = next;
    for (var o in arrCodes) {

        if (arrCodes[o]['pid'] == item) {

            if (next == o) var classname = 'xsscwf2';

            else var classname = 'xsscwf1';

            if (next_type == '') next_type = o;
            next_arr += '<span class="' + classname + '" id=\'code_' + o + '\'  onclick="add_plays(\'' + item + '\',\'' + arrCodes[o]['mode'] + '\',\'' + o + '\');">' + arrCodes[o]['title'] + '</span>';
        }
    }


    /*根据item值进行玩法显示*/

    var code_div = G('game_codes');
    var a = code_div.getElementsByTagName("a");
    for (var j = 0; j < a.length; j++) {
        a[j].className = "";
    }


    G('code_' + item).className = 'cur';

    if (next) {
        item = next;
    }
    else {
        if (next_type != '') item = next_type;

    }

    clear_sel();
    selplay.code = arrCodes[item].title;
    selplay.coteid = item;
    var plays = arrPlays[item];

    play_item = item;

    var playid, CodeTile, ShowTile, Rebates;
    var lastCode = "";
    var playHTML = "";
    var codeshow = "";
    var itemHTML = "";
    var checkon = "";
    var endcodediv = "";
    var ids = 0;


    if (next_arr != '') {
        playHTML += '<div class="c-gjwfle" style="display:block;">玩法选择：' + next_arr + '</div>';


    }

    var game_cate = G('game_cate').innerHTML;
    var len = 0;
    var t1 = 0;
    var leve = 0;

    var temp = new Array();
    for (var ii in plays) {


        playid = plays[ii].playid;
        if (wanfa.indexOf(playid) > -1) {
            CodeTile = Trim(plays[ii].CodeTile);
            ShowTile = plays[ii].ShowTile;
            if (plays[ii].Rebates) {
                Rebates = plays[ii].Rebates;
            } else {
                Rebates = "Normal";
            }
            if (len - 1 < 0) {
                checkon = "checked";
                selplay.plays = ShowTile;
                add_input(playid, ShowTile, Rebates, modes);
                G('playid_hidden').innerHTML = playid;
            }
            else {
                checkon = "";
            }

            if (CodeTile != lastCode) {
                t1 += 1;
            } else {

                temp[leve] = t1;
                leve += 1;
                //t1=0;
                //t1+=1;
            }

            len += 1;


        }


    }

    play_len = len;
    var tt = 0;

    var num = 0;
    for (var i in plays) {


        playid = plays[i].playid;

        if (wanfa.indexOf(playid) > -1) {
            CodeTile = Trim(plays[i].CodeTile);
            ShowTile = plays[i].ShowTile;
            if (plays[i].Rebates) {
                Rebates = plays[i].Rebates;
            } else {
                Rebates = "Normal";
            }
            if (ids - 1 < 0) {
                checkon = "lable_cur";
                selplay.plays = ShowTile;
                add_input(playid, ShowTile, Rebates, modes, 0);
                G('playid_hidden').innerHTML = playid;
            }
            else {
                checkon = "lable";
            }
            if (CodeTile || len > 1) {

                itemHTML = ShowTile;

                if (mobile == 1) {
                    if (CodeTile == lastCode) {
                        //	if(ids==5  && play_item=='RXX')playHTML+="<br><span  style='width:65px;display:block;float:left;'>&nbsp;</span>";
                        playHTML += "<div   class='" + checkon + "'  id='tag_" + num + "'  onclick=\"add_input('" + playid + "','" + ShowTile + "','" + Rebates + "','" + modes + "','" + num + "');colse_game_codes();\"  >" + itemHTML + "</div>";
                    } else {
                        if (ids == 0) endcodediv = "<div class='playlist'>";
                        else {
                            if (ids == len) {
                                endcodediv = "</div></div>";

                            }
                            else {
                                endcodediv = "</div></div><div class='playlist'>";
                                tt++;
                            }

                        }

                        playHTML += endcodediv + "<span>" + CodeTile + "</span><div class='wanfa_item'><div class='" + checkon + "' id='tag_" + num + "'    onclick=\"add_input('" + playid + "','" + ShowTile + "','" + Rebates + "','" + modes + "','" + num + "');colse_game_codes();\">" + itemHTML + "</div>";
                        lastCode = CodeTile;

                    }


                }
                else {

                    if (CodeTile == lastCode) {
                        //	if(ids==5  && play_item=='RXX')playHTML+="<br><span  style='width:65px;display:block;float:left;'>&nbsp;</span>";
                        playHTML += "<div   class='" + checkon + "'  id='tag_" + num + "'  onclick=\"add_input('" + playid + "','" + ShowTile + "','" + Rebates + "','" + modes + "','" + num + "');colse_game_codes();\"  >" + itemHTML + "</div>";
                    } else {
                        if (ids == 0) endcodediv = "<div class='playlist'>";
                        else {
                            if (ids == len) {
                                endcodediv = "</div>";

                            }
                            else {
                                endcodediv = "</div><div class='playlist'>";
                                tt++;
                            }

                        }

                        playHTML += endcodediv + "<span>" + CodeTile + "</span><div class='" + checkon + "' id='tag_" + num + "'    onclick=\"add_input('" + playid + "','" + ShowTile + "','" + Rebates + "','" + modes + "','" + num + "');colse_game_codes();\">" + itemHTML + "</div>";
                        lastCode = CodeTile;

                    }


                }


                num++;
            }

            ids += 1;
        }
    }

    if (mobile == 1)
        playHTML += "</select>";
    else
        playHTML += "</div>";


    if (ids > 1 || gametype != 'k3') {
        G('lt_samll_label').innerHTML = playHTML;
        G('lt_samll_label').style.display = 'block';
    } else {


        G('lt_samll_label').style.display = 'none';
    }
    if (ids <= 1 && mobile == 1) {

        G('lt_samll_label').style.display = 'none'
        if (document.querySelector('.navbar_header_bg').style.display == 'block') show_game_codes();
    }


    if (next_type != '' && next_old == '')
        G('code_' + next_type).className = 'xsscwf2';
    G('code_item').innerHTML = item;
    //DialogAlert(item);

    if (mobile == 1) show_code_name();


}

var item_old = '';

function set_mobile_play(item) {

    var div = document.getElementById('code_' + item);

    set_nav_position();
    if (G('lt_samll_label').innerHTML != '') {
//G('lt_samll_label').className='small_show';


        div.select = 'selected';
    }
    else {
        colse_game_codes();
        //G('lt_samll_label').className='small_hide';
        div.className = '';
    }

    if (G('lt_samll_label').className == 'small_hide' || item_old != item) {
        div.select = 'selected';
    }

    item_old = item;
}


function colse_game_codes() {

    if (mobile == 1) {
        show_code_name();
        show_game_codes();
//G('lt_samll_label').className='small_hide';


    }
}

function show_code_name() {


    if (mobile == 1) {


        var show = arrCodes[G('code_item').innerHTML].title;
        if (gametype != 'k3') {
            if (show != arrPlays[G('code_item').innerHTML][G('playid_hidden').innerHTML].CodeTile)
                show += '' + arrPlays[G('code_item').innerHTML][G('playid_hidden').innerHTML].CodeTile;
            show += '' + arrPlays[G('code_item').innerHTML][G('playid_hidden').innerHTML].ShowTile;

        }

        G('show_game_codes').innerHTML = show;
        document.getElementById('game_item_title').innerHTML = show;


    }

}


var play_id = '';

function add_input(item, titles, rebates, modes, num) {

    try {
        for (var i = 0; i < play_len; i++) {
            if (i == num) {

                document.getElementById('tag_' + i).className = 'lable_cur';

            }
            else {
                document.getElementById('tag_' + i).className = 'lable';


            }


        }
    }
    catch (e) {

    }


    play_id = item;
    /*根据mode值进行自由或固定模式处理*/
    if (modes == "fix") {
        isAutoForPlay = "no";
        if (G('SelectAutoMode')) {
            G('SelectAutoMode').style.display = "none";
        }
    } else {
        isAutoForPlay = "yes";
    }


    //ResetMode(modes)
    clear_sel();
    selists = [];

    var plays = arrPlayList[item];

//DialogAlert(plays.shownum);

    G('lt_examples_div').innerHTML = plays.example;
    if (plays.example !== '') G('lt_example').style.display = 'inline-block';
    else G('lt_example').style.display = 'none';


    G('lt_helps_div').innerHTML = plays.help;
    if (plays.help !== '') G('lt_help').style.display = 'inline-block';
    else G('lt_help').style.display = 'none';

    var pri_temp = arrPlayPri[plays.playid].prize;
    if (pri_temp.indexOf('|') > 0) {
        var min = 9999999999;
        var max = 0;
        var arr1 = pri_temp.split("|");
        for (var i = 0; i < arr1.length; i++) {
            if (parseFloat(arr1[i]) > max) max = parseFloat(arr1[i]);
            if (parseFloat(arr1[i]) < min) min = parseFloat(arr1[i]);

        }
        if (min.toString().indexOf('.') > 0) min = parseFloat(min).toFixed(2);
        if (max.toString().indexOf('.') > 0) max = parseFloat(max).toFixed(2);
        if (min == max) {
            var pri_str = max;

        }
        else var pri_str = min + '- ' + max;
    }
    else
        var pri_str = arrPlayPri[plays.playid].prize;
    if (mobile == 1) {

        pri_str = "";

    } else {
        if (gametype == 'k3')
            pri_str = "赔率<span class='red'>" + pri_str + "</span>倍";
        else
            pri_str = "奖金<span class='red'>" + pri_str + "</span>元";
    }

    G('lt_desc').innerHTML = plays.content + pri_str;
    G('lt_selector').innerHTML = "";

    try {
        var pri_temp = arrPlayPri[plays.playid].prize;
        if (pri_temp.indexOf('|') > 0) {
            var arr1 = pri_temp.split("|");
            G('prize_11').innerHTML = arr1[0];

        }
        else
            G('prize_11').innerHTML = arrPlayPri[plays.playid].prize;
    }
    catch (e) {

    }


    var linum = 0;
    var shownum = Trim(plays.shownum);
//	DialogAlert(shownum);
    var show_other = Trim(plays.show_other);
    var show_key = Trim(plays.show_key);
    /*playlist={playid:plays.playid,shownum:plays.shownum,minnum:plays.minnum,maxnum:plays.maxnum,show_key:plays.show_key,show_other:plays.show_other,max_select:plays.max_select,min_select:plays.min_select};
	*/

    G('playid_hidden').innerHTML = plays.playid;
    selplay.plays = titles;
    playlist.playid = plays.playid;
    playlist.shownum = plays.shownum;
    playlist.minnum = plays.minnum;
    playlist.maxnum = plays.maxnum;
    playlist.show_key = plays.show_key;
    playlist.show_other = plays.show_other;
    playlist.max_select = plays.max_select;
    playlist.min_select = plays.min_select;
    if (rebates != "") {
        selplay.retype = rebates;
    }
    //playlist:{playid:'',shownum:'',minnum:'',maxnum:'',show_key:'',show_other:'',max_select:'',min_select:''};

    //DialogAlert(plays.playid);
    var game_cate = G('game_cate').innerHTML;
//DialogAlert(shownum);
    if (play_item.indexOf('QP') > -1 || play_item == 'HZ-k3' || play_item.indexOf('QWX2') > -1) wanfa_cate = 'qw';
    else wanfa_cate = 'ct';

    if (wanfa_cate == 'qw') {


        G("lt_sel_insert").onclick = function () {
            qwinsertline()
        }
//console.log(rebates);
        add_input_qw(plays, rebates);


    }
    else {
        G("lt_sel_insert").onclick = function () {
            selinsertline()
        }
        if ((shownum == "0") && (show_other == "0") && (show_key == "0")) {


            if (play_item == 'TJZH') {


                add_input_tjzh(plays, rebates);
                G("lt_sel_insert").onclick = function () {
                    boxinsertline()
                }
            }
            else {
                //单式

                add_input_ds(plays, rebates);
                G("lt_sel_insert").onclick = function () {
                    boxinsertline()
                }
            }

        }

        if (show_key.length - 2 >= 0) {

            //特殊号码
            linum = add_input_key(plays, rebates);
        }
        if (show_other.length - 2 >= 0) {
            //和值


            add_input_other(plays, rebates);
        }
        if (parseInt(shownum) - 1 >= 0) {
            //复式

            add_input_shownum(plays, rebates, linum);
        }

    }
    show_select_mode(plays.playid);
    resetAutoMode();
    if (mobile == 0) {
        if (wanfa_cate == 'qw') {
            document.getElementById('lt_selbot').style.display = 'none';


        }
        else {

            document.getElementById('lt_selbot').style.display = 'block';


        }


    }


    //set_game_xingtai();
}


function set_game_xingtai() {

    if (mobile == 1) return false;

    //alert(play_id);

    if (play_item == '3X1' || play_item == '3X2' || play_item == '3X3' || play_item == 'BDW' || play_item == 'DXDS') {
        var str = '';
        $("#historylot tr").each(function (i) {
            //console.log($(this).html());

            var reg = /<td>.*?<\/td>/g;
            var arr = $(this).html().match(reg);
            var temp = arr[1];

            temp = temp.toString().substr(14, temp.length - 31);

            var number = temp.split('</em><em>');
            //console.log(number);
            var num = -1;
            var result = '';
            if (play_item == '3X1' || play_id == 'BDW_qsym' || play_id == 'BDW_qsem') num = 0;
            if (play_item == '3X2' || play_id == 'BDW_hsym' || play_id == 'BDW_hsem') num = 2;
            if (play_item == '3X3') num = 1;
            if (num > -1) {
                if (number[num] == number[num + 1] || number[num] == number[num + 2] || number[num + 1] == number[num + 2]) {

                    result = '组三';

                }
                else {
                    result = '组六';
                }

            }
            if (play_id == 'DXDS_qedx') {
                if (number[0] >= 5) result += '大'; else result += "小";
                if (number[1] >= 5) result += '大'; else result += "小";
                if (number[0] % 2 == 1) result += '单'; else result += "双";
                if (number[1] % 2 == 1) result += '单'; else result += "双";

            }
            if (play_id == 'DXDS_hedx') {
                if (number[3] >= 5) result += '大'; else result += "小";
                if (number[4] >= 5) result += '大'; else result += "小";
                if (number[3] % 2 == 1) result += '单'; else result += "双";
                if (number[4] % 2 == 1) result += '单'; else result += "双";

            }


            if (result != '')
                str += "<tr>" + arr[0] + arr[1] + "<td><span>" + result + "</span></td></tr>";
            else str += "<tr>" + arr[0] + arr[1] + "</tr>";

        })

        if (play_item == 'DXDS')
            document.getElementById('show_xingtai').innerHTML = '大小单双';
        else document.getElementById('show_xingtai').innerHTML = '形态';

        document.getElementById('historylot').innerHTML = str;
        document.getElementById('show_xingtai').style.display = 'none';
        // console.log(str);
    }
    else {
        var str = '';
        $("#historylot tr").each(function (i) {
            //console.log($(this).html());

            var reg = /<td>.*?<\/td>/g;
            var arr = $(this).html().match(reg);
            str += "<tr>" + arr[0] + arr[1] + "</tr>";

        })


        document.getElementById('historylot').innerHTML = str;
        document.getElementById('show_xingtai').style.display = 'none';
    }


    //console.log(play_item);

}


function show_select_mode(playid) {
    var modes = getselectValue(G('lt_project_modes'));
    var user_mode = selplay.CurMode;
    var fandian = (user_mode - 1800) / 20;
    //  console.log(playid);
    // console.log(arrPlayPri);
    var prize = arrPlayPri[playid].prize;
    var temp = arrPlayList[playid].show_key;
    if (prize.indexOf('|') > 0 && temp.indexOf('|') > 0) {
        var strs = prize.split("|");

        temp = temp.split("|");
        var str = '';


        var html = '<option value="' + user_rebate + '">返点模式-' + user_rebate + '%</option>';
    }
    else {
        if (prize.indexOf('|') > 0) {
            var strs = prize.split("|");
            prize = strs[0];
        }

        if (modes == "jiao") {
            prize = prize / 10;
        }
        if (modes == "fen") {
            prize = prize / 100;
        }
        if (modes == "li") {
            prize = prize / 1000;
        }


        var html = '<option value="' + user_rebate + '">' + prize + '-0%</option>';
        document.getElementById('lt_prize').style.display = 'none';

    }


    G('select_mode').innerHTML = html;
}


add_code();
lastlotTimer = window.setTimeout("Ajax_last_lotnum()", 500);
if (G('SelectAutoMode')) {
    new zzjs_net('btn', 'bar', 'title');
}

if (selplay.CurModeType == "auto") {
    selectSetItem(G('primode'), 'auto');
    if (G('SelectAutoMode')) {
        G('SelectAutoMode').style.display = "";
    }
    resetAutoMode();
} else {
    selectSetItem(G('primode'), selplay.CurMode);
    if (G('SelectAutoMode')) {
        G('SelectAutoMode').style.display = "none";
    }
}

function clear_sel() {
    var item = G('code_item').innerHTML;

    var code_item = document.getElementsByName('code_' + item);

    for (var i = 0; i < code_item.length; i++) {

        if (code_item[i].checked) {

//	code_item[i].click();

        }


    }

    selists = new Array();
    G("lt_sel_nums").innerHTML = "0";
    G("lt_sel_money").innerHTML = "0";
    G("lt_prize_money").innerHTML = "0";
    G("lt_prize_money11").innerHTML = "0";
    G("base_num").value = '0';
    if (mobile == 1 && gametype != 'k3') {

        document.getElementById('lt_sel_insert').querySelector('span').style.color = '#fff';

    }
    sel_nums = 0;
    sel_money = 0;
    G('lt_trace_stop').checked = true;
    if (wanfa_cate == 'qw') {
        var div_line = document.querySelector('#xcaiconter').querySelectorAll('.kk');

        for (var i = 0; i < div_line.length; i++) {

            if (div_line[i].className == 'kk kkon') {
                div_line[i].click();

            }

        }

    }

    for (i = 0; i < 10; i++) {
        for (j = 0; j < 80; j++) {
            if (G("select_" + i + "_" + j)) {
                lastcss = G("select_" + i + "_" + j).className;
                newcss = get_css(lastcss, "nocheck");
                G("select_" + i + "_" + j).className = newcss;
            }
        }
    }


}

function count_select_arr() {
    selists = new Array();
    var shownum = 0;
    var minnum = 0;
    var maxnum = 0;
    var Objs;
    var n = 0;
    var newlines = 0;
    var playid = playlist.playid;


    if (playlist.show_other.indexOf("|") > 0 || playlist.show_other.length > 1) {
        var arrs = playlist.show_other.split("~");
        for (i = 0; i < arrs.length; i++) {
            var arrlist = arrs[i].split("|");
            minnum = parseInt(arrlist[0]);
            maxnum = parseInt(arrlist[arrlist.length - 1]);
            selists[i] = new Array();
            n = 0;
            for (j = minnum; j <= maxnum; j++) {
                if (G("select_" + i + "_" + j)) {
                    Objs = G("select_" + i + "_" + j);
                    if (Objs.className.indexOf("cur") > 0) {
                        selists[i][n] = Objs.innerHTML;
                        n += 1;
                    }
                }
            }
        }
    }
    if (playlist.show_key.indexOf("|") > 0 || playlist.show_key.length > 1) {
        var arrs = playlist.show_key.split("~");
        for (i = 0; i < arrs.length; i++) {
            var arrlist = arrs[i].split("|");
            minnum = 0;
            maxnum = arrlist.length - 1;
            selists[i] = new Array();
            n = 0;
            for (j = minnum; j <= maxnum; j++) {
                if (G("select_" + i + "_" + j)) {
                    Objs = G("select_" + i + "_" + j);
                    if (Objs.className.indexOf("cur") > 0) {
                        selists[i][n] = Objs.innerHTML;
                        n += 1;
                    }
                }
            }
        }
        newlines = i;
    }
    shownum = parseInt(playlist.shownum, 10);
    minnum = parseInt(playlist.minnum, 10);
    maxnum = parseInt(playlist.maxnum, 10);
    if (shownum - 1 >= 0) {
        shownum += newlines;
        for (i = newlines; i < shownum; i++) {
            selists[i] = new Array();
            n = 0;
            for (j = minnum; j <= maxnum; j++) {
                if (G("select_" + i + "_" + j)) {
                    Objs = G("select_" + i + "_" + j);
                    if (Objs.className.indexOf("cur") > 0) {
                        selists[i][n] = Objs.innerHTML;
                        n += 1;
                    }
                }
            }
        }
    }

    count_select(selists);
}

function Count_Money() {


    if (mobile != 1) {

        document.querySelector('.choose-list').style.display = 'none';

    }

    var modes = getselectValue(G('lt_project_modes'));
    //	DialogAlert(modes);
    var times = selplay.times;//当前的倍数
    if (modes == "") {
        modes = "yuan";
    }
    var nums = parseInt(G("base_num").value, 10); //当前的注数

    if (wanfa_cate == 'qw') {
        var is_ok = "no";


        var TouZhuMoneys = document.getElementsByName('TouZhuMoneys');

        var prizeqw = document.getElementsByName('prize_qw11');


        for (i = 0; i < TouZhuMoneys.length; i++) {
            if (TouZhuMoneys[i].value > 0) {
                nums += parseFloat(TouZhuMoneys[i].value);
                prize += parseFloat(prizeqw[i].value);
            }

        }

        sel_nums = G("lt_sel_nums").innerHTML = nums;

        G("lt_sel_nums").innerHTML = nums;
        var lt_sel_nums = parseInt(G("base_num").value, 10);


    }
    else {

        var playid = G("playid_hidden").innerHTML;
        var pri_temp = arrPlayPri[playid].prize;

        if (pri_temp.indexOf('|') > 0) {
            var arr1 = pri_temp.split("|");
            var prize = arr1[0];

        }
        else
            var prize = arrPlayPri[playid].prize;


        prize = prize * G('select_mode').value / selplay.modes_sys;


        var fangan_num = 1;
        try {
            fangan_num = document.getElementById('fangan_num').innerHTML;

        }
        catch (e) {
            fangan_num = 1;
        }


        var is_ok = "no";
        G("lt_sel_money").innerHTML = "0";
        var lt_sel_nums = parseInt(G("base_num").value, 10);

        if (Is_str_type(lt_sel_nums, '1')) {
            is_ok = "yes"
        } else {
            return false;
        }

        nums = nums * fangan_num;
        sel_nums = G("lt_sel_nums").innerHTML = nums;


    }
    if (mobile == 1 && gametype == 'k3') {
        var moneys = 0;
        if (parseInt(document.getElementById('per_money').value) > 0) {

            moneys = nums * parseInt(document.getElementById('per_money').value);

        }

        sel_money = G("lt_sel_money").innerHTML = moneys.toFixed(2);

        if (nums > 0) {

            document.getElementById('randnumid').style.display = 'none';
            document.getElementById('clearid').style.display = 'inline-block';
        }
        else {

            document.getElementById('randnumid').style.display = 'inline-block';
            document.getElementById('clearid').style.display = 'none';

        }

        return true;


    }


    //  if (Is_str_type(lt_sel_nums,'1')){is_ok="yes"}else{times=1;}
    var moneys; //注数*倍数


    if (nums >= 1) {   //注数大于0时，才能有值

        if (modes == "yuan") {
            moneys = nums * times * 2;
        }
        if (modes == "jiao") {
            moneys = nums * times * 2 / 10;
            prize = prize / 10;
        }
        if (modes == "fen") {
            moneys = nums * times * 2 / 100;
            prize = prize / 100;
        }
        if (modes == "li") {
            moneys = nums * times * 2 / 1000;
            prize = prize / 1000;
        }
        document.cookie = "modes=" + modes + "";
        selplay.modes = modes;

        //  alert(times);
    } else {
        moneys = 0;
        prize = 0;
    }
    prize = prize * times;

    if (moneys > 0) {
        if (modes == "yuan") {
            moneys = moneys.toFixed(0);
            prize = parseFloat(prize).toFixed(0);
        }
        if (modes == "jiao") {
            moneys = moneys.toFixed(1);
            prize = parseFloat(prize).toFixed(1);
        }
        if (modes == "fen") {
            moneys = moneys.toFixed(2);
            prize = parseFloat(prize).toFixed(2);
        }
        if (modes == "li") {
            moneys = moneys.toFixed(3);
            prize = parseFloat(prize).toFixed(3);
        }
    }

    sel_money = G("lt_sel_money").innerHTML = moneys;

    G("lt_prize_money11").innerHTML = prize;
    var prize_money = parseFloat(prize) - parseFloat(moneys)
    G("lt_prize_money").innerHTML = prize_money;

    if (mobile == 1 && gametype != 'k3') {
        if (nums > 0) {
            document.getElementById('lt_sel_insert').querySelector('span').style.color = '#f93e3e';

        } else {
            document.getElementById('lt_sel_insert').querySelector('span').style.color = '#fff';

        }

    }
    if (mobile == 0 && nums > 0 && wanfa_cate == 'qw') {


        qwinsertline();
    }
}


function k3input(value) {

    value = parseInt(value);
    if (parseInt(document.getElementById('lt_sel_nums').innerHTML) < 1) {
        Count_Money();
        return false;
    }
    var lines = '';
    if (play_id == 'K3HZ') {

        var div_line = document.getElementById('xcaiconter').querySelectorAll('.kkon');
        for (var i = 0; i < div_line.length; i++) {

            if (lines != '') lines += ',';
            lines += div_line[i].querySelector('.kkls').querySelector('b').innerHTML;

        }
    }


    Count_Money();
    var prize = get_car_prizemin(play_id, lines);
    var pri = prize * value;
    if (pri.toString().indexOf('.') > 0) pri = pri.toFixed(2)

    document.getElementById('lt_prize_money').innerHTML = pri;
}


function k3buy() {
    if (document.getElementById('per_money').value == '') {

        DialogAlert('您还没输入投注金额');
        return false;
    }

    if (selplay.isbuy != 1) {

        DialogAlert('第' + selplay.lotpriod + '期已经封单');
        return false;


    }
    var lines = '';
    if (play_id == 'K3HZ') {

        var div_line = document.getElementById('xcaiconter').querySelectorAll('.kkon');
        for (var i = 0; i < div_line.length; i++) {

            if (lines != '') lines += ',';
            lines += div_line[i].querySelector('.kkls').querySelector('b').innerHTML;

        }
    }

    var min = get_car_buymin(play_id, lines);

    if (parseFloat(document.getElementById('per_money').value) < parseFloat(min)) {

        DialogAlert('单注投注金额不能低于' + min + '元');
        return false;

    }
    var max = get_car_buymax(play_id, lines);
    if (parseFloat(document.getElementById('per_money').value) > parseFloat(max)) {

        DialogAlert('单注投注金额不能高于' + max + '元');
        return false;

    }


//clearsels();

    buylist = '';
    document.getElementById('lt_sel_insert').click();
    var buy_arr = buylist.split('^');

    buy_arr[6] = parseInt(document.getElementById('per_money').value) * buy_arr[5];
    buylist = buy_arr.join('^');


    setTimeout(function () {

        // console.log(buylist);
        gamebuy();
    }, 10)


}


function setSelectChecked(selectId, checkValue) {
    var select = document.getElementById(selectId);
    for (var i = 0; i < select.options.length; i++) {
        if (select.options[i].value == checkValue) {
            select.options[i].selected = true;
            break;
        }
    }
}

function select_mode(mode) {


//	DialogAlert(mode);
//

    setSelectChecked('lt_project_modes', mode);
    Count_Money();


    var arr = new Array('yuan', 'jiao', 'fen', 'li');
    if (mobile != 1) {

        for (var i = 0; i < arr.length; i++) {
            if (arr[i] == mode)
                document.getElementById('mode_' + arr[i]).className = 'active';
            else
                document.getElementById('mode_' + arr[i]).className = '';

        }

    }

    show_select_mode(G('playid_hidden').innerHTML);
}

function select_mode11(mode) {


//	DialogAlert(mode);
//

    setSelectChecked('lt_project_modes', mode);
    Count_Money();

    show_select_mode(G('playid_hidden').innerHTML);
}

//AJAX得到最大倍数
function IsMax_Times(vthis) {
    var times = 1;
    var $is_ok_l = "no";
    if (vthis.id == "times") {
        times = parseInt(getselectItem(vthis), 10);
        $is_ok_l = "yes";
    }
    if (vthis.id == "lt_sel_times") {
        times = parseInt(vthis.value, 10);
        $is_ok_l = "yes";
    }
    var maxtimes = GetMaxTimes();
    if (parseInt(maxtimes, 10) - 1 > 0) {
        if (times - parseInt(maxtimes, 10) > 0) {
            times = parseInt(maxtimes, 10);
            vthis.value = times;
            DialogAlert("超过最大倍数")
        }
    }
    selplay.times = times;
    if ($is_ok_l == "yes") {
        Count_Money(1);
    }
    if (mobile != 1) {

        document.querySelector('.choose-list').style.display = 'none'
    }

}

function GetMaxTimes() {
    var playid = playlist.playid;
    items = selplay.modes;
    var maxtimes = arrPlayTime[playid][items];
    return maxtimes;
}

function show_choose() {
    if (document.querySelector('.choose-list').style.display == 'none') {
        document.querySelector('.choose-list').style.display = 'block'
    }
    else {
        document.querySelector('.choose-list').style.display = 'none'
    }
}

function set_choose_value(value) {
    document.getElementById('lt_sel_times').value = value;
    IsMax_Times(document.getElementById('lt_sel_times'));
}

//Ajax 获取已开奖号码
var ajax_last_timer = 0;

function Ajax_last_lotnum() {


    ajaxobj = new AJAXRequest;
    ajaxobj.method = "POST";
    var rootURL = G("do_url").value;
    // var myDate = new Date();
    var timestamp = new Date().getTime();
    if (parseInt(timestamp) - parseInt(ajax_last_timer) > 1000) {
        ajax_last_timer = parseInt(timestamp);
        //console.log(ajax_last_timer);
        // console.log(showLocale11(myDate));;
        ajaxobj.url = rootURL + "?mod=ajax&code=get&list=data&action=lottery_list&flag=yes&play=" + gamekey;
        //DialogAlert(	ajaxobj.url);

        ajaxobj.callback = function (xmlobj) {
            var response = xmlobj.responseText;
            Show_last_lotnum(response);

            lastlotTimer = setTimeout(function () {
                var arr = response.split('^')
                if (arr[1] != selplay.pre_period) {

                    Ajax_last_lotnum();

                }
                else {


                    console.log('开奖数据已更新，停止监控');
                    var time1122 = setTimeout(function () {
                        prostep = 0;
                        get_new_lot();
                        clearTimeout(time1122);
                    }, 20000);
                    clearTimeout(lastlotTimer);

                }

            }, 4000);
        };
        ajaxobj.send();

    }


}

var history_time = 0;

function Show_last_lotnum(response) {

    if (response.length - 5 < 0) {
        return false;
    }
    var lists = response.split("^");

    try {


        var current_issue = selplay.lotpriod;

    }
    catch (err) {

        var current_issue = '';

    }

    var cha = parseInt(return_now() - history_time);

    if (current_issue != lists[1] || cha > 10) {

        if (cha > 10) {
            //console.log(cha);
            //get_new_lot();
        }

        history_time = return_now();

        processCode(lists[1], lists[2]);
        addhistorylist(lists[1], lists[2], lists[3]);
        // 2019-10-24 手机不自动刷新
        if (mobile != 1) {
          Ajax_get_buy();
        }

    }
}

function addhistorylist(issue, code, time) {

    //DialogAlert(code);
    var vv = code.split(",");
    var hz = 0;

    if (vv.length >= 20) {
        for (var i = 0; i < vv.length - 1; i++) {

            hz = parseInt(hz) + parseInt(vv[i]);

        }


    } else {

        for (var i = 0; i < vv.length; i++) {

            hz = parseInt(hz) + parseInt(vv[i]);

        }

    }
    var ss = '';
    for (var i = 0; i < vv.length; i++) {
        if (mobile == 1) {

            ss += '<em>' + vv[i] + '</em>';


        } else
            ss += '<em>' + vv[i] + '</em>';

    }


    if (hz % 2 == 0) var ds = '双'; else ds = '单';

    var qi = '';
    var qi1 = '';
    if (gametype == 'k3') {

        temp = '<td>' + hz + '</td>';
        temp += '<td>';
        if (parseInt(hz) > 10) temp += '<span class="color1">大</span> '; else temp += '<span class="color2">小</span> ';
        if (parseInt(hz) % 2 == 1) temp += '<span class="color1">单</span>'; else temp += '<span class="color2">双</span>';
        temp += '</td>';
    } else {
        if (mobile == 1)
            temp = "<td>" + time.substr(10, 10) + "</td>";
        else
            temp = "";
    }

    var str = '   <tr><td>' + qi1 + issue + qi + '</td><td class="numbercode">' + code + '</td>' + temp + '</tr>';

    var indexHTML = "";
    var bodyHTML = "";
    var num = 10;
    $("#historylot tr").each(function (i) {
        // bodyHTML+=str;
        if (i > 0) {
            if (i == 1) {
                var reg = /<td>.*?<\/td>/g;
                var arr = $(this).html().match(reg);
                var temp = arr[0];
                if (temp != '<td>' + qi1 + issue + qi + '</td>') {
                    bodyHTML += str;

                    num = 9;

                }

                //	console.log('<td><span>'+qi1+issue+qi+'</span></td>')
            }

            if (i < num)
                bodyHTML += "<tr>" + $(this).html() + "</tr>";


        }
        else {
            bodyHTML += "<tr>" + $(this).html() + "</tr>";

        }


    })
    //console.log(bodyHTML)
    $("#historylot").html(bodyHTML);
    // set_game_xingtai();
//	bodyHTML+="</table>";
    if (bodyHTML.indexOf(issue) > 0) {
        return false;
    } else {
        indexHTML += bodyHTML
        $("#historylot").html(indexHTML);
    }
}

var timer_process = '';

function process_loading(sum, num) {

    if (num > 0) {
        num--;
        var pre = 100 - parseFloat(100 * num / sum);


        var html = "<div class='process'><div class='pre' style='width:" + pre + "%;'></div></div>";
        document.getElementById('J-lottery-info-status').innerHTML = html;
        clearTimeout(timer_process);
        timer_process = setTimeout(function () {

            process_loading(sum, num);
        }, 1000)

    }
    else {
        document.getElementById('J-lottery-info-status').innerHTML = '即将开奖，请稍后.....';
        clearTimeout(timer_process);

    }


}


function period_loading() {
    if (gametype == 'k3' || gametype == 'kl8' || gametype == 'pk10') {

        if (gametype == 'k3') {
            document.getElementById("last_code").innerHTML = ' <ul >\n' +
                '                        <li><span><i></i></span></li>\n' +
                '                        <li><span><i></i></span></li>\n' +
                '                        <li><span><i></i></span></li></ul>';

        }
        document.getElementById("last_code").className = 'tdl-viewer-sub number tdl-vs-dice ks-tdl-loading ' + gametype + 'code';


    }

    else {

        document.getElementById("last_code").className = 'tdl-viewer-sub number tdl-vs-dice ks-tdl-loading';

    }

    document.getElementById('lottitle1').style.display = 'none';
    document.getElementById('lottitle2').style.display = 'block';
    if (selplay.isbuy == 1)
        document.getElementById('last_issues1').innerHTML = selplay.pre_period;
    else
        document.getElementById('last_issues1').innerHTML = selplay.lotpriod;
    document.getElementById('J-lottery-info-status').style.display = 'block';
    if (selplay.isbuy == 0 && (parseInt(selplay.stoptime) - parseInt(selplay.lastsecond)) < 10) {

        process_loading(10, 10 - (parseInt(selplay.stoptime) - parseInt(selplay.lastsecond)));

    }
    else {
        if (document.getElementById('last_issues').innerHTML != selplay.pre_period)
            document.getElementById('J-lottery-info-status').innerHTML = '即将开奖，请稍后.....';
        else {

            //      Ajax_last_lotnum();
        }
    }
    if (gametype == 'kl8' || gametype == 'pk10') {

        document.getElementById('J-lottery-info-status').style.display = 'none';
    }

}

var prostep = 1;

function processCode(issue, code) {
//DialogAlert(code);

    if ((selplay.lotpriod != issue && selplay.isbuy == 0) || (selplay.pre_period != issue && selplay.isbuy == 1)) {


        period_loading();
        return false;

    }
    clearTimeout(lastlotTimer);
    // console.log('开奖数据已更新');

    document.getElementById('last_issues').innerHTML = issue;
    document.getElementById('lottitle2').style.display = 'none';
    document.getElementById('lottitle1').style.display = 'block';
    document.getElementById('J-lottery-info-status').style.display = 'none';
    $("#last_issues").html(issue);


    var cStr = '';
    var aTmp = new Array;
    //处理中奖号码
    if (code.indexOf(',') == -1) {
        //无空格
        aTmp = code.split('');

    }
    else {
        //有空格
        aTmp = code.split(',');

    }


    if (aTmp.length >= 10) {
        ShowLongCode(aTmp);

    } else if (gametype == 'k3') {

        ShowK3Code(aTmp);

    } else {

        show_code11(aTmp);

    }
    document.getElementById('lottitle1').style.display = 'block';
    document.getElementById('lottitle2').style.display = 'none';

}


function ShowK3Code(aTmp) {


    var str = ' <ul >';

    for (i = 0; i < aTmp.length; i++) {

        str += "  <li><img src='static/images/ico/num-" + parseInt(aTmp[i]) + ".png' ></li>";


    }

    str += '</ul>';
    $("#last_code").html(str);
    document.getElementById("last_code").className = 'tdl-viewer-sub number tdl-vs-base k3code';

    show_lottery_info(aTmp);

}


function show_code11(aTmp) {


    var str = ' <ul >';

    for (i = 0; i < aTmp.length; i++) {

        str += "  <li><span><i>" + aTmp[i] + "</i></span></li>";


    }

    str += '</ul>';
    $("#last_code").html(str);
    document.getElementById("last_code").className = 'tdl-viewer-sub number tdl-vs-base';

    show_lottery_info(aTmp);

}

function show_lottery_info(code) {

    var str = '';
    if (gametype == 'ssc') {
        var arr1 = new Array('前三', '中三', '后三');
        var arr2 = new Array('组六', '组六', '组六');
        for (var i = 0; i < 3; i++) {

            if (code[i] == code[i + 1] || code[i] == code[i + 2] || code[i + 1] == code[i + 2]) {
                arr2[i] = '组三';

            }

        }

        for (var i = 0; i < 3; i++) {
            str += "<span>" + arr1[i] + ":" + arr2[i] + "</span>";
        }

    }

    if (gametype == '11x5') {
        var num1 = 0;
        var num2 = 0;
        for (var i = 0; i < code.length; i++) {
            if (parseInt(code[i].substr(1, 1)) / 2 == 0) num2++;
            else num1++;

        }
        str = "<span>单双：" + num1 + "单" + num2 + "双</span>";
        code.sort(NumAscSort);
        str += "<span>中位：" + code[2] + "</span>";

    }
    if (gametype == 'k3') {
        var sum = 0;
        var num2 = 0;
        var sum = parseInt(code[0]) + parseInt(code[1]) + parseInt(code[2]);
        if (sum <= 10) str = "<span>小</span>"; else str = "<span>大</span>";
        if (sum % 2 == 0) str += "<span>双</span>"; else str += "<span>单</span>";
        str += "<span>和值：" + sum + "</span>";

    }

    if (gametype == 'dp') {
        var str1 = '组六';
        for (var j = 0; j < 0; j++) {
            if (code[j] == code[j + 1]) {
                str1 = '组三';
                break;
            }
        }
        str += "<span>组选：" + str1 + "</span>";
        var sum = parseInt(code[0]) + parseInt(code[1]) + parseInt(code[2]);
        str += "<span>和值：" + sum + "</span>";

    }

    //if(mobile==0){
    clearTimeout(timer_process);
    document.querySelector('#J-lottery-info-status').style.display = 'block';
    document.querySelector('#J-lottery-info-status').innerHTML = str;

    if (gametype == 'pk10' || gametype == 'kl8') document.querySelector('#J-lottery-info-status').style.display = 'none';
    ;
    // }

}

function NumAscSort(a, b) {
    return a - b;
}

function show_period_s(lines, num) {
    var class_name = "num_" + num
    document.getElementById("span_lot_" + lines).className = class_name;
}

function ShowLongCode(ary_code) {
    var this_value;
    var counts = 0;
    var maxs = 0;
    var mins = 0;
    var jis = 0;
    var ers = 0;
    var cStr = '';
    // cStr += '<tr>';
    //  if(ary_code.length==10)
    //  	cStr += '	<td  style="width:100%;padding-left:1px">';
    //  else
    //  cStr += '	<td  style="width:100%;padding-left:10px">';
    for (var i = 0; i < ary_code.length; i++) {
        this_value = ary_code[i].substr(0, 2);
        counts += parseInt(this_value);
        if (parseInt(this_value) - 40 > 0) {
            maxs += 1;

        } else {
            mins += 1;

        }
        if (parseInt(this_value) % 2 == 0) {
            ers += 1;

        } else {
            jis += 1;

        }

        if (ary_code.length > 10) {

            if (i == 0 || i == 10) cStr += '<ul>';
            if (i < 20)
                cStr += '<li><span ><i>' + this_value + '</i></span></li>';
            if (i == 9 || i == 20) cStr += '</ul>';

        }
        else {

            if (mobile == 1) {

                if (i == 0 || i == 5) cStr += '<div  style="display:block;width:130px;margin:0 auto;clear:both;text-align:center;">';

                cStr += '<span class="ball" >' + this_value + '</span>';
                if (i == 4 || i == 9) cStr += '</div>';

            }
            else {
                if (i == 0 || i == 5) cStr += '<ul>';

                cStr += '<li><span ><i>' + this_value + '</i></span></li>';
                if (i == 4 || i == 9) cStr += '</ul>';


            }


        }


    }
    // cStr += '	</td>';
    // cStr += '</tr>';
    // cStr += '</table>';
    // $("#last_code").removeClass().addClass("long_code").html(cStr);


    $("#last_code").html(cStr);
    document.getElementById("last_code").className = 'tdl-viewer-sub number tdl-vs-base ' + gametype + 'code';


}


function Get_Hz(num) {
    var dax;
    var dans;
    if (num - 811 >= 0) {
        dax = "大";

    } else {
        dax = "小";

    }
    if (num % 2 == 0) {
        dans = "双";

    } else {
        dans = "单";

    }
    return dax + "," + dans;


}

function Get_Pm(maxs, mins, ers, jis) {
    var dazxs;
    var jes;
    if (maxs - mins > 0) {
        dazxs = "下"

    }
    if (mins - maxs > 0) {
        dazxs = "上"

    }
    if (mins - maxs == 0) {
        dazxs = "中"

    }
    if (ers - jis > 0) {
        jes = "偶"

    }
    if (jis - ers > 0) {
        jes = "奇"

    }
    if (jis - ers == 0) {
        jes = "和"

    }
    return dazxs + "," + jes;


}

function periodlists(nowdate_s, nextdate_s, lastdate_s, nowtime_s) {
    var nowdate = nowdate_s.replace(/[^0-9]+/g, "");
    var nextdate = nextdate_s.replace(/[^0-9]+/g, "");
    var nowtimes = nowtime_s.replace(/[^0-9]+/g, "");
    var endtime_s = selplay.end;
    var endtime = endtime_s.replace(/[^0-9]+/g, "");

    var offset = parseInt(selplay.lotnum, 10);
    var lotpriod = selplay.lotpriod;
    var thispri = "";
    var thistime = "";
    var nowpri = "";
    var fl_num_a = 0;
    var fl_num_b = 0;
    var nowtime = "";
    var do_key = "ss";
    var lotarr_a = new Array();
    var lottime_a = new Array();
    var lotarr_b = new Array();
    var lottime_b = new Array();
    if (gamekey == "3D" || gamekey == "P5(P3)" || gamekey == "PL3" || gamekey == 'LF3d') {
        do_key = "dp";
    }
    if (gamekey == "LJSSC" || gamekey.indexOf("KL8") > 0) {
        do_key = "fl";
    }
    var is_next_date = "no";//DialogAlert(nowtime+"|"+endtime)
    if (parseInt(offset) - 1 == 0) {
        if (nowtimes - endtime > 0) {
            is_next_date = "yes";
            nowdate = nextdate;
            nowdate_s = nextdate_s;
        }
    }
    for (var i in arrTimes) {
        thispri = parseInt(arrTimes[i].period, 10);
        if (thispri - offset >= 0) {
            if (do_key == "ss") {
                nowpri = nowdate + arrTimes[i].period;
                lotarr_a.push(nowpri);
            }
            if (do_key == "fl") {
                nowpri = parseInt(lotpriod, 10) + fl_num_a;
                lotarr_a.push(nowpri);
                fl_num_a += 1;
            }
            nowtime = nowdate_s + " " + arrTimes[i].ends;
            lottime_a.push(nowtime);
        }
        if (offset - thispri > 0) {
            if (do_key == "ss") {
                nowpri = nextdate + arrTimes[i].period;
                lotarr_b.push(nowpri);
            }
            if (do_key == "fl") {
                nowpri = parseInt(lotpriod, 10) + fl_num_b;
                lotarr_b.push(nowpri);
                fl_num_b += 1;
            }
            nowtime = nextdate_s + " " + arrTimes[i].ends;
            lottime_b.push(nowtime);
        }

    }
    if (do_key == "dp") {
        nowpri = selplay.lotpriod;
        lotarr_a.push(nowpri);
        nowtime = selplay.lotendtime;
        lottime_a.push(nowtime);
    }
    lotarr_a.sort();
    lottime_a.sort();
    lotarr_b.sort();
    lottime_b.sort();
    lotarr_a.concat(lotarr_b);
    lottime_a.concat(lottime_b);
    //打印起始期
    peroarr = [];
    perotimearr = [];
    var select_lot = document.getElementById("list_lot_num");
    select_lot.options.length = 0;
    var option1;
    var f = 0;


    beginTimes(zui_num, 1);
    clearTask();
}

//selinsertline()  boxinsertline()


function selinsertline() {


    var ss = check_post();
    if (ss == false) {

        return false;
    }
    var flags = "yes";
    var lines = reselline();


    var wei_item = '';
    if (play_item == '2R' || play_item == '3R' || play_item == '4R') {
        var wei_value = get_wei_value();
        wei_item = "^" + wei_value;
    }
    else {
        wei_item = '';
    }

    var showNums = "";
    var innerHTML = "";
    var showHTML = "";
    var nums = sel_nums;
    var money = sel_money;

    var code = selplay.code;
    var titles = selplay.plays;
    var playid = playlist.playid;
    var prize = G('lt_prize_money').innerHTML;
    var modes = "";
    if ((selplay.modes == "yuan") || (selplay.modes == "元")) {
        modes = "元";
    }
    var CurMode = document.getElementById("select_mode").value;

    var CurModeType = selplay.CurModeType;
    var times = selplay.times;
    var lotpriod = selplay.lotpriod;

    //console.log(selplay);
    if (code == titles) var st = code;
    else {
        if (arrPlays[play_item][play_id]['CodeTile'])
            var st = code + "," + arrPlays[play_item][play_id]['CodeTile'] + ',' + titles;
        else
            var st = code + "," + titles;

    }
    var showcode = "[" + st + "]" + lines;

    if ((selplay.modes == "jiao") || (selplay.modes == "角")) {
        modes = "角";
        if (MinModeJiao) {
            if (parseInt(MinModeJiao, 10) - 1 >= 0) {
                if (parseInt(MinModeJiao, 10) - parseInt(times, 10) > 0) {
                    DialogAlert("角模式下注单倍数至少为" + MinModeJiao + "倍！");
                    return false;
                }
            }
        }
    }
    if ((selplay.modes == "fen") || (selplay.modes == "分")) {
        modes = "分";
        if (MinModeFen) {
            if (parseInt(MinModeFen, 10) - 1 >= 0) {
                if (parseInt(MinModeFen, 10) - parseInt(times, 10) > 0) {
                    DialogAlert("分模式下注单倍数至少为" + MinModeFen + "倍！");
                    return false;
                }
            }
        }
    }

    if ((selplay.modes == "li") || (selplay.modes == "厘")) {
        modes = "厘";

    }


    //判断字段是否为空

    if (nums == "0" || typeof(nums) == "undefined") {
        flags = "no";
    }
    if (gamekey == "" || typeof(gamekey) == "undefined") {
        flags = "no";
    }
    if (playid == "" || typeof(playid) == "undefined") {
        flags = "no";
    }
    if (modes == "" || typeof(modes) == "undefined") {
        flags = "no";
    }
    if (CurMode == "" || typeof(CurMode) == "undefined") {
        flags = "no";
    }
    if (CurModeType == "" || typeof(CurModeType) == "undefined") {
        flags = "no";
    }
    if (times == "" || typeof(times) == "undefined") {
        flags = "no";
    }
    if (lotpriod == "" || typeof(lotpriod) == "undefined") {
        flags = "no";
    }
    if (lines == "" || typeof(lines) == "undefined") {
        flags = "no";
    }
    if (showcode == "" || typeof(showcode) == "undefined") {
        flags = "no";
    }
    if (flags == "no" && !(mobile == 1 && gametype == 'k3')) {
        DialogAlert("信息读取失败，请刷新页面或重新登陆后再试！");
        return false;
    }

    var MaxNote = arrPlays[selplay.coteid][playid].MaxNote;
    if (parseInt(MaxNote, 10) - 1 >= 0) {
        if (parseInt(nums, 10) - parseInt(MaxNote, 10) > 0) {
            DialogAlert("超过系统设置的最大注数:" + MaxNote);
            return false;
        }
    }
    //if(arrPlays[].MaxNote nums)
    var ids = "";
    if (showcode.length - 30 > 0) {
        showNums = "[" + code + "-" + titles + "]" + "...";
    } else {
        showNums = showcode;
    }
    ids = RndNum(5);
    innerHTML = gamekey + "^" + code + "^" + titles + "^" + playid + "^" + modes + "^" + nums + "^" + money + "^" + CurMode + "^" + CurModeType + "^" + times + "^" + lotpriod + "^" + ids + "^" + lines + wei_item;

    if (quick_buy == 1) {

        buylist1 = innerHTML;
        return true;
    }


    var msgObj = document.createElement("div");
    msgObj.id = "div_" + playid + "_" + ids;
    msgObj.className = "sel_div";
    msgObj.title = "投注号码：" + lines;

    var showHTML = set_shopcar_html(ids, playid, code, lines, titles, modes, times, nums, money, showNums, innerHTML);

    msgObj.innerHTML = showHTML;
    set_buylist(innerHTML);

    G('lt_cf_content').appendChild(msgObj);

    var shownum = parseInt(playlist.shownum, 10);
    var minnum = parseInt(playlist.minnum, 10);
    var maxnum = parseInt(playlist.maxnum, 10);
    var max_select = parseInt(playlist.max_select, 10);
    var min_select = parseInt(playlist.min_select, 10);
    var playid = playlist.playid;
    var lastcss = "";
    var newcss = "";
    for (i = 0; i < 5; i++) {
        for (j = 0; j < 80; j++) {
            if (G("select_" + i + "_" + j)) {
                lastcss = G("select_" + i + "_" + j).className;
                newcss = get_css(lastcss, "nocheck");
                G("select_" + i + "_" + j).className = newcss;
            }
        }
    }
    selists = [];
    clear_sel();
    G('lt_cf_count').innerHTML = parseInt(G('lt_cf_count').innerHTML, 10) + 1;
    set_cf_count_display();
    G('lt_cf_nums').innerHTML = parseInt(G('lt_cf_nums').innerHTML, 10) + parseInt(nums, 10);
    var comoney = parseFloat(G('lt_cf_money').innerHTML, 10) + parseFloat(money, 10);
    hm_check();
    comoney = comoney.toFixed(3);
    G('lt_cf_money').innerHTML = comoney;

    fly_cart();
}

function fly_cart() {
    if (mobile == 1 && gametype != 'k3') {

        if (document.getElementById('shopcar').style.display != 'block') {
            var event = this.event;

            var offset = $('#lt_cf_count').offset();
            var flyer = $('<div style="height:25px;width:25px;line-height:25px;background-color: #dc3b40;border-radius:50%;z-index:999999999999;color: #fff;text-align: center;">+</div>');
            flyer.fly({
                start: {
                    left: event.pageX,
                    top: event.pageY
                },
                end: {
                    left: offset.left,
                    top: offset.top,
                    width: 0,
                    height: 0
                }
            });


        }

        //show_bg('block','添加成功');
    }
}


function get_car_maxselect(playid, lines) {

    var prize_temp = arrPlayList[playid].max_select;

    if (prize_temp.indexOf('|') > 0) {
        var show_key = arrPlayList[playid].show_key.split('|');
        var buytemp = arrPlayList[playid].max_select.split('|');
        var prize_temp = prize_temp.split('|');
        var line_temp = lines.split(',');
        var maxselect = 0;
        for (var i = 0; i < line_temp.length; i++) {

            for (var j = 0; j < show_key.length; j++) {

                if (show_key[j] == line_temp[i]) {
                    maxselect += parseFloat(buytemp[j]);
                }
            }
        }


    } else {
        var buymin = arrPlayList[playid].maxselect;


    }

    return maxselect;

}

function get_car_buymin(playid, lines) {

    var prize_temp = arrPlayList[playid].buymin;

    if (prize_temp.indexOf('|') > 0) {
        var show_key = arrPlayList[playid].show_key.split('|');
        var buytemp = arrPlayList[playid].buymin.split('|');
        var prize_temp = prize_temp.split('|');
        var line_temp = lines.split(',');
        var buymin = buytemp[0];
        for (var i = 0; i < line_temp.length; i++) {

            for (var j = 0; j < show_key.length; j++) {

                if (show_key[j] == line_temp[i]) {

                    if (parseFloat(buytemp[j]) < buymin) buymin = parseFloat(buytemp[j]);
                }
            }
        }


    } else {
        var buymin = arrPlayList[playid].buymin;


    }

    return buymin;

}

function get_car_buymax(playid, lines) {

    var prize_temp = arrPlayList[playid].buymax;

    if (prize_temp.indexOf('|') > 0) {
        var show_key = arrPlayList[playid].show_key.split('|');
        var buytemp = arrPlayList[playid].buymax.split('|');
        var prize_temp = prize_temp.split('|');
        var line_temp = lines.split(',');
        var buymax = buytemp[0];
        for (var i = 0; i < line_temp.length; i++) {

            for (var j = 0; j < show_key.length; j++) {

                if (show_key[j] == line_temp[i]) {

                    if (parseFloat(buytemp[j]) > buymax) buymax = parseFloat(buytemp[j]);
                }
            }
        }


    } else {
        var buymax = arrPlayList[playid].buymax;


    }

    return buymax;

}

function get_car_prizemin(playid, lines) {
    var prize_temp = arrPlayList[playid].prize;
    if (prize_temp.indexOf('|') > 0) {
        var show_key = arrPlayList[playid].show_key.split('|');
        var buytemp = arrPlayList[playid].buymin.split('|');
        var prize_temp = prize_temp.split('|');

        var line_temp = lines.split(',');
        var prize = 0;
        for (var i = 0; i < line_temp.length; i++) {

            for (var j = 0; j < show_key.length; j++) {

                if (show_key[j] == line_temp[i]) {
                    if (parseFloat(prize_temp[j]) > prize) prize = parseFloat(prize_temp[j]);
                }
            }
        }


    } else {

        var prize = prize_temp;

    }
    if (prize.toString().indexOf('.') > 0) prize = parseFloat(prize).toFixed(2);
    return prize;

}

function set_shopcar_html(ids, playid, code, lines, titles, modes, times, nums, money, showNums, innerHTML) {
    var mode = 1;
    if (modes == '角') mode = 0.1;
    if (modes == '分') mode = 0.01;
    if (modes == '厘') mode = 0.001;
    if (isArray(lines)) lines = lines.join(',');
    var prize = get_car_prizemin(playid, lines);
    var buymin = get_car_buymin(playid, lines);
    if (gametype == 'k3') {

        var prize_max = prize * buymin;
    }
    else {
        var prize_max = prize * times * mode;

    }

    if (prize_max.toString().indexOf('.') > 0) {

        prize_max = prize_max.toFixed(2);
    }

    var showHTML = '';
    if (mobile == 1) {
        if (lines.length > 40) var temp = lines.substr(0, 40) + '...';
        else var temp = lines;
        showHTML = "<span class='title' title='" + lines + "'>" + temp + "</span>";
        showHTML += "<div class='car_con'>";
        var reg = /\[.*?\]/i;
        var match = showNums.match(reg);
        // console.log(match);
        showHTML += match[0];
        showHTML += nums + "注";
        // showHTML+="<span class='times' id='time_"+playid+"_"+ids+"'>"+times+"倍</span>";
        // showHTML+="<span class='modes'>"+modes+"</span>";
        var pri_money = money / nums / times;


        showHTML += " 每注" + pri_money + "元";

        showHTML += "</div>";

        showHTML += "<div class='dos' title='删除' onclick=\"deleteDiv('" + ids + "')\"><i class='icon-minus-circle'></i> </div>";

    }
    else {

        if (gametype == 'k3') {
            showHTML = "<span class='title' title='" + lines + "'>" + showNums + "</span>";

            //showHTML+="<span class='primode'>赔率："+G('prize_11').innerHTML+"</span>";
            //    showHTML+="<span class='modes'>"+modes+"</span>";
            showHTML += "<span class='nums' id='num_" + playid + "_" + ids + "'>总共：" + nums + "注</span>";
            //     showHTML+="<span class='times' id='time_"+playid+"_"+ids+"'>"+times+"倍</span>";
            showHTML += "<span class='moneys' id='money_" + playid + "_" + ids + "'>每注<input type='number' id='premoney_" + playid + "_" + ids + "'  min='" + buymin + "' value='" + buymin + "' oninput='set_prizemax(this.value," + prize + ",\"" + playid + "\",\"" + ids + "\")'>元</span>";
            showHTML += "<span class='fangan'>可中金额：<font style='color: #ff0000;'  id='prizemax_" + playid + "_" + ids + "'>" + prize_max + "</font>元</span>";
            showHTML += "<span class='dos icon-cancel-3' title='删除' onclick=\"deleteDiv('" + ids + "')\"></span>";
            setTimeout(function () {
                newbuylist_money(buymin, ids);
            }, 500);
//console.log(buylist);
        } else {

            showHTML = "<span class='title' title='" + lines + "'>" + showNums + "</span>";

            //showHTML+="<span class='primode'>赔率："+G('prize_11').innerHTML+"</span>";
            //   showHTML+="<span class='modes'>"+modes+"</span>";
            showHTML += "<span class='nums' id='num_" + playid + "_" + ids + "'>" + nums + "注</span>";
            showHTML += "<span class='times'style='width: 50px;'  id='time_" + playid + "_" + ids + "'>" + times + "倍</span>";
            showHTML += "<span class='moneys' style='width:70px;'  id='money_" + playid + "_" + ids + "'>￥" + money + "</span>";
            showHTML += "<span class='fangan'>可中金额：<font style='color: #ff0000;'>" + prize_max + "</font>元</span>";
            showHTML += "<span class='dos icon-cancel-3' title='删除' onclick=\"deleteDiv('" + ids + "')\"></span>";


        }

    }

    return showHTML;

}

function set_prizemax(value, prize, playid, ids) {
    if (value == '') value = 0;
    var pri = prize * value;

    if (pri.toString().indexOf('.') > 0) {

        pri = pri.toFixed(2);
    }
    document.getElementById("prizemax_" + playid + "_" + ids).innerHTML = pri;
    newbuylist_money(value, ids);

}

function newbuylist_money(value, ids) {
    var buytemp = new Array();
    var summoney = 0;
    if (buylist.indexOf('#') > 0) {
        buytemp = buylist.split('#');
    }
    else {

        buytemp[0] = buylist;
    }

    for (var i = 0; i < buytemp.length; i++) {
        var buytemp1 = buytemp[i].split('^');
        if (buytemp1[11] == ids) {

            buytemp1[6] = value * parseFloat(buytemp1[5]);

            buytemp[i] = buytemp1.join('^');
        }
        summoney += parseFloat(buytemp1[6]);
    }
    buylist = buytemp.join('#');
    if (summoney.toString().indexOf('.') > 0) {

        summoney = summoney.toFixed(2);
    }

    document.getElementById('lt_cf_money').innerHTML = summoney;

}


//输入框号码
function boxinsertline() {

    //js
//	check_post();
    var ss = check_post();
    if (ss == false) {

        return false;
    }
//if(quick_buy==1) countinput();
    var lines = $('#lt_write_box_ok').val();
    var p_lines = $('#lt_write_box').val();
    if (quick_buy == 1 && !lines) {

        lines = document.getElementById('lt_write_box').value;
        if (!lines) lines = box_old;

    }
    if (lines != p_lines && quick_buy == 0) {
        var lotTimer
        window.clearTimeout(lotTimer);
        if ($('#autocou').val() == "no") {
            $('#autocou').val('yes');

            countinput();
            lotTimer = window.setTimeout("boxinsertline()", 500);
        } else {
            lotTimer = window.setTimeout("boxinsertline()", 500);
        }
        return false;
    }
    var write_type = document.getElementById('write_type').value;


    $('#autocou').val('no');
    if (sel_money == "0") {
        //DialogAlert("读取注数失败，请点击右边的＂计算注数＂按钮或请填写完整号码！");
        return false;
    }
//	if(parseInt(G('lt_cf_count').innerHTML,10)-10>=0){
//		DialogAlert("单次投注最多10注号码");
//		return false;
//	}
//
    var flags = "yes";
    var flaginfor = "no";
    //var lines=G('lt_write_box_ok').value;

    var wei_item = '';
    if (play_item == '2R' || play_item == '3R' || play_item == '4R') {
        var wei_value = get_wei_value();
        wei_item = "^" + wei_value;
    }
    else {
        wei_item = '';
    }

    var showNums = "";
    var innerHTML = "";
    var showHTML = "";
    var nums = sel_nums;
    var money = sel_money;

    var code = selplay.code;
    var titles = selplay.plays;
    var playid = playlist.playid;
    var primode = document.getElementById("usermode").value;
    var modes = "";

    var CurMode = document.getElementById("select_mode").value;
    var CurModeType = selplay.CurModeType;
    var times = selplay.times;
    var lotpriod = selplay.lotpriod;
    if (code == titles) var st = code;
    else {
        if (arrPlays[play_item][play_id]['CodeTile'])
            var st = code + "," + arrPlays[play_item][play_id]['CodeTile'] + ',' + titles;
        else
            var st = code + "," + titles;

    }

    var showcode = "[" + st + "]" + lines;
    if ((selplay.modes == "yuan") || (selplay.modes == "元")) {
        modes = "元";
    }
    if ((selplay.modes == "jiao") || (selplay.modes == "角")) {
        modes = "角";
        if (MinModeJiao) {
            if (parseInt(MinModeJiao, 10) - 1 >= 0) {
                if (parseInt(MinModeJiao, 10) - parseInt(times, 10) > 0) {
                    DialogAlert("角模式下注单倍数至少为" + MinModeJiao + "倍！");
                    return false;
                }
            }
        }
    }
    if ((selplay.modes == "fen") || (selplay.modes == "分")) {
        modes = "分";
        if (MinModeFen) {
            if (parseInt(MinModeFen, 10) - 1 >= 0) {
                if (parseInt(MinModeFen, 10) - parseInt(times, 10) > 0) {
                    DialogAlert("分模式下注单倍数至少为" + MinModeFen + "倍！");
                    return false;
                }
            }
        }
    }

    if ((selplay.modes == "li") || (selplay.modes == "厘")) {
        modes = "厘";

    }
    //判断字段是否为空
    if (nums == "0" || typeof(nums) == "undefined") {
        flags = "no";
        flaginfor = "nums";
    }
    if (gamekey == "" || typeof(gamekey) == "undefined") {
        flags = "no";
        flaginfor = "gamekey";
    }
    if (playid == "" || typeof(playid) == "undefined") {
        flags = "no";
        flaginfor = "playid";
    }
    if (modes == "" || typeof(modes) == "undefined") {
        flags = "no";
        flaginfor = "modes";
    }
    if (CurMode == "" || typeof(CurMode) == "undefined") {
        flags = "no";
        flaginfor = "CurMode";
    }
    if (CurModeType == "" || typeof(CurModeType) == "undefined") {
        flags = "no";
        flaginfor = "CurModeType";
    }
    if (times == "" || typeof(times) == "undefined") {
        flags = "no";
        flaginfor = "times";
    }
    if (lotpriod == "" || typeof(lotpriod) == "undefined") {
        flags = "no";
        flaginfor = "lotpriod";
    }
    if (lines == "" || typeof(lines) == "undefined") {
        flags = "no";
        flaginfor = "lines";
    }
    if (showcode == "" || typeof(showcode) == "undefined") {
        flags = "no";
        flaginfor = "showcode";
    }

    if (flags == "no") {
        DialogAlert("信息读取失败，请稍后后再试！" + flaginfor);
        return false;
    }


    var ids = "";
    if (showcode.length - 30 > 0) {
        showNums = "[" + code + "-" + titles + "]" + "...";
    } else {
        showNums = showcode;
    }
    ids = RndNum(5);
    innerHTML = gamekey + "^" + code + "^" + titles + "^" + playid + "^" + modes + "^" + nums + "^" + money + "^" + CurMode + "^" + CurModeType + "^" + times + "^" + lotpriod + "^" + ids + "^" + lines + wei_item;//DialogAlert(comps)
    if (quick_buy == 1) {

        buylist1 = innerHTML;
        //DialogAlert(buylist1);
        clear_sel();
        return true;
    }

    var msgObj = document.createElement("div");
    msgObj.id = "div_" + playid + "_" + ids;
    msgObj.className = "sel_div";
    msgObj.title = lines;

    var showHTML = set_shopcar_html(ids, playid, code, lines, titles, modes, times, nums, money, showNums, innerHTML);
    msgObj.innerHTML = showHTML;
    G('lt_cf_content').appendChild(msgObj);
    set_buylist(innerHTML);
    var shownum = parseInt(playlist.shownum, 10);
    var minnum = parseInt(playlist.minnum, 10);
    var maxnum = parseInt(playlist.maxnum, 10);
    var max_select = parseInt(playlist.max_select, 10);
    var min_select = parseInt(playlist.min_select, 10);
    var playid = playlist.playid;
    var lastcss = "";
    var newcss = "";
    for (i = 0; i < 5; i++) {
        for (j = 0; j < 80; j++) {
            if (G("select_" + i + "_" + j)) {
                lastcss = G("select_" + i + "_" + j).className;
                newcss = get_css(lastcss, "nocheck");
                G("select_" + i + "_" + j).className = newcss;
            }
        }
    }

    clear_sel();//selists=[];clear_sel();

    G('lt_write_box_ok').value = "";
    G('lt_write_box').value = "";
    G('lt_cf_count').innerHTML = parseInt(G('lt_cf_count').innerHTML, 10) + 1;
    set_cf_count_display();
    G('lt_cf_nums').innerHTML = parseInt(G('lt_cf_nums').innerHTML, 10) + parseInt(nums, 10);
    var comoney = parseFloat(G('lt_cf_money').innerHTML, 10) + parseFloat(money, 10);
    comoney = comoney.toFixed(2);
    G('lt_cf_money').innerHTML = comoney;
    hm_check();
    fly_cart();
}

function set_cf_count_display() {
    if (mobile == 1) {
        if (G('lt_cf_count').innerHTML == '0')
            G('lt_cf_count').style.display = 'none';
        else
            G('lt_cf_count').style.display = 'inline-block';
    }
    else {


    }

}


function getBuyInfor() {
    /*投注内容*/
    var qihao = selplay.lotpriod;

    var moneys = document.getElementById("lt_cf_money").innerHTML;
    var selArr = readSelToArr();
    var arrs = new Array();
    var topHTML = "<div style='clear: both'>彩种：" + gamename + "</div><div style='clear: both'>期号：第" + qihao + "期</div>";
    var modes = "";
    var codels = "";
    var numbers = "";
    var innerHTML = "<div style='clear: both;vertical-align: top;text-align: left;padding-top: 5px;'><span style='display: inline-block;vertical-align: top;height:120px;line-height:120px;' >详情：</span>" +
        "<div style='height:120px;width:360px;border-radius:2px  5px; padding:5px;border:1px solid #ddd;overflow:auto;overflow-x:hidden;display: inline-block;text-align: left;line-height: 30px;'>";
    var nums = 0;
    for (a = 0; a < selArr.length; a++) {
        arrs = selArr[a];

        modes = arrs[4];

        if (arrs[1] == arrs[2])
            codels = arrs[1];
        else {
            if (arrPlays[play_item][play_id]['CodeTile']) {

                codels = arrs[1] + "," + arrPlays[play_item][play_id]['CodeTile'] + ',' + arrs[2];

            }
            else {

                codels = arrs[1] + "," + arrs[2];

            }

        }

        //DialogAlert(arrs[12])
        if (arrs[12].length - 25 > 0) {
            numbers = arrs[12].substr(0, 23) + "..";
        } else {
            numbers = arrs[12];
        }

        innerHTML += '<div style="clear: both">[' + codels + ']' + numbers + '&nbsp;<span style="color: #ff0000" >' + arrs[6] + '</span>元</div>';
        nums = nums + parseInt(arrs[5]);
    }
    innerHTML += "</div></div>";

    if (seltask.istask == "yes") {
        var task_moneys = seltask.moneys;
        if (parseFloat(task_moneys, 10) - 0.01 > 0) {
            var zui_peroid = seltask.nums;
            moneys = task_moneys;
            // topHTML="您确定要追号 "+zui_peroid+" 期？"
        }
    }
    var retuenHTML = "<div style='line-height:30px;text-align:left;'>" + topHTML + "</div>";
    retuenHTML += innerHTML;
    if (gamekey == 'MMSSC') {

        moneys = moneys * G('qi_num').value;
    }


    if (mobile == 1) {

        if (gametype == 'k3') {
            var buy_arr = buylist.split('^');
            moneys = buy_arr[6];

        }
        var str = '';

        for (var a = 0; a < selArr.length; a++) {
            arrs = selArr[a];

            if (arrs[12].length - 25 > 0) {
                var numbers = arrs[12].substr(0, 23) + "..";
            } else {
                var numbers = arrs[12];
            }
            if (str != '') str += ',';
            str += numbers;

        }
        var retuenHTML = "<div style='height:35px;line-height:35px;text-align:left;clear: both;font-size:16px;'>" + gamename + ":" + qihao + "期</div>";
        retuenHTML += "<div style='height:35px;line-height:35px;text-align:left;clear: both;font-size:16px;overflow: hidden; text-overflow: ellipsis; white-space: nowrap;'>投注内容:" + str + "</div>";
        retuenHTML += "<div style='height:35px;line-height:35px;text-align:left;font-size:16px;padding-top: 5px;'>投注金额:<span style='color:#ff0000'>" + moneys + "元</span></div>";


    }
    else {
        if (seltask.istask == "yes") {

            var moneyname = "";
        }
        else {

            var moneyname = "";
        }
        var bottomHTML = "<span>投注总金额：<span style='color: #ff0000'>" + moneyname + moneys + "</span>元</span>";
        if (seltask.istask == "yes")
            bottomHTML += "<span style='padding-left:40px;'>追号期数：<span style='color: #ff0000'>" + zui_peroid + "</span>期</span>";
        else bottomHTML += "";
        bottomHTML += "</span>";
        retuenHTML += "<div style='height:30px;line-height:30px;text-align:left;margin-top: 5px;'>" + bottomHTML + "</div>";

    }

    //retuenHTML+="<div style='height:25px;line-height:25px;text-align:center;font-weight:;'>"+
//	"<span id='BackInforDiv' style='display:inline-block;text-align:center;margin:5px auto;height:30px;line-height:30px;color:#fff;padding:0px 10px;font-size:14px;'>共<strong>"+nums+"</strong>注，投注总金额<strong>"+moneys+"</strong>元</span></div>";
    if (mobile == 0)
        retuenHTML = "<div style='line-height:30px;font-size:16px;padding:5px 20px;'>" + retuenHTML + "</div>";

    return retuenHTML;
}


function check_curtime() {

    var cur = G("current_issue").innerHTML;

    var selArr = readSelToArr();

    if (buylist == '') {
        DialogAlert("请先添加投注号码！");
        return false;


    }
    for (var i = 0; i < selArr.length; i++) {


        if (selArr[i][10] != cur) {

            DialogAlert("第" + cur + "已停止投注");
            return false;
        }
        // console.log(selArr[i]);


        var prebuy = parseFloat(selArr[i][6]) / parseInt(selArr[i][5]);
        var showname = selArr[i][1];

        if (showname != selArr[i][2]) showname += '-' + selArr[i][2];
        var maxselect = get_car_maxselect(selArr[i][3], selArr[i][12]);
        if (parseFloat(selArr[i][5]) > parseFloat(maxselect)) {
            DialogAlert(showname + "单次最多可以选择" + maxselect + "注");
            return false;

        }
        if (showname == '和值') showname += selArr[i][12];

        var buymin = get_car_buymin(selArr[i][3], selArr[i][12]);
        if (parseFloat(prebuy) < parseFloat(buymin)) {
            DialogAlert(showname + "单注金额不能低于" + buymin + "元");
            return false;

        }

        var buymax = get_car_buymax(selArr[i][3], selArr[i][12]);
        if (parseFloat(selArr[i][6]) > parseFloat(buymax)) {
            DialogAlert(showname + "单注投注金额不能高于" + buymax + "元");
            return false;

        }


        //console.log(selArr[i]);


    }


    return true;

}


var isbuy_btn = 1;

function gamebuy() {
    document.getElementById('lt_sendok').disabled = true;
    setTimeout(function () {
        document.getElementById('lt_sendok').disabled = false;
    }, 2000);

    if (selplay.isbuy != 1 && gamekey != 'MMSSC') {
        DialogAlert("第" + selplay.lotpriod + "期已封单！");
        return false;
    }

    if (check_curtime() == false) return false;


    if (gamekey == "MMSSC") {
        if (parseFloat(G("lostmoney").innerHTML) + parseFloat(G("lt_trace_hmoney11").innerHTML) < parseFloat(G("lt_cf_money").innerHTML) * parseFloat(document.getElementById('qi_num').value)) {

            DialogAlert("您的账户余额不足，请先充值！");

            return false;
        }


    }
    else {
        if (parseFloat(G("lostmoney").innerHTML) + parseFloat(G("lt_trace_hmoney11").innerHTML) < parseFloat(G("lt_cf_money").innerHTML)) {

            DialogAlert("您的账户余额不足，请先充值！");

            return false;
        }


    }


    var moneys = parseFloat(G("lt_cf_money").innerHTML, 10);


    if (moneys - 0.001 > 0 && isbuy_btn == 1) {

        var moneys = sel_money; //注数*倍数

        var showBody = getBuyInfor();//DialogAlert(showBody);//return false;
        var diag = new Dialog();
        diag.Title = "确定投注";
        diag.URL = "/?comes=highgame&controller=game&action=putbuy";
        if (quick_buy != '1') {
            diag.Width = 500;
            diag.Height = 250;

        }
        else {
            diag.Title = "投注中";
            diag.Width = 250;
            diag.Height = 80;


        }
        if (mobile == 1) {
            diag.Width = 300;
            diag.Height = 120;

            if (seltask.istask == "yes") diag.Title = "温馨提示";

        }


        diag.OKEvent = function () {
            document.getElementById("_DialogButtons_0").style.visibility="hidden";

            if (isbuy_btn == 0) {
                DialogAlert("请不要连续点击！");
                return false;
            }
            isbuy_btn = 0;
            if (check_curtime() == false) return false;
            var last_second = G('last_second').innerHTML;
            if (game_close == '1') {
                DialogAlert("该彩种正在维护中，敬请期待");
                return false;
            }


            if (parseFloat(G("lt_cf_money").innerHTML, 10) < 0.02) {
                DialogAlert("投注金额不能低于0.02元");
                return false;
            }


            this.value = "正在提交";
            this.setAttribute('disabled', true);

            var selArr = readSelToArr();
            var selists = "";
            var ThisNum = 0;

            //DialogAlert(selArr.length); return false;
            //*有追号内容seltask={istask:'no',perstop:'no',moneys:'0',nums:'0',list:''}*/
            var total = '';
            var post = '';
            prnlist = '';

            prnmoney = 0;
            var wei_item = '';
            for (i = 0; i < selArr.length; i++) {


                selists = selArr[i].join("|");

                if (wanfa.indexOf(selArr[i][3]) > -1) {


                }
                else {

                    DialogAlert(game_name + selArr[i][1] + selArr[i][2] + "已暂停投注");
                    this.value = "确 定";
                    this.removeAttribute('disabled');
                    ;
                    return false;

                }


                post = post + "&selArr[" + i + "]=" + selists;

                ThisNum += 1;

                total += selArr[i];

                if (seltask.istask == 'no') {

                    try {

                        var wei_str = '';
                        var temp11 = selists.split("|");
                        if (temp11[13].indexOf(',') > 0) {
                            var temp22 = temp11[13].split(",");
                            var weiarr = new Array('万', '千', '百', '十', '个');


                            for (var jj = 0; jj < 5; jj++) {

                                if (temp22[jj] == 1) {
                                    wei_str += weiarr[jj];


                                }
                            }
                            wei_str = '(' + wei_str + ')';

                        }
                    }
                    catch (err) {

                    }


                    prnlist += temp11[1] + '-' + temp11[2] + wei_str + "<br>";
                    if (temp11[12].length > 200)
                        temp11[12] = temp11[12].substr(0, 200);


                    prnlist += "<div style='padding-left:50px;'><span style='width:300px;display:inline-block;word-wrap: break-word; word-break: normal; '>" + temp11[12] + "</span><span >金额：" + temp11[6] + "元</span></div>";
                    prnmoney = parseFloat(prnmoney) + parseFloat(temp11[6]);
                    //	document.getElementById('print_btn').style.display='inline-block';

                }

                else {

                    document.getElementById('print_btn').style.display = 'none';

                }


            }

            //DialogAlert(post);return false;
            //	DialogAlert(total); return false;
            if (G('lt_trace_stop11').checked == true) var lt_trace_stop11 = 1;
            else var lt_trace_stop11 = 0;
            if (G('lt_trace_stop').checked == true) {

                clearTask();

            }

            if (gamekey == 'MMSSC') {

                var period = '';
                var endtime = '';
                post += "&qi_num=" + document.getElementById('qi_num').value;
            }
            else {
                var period = selplay.lotpriod;
                var endtime = selplay.end;

            }

            ajaxobj = new AJAXRequest;
            ajaxobj.method = "POST";
            ajaxobj.content = "selArr=" + selists + "&istask=" + seltask.istask + "&perstop=" + lt_trace_stop11 + "&period=" + period + "&endtime=" + endtime + "&moneys=" + seltask.moneys + "&lists=" + seltask.list + post;
            //prnlist=post;

            //alert(ajaxobj.content);return false;

            ajaxobj.url = $("#do_url").val() + "?mod=ajax&code=game&list=buy&flag=yes&gametype=" + gametype + "&player_item=" + play_item + wei_item;//DialogAlert(ajaxobj.content);return false;

            ajaxobj.callback = function (xmlobj) {
                isbuy_btn = 1;
                var response = Trim(xmlobj.responseText);

                //	console.log(response);
                var re_list = response.split("|");
                if (gamekey == 'MMSSC') {
                    Ajax_get_mmssc();
                    diag.close();


                    MMSSC_buyok(re_list);
                    return false;

                }
                //   var re_title=Re_Buy_Info(re_list[0]);

                if (re_list[1] == 100) {

                    DialogAlert(re_list[2]);
                    return false;

                }

                else
                    var back_info = Re_Back_Info(re_list[1]);
                //var back_info=Re_Back_Info(re_list[1]);


                // diag.innerFrame.contentWindow.document.getElementById('BackInforDiv').style.color=back_info.colors;
                // diag.innerFrame.contentWindow.document.getElementById('BackInforDiv').style.background=back_info.bgcolors;
                // diag.innerFrame.contentWindow.document.getElementById('BackInforDiv').style.border="1px solid "+back_info.colors;
                // diag.innerFrame.contentWindow.document.getElementById('BackInforDiv').innerHTML="提示："+back_info.infos+"！";
                diag.close();


                buy_ok(back_info);

                if (document.getElementById('print_btn').style.display == 'inline-block')
                    set_print_info();

            };
            ajaxobj.send();

            //window.setTimeout("window.parent.document.getElementById('refreshimg').onclick()",1000);


        }
        diag.show();
        var doc = diag.innerFrame.contentWindow.document;
        doc.open();
        if (quick_buy != '1') {

            if (mobile == 1) {
                doc.write("<html><body style='font-size:14px;text-align:center;height:50px'>" + showBody + "</body></html>");
            }
            else
                doc.write("<html><body style='font-size:12px;text-align:center;height:200px'>" + showBody + "</body></html>");

        }
        else {
            doc.write("<html><body style='font-size:12px;text-align:center;height:50px;line-height:50px;'><div style='display:none;'>" + showBody + "</div>正在投注中，请稍后...</body></html>")
            quick_buy = '0';
        }
        ;
        doc.close();

    } else {
        DialogAlert("请添加投注号码！");
    }
}

var current_pro = '';

function MMSSC_buyok(response) {

    if (quick_buy != 1) {
        document.getElementById("lt_cf_count").innerHTML = "0";
        document.getElementById("lt_cf_money").innerHTML = "0";
        document.getElementById("lt_cf_nums").innerHTML = "0";
        document.getElementById("lt_prize_money").innerHTML = "0";
        document.getElementById("lt_prize_money11").innerHTML = "0";
        if (mobile == 1 && gametype != 'k3') {

            document.getElementById('lt_sel_insert').querySelector('span').style.color = '#fff';


        }
        clearTask();
        clearsels();
        set_cf_count_display();
        if (mobile == 1) show_shopcar();
    }
    else {
        quick_buy = '0';

    }

    if (mobile != 1) {

        Ajax_get_buy();
    } else {


        document.getElementById('print_btn').style.display = 'none';
    }


    GetNewMoney();
    var sTop = document.body.scrollTop + document.documentElement.scrollTop;
    if (mobile == 1)
        document.getElementById('messageDiv').style.top = 120 + 'px';

//	else 	document.getElementById('messageDiv').style.top=sTop+250+'px';

    document.getElementById('BgDiv').style.display = 'block';
    document.getElementById('messageDiv').style.display = 'block';
//	document.getElementById('message_con1').innerHTML=back_info.infos;
    close_time = 2;
    timer22 = setInterval("close_time11()", 1000);
    setTimeout(function () {
        buy_close();
    }, 3000);
    var msg = "开奖成功！";


    current_pro = response[6];
    document.getElementById('message_con1').innerHTML = "<div style='text-align:left;'>" + msg + "</div>";
    document.getElementById('print_btn').style.display = 'none'
    Ajax_get_buy();
    Ajax_last_lotnum();

}


function buy_ok(back_info) {

    document.getElementById("waiting").style.display = 'none';
    if (quick_buy != 1) {
        document.getElementById("lt_cf_count").innerHTML = "0";
        document.getElementById("lt_cf_money").innerHTML = "0";
        document.getElementById("lt_cf_nums").innerHTML = "0";
        document.getElementById("lt_prize_money").innerHTML = "0";
        document.getElementById("lt_prize_money11").innerHTML = "0";


        if (mobile == 1) {
            if (gametype != 'k3') {

                document.getElementById('lt_sel_insert').querySelector('span').style.color = '#fff';

                check_zuinum(1);
                check_beinum(1);
                show_shopcar();

            }

        }
        clearTask();
        clearsels();
        set_cf_count_display();
    }
    else {
        quick_buy = '0';

    }

    if (mobile != 1) {
        //Ajax_get_buy();
    } else {


        document.getElementById('print_btn').style.display = 'none';
    }


    GetNewMoney();

    var sTop = document.body.scrollTop + document.documentElement.scrollTop;

    if (mobile == 1) {
        document.getElementById('messageDiv').style.top = 120 + 'px';


    }


    else document.getElementById('messageDiv').style.top = 250 + 'px';
    get_new_lot();
    document.getElementById('BgDiv').style.display = 'block';
    document.getElementById('messageDiv').style.display = 'block';
    document.getElementById('message_con1').innerHTML = back_info.infos;
    close_time = 1;
    timer22 = setInterval("close_time11()", 1000);
    setTimeout(function () {
        buy_close();
    }, 2000);

    document.getElementById('message_con1').innerHTML = back_info.infos;


}

function buy_close() {
    clearInterval(timer22);
    document.getElementById('BgDiv').style.display = 'none';
    document.getElementById('messageDiv').style.display = 'none';
    document.getElementById('close_timer').innerHTML = "关闭";
    location.reload();
}

var close_time = 2;
var timer22 = '';

function close_time11() {

    document.getElementById('close_timer').innerHTML = "关闭(" + close_time + ")";
    close_time--;
}

function print_orders() {
    winname = window.open('', "_blank", '');
    bdhtml = window.document.body.innerHTML;

    winname.document.body.innerHTML = prnhtml;
    winname.print();
    winname.opener = null;
    winname.close();
}

var prnhtml = '';
var prnlist = '';
var prnmoney = 0;

function set_print_info() {

    var html = '';

    html += "彩种:" + game_name + '<br>';
    try {
        html += '期号:' + document.getElementById('current_issue').innerHTML + '<br>';
    }
    catch (err) {
        html += '期号:' + current_pro + '<br>';
    }

    html += prnlist + "<br>";

    html += "投注总金额：" + prnmoney.toFixed(3) + "元<br>";

    var date = new Date();
    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    var day = date.getDate();
    var hour = date.getHours();
    var minute = date.getMinutes();
    var second = date.getSeconds();
    html += '购买时间:' + year + '年' + month + '月' + day + '日 ' + hour + ':' + minute + ':' + second;
    prnhtml = "<title>领航彩票</title><div style='width:100%;line-height:30px;'>" + html + "</div>";


}


function clearsels() {
    G('lt_cf_content').innerHTML = "";
    G('lt_cf_count').innerHTML = "0";
    G('lt_cf_nums').innerHTML = "0";
    G('lt_cf_money').innerHTML = "0";

    G('lt_prize_money').innerHTML = "0";
    G('lt_prize_money11').innerHTML = "0";
    if (mobile == 1 && gametype != 'k3') {

        document.getElementById('lt_sel_insert').querySelector('span').style.color = '#fff';


    }
    buylist = '';
    clearTask();
    hm_check();
    set_cf_count_display();
}

//追号==========================================

function click_zuihao(type) {

    var is_zui = document.getElementById('zuihao_click').checked;


    if ((is_zui == false && type == 0) || (is_zui == true && type == 1)) {
        document.getElementById('zuihao_btn').click();
        if (G('lt_cf_count').innerHTML == "0") {
            document.getElementById('zuihao_click').checked = false;
            G('lt_trace_stop').checked = true;
            return false;
        }
        else
            document.getElementById('zuihao_click').checked = true;

    }
    else {
        document.getElementById('lt_trace_stop').click();
        document.getElementById('zuihao_click').checked = false;
    }
}

function addgametask(ss, div) {

    if (ss == true) {
        if (G('lt_cf_count').innerHTML == "0") {

            DialogAlert("请添加投注号码再进行追号！");
            div.checked = false;
            G('lt_trace_stop').checked = true;
            if (mobile == 1) {
                setTimeout(function () {
                    check_zuinum(1);
                }, 100)
            }
            return false;
        }

        if (mobile == 1) {
            G('lt_trace_stop').checked = false;
            //alert(G('lt_cf_count').innerHTML);
            // document.getElementById('lt_trace_box1').style.display='block';
            //document.getElementById('lt_trace_box1').className='small_show';


        }
        else {

            //	document.getElementById('BgDiv').style.display='block';

            //	message_top();

            //	 document.getElementById('lt_trace_box1').className='xcaik';
            document.getElementById('lt_trace_box1').style.display = 'block';
            //var sTop=document.body.scrollTop+document.documentElement.scrollTop;
            // document.getElementById('lt_trace_box1').style.top=sTop+100+'px';

        }


    } else {
        G('lt_trace_stop').checked = true;
        if (mobile != 1)
            G('lt_trace_box1').style.display = "none";
        else {
            document.getElementById('lt_trace_box1').style.display = 'block';
            // document.getElementById('lt_trace_box1').className='small_hide';


        }
    }
}


function zh_close() {


    G('lt_trace_stop').click();

    document.getElementById('BgDiv').style.display = 'none';

    G('lt_trace_box1').style.display = "none";
    beginTimes(0, '0');
}

function zh_close1() {


    G('lt_trace_stop').click();

    document.getElementById('BgDiv').style.display = 'none';


    //document.getElementById('lt_trace_box1').className='small_hide';
    document.getElementById('lt_trace_box1').style.display = 'none';
    document.getElementById('click_zhuihao').checked = false;
    beginTimes(0, '0');
}

function addgametask1(ss, div) {


    if (ss == true) {
        if (G('lt_cf_count').innerHTML == "0") {
            DialogAlert("请添加投注号码再发起合买！");

            G('lt_trace_stop').click();
            return false;
        }

        if (parseFloat($('#lt_cf_money').html()) < parseFloat($('#hm_min').html())) {

            DialogAlert("合买金额不能低于" + $('#hm_min').html() + "元");

            G('lt_trace_stop').click();
            return false;

        }


        document.getElementById('BgDiv').style.display = 'block';
        message_top();

        document.getElementById('lt_trace_box2').className = 'xcaik';
        document.getElementById('lt_trace_box2').style.display = 'block';

        hm_check();

    } else {

        G('lt_trace_box2').style.display = "none";
    }
}


function hm_close() {


    G('lt_trace_stop').click();
    document.getElementById('BgDiv').style.display = 'none';
    G('lt_trace_box2').style.display = "none";

}

function check_zuinum(value) {
    value = parseInt(value);
    var maxnum = parseInt(selplay.per_sum) - parseInt(selplay.per_num);
    if (maxnum > 120) maxnum = 120;
    if (value > maxnum) {
        value = maxnum;
    }

    if (value < 1) value = 1;

    document.getElementById('zui_num').value = value;
    if (value > 1) {
        document.getElementById("click_zhuihao").click();

        beginTimes(value, 0);

        document.getElementById('lt_cf_money').style.display = 'none';
        document.getElementById('lt_trace_hmoney11').style.display = 'inline-block';

    } else {
        document.getElementById("lt_trace_stop").click();
        document.getElementById('lt_cf_money').style.display = 'inline-block';
        document.getElementById('lt_trace_hmoney11').style.display = 'none';
        document.getElementById('lt_trace_count').innerHTML = value;
    }
}

function check_beinum(value) {
    value = parseInt(value);
    // var maxnum=parseInt(selplay.per_sum)-parseInt(selplay.per_num);
    // if(maxnum>120) maxnum=120;
    // if(value>100){
    //     value=maxnum;
    // }

    if (value < 1) value = 1;

    if (parseInt(document.getElementById('zui_num').value) > 1) {

        beginTimes(document.getElementById('zui_num').value, 0);
        zui_fresh();

    } else {

        if (buylist.length > 1) {
            var sum = 0;
            var buy_arr = new Array();
            if (buylist.indexOf('#') > 0) {
                buy_arr = buylist.split('#');
            } else {
                buy_arr[0] = buylist;
            }


            for (var i = 0; i < buy_arr.length; i++) {
                var temp = buy_arr[i].split('^');

                temp[6] = value * temp[6] / temp[9];
                temp[9] = value;
                sum += temp[6];
                buy_arr[i] = temp.join('^');
            }


            buylist = buy_arr.join('#');

            if (sum > 0) document.getElementById('lt_cf_money').innerHTML = sum.toFixed(3);
        }

//  console.log(buylist);

    }


    document.getElementById('lt_beinum').innerHTML = value;

    document.getElementById('bs_num').value = value;
    document.getElementById('lt_sel_times').value = value;
    document.getElementById('lt_trace_count').innerHTML = document.getElementById('zui_num').value;
}


function clearTask() {
    clearTaskSel();
    seltask.nums = 0;
    if (G('lt_trace_if_button')) {
        G('lt_trace_if_button').checked = false;
    }
    G('lt_trace_stop').checked = true;
    if (G('lt_trace_box1')) {
        G('lt_trace_box1').style.display = "none";
    }
//	G('lt_trace_box2').style.display="none";
    selectSetItem(G('lt_trace_qissueno'), '0');

    if (wanfa_cate == 'qw') {


        var TouZhuMoneys = document.getElementsByName('TouZhuMoneys');
        for (i = 0; i < TouZhuMoneys.length; i++) {
            TouZhuMoneys[i].value = '';
            document.getElementById('kk_' + i).className = 'kk';
        }
    }
}


function change_tabs(num, sum) {
    for (var i = 1; i <= sum; i++) {
        if (i == num) {
            document.getElementById('history_title_' + i).className = 'item active';
            document.getElementById('history_content_' + i).className = 'item active';
        } else {

            document.getElementById('history_title_' + i).className = 'item';
            document.getElementById('history_content_' + i).className = 'item';

        }


    }


}

//Ajax 获取已投注单
function Ajax_get_buy() {

    if (gametype == 'k3' || gametype == 'dp') {

        Ajax_get_buy0();
    }
    else {
        Ajax_get_buy0();
        if (mobile == 0) Ajax_get_buy2();
        ////  Ajax_get_buy3();

    }

}


function Ajax_get_mmssc() {
    ajaxobj = new AJAXRequest;
    ajaxobj.method = "POST";
    ajaxobj.content = "action=mmssc";
    ajaxobj.url = $("#do_url").val() + "?mod=ajax&code=get&list=data&flag=yes";
    ajaxobj.callback = function (xmlobj) {
        var response = xmlobj.responseText;
    };
    ajaxobj.send();

}

function Ajax_get_buy0() {
//	G("history_info_1").innerHTML="<tr><td colspan='3' align='center'>正在刷新...</td></tr>";
    ajaxobj = new AJAXRequest;
    ajaxobj.method = "POST";
    ajaxobj.content = "play=" + gamekey + "&action=historybuy";
    ajaxobj.url = $("#do_url").val() + "?mod=ajax&code=get&list=data&flag=yes&mobile=" + mobile;
    ajaxobj.callback = function (xmlobj) {
        var response = xmlobj.responseText;
        Show_get_buy(response);
    };
    ajaxobj.send();

}

function Ajax_get_buy1() {
    //G("history_info_1").innerHTML="<tr><td colspan='3' align='center'>正在刷新...</td></tr>";
    ajaxobj = new AJAXRequest;
    ajaxobj.method = "POST";
    ajaxobj.content = "play=" + gamekey + "&action=historybuy&current_issue=" + G("current_issue").innerHTML;
    ajaxobj.url = $("#do_url").val() + "?mod=ajax&code=get&list=data&flag=yes";
    ajaxobj.callback = function (xmlobj) {
        var response = xmlobj.responseText;
        Show_get_buy(response);
    };
    ajaxobj.send();

}

function Show_get_buy(skey) {
//DialogAlert(skey);
    if (skey.length < 10) {
        G("history_info_1").innerHTML = "<tr><td colspan='12' align='center'><i class='icon-bell-2 fa-4x' ></i><br>该彩种最近7天没有投注记录</td></tr>";
        return false;
    }
    var code = skey.split("#");
    var codenum = code.length;
    var lists;
    var lastcate = new Array();
    var titles = "";
    var innerHTML = "";

    var length = code.length;
    //if(length>3) length=3;
    for (i = 0; i < length; i++) {

        lists = "";
        lists = code[i].split("^");
        if (lists[0].length - 15 > 0) {
            titles = lists[0].substr(0, 15) + "..";
        } else {
            titles = lists[0];
        }
        var zhao;
        if (lists[10] == "yes") {
            zhao = "<font color='YELLOW'>是</font>";
            var open_url = $("#do_url").val() + "?mod=read&code=game&list=info&flag=yes&uid=" + lists[11];
            var height = "500";
        } else {
            zhao = "否";
            var open_url = $("#do_url").val() + "?mod=read&code=game&list=info&flag=yes&uid=" + lists[11];
            var height = "480";
        }
        if (mobile == 1)
            var onclick = " onclick=\"location.href='home_user_gameinfo.html?mobile=1&id=" + lists[11] + "';\""

        else
            var onclick = " onclick=\"javascript:DialogResetWindow('查看投注单','" + open_url + "','700','460')\"";
        innerHTML += "<tr style='cursor:pointer;'>";
        //innerHTML+="<td "+onclick+">"+lists[9]+"</td>";
        // innerHTML+="<td  "+onclick+">"+lists[19]+"</td>"  ;

        //  innerHTML+="<td><a title='"+lists[0]+"' onclick=\"javascript:DialogResetWindow('查看投注单','"+open_url+"','700','460')\" style='cursor:pointer;' title='查看注单详情' class='blue'>"+titles+"</a></td>"

        //innerHTML+="<td "+onclick+">"+lists[2]+"</td>";
        innerHTML += "<td " + onclick + ">" + lists[3] + "</td>";
        // innerHTML+="<td "+onclick+">"+lists[7]+"</td>"  ;
        //innerHTML+="<td "+onclick+">"+lists[6]+"倍</td>"  ;
        if (lists[4].length - 15 > 0) {
            var con = lists[4].substr(0, 15) + "..";
        } else {
            var con = lists[4];
        }
        if (mobile == 1)
            innerHTML += "<td " + onclick + ">" + con + "</td>";
        innerHTML += "<td " + onclick + ">￥" + lists[8] + "</td>";
        //innerHTML+="<td "+onclick+">"+lists[17]+"</td>";

        //	var isprize=lists[13];

        innerHTML += "<td " + onclick + ">" + lists[13] + "</td>";


        if (lists[14] == 1) {
            // innerHTML+="<td  id='opid_"+lists[15]+"'><a  onclick='gameback("+lists[15]+");' class='blue'>撤单</a></td>";

        } else
        //  innerHTML+="<td><a "+onclick+"  title='查看注单详情' class='blue'>查看</a></td>";
            innerHTML += "</tr>";
    }

    innerHTML += "<tr><td colspan='12' align='center'><a href='home_user_buy.html'>更多投注记录</a></td></tr>";

    G("history_info_1").innerHTML = innerHTML;

}

function gameback(id) {


    ajaxobj = new AJAXRequest;
    ajaxobj.method = "POST";
    ajaxobj.content = "";
    ajaxobj.url = "do.aspx?mod=back&code=game&list=info&flag=yes&active=lot_back&user=1&uid=" + id;
    ajaxobj.callback = function (xmlobj) {
        var response = xmlobj.responseText;
        Ajax_get_buy();
    };
    ajaxobj.send();

    document.querySelector('opid_' + id).innerHTML = '-';


}

function Ajax_get_buy2() {
//	G("history_info_2").innerHTML="<tr><td colspan='3' align='center'>正在刷新...</td></tr>";
    ajaxobj = new AJAXRequest;
    ajaxobj.method = "POST";
    ajaxobj.content = "play=" + gamekey + "&action=historybuy2&current_issue=" + G("current_issue").innerHTML;
    ajaxobj.url = $("#do_url").val() + "?mod=ajax&code=get&list=data&flag=yes";
    ajaxobj.callback = function (xmlobj) {
        var response = xmlobj.responseText;
        Show_get_buy2(response);
    };
    ajaxobj.send();

}

function Show_get_buy2(skey) {
    //console.log(skey);
    if (skey.length < 10) {
        G("history_info_2").innerHTML = "<tr><td colspan='12'  align='center'><i class='icon-bell-2 fa-4x' ></i><br>该彩种最近7天没有追号记录</td></tr>";
        return false;
    }
    var code = skey.split("#");
    var codenum = code.length;
    var lists;
    var lastcate = new Array();
    var titles = "";
    var innerHTML = "";

    var length = code.length;
//	if(length>3) length=3;

    for (i = 0; i < length; i++) {

        lists = "";
        lists = code[i].split("^");
        if (lists[0].length - 15 > 0) {
            titles = lists[0].substr(0, 15) + "..";
        } else {
            titles = lists[0];
        }
        var zhao;
        if (lists[10] == "yes") {
            zhao = "<font color='YELLOW'>是</font>";
            var open_url = $("#do_url").val() + "?mod=read&code=game&list=info&flag=yes&uid=" + lists[11];
            var height = "580";
        } else {
            zhao = "否";
            var open_url = $("#do_url").val() + "?mod=read&code=game&list=info&flag=yes&uid=" + lists[11];
            var height = "580";
        }

        innerHTML += "<tr onclick=\"javascript:DialogResetWindow('查看投注单','" + open_url + "','700','550')\" >";
        // innerHTML+="<td>"+lists[9]+"</td>"  ;
        // innerHTML+="<td>"+lists[21]+"</td>"  ;
        // innerHTML+="<td>"+lists[22]+"</td>"  ;

        //	innerHTML+="<td><a title='"+lists[0]+"' onclick=\"javascript:DialogResetWindow('查看投注单','"+open_url+"','700','550')\" style='cursor:pointer;' title='查看注单详情' class='blue'>"+titles+"</a></td>"

        innerHTML += "<td>" + lists[3] + "</td>";

        var money = parseFloat(lists[18]) + parseFloat(lists[19]) + parseFloat(lists[20]);

        innerHTML += "<td>￥" + lists[18] + "</td>";

        innerHTML += "<td>" + lists[22] + "/" + lists[21] + "</td>";

        innerHTML += "<td>" + lists[13] + "</td>";


        innerHTML += "</tr>";
    }
    innerHTML += "<tr><td colspan='12' align='center'><a href='home_user_task.html'>更多追号记录</a></td></tr>";
    G("history_info_2").innerHTML = innerHTML;

}


function Ajax_get_buy3() {

    ajaxobj = new AJAXRequest;
    ajaxobj.method = "POST";
    ajaxobj.content = "play=" + gamekey + "&action=historybuy3&current_issue=" + G("current_issue").innerHTML;
    ajaxobj.url = $("#do_url").val() + "?mod=ajax&code=get&list=data&flag=yes";
    ajaxobj.callback = function (xmlobj) {
        var response = xmlobj.responseText;
        Show_get_buy3(response);
    };
    ajaxobj.send();

}

function Show_get_buy3(skey) {

    if (skey.length < 2) {
        G("history_info_3").innerHTML = "<tr><td colspan='12'  align='center'><i class='icon-bell-2 fa-4x' ></i><br>您最近7天没有合买记录</td></tr>";
        return false;
    }
    var code = JSON.parse(skey);

    var length = code.length;

    var codenum = code.length;
    var lists;
    var lastcate = new Array();
    var titles = "";
    var innerHTML = "";

    //if(length>3) length=3;

    for (i = 0; i < length; i++) {

        lists = code[i];

        var open_url = "index_hemai_detail.html?id=" + lists.id;
        var onclick = " onclick=\"javascript:DialogResetWindow('查看投注单','" + open_url + "','700','520')\"";
        innerHTML += "<tr " + onclick + " >";
        innerHTML += "<td>" + lists.addtime + "</td>";
        innerHTML += "<td>" + lists.user_name + "</td>";
        innerHTML += "<td>" + lists.game_name + "</td>";
        innerHTML += "<td>第" + lists.period + "期</td>";
        var temp = lists.mebuy + '%';
        if (lists.baodi > 0) temp += "+" + lists.baodi + "%<span class='red'>(保)</span>";
        innerHTML += "<td>" + temp + "</td>";
        innerHTML += "<td>" + lists.sum1 + "</td>";
        innerHTML += "<td>" + lists.premoney + "元</td>";


        innerHTML += "<td>" + lists.status_name + "</td>";
        ;
        innerHTML += "</tr>";
    }
    innerHTML += "<tr><td colspan='12' align='right'><a href='home_user_hemai.html'>更多合买记录</a></td></tr>";
    G("history_info_3").innerHTML = innerHTML;

}


function isPositiveNum(s) {//是否为正整数
    var re = /^[0-9]*[1-9][0-9]*$/;
    return re.test(s)
}

function do_statistics(id, max) {


    var div = 'num_' + id;
    var num = document.getElementById(div).value;
    if (isPositiveNum(num)) {
        if (parseInt(num) > parseInt(max)) {
            document.getElementById(div).value = max;


            window.wxc.xcConfirm('最多认购' + max + '注', window.wxc.xcConfirm.typeEnum.warning);
            return false;
        }


        var xmlHttp;

        if (window.ActiveXObject) {
            xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
        }
        else if (window.XMLHttpRequest) {
            xmlHttp = new XMLHttpRequest();
        }

        xmlHttp.open('GET', "do.aspx?mod=ajax&code=game&list=hmbuy&hm_id=" + id + "&num=" + num, true);
        xmlHttp.onreadystatechange = function () {

            if (xmlHttp.readyState == 4) {
                var response = xmlHttp.responseText;
                var str = response.split("|");

                if (str[0] == 'ok') {

                    window.wxc.xcConfirm("认购成功", window.wxc.xcConfirm.typeEnum.success);
                    Ajax_get_buy3();
                }
                else {

                    window.wxc.xcConfirm(str[1], window.wxc.xcConfirm.typeEnum.warning);
                }
            }


        };
        xmlHttp.send(null);


    }
    else {
        window.wxc.xcConfirm('请输入正整数', window.wxc.xcConfirm.typeEnum.success), window.wxc.xcConfirm.typeEnum.warning;
        document.getElementById(div).value = max;
        return false;
    }


}


Ajax_get_buy();

//get_zuilist();


function CheckTxt11(div, num) {
    var max_select = document.getElementById('max_select_' + num).innerHTML;
    if (parseFloat(div.value) > parseFloat(max_select)) {
        DialogAlert('一次性最多可投' + max_select + '注');
        div.value = '';
        return false;
    }
    if (div.value > 0) {
        document.getElementById('kk_' + num).className = 'kk kkon';
    }
    else document.getElementById('kk_' + num).className = 'kk';
    //
    // var listnum=2;
    // if(listnum){G("base_num").value = G("lt_sel_nums").innerHTML = listnum;Count_Money();}
    // else{G("lt_sel_nums").innerHTML = "0";G("lt_sel_money").innerHTML = "0";G("lt_prize_money").innerHTML="0";G("base_num").value = "0";}
}

function CheckTxt22(playid, id) {


    var div = document.getElementById(playid + '-' + id);


    if (div.value == '') {

        div.value = '1';
    }
    else div.value = '';

    CheckTxt11(div, id);
    CheckTxt(div);
    Count_Money();


}


function ClearTxt() {
    var TouZhuMoneys = document.getElementsByName('TouZhuMoneys');
    for (i = 0; i < TouZhuMoneys.length; i++) {
        TouZhuMoneys[i].value = '';
        document.getElementById('kk_' + i).className = 'kk';
    }
    clearsels();
}

function closeZhuiHao() {

    document.getElementById('buy_area').style.display = 'none';
    ClearTxt();
    document.getElementById('BackInforDiv1').style.display = 'none';
    document.getElementById("button3").style.display = 'none';
    document.getElementById("button1").style.display = 'block';
    document.getElementById('BgDiv').style.display = 'none';
}

function getBuyInfor1() {


    /*投注内容*/
    var qihao = document.getElementById("list_lot_num").value;

    var moneys = document.getElementById("lt_cf_money").innerHTML;
    var selArr = readSelToArr();
    var arrs = new Array();
    var topHTML = "确定加入 " + qihao + " 期?";
    var modes = "";
    var codels = "";
    var numbers = "";
    var innerHTML = '	 <div class="xcaik1"><div class="xcaik1a"><table width="100%"><tbody>';


    for (a = 0; a < selArr.length; a++) {
        arrs = selArr[a];

        modes = arrs[4];
        codels = "[" + arrs[1] + "-" + arrs[2] + "]" + arrs[12];//DialogAlert(arrs[12])
        if (codels.length - 25 > 0) {
            numbers = codels.substr(0, 23) + "..";
        } else {
            numbers = codels;
        }
        if (a % 3 == 0) innerHTML += "<tr>";

        innerHTML += "<td >" + numbers + "<b class=\"red\">" + arrs[6] + "</b>元 &nbsp;<span id='play_" + a + "'></span></td>";

        if ((a + 1) % 3 == 0 && a == selArr.length - 1) innerHTML += "</tr>";
    }
    innerHTML += "</tbody></table></div></div>";
    /*有追号内容seltask={istask:'no',perstop:'no',moneys:'0',nums:'0',list:''}*/
    if (seltask.istask == "yes") {
        var task_moneys = seltask.moneys;
        if (parseFloat(task_moneys, 10) - 0.01 > 0) {
            var zui_peroid = seltask.nums;
            moneys = task_moneys;
            topHTML = "确定要追号 " + zui_peroid + " 期？"
        }
    }
    var retuenHTML = "";
    retuenHTML += innerHTML;
    retuenHTML += "<div class=\"xcaik2b\">总共投注<b class=\"red\">" + selArr.length + "</b>。共计 <b class=\"red\">" + moneys + "</b>元</div></div>";
    return retuenHTML;
}

function qwinsertline() {
    var last_second = G('last_second').innerHTML;


    var ss = check_post();
    if (ss == false) {

        return false;
    }

    var playid = playlist.playid;

    var TouZhuMoneys = document.getElementsByName('TouZhuMoneys');
    var title_name = document.getElementsByName('title_name');
    var comoney = G('lt_cf_money').innerHTML;
    var conum = G('lt_cf_count').innerHTML;

    var lines = reselline();
    var code = selplay.code;
    var titles = selplay.plays;
    var playid = playlist.playid;
    var primode = document.getElementById("usermode").value;
    G("lt_sel_nums").innerHTML = nums;
    var modes = getselectValue(G('lt_project_modes'));


    var times = selplay.times;//当前的倍数


    if (modes == "") {
        modes = "yuan";
    }
    if (times == '') times = 1;


    var CurMode = document.getElementById("select_mode").value;
    var CurModeType = selplay.CurModeType;

    var lotpriod = selplay.lotpriod;


    var click_str = '';
    var money = 0;
    var nums = 0;
    for (var i = 0; i < TouZhuMoneys.length; i++) {
        if (TouZhuMoneys[i].value >= 1 && TouZhuMoneys[i].value.indexOf(".") == -1) {

            if (click_str != '') click_str += ',';
            click_str += title_name[i].value;

            money = +TouZhuMoneys[i].value;
            nums++;
        }

    }

    if (code == titles) var st = code;
    else {
        if (arrPlays[play_item][play_id]['CodeTile'])
            var st = code + "," + arrPlays[play_item][play_id]['CodeTile'] + ',' + titles;
        else
            var st = code + "," + titles;

    }

    var showcode = "[" + st + "]" + click_str;

    var ids = RndNum(5);

    var showNums = '';
    if (showcode.length - 30 > 0) {
        showNums = "[" + code + "-" + titles + "]" + "...";
    } else {
        showNums = showcode;
    }


    if (modes == "yuan") {
        money = nums * times * 2;
        var mode = '元'
    }
    if (modes == "jiao") {
        money = nums * times * 2 / 10;
        var mode = '角';
    }
    if (modes == "fen") {
        money = nums * times * 2 / 100;
        var mode = '分';
    }
    if (modes == "li") {
        money = nums * times * 2 / 1000;
        var mode = '厘';
    }
    var innerHTML = gamekey + "^" + code + "^" + titles + "^" + playid + "^" + mode + "^" + nums + "^" + money + "^" + CurMode + "^" + CurModeType + "^" + times + "^" + lotpriod + "^" + ids + "^" + click_str + "^0";//DialogAlert(comps)
    if (quick_buy == 1) {

        buylist1 = innerHTML;
        return true;
    }

    lines = click_str;
    var showHTML = set_shopcar_html(ids, playid, code, lines, titles, mode, times, nums, money, showNums, innerHTML);
    set_buylist(innerHTML);
    var msgObj = document.createElement("div");
    msgObj.id = "div_" + playid + "_" + ids;
    msgObj.className = "sel_div";
    msgObj.innerHTML = showHTML;
    G('lt_cf_content').appendChild(msgObj);
    comoney = parseFloat(comoney) + parseFloat(money);
    conum = parseFloat(conum) + parseFloat(nums);


    G('lt_cf_count').innerHTML = conum;
    G('lt_cf_nums').innerHTML = conum;

    comoney = comoney.toFixed(2);
    G('lt_cf_money').innerHTML = comoney;
    hm_check();
    set_cf_count_display();
    var TouZhuMoneys = document.getElementsByName('TouZhuMoneys');
    for (i = 0; i < TouZhuMoneys.length; i++) {
        TouZhuMoneys[i].value = '';
        document.getElementById('kk_' + i).className = 'kk';
    }
    G("lt_sel_nums").innerHTML = "0";
    G("lt_sel_money").innerHTML = "0";
    G("lt_prize_money").innerHTML = "0";
    G("base_num").value = "0";
    G("lt_prize_money11").innerHTML = "0"
    sel_nums = "0";
    sel_money = "0";


    if (mobile == 1 && gametype != 'k3') {

        document.getElementById('lt_sel_insert').querySelector('span').style.color = '#fff';

    }


//clear_sel();

    //ClearTxt();
}


function CZH() {


    var temp = 0;
    var TouZhuMoneys = document.getElementsByName('TouZhuMoneys');
    for (i = 0; i < TouZhuMoneys.length; i++) {

        if (TouZhuMoneys[i].value > 0) {
            temp = 1;
            break;
        }

    }
    if (temp == 0) {

        DialogAlert('请先选号');
        return false;
    }
    else {
        var last_second = G('last_second').innerHTML;


        document.getElementById('BgDiv').style.height = document.body.clientHeight + 'px';
        document.getElementById('BgDiv').style.display = 'block';

        qwinsertline();

        var buy_html = "<div  class='buy_info'><ul>";
        var TouZhuMoneys = document.getElementsByName('TouZhuMoneys');
        var title_name = document.getElementsByName('title_name');
        for (i = 0; i < TouZhuMoneys.length; i++) {

            if (TouZhuMoneys[i].value > 0) {

                buy_html += "<li>" + selplay.code + title_name[i].innerHTML + "&nbsp;&nbsp;&nbsp;<font style='color:red;font-weight:700;'>" + TouZhuMoneys[i].value + "</font>元</li>";

            }

        }
        buy_html += "</ul></div>";
        var buyinfo1 = getBuyInfor1();

        message_top();
        document.getElementById('buyinfo1').innerHTML = buyinfo1;
        document.getElementById('buy_area').className = 'xcaik';
        document.getElementById('buy_area').style.display = 'block';
        var sTop = document.body.scrollTop + document.documentElement.scrollTop;
        document.getElementById('buy_area').style.top = sTop + 140 + 'px';

    }


}


function gamebuy_qw() {
    if (parseFloat(G("lostmoney").innerHTML) + parseFloat(G("lt_trace_hmoney11").innerHTML) < parseFloat(G("lt_cf_money").innerHTML)) {

        DialogAlert("您的账户余额不足，请先充值！");

        return false;
    }


    if (confirm('确定要投注吗? ') == false) {
        return false;
    }
    else {
        document.getElementById("button1").style.display = 'none';
        document.getElementById("button2").style.display = 'block';
    }


    var last_second = G('last_second').innerHTML;


    var selArr = readSelToArr();
    var selists = "";
    var ThisNum = 0;

    var post = '';
    message_top();

    for (i = 0; i < selArr.length; i++) {
        selists = selArr[i].join("|");
        post = post + "&selArr[" + i + "]=" + selists;

        ThisNum += 1;
    }
    if (G('lt_trace_stop11').checked == true) var lt_trace_stop11 = 1;
    else var lt_trace_stop11 = 0;
    if (G('lt_trace_stop').checked == true) {

        clearTask();

    }

    var period = document.getElementById('current_issue').innerHTML;
    var endtime = document.getElementById('current_endtime').innerHTML;


    ajaxobj = new AJAXRequest;
    ajaxobj.method = "POST";
    ajaxobj.content = "istask=" + seltask.istask + "&perstop=" + lt_trace_stop11 + "&moneys=" + seltask.moneys + "&lists=" + seltask.list + post;
    //	DialogAlert(ajaxobj.content);return false;
    ajaxobj.url = $("#do_url").val() + "?mod=ajax&code=game&list=buy&flag=yes&prenum=1&period=" + period + "&endtime=" + endtime + "&player_item=" + play_item;//DialogAlert(ajaxobj.content);return false;


    ajaxobj.callback = function (xmlobj) {
        var response = Trim(xmlobj.responseText);
        //DialogAlert(response);
        response.indexOf("|");

        var re_list = response.split("|");

        var re_title = Re_Buy_Info(re_list[0]);
        var back_info = Re_Back_Info(re_list[1]);

        ThisNum += 1;
        document.getElementById('messageDiv').style.display = 'block';

        document.getElementById('message_con1').innerHTML = back_info.infos;
        document.getElementById("button2").style.display = 'none';
        document.getElementById("button3").style.display = 'block';

        document.getElementById("lt_cf_count").innerHTML = "0";
        set_cf_count_display();
        document.getElementById("lt_cf_money").innerHTML = "0";
        document.getElementById("lt_cf_nums").innerHTML = "0";
        document.getElementById("lt_prize_money").innerHTML = "0";
        document.getElementById("lt_prize_money11").innerHTML = "0";
        hm_check();
        clearTask();
        clearsels();

        GetNewMoney();
        Ajax_get_buy();
        get_zuilist();
        closeZhuiHao1();

        document.getElementById('BgDiv').style.display = 'block';
        setTimeout(function () {
            document.getElementById('BgDiv').style.display = 'none';
            document.getElementById('messageDiv').style.display = 'none';
        }, 3000);

    };
    ajaxobj.send();


}


function closeZhuiHao1() {

    closeZhuiHao();
    GetNewMoney();
    Ajax_get_buy();
    get_zuilist();
    clear_sel();
    document.getElementById('BackInforDiv1').style.display = 'none';
}


function CheckTxt(obj) {
    $(obj).val($(obj).val().replace(/[^\d]/g, ""));
    var objs = $(obj).attr("id").split("_");
    var xb = objs[5];
    var objv = $(obj).val();
    if (objv.length > 0) {
        $(obj).parent().parent(".kk").removeClass().addClass("kk kkon");
        if (parseInt(objv) > parseInt(xb)) {
            DialogAlert("超过最大限倍");
            $(obj).val(objv.substring(0, objv.length - 1));
        }
        //写入选号标识
        $(obj).parent().find('input[name="etNums"]').val($(obj).attr("id"));
    } else {
        $(obj).parent().parent(".kk.kkon").removeClass().addClass("kk");
        //删除选号标识
        $(obj).parent().find('input[name="etNums"]').val("");
    }


}


function hm_check() {


    var lt_trace_if = document.getElementsByName('lt_trace_if');
    var temp = 1;
    for (var i = 0; i < lt_trace_if.length; i++) {

        if (lt_trace_if[i].checked) temp = lt_trace_if[i].value;


    }

    if (temp == 4) {

        if (parseFloat($('#lt_cf_money').html()) < parseFloat($('#hm_min').html())) {

            G('hm_tip').style.display = "block";

        }
        else
            G('hm_tip').style.display = "none";


        G('hm_sum').value = parseInt(G('lt_cf_money').innerHTML);
        set_hm_sum();


    }


}

var hm_fee = 0;

function set_hm_fee(value) {

    hm_fee = value;
    if (value == 0) value = 1;

    G('minCreaterBuyPercent').innerHTML = value;

    var createrBuyMoney = G('lt_cf_money').innerHTML * value / 100;

    if (createrBuyMoney < parseFloat(G('perPieceMoney').innerHTML)) {

        createrBuyMoney = G('perPieceMoney').innerHTML;
        var hm_mebuy = 1;
    }
    else {
        var hm_mebuy = Math.ceil(createrBuyMoney / parseFloat(G('perPieceMoney').innerHTML));

        createrBuyMoney = hm_mebuy * parseFloat(G('perPieceMoney').innerHTML);

    }
    if (parseFloat(G('hm_mebuy').value) < hm_mebuy) {
        G('hm_mebuy').value = hm_mebuy;

    }
    set_hm_sum();
    //G('createrBuyMoney').createrBuyMoney=createrBuyMoney;
}


function set_hm_sum() {
    G('createrBuyMoney').innerHTML = parseFloat(G('hm_mebuy').value * G('perPieceMoney').innerHTML).toFixed(3);
    var money = parseFloat(G('lt_cf_money').innerHTML);

    var sum = G('hm_sum').value;
    set_hm_result();
    var re = /^[0-9]*[1-9][0-9]*$/;
    if (re.test(sum)) {


        sum = parseInt(sum);
        var vv = money / sum;
        //DialogAlert(vv);
        if (parseFloat(vv) < parseFloat(G('hm_min_money').innerHTML)) {

            DialogAlert('每份最低不能低于' + G('hm_min_money').innerHTML + '元');
            G('hm_sum').value = parseInt(G('lt_cf_money').innerHTML);
            G('perPieceMoney').innerHTML = 0;
            return false;

        }
        else {

            G('perPieceMoney').innerHTML = vv.toFixed(3);
            if (G('hm_fee').value > 0) {

                //set_hm_fee(G('hm_fee').value);

            }
            else {
                //G('hm_mebuy').value=1;
                G('createrBuyMoney').innerHTML = vv.toFixed(3);

                G('minCreaterBuyPercent').innerHTML = 1;
                set_hm_result();
            }


        }


    }

    else {

        DialogAlert('请输入正整数');
        G('hm_sum').value = parseInt(G('lt_cf_money').innerHTML);
        G('perPieceMoney').innerHTML = 0;
        set_hm_result();
        return false;

    }
    return true;
}


function set_hm_baodi() {

    var sum = G('hm_baodi').value;

    var re = /^[0-9]*[0-9][0-9]*$/;
    if (re.test(sum)) {
        sum = parseInt(sum);
        var vv = parseFloat(G('hm_sum').value) - parseFloat(G('hm_mebuy').value);
        //DialogAlert(vv);
        if (parseFloat(vv) < sum) {

            DialogAlert('最多保底' + vv + '份');
            G('hm_baodi').value = vv;
            G('hmBaodiMoney').innerHTML = 0;
            set_hm_result();
            return false;

        }
        else {
            G('hmBaodiMoney').innerHTML = parseFloat(sum * G('perPieceMoney').innerHTML).toFixed(3);
            set_hm_result();
        }


    }

    else {

        DialogAlert('请输入正整数');
        G('hm_baodi').value = '0';
        G('hmBaodiMoney').innerHTML = 0;
        set_hm_result();
        return false;

    }


}


function set_hm_result() {
    //var sum=parseInt(G('createrBuyMoney').innerHTML)+parseInt(G('hmBaodiMoney').innerHTML);
    var pay_sum = parseFloat(parseFloat(G('createrBuyMoney').innerHTML) + parseFloat(G('hmBaodiMoney').innerHTML)).toFixed(3);
    G('hm_result').innerHTML = '需支付：<span><strong  class="c_ba2636" id="hm_money">' + pay_sum + '</strong>元(认购' + G('createrBuyMoney').innerHTML + '元+保底' + G('hmBaodiMoney').innerHTML + '元)</span>';
}


function hmsub_check() {


    if (parseFloat(G('hm_mebuy').value) > parseFloat(G('hm_sum').value)) {

        DialogAlert("认购份数不能大于" + G('hm_sum').value);

        return false;
    }

    if (parseFloat(G('hm_mebuy').value) + parseFloat(G('hm_baodi').value) > parseFloat(G('hm_sum').value)) {

        DialogAlert("认购+保底不能大于" + G('hm_sum').value);

        return false;
    }
    var last_buy = parseInt(parseInt(G('hm_sum').value) * parseInt(G('minCreaterBuyPercent').innerHTML) / 100);
    if (parseInt(G('hm_mebuy').value) < last_buy) {
        DialogAlert('您至少需要认购' + last_buy + '份');
        G('hm_mebuy').value = last_buy;
        return false;

    }

}

function gamebuy_hm() {
    if (hmsub_check() == false) return false;
    var rr = set_hm_sum();

    if (rr == false) return false;
    if (game_close == '1') {
        DialogAlert("该彩种正在维护中，敬请期待");
        return false;
    }
    if (parseFloat(G("hm_money").innerHTML) > parseFloat(G("lostmoney").innerHTML) + parseFloat(G("lt_trace_hmoney11").innerHTML)) {

        DialogAlert("您的账户余额不足，请先充值！");

        return false;
    }

    var last_second = G('last_second').innerHTML;


    var selArr = readSelToArr();
    var selists = "";
    var ThisNum = 0;
    var wei_item = '';
    //	DialogAlert(selArr.length); return false;
    //*有追号内容seltask={istask:'no',perstop:'no',moneys:'0',nums:'0',list:''}*/
    var total = '';
    var post = '';
    for (i = 0; i < selArr.length; i++) {
        selists = selArr[i].join("|");
        post = post + "&selArr[" + i + "]=" + selists;

        ThisNum += 1;

        total += selArr[i];

    }
    var period = document.getElementById('current_issue').innerHTML;
    var endtime = document.getElementById('current_endtime').innerHTML;
    var hm_view = document.getElementsByName('hm_view');
    var hm_view1 = 0;
    for (var i = 0; i < hm_view.length; i++) {
        if (hm_view[i].checked == true)
            hm_view1 = hm_view[i].value;


    }

    document.getElementById("button1").style.display = 'none';
    document.getElementById("button2").style.display = 'block';
    document.getElementById('print_btn').style.display = 'none';
    post += '&hm_fee=' + G("hm_fee").value + '&hm_sum=' + G("hm_sum").value + '&hm_mebuy=' + G("hm_mebuy").value + '&hm_baodi=' + G("hm_baodi").value + '&hm_view=' + hm_view1;
    ajaxobj = new AJAXRequest;
    ajaxobj.method = "POST";
    ajaxobj.content = "selArr=" + selists + "&istask=" + seltask.istask + "&perstop=" + lt_trace_stop11 + "&period=" + period + "&endtime=" + endtime + "&moneys=" + seltask.moneys + "&lists=" + seltask.list + post;

    //DialogAlert(ajaxobj.content);return false;
    ajaxobj.url = $("#do_url").val() + "?mod=ajax&code=game&list=hm&flag=yes&player_item=" + play_item + wei_item;//DialogAlert(ajaxobj.content);return false;


    ajaxobj.callback = function (xmlobj) {
        var response = Trim(xmlobj.responseText);

        var str = response.split("|");
        hm_close();
        if (str[0] == 'ok') {

            //DialogAlert(str[1]);
            var back_info = {colors: '#246732', bgcolors: '#CAF5D3', infos: '合买成功'};
            buy_ok(back_info);
        }
        else {

            var back_info = {colors: '#C2130E', bgcolors: '#CAF5D3', infos: str[1]};
            buy_ok(back_info);
        }


//			buy_ok(back_info);

    };
    ajaxobj.send();


}


var wait_time = 0;

function wait_time12() {

    wait_time = 0;
    document.getElementById("upload_pre").innerHTML = 0;
    document.getElementById('BgDiv').style.display = 'block';
    document.getElementById("waiting").style.display = 'block';

    setInterval(function () {
        wait_time1();
    }, 1000);
}

function wait_time1() {
    var time_arr = Array('25', '50', '75', '98', '98', '98', '98', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99');
    document.getElementById("upload_pre").innerHTML = time_arr[wait_time];
    if (wait_time < time_arr.length - 1)

        wait_time++;
    else
        wait_time = 0;

}


function check_post() {
    if (gamekey == 'MMSSC') {
        if (sel_money == "0") {
            DialogAlert("请选择完整号码再投注！");
            return false;
        }
        return true;
    }
    if (selplay.isbuy == "no") {
        DialogAlert("未到销售时间禁止下注！");
        return false;
    }

    if (play_id.indexOf('ds') < 0 && play_id.indexOf('DS') < 0) {

        if (sel_money == "0") {
            DialogAlert("请选择完整号码再投注！");
            return false;
        }
    }


    var plays = arrPlayList[play_id];

    if (plays.max_select.indexOf('|') > 0) {

        var temp = plays.max_select.split('|');
        var max = 0;
        for (var i = 0; i < temp.length; i++) {

            max += parseInt(temp[i]);

        }


    }
    else {
        var max = parseInt(plays.max_select);


    }
    //' if(max>0){
    if (parseInt(document.getElementById('lt_sel_nums').innerHTML) > max) {

        DialogAlert(arrPlays[play_item][play_id].ShowTile + "一次性最多只能投" + max + "注！");
        return false;
    }

    // }

    return true;

}


var quick_step = 1;

function fast_buy() {


//	quick_buy=1;
    var plays = arrPlayList[play_id];


    var linum = 0;
    var shownum = Trim(plays.shownum);

    var show_other = Trim(plays.show_other);
    var show_key = Trim(plays.show_key);

    if (selplay.isbuy != 1 && gamekey != 'MMSSC') {
        DialogAlert("未到销售时间禁止下注！");
        return false;
    }


    if (game_close == '1') {
        DialogAlert("该彩种正在维护中，敬请期待");
        return false;
    }

    if (wanfa.indexOf(play_id) > -1) {


    }
    else {

        DialogAlert(game_name + arrPlays[play_item][play_id]['ShowTile'] + "已暂停投注");
        return false;

    }


    if ((shownum == "0") && (show_other == "0") && (show_key == "0")) {


        if (quick_buy == 0) {
            quick_buy = 1;


            countinput();
            var tt = $('#lt_write_box').val();
            if (tt.length < 500) window.setTimeout("fast_buy()", 500);
            else if (tt.length > 500 && tt.length < 5000) window.setTimeout("fast_buy()", 1000);
            else if (tt.length > 5000) window.setTimeout("fast_buy()", 1500);
//else if(tt.length>20000 && tt.length<50000)window.setTimeout("fast_buy()",2000);
//else if(tt.length>50000 && tt.length<100000)window.setTimeout("fast_buy()",3000);
            else window.setTimeout("fast_buy()", 2000);
            return false;
        }
        quick_buy = 1;

        G('lt_write_box').value = '';

        //	add_input_ds(plays,'Normal');

        if (wanfa_cate == 'qw') {


            var rr = qwinsertline();

        }
        else {

            var rr = boxinsertline();
        }

    }
    else {
        if (sel_money == "0") {
            DialogAlert("请选择完整号码再投注！");
            return false;
        }
        quick_buy = 1;


        if (wanfa_cate == 'qw') {


            var rr = qwinsertline();

        }
        else {

            var rr = selinsertline();
        }

    }


    //document.getElementById('lt_sel_insert').click();
    var divid = "";
    var dividlen = 0;
    var spanid = "";
    var sphtml = "";
    var splist = new Array();
    var arrs = new Array();
    var strs = buylist1.split("#");
////
    for (var i = 0; i < strs.length; i++) {
////
        sphtml = strs[i];
        ;
        arrs = sphtml.split("^");
        splist[i] = arrs;

    }
    var selArr = splist;
    var moneys = parseFloat(splist[0][6]);


    var ss = check_post();
    if (ss == false) {

        return false;
    }


    var wei_item = '';

    if (gamekey == 'MMSSC') {

        moneys = moneys * parseFloat(document.getElementById('qi_num').value);

    }


    if (moneys - 0.02 >= 0) {
        if (playlist.playid == '5X_ds' || playlist.playid == '4X_ds' || playlist.playid == 'RXDS_5z4') wait_time12();


        if (parseFloat(G("lostmoney").innerHTML) + parseFloat(G("lt_trace_hmoney11").innerHTML) < moneys) {


            DialogAlert("您的账户余额不足，请先充值！");
            document.getElementById("waiting").style.display = 'none';
            document.getElementById('BgDiv').style.display = 'none';
            return false;
        }

        var last_second = G('last_second').innerHTML;


        var diag = new Dialog();
        diag.Title = "确定投注";
        diag.URL = "/?comes=highgame&controller=game&action=putbuy";

        diag.Title = "投注中";
        diag.Width = 250;
        diag.Height = 80;
        var selists = "";
        var ThisNum = 0;

        //	DialogAlert(selArr.length); return false;
        //*有追号内容seltask={istask:'no',perstop:'no',moneys:'0',nums:'0',list:''}*/
        var total = '';
        var post = '';
        prnlist = '';

        prnmoney = 0;


        //alert(selArr);return false;
        for (i = 0; i < selArr.length; i++) {
            selists = selArr[i].join("|");


            var wei_str = '';
            var temp11 = selists.split("|");
            try {

                if (temp11[13].indexOf(',') > 0) {
                    var temp22 = temp11[13].split(",");
                    var weiarr = new Array('万', '千', '百', '十', '个');


                    for (var jj = 0; jj < 5; jj++) {

                        if (temp22[jj] == 1) {
                            wei_str += weiarr[jj];


                        }
                    }
                    wei_str = '(' + wei_str + ')';

                }
            }
            catch (err) {
                //在此处理错误
            }


            post = post + "&selArr[" + i + "]=" + selists;

            ThisNum += 1;

            total += selArr[i];
            var temp11 = selists.split("|");
            prnlist += temp11[1] + '-' + temp11[2] + wei_str + "<br>";
            if (temp11[12].length > 200)
                temp11[12] = temp11[12].substr(0, 200);
            prnlist += "<div style='padding-left:50px;'><span style='width:300px;display:inline-block;word-wrap: break-word; word-break: normal; '>" + temp11[12] + "</span><span >金额：" + temp11[6] + "元</span></div>";
            prnmoney = parseFloat(prnmoney) + parseFloat(temp11[6]);
        }

        //DialogAlert(post);return false;
        //	DialogAlert(total); return false;
        if (G('lt_trace_stop11').checked == true) var lt_trace_stop11 = 1;
        else var lt_trace_stop11 = 0;
        if (G('lt_trace_stop').checked == true) {

            clearTask();

        }


        if (gamekey == 'MMSSC') {

            var period = '';
            var endtime = '';
            post += "&qi_num=" + document.getElementById('qi_num').value;
        }
        else {
            var period = document.getElementById('current_issue').innerHTML;
            var endtime = document.getElementById('current_endtime').innerHTML;

        }


        ajaxobj = new AJAXRequest;
        ajaxobj.method = "POST";
        ajaxobj.content = "selArr=" + selists + "&istask=" + seltask.istask + "&perstop=" + lt_trace_stop11 + "&period=" + period + "&endtime=" + endtime + "&moneys=" + seltask.moneys + "&lists=" + seltask.list + post;

        //DialogAlert(ajaxobj.content);return false;
        ajaxobj.url = $("#do_url").val() + "?mod=ajax&code=game&list=buy&flag=yes&player_item=" + play_item + wei_item;//DialogAlert(ajaxobj.content);return false;


        ajaxobj.callback = function (xmlobj) {
            var response = Trim(xmlobj.responseText);
            //DialogAlert(response);

            clear_sel();


            var re_list = response.split("|");
            if (gamekey == 'MMSSC') {

                Ajax_get_mmssc();
                MMSSC_buyok(re_list);
                buylist1 = '';
                diag.close();
                return false;

            }
            var re_title = Re_Buy_Info(re_list[0]);

            if (re_list[1] == 100) {
                //var back_info={colors:'#C2130E',bgcolors:'#FBD2D2',infos:re_list[2]};
                DialogAlert(re_list[2]);
                return false;

            }

            else
                var back_info = Re_Back_Info(re_list[1]);


            document.getElementById("lt_prize_money").innerHTML = "0";
            document.getElementById("lt_prize_money11").innerHTML = "0";
            hm_check();
            if (document.getElementById("waiting").style.display != 'block')
                diag.close();
            buylist1 = '';

            buy_ok(back_info);
            //document.getElementById('print_btn').style.display='inline-block'
            set_print_info();


        };
        ajaxobj.send();

        //window.setTimeout("window.parent.document.getElementById('refreshimg').onclick()",1000);


        diag.show();


        if (document.getElementById("waiting").style.display != 'block') {
            var doc = diag.innerFrame.contentWindow.document;
            doc.open();

            doc.write("<html><body style='font-size:12px;text-align:center;height:50px;line-height:50px;'>正在投注中，请稍后...</body></html>")


            doc.close();
        } else diag.close();

    } else {

        DialogAlert("投注金额不能低于0.02元");
        return false;
    }


}


function open_history(num) {

    var ibet = document.querySelector('.selectType').querySelectorAll('.ibet');

    for (var i = 0; i < ibet.length; i++) {
        if (i == num) ibet[i].className = 'ibet on';
        else ibet[i].className = 'ibet';

    }
    if (num == 1) {
		Ajax_get_buy();
        document.querySelector('.lottery-order').style.display = 'block';
    }
    else {
        document.querySelector('.lottery-order').style.display = 'none';

    }
}





