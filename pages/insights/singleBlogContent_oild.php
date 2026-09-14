<?php foreach($Blog->SingleBlog as $singleBlog) {?>
  <div id="blogcontainer" class="ins__blogcontainer" style="overflow:hidden">
  <?=file_get_contents($root."docs/blog/".$singleBlog["ID"]."_".$singleBlog["FILENAME"])?>
  </div>
<?php } ?>