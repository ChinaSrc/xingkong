
<style type="text/css">
.menu_w ul li a:hover{color:#FFFFFF;background:#006699;}
</style>

<div class="my_l_m"  style='padding-top:5px;'>
    <div class="hl_menu">
    
    
    
    
    <div id="user-menu">
                <div class="tp-ui-item tp-ui-menu">
                
                
                <ul>
                   <!--{foreach from=$navilist key=Nkey item=Ntitle}--> 
                
                    <li id='parent_menu_<!--{$Nkey}-->' class="parentMemberMenu tp-ui-menu-sub tp-ui-menu-sub-group <!--{if $smarty.get.mod eq $Nkey}-->tp-ui-active<!--{/if}--> "  >
                        
                        
                    <div class="tp-ui-sub tp-ui-menu-base tp-ui-menu-head tp-ui-menu-base-arrow"  onclick="show_menu('<!--{$Nkey}-->');"><a href="javascript:void(0);"><!--{$navititle[$Nkey]}--></a>
                    <div class="tp-ui-sub tp-ui-handle-button tp-ui-menu-arrow"><button type="button"><em>&nbsp;</em></button></div>
                    </div>
                    <div  id='sub_menu_<!--{$Nkey}-->' class="tp-ui-sub tp-ui-menu-submenu" style="display: <!--{if $smarty.get.mod eq $Nkey}-->block<!--{else}-->none<!--{/if}-->;"  >
                    <ul>
                
                            
                               <!--{foreach from=$Ntitle key=Tkey item=Ttitle}-->
		       
		            <li class="tp-ui-menu-sub tp-ui-active    <!--{if $smarty.get.mod eq $Nkey && $smarty.get.code eq $Tkey}-->active<!--{/if}-->">
		            <div class="tp-ui-sub tp-ui-menu-base"><a href="home<!--{if $Tkey neq 'index'}-->_<!--{$Nkey}-->_<!--{$Tkey}--><!--{/if}-->.html" title="<!--{$Ttitle}-->"><!--{$Ttitle}--></a></div></li>
		          <!--{/foreach}-->              
   
                        </ul></div>
                        
                        </li>

	          <!--{/foreach}--> 
                
                
              
                    </ul></div>
                </div>

   




        
    </div>
</div>
<script language="javascript">
function show_menu(id){
//alert(id);
var div='sub_menu_'+id;
var pmenu='parent_menu_'+id;
if( document.getElementById(div).style.display=='none'){

	document.getElementById(div).style.display='block';
	document.getElementById(pmenu).className='parentMemberMenu tp-ui-menu-sub tp-ui-menu-sub-group tp-ui-active';
	}

else{

	document.getElementById(div).style.display='none';
	document.getElementById(pmenu).className='parentMemberMenu tp-ui-menu-sub tp-ui-menu-sub-group';
	}

	          }

</script>
