      <!--{section name=p loop=$game_arr}-->
          <!--{if $game_arr[p].ckey==<!--{$games}-->}-->
	       <li class='cur'> <!--{$game_arr[p].ckey}--></li>
          <!--{else}-->
	       <li class='nor'><!--{$game_arr[p].ckey}--></li>
	  <!--{/if}--> 
      <!--{/section}-->


      <!--{foreach from=$list key=arrkey item=arrtitle}-->
	  <li><a href="<!--{$root_url}-->?mod=<!--{$topkey}-->&code=<!--{$arrkey}-->" <!--{$css_left_navi.$topkey.$arrkey}--> id="g"><!--{$arrtitle}--></a></li> 
      <!--{/foreach}--> 


      <!--{section name=p loop=$sysbank}--> 
           <label for='<!--{$sysbank[p].uid}-->' style='float:left;margin:5px;height:40px;line-height:40px;'>
	      <input type='radio' id='bank_uid' name='bank_uid[]' value='<!--{$sysbank[p].uid}-->' <!--{if $smarty.section.p.index==0}--> checked <!--{/if}--> >
	      &nbsp;<img src='<!--{$file_uri}-->/images/bank/<!--{$sysbank[p].images}-->' width='125' height='35'>
	   </label>
       <!--{/section}-->

        <!--{foreach from=$lotlistarrs key=arrkey item=arrtitle}--> 
	       <option value='<!--{$arrtitle}-->'><!--{$arrtitle}--><!--{if $arrkey==0}-->(µ±Ç°ÆÚ)<!--{/if}--></option>
	       <!--{/foreach}--> 