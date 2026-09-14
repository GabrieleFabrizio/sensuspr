           <div id="BlogContent" class="row">
                            
                            <?php   
                            // conto per paginazione
                            $page = 1;
                            $pageSize = 6;
                            // $numberOfPages =  count($Blog->totalBlogs)/$pageSize +1; cambiato perché se il conto era intero mi aggiungeva una pagina vuota di seguito a%b significa il resto della divisione a con b
                            if((count($Blog->totalBlogs)%$pageSize)==0)
                                    {
                                $numberOfPages =  count($Blog->totalBlogs)/$pageSize;
                                    } else {
                                $numberOfPages =  count($Blog->totalBlogs)/$pageSize +1;
                                    }      
                            $i=0;
                            foreach($Blog->AllBlogs as $singleBlog) {
                            $i++;
                           ?>	
                         <a href="<?=$root?>news/<?=$singleBlog["ID"]?>/<?=cleanname($singleBlog["TITLE"])?>">
                          
                            <div class="loc-blog-wrap col-lg-4 col-md-6 col-sm-6 col-xs-12 display-block">
                             <div class="loc-blog-img">
                             <?php
                                 //build the image from the blogpost
                                 preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', file_get_contents($root."docs/blog/".$singleBlog["ID"]."_".$singleBlog["FILENAME"]), $matches);
                                 $first_img = $matches [1] [0];
                                 // Load
                                 list($width, $height) = getimagesize($first_img);
                                 //$newwidth = $width * $percent;
                                 //newheight = $height * $percent;


                                $thumb = imagecreatetruecolor(340,340);
                                $source = imagecreatefromjpeg($first_img);

                                
                                // Resize
                                imagecopyresized($thumb, $source, 0, 0, 0, 0, 340,340, $width, $height);
                                 
                                // echo $first_img;
                                 ob_start();
                                  header( "Content-type: image/jpeg" ); 
                                  imagejpeg( $thumb, NULL, 100 );
                                  imagedestroy( $thumb );
                                  $i = ob_get_clean();
                                  
                             if($first_img!="") {
                             
                                echo "<img  class='thumb img-responsive center-block loc-blog-image' data-placement='bottom' src='data:image/jpeg;base64," . base64_encode( $i )."'>"; //saviour line!
                             ?>
                          
			                <?php } else { ?>
                             <img class="thumb img-responsive center-block loc-blog-image" src="<?=$root?>img/blog/default.png"data-placement="bottom" />
                             <?php } ?>
			                </div>
                            <?php 
                                 // prendo le prime 15 parole del sottotitolo:
                                 $firstwords = implode(' ', array_slice(str_word_count($singleBlog["SUBTITLE"],1), 0, 15));
                                 //coverto la data in formato americano
                                 $dataconv= date('M-d-Y',strtotime($singleBlog["POST_DATE"]));
                                 ?>
                            <div class="loc-blog-info">
                                 <div>
                                 <h2 class="loc-blog-h2"><?=$singleBlog["TITLE"]?></h2>
                                 </div>
                                 <div>
                                 <h3 class="loc-blog-h3"><?=$firstwords?>...</h3>
                                 </div>
                                 <div>                            
                                 <h4 class="loc-blog-h4"><i>by <b><?=$singleBlog["AUTHOR_NAME"]?></b> on <?=$dataconv?></i>&nbsp;&nbsp;&nbsp;
                                    <?php foreach ($global->BlogsCommentCount as $singleCount) {
                                            if( $singleCount["ID_BLOG"] == $singleBlog["ID"])
                                            { ?>
                                           <span class="glyphicon glyphicon-comment"><?=$singleCount["TOTAL"]?></span>
                                    <?php }
                                } ?>
                                </h4>
                                </div> 
                            </div>
                         </div>
                        </a>
                          <?php }	?>
                        
                        </div>
                        <?php
                        $firstpost=$blog->paginnum*$pageSize+1;
                        $lastpost=$blog->paginnum*$pageSize+$pageSize;
                        $totpost=count($Blog->totalBlogs);
                        if ($lastpost>$totpost) { $lastpost=$totpost; }
                        ?>
                        <div class="row" style="text-align:center;">
                    <p class="paginationblog" style="padding-left: 20px; padding-right: 20px;">Read more from our Blog (<?=$firstpost?> to <?=$lastpost?> of <?=count($Blog->totalBlogs)?> Blog Posts):</p>
	                       <ul class="pagination paginationblog">
                               <?php if ($blog->paginnum>0) {?>
                               <li><a href="#Blog" onClick="sceltapagina(<?php echo ($blog->paginnum-1);?>)">Prev.</a></li>
                               <?php }?> 
                                  <?php for($i = 0; $i<=$numberOfPages-1;$i++) { ?>
                                    <li><a href="#Blog" onClick="sceltapagina(<?=$i?>)">
                                  <?php if ($i==$blog->paginnum) { ?><font color="#65A3FF" !important><b><?php }?>
                                    <?=$i+1?>
                                  <?php if ($i==$blog->paginnum) { ?></b></font><?php }?>
                                    </a>
                            <?php } ?>
                            <?php if ($blog->paginnum<$i-1) {?>
                               <li><a href="#Blog" onClick="sceltapagina(<?php echo ($blog->paginnum+1);?>)">Next</a></li>
                            <?php } ?>
                            </ul>
	                   </div> 
                     