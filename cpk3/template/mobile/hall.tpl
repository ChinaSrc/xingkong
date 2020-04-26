
<!--{include file="<!--{$tplpath}-->head.tpl"}--> 


	         

                              <ul  class="index-lots">
                                  <!--{foreach from=$game_list key=key1 item=item1}-->

                                  <li onclick="location.href='<!--{$root_url}-->game_<!--{$item1['id']}-->.html'" >
                                      <img  src="<!--{$item1['ico']|getFileUri}-->" />
                                      <p>
                                          <span class="title"><!--{$item1['fullname']}--></span>
                                          <span class="desc"><!--{$item1['content']}--></span>
                                      </p>


                                  </li>

                                  <!--{/foreach}-->


                              </ul>


<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->  
   



</body>
</html>

