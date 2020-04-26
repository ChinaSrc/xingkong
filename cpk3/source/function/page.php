<?php
class Page{
    public $page;//当前页
    public $total;//总条数
    public $totalpage;//总页数
    public $num;//每页条数
    public $from;//开始位置
    public $url;//当前url
    public $pagenum;//关联页数
    function __construct($sql,$num,$page,$pagenum='3', $total=null){
        if(!$page) $page=1;
        $this->num=$num;
        $this->page=$page;
        $this->pagenum=$pagenum;

        if($total!= null) {
					$this->total= $total;
				} else {
					$query=mysql_query($sql);
					$this->total=@mysql_num_rows($query);
				}

        if($this->total%$num==0)
            $this->totalpage= floor ($this->total/$num);
        else
            $this->totalpage= floor($this->total/$num)+1;
        if($page>$this->totalpage)
            $page=$this->totalpage;
        $this->from=$this->num*($this->page-1);
        if($this->from<0)
            $this->from=0;

    }

    function set_url($page){

        $url="//".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        if(strpos($url,"?")!==false){
            if(strpos($url,"page")!==false){
                if(!strpos($url,"page"))
                    $this->url=$url."?page=".$page;
                else{
                    $u=explode("?", $url);
                    $this->url=$u[0];
                    $u=explode("&", $u[1]);

                    for($i=0;$i<count($u);$i++){

                        if(strpos($u[$i],"page")===false){

                             if(strpos($this->url,"?")!==false)
                                 $this->url.="&".$u[$i];
                                 else
                            $this->url.="?".$u[$i];


                        }

                    }
                    if(strpos($this->url,"?")!==false)

                        $this->url=$this->url."&page=".$page;
                        else
                    $this->url=$this->url."?page=".$page;
                }

            }
            else
                $this->url=$url."&page=".$page;
        }

        else
            $this->url=$url."?page=".$page;
        return $this->url;
    }


//上一页
    function get_pre_page($page){
        if($page<$this->pagenum)
            $this->pagenum=$page;
        $start=$page-$this->pagenum;
        if($start<1) $start=1;
        for($i=$start;$i<$page;$i++){
            if($i!=$this->page)
                return  "<li>&nbsp;<a href='".$this->set_url($i)."' class='page'>".$i."</a></li>";
            else
                return  $this->page;
        }
    }



//下一页
    function get_next_page($page){
        $from=$page - $this->pagenum;
        if($from<1) $from=1;
        $to=$page + $this->pagenum;
        if($to>$this->totalpage) $to=$this->totalpage;



$html='';
        for($i=$from;$i<=$to;$i++){
            if($i!=$this->page)
                $html.=  "<a href='".$this->set_url($i)."' >".$i."</a>";
            else
                $html.=   "<span class='current'>".$this->page."</span>";

        }

        return $html;
    }



    function get_page(){

        if($this->totalpage>1){

            $html= "页次".$this->page."/".$this->totalpage."&nbsp;共".$this->total."条 &nbsp; ";
            if($this->page>1){
                $html.="<a href='".$this->set_url(1)."'>首页</a><a href='".$this->set_url($this->page-1)."'>&lt;&lt;</a>&nbsp;";
                $this->get_pre_page($this->page);
            }
            else $html.="";
            $html.=  $this->get_next_page($this->page);
            if($this->page>=$this->totalpage)
                $html.='';
            else {

                $html.= "<a href='".$this->set_url($this->page+1)."'>&gt;&gt;</a>&nbsp;$htmlapt&nbsp;<a href='".$this->set_url($this->totalpage)."'>尾页</a>&nbsp;";
            }
          	$html .= '转到 <select id ="pageselect" onchange="location.href=\'' . $this->set_url('') . '\'+this.value">';
          	for ($i = 1; $i <= $this->totalpage; $i++) {
              	$selected = '';
              	if ($i == $this->page) {$selected = 'selected';}
            	$html .='<option value="' . $i . '" ' . $selected .'>' . $i . '</option>';
            }
          	$html .= '</select> 页';
            return $html;

        }

    }

}

class Page1{
    public $page;//当前页
    public $total;//总条数
    public $totalpage;//总页数
    public $num;//每页条数
    public $from;//开始位置
    public $url;//当前url
    public $pagenum;//关联页数
    function __construct($num,$page,$total,$pagenum=3){
        if(!$page) $page=1;
        $this->num=$num;
        $this->page=$page;
        $this->pagenum=$pagenum;

        $this->total=$total;
        if($this->total%$num==0)
            $this->totalpage= floor ($this->total/$num);
        else
            $this->totalpage= floor($this->total/$num)+1;
        if($page>$this->totalpage)
            $page=$this->totalpage;
        $this->from=$this->num*($this->page-1);
        if($this->from<0)
            $this->from=0;

    }

    function set_url($page){


        $url="//".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        if(strpos($url,"?")!==false){
            if(strpos($url,"page")!==false){
                if(!strpos($url,"page"))
                    $this->url=$url."?page=".$page;
                else{
                    $u=explode("?", $url);
                    $this->url=$u[0];
                    $u=explode("&", $u[1]);

                    for($i=0;$i<count($u);$i++){

                        if(strpos($u[$i],"page")===false){

                            if(strpos($this->url,"?")!==false)
                                $this->url.="&".$u[$i];
                            else
                                $this->url.="?".$u[$i];


                        }

                    }
                    if(strpos($this->url,"?")!==false)

                        $this->url=$this->url."&page=".$page;
                    else
                        $this->url=$this->url."?page=".$page;
                }

            }
            else
                $this->url=$url."&page=".$page;
        }

        else
            $this->url=$url."?page=".$page;
        return $this->url;
    }


//上一页
    function get_pre_page($page){
        if($page<$this->pagenum)
            $this->pagenum=$page;
        $start=$page-$this->pagenum;
        if($start<1) $start=1;
        for($i=$start;$i<$page;$i++){
            if($i!=$this->page)
                return  "<li>&nbsp;<a href='".$this->set_url($i)."' class='page'>".$i."</a></li>";
            else
                return  $this->page;
        }
    }



//下一页
    function get_next_page($page){
        $from=$page - $this->pagenum;
        if($from<1) $from=1;
        $to=$page + $this->pagenum;
        if($to>$this->totalpage) $to=$this->totalpage;



        $html='';
        for($i=$from;$i<=$to;$i++){
            if($i!=$this->page)
                $html.=  "<a href='".$this->set_url($i)."' >".$i."</a>";
            else
                $html.=   "<span class='current'>".$this->page."</span>";

        }

        return $html;
    }



    function get_page(){

        if($this->totalpage>1){

            $html= "页2次".$this->page."/".$this->totalpage."&nbsp;共".$this->total."条 &nbsp; ";
            if($this->page>1){
                $html.="<a href='".$this->set_url(1)."'>首页</a><a href='".$this->set_url($this->page-1)."'>&lt;&lt;</a>&nbsp;";
                $this->get_pre_page($this->page);
            }
            else $html.="";
            $html.=  $this->get_next_page($this->page);
            if($this->page>=$this->totalpage)
                $html.="";
            else {

                $html.= "<a href='".$this->set_url($this->page+1)."'>&gt;&gt;</a>&nbsp;<a href='".$this->set_url($this->totalpage)."'>尾页</a>&nbsp;";
            }
            return $html;

        }

    }

}


?>