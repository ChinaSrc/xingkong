
<!--{include file="<!--{$tplpath}-->head.tpl"}--> 


<script>

    function show_content(id) {


         if(document.getElementById('content_'+id).style.display=='block'){

             document.getElementById('arrow_'+id).className='arrow bott';
             document.getElementById('content_'+id).style.display='none';
         }
         else{

             var title= document.querySelector('.help_list').querySelectorAll('.title');

             for(var i=0;i<title.length;i++){
                 title[i].querySelector('.arrow').className='arrow bott';

             }
             var content= document.querySelector('.help_list').querySelectorAll('.content');
             for(var i=0;i<content.length;i++){

                 content[i].style.display='none';

             }
             document.getElementById('arrow_'+id).className='arrow up';
             document.getElementById('content_'+id).style.display='block';

         }

    }


</script>


<div id='hd'   >


    <div class="wap_list">
<div style="width: 100%;font-size: 20px;font-weight: 600;text-align: center;color:#222;">

    <!--{$news['title']}-->

</div>

    <div style="width: 100%;background: #fff;color:#444;">

        <!--{$news['content']}-->

    </div>

    </div>

<!--{include file="<!--{$tplpath}-->bottom.tpl"}--> 
