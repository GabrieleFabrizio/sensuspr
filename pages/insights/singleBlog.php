<?php $urlSocial = "index.php?page=Blog&step=singleBlogShare&idBlog=".$singleBlog["ID"]?>
<?php 
    $Title="";
    $Subtitle="";
     foreach($Blog->SingleBlog as $singleBlog) {       
    $Title=$singleBlog["TITLE"];
    $Subtitle=$singleBlog["SUBTITLE"];
                             ?>
<section id="SingleBlog" class="container">
    <h1 class="ins__single__title text-center pb-5"><?=$singleBlog["TITLE"]?></h1>
    <div id="blogcontainer">
        <h2 class="text-justify ins__single__subt pb-3">
            <?=$singleBlog["SUBTITLE"]?>
        </h2>
        <div class="pb-5">
            <?php                                
            $blog=file_get_contents($root."docs/blog/".$singleBlog["ID"]."_".$singleBlog["FILENAME"]);
            $blogpulito = preg_replace("/<span[^>]+\>/i","",$blog);
            $blogpulitob = preg_replace('/(\<span\>|\<\/span\>)/',"",$blogpulito);
            $blogpulitoc = preg_replace('/(\<u\>|\<\/u\>)/',"",$blogpulitob);
            echo $blogpulitoc; 
            ?>
        </div>
    </div>

</section>
<?php }	?>
<div class="ins__single__menu pb-7">
    <div class="ins__single__menu-left">
        <?php 
        if ($Blog->prevBlog['ID']!="") {
        ?>
        <a href="<?=$root?>insights/<?=$Blog->prevBlog["ID"]?>/<?=cleanname($Blog->prevBlog["TITLE"])?>">
        <svg class="ins__single__menu__icon">
            <use xlink:href="<?=$root?>icon/icon.svg#arrow-left"></use>
          </svg>
        </a>
        <?php }?>
    </div>
    <div class="">
        <a href="<?=$root?>insights">
            <svg class="ins__single__menu__icon">
                <use xlink:href="<?=$root?>icon/icon.svg#arrow-up"></use>
            </svg>
        </a>
    </div>
    <div class="ins__single__menu-right">
        <?php 
        if ($Blog->segBlog['ID']!="") {
        ?>
            <a href="<?=$root?>insights/<?=$Blog->segBlog["ID"]?>/<?=cleanname($Blog->segBlog["TITLE"])?>">
                <svg class="ins__single__menu__icon">
                    <use xlink:href="<?=$root?>icon/icon.svg#arrow-right"></use>
                </svg>
        </a>
        <?php }?>
    </div>
</div>
<script type="text/javascript">
    // Get the element with id="myDIV" (a div), then get all p elements inside div
    var x = document.getElementById("blogcontainer").querySelectorAll("div");
    var y = document.getElementById("blogcontainer").querySelectorAll("p");
    var z = document.getElementById("blogcontainer").querySelectorAll("a");
    var e = document.getElementById("blogcontainer").querySelectorAll("em");
    // Create a for loop and set the background color of all p elements in div
    var i;
    for (i = 0; i < x.length; i++) {
        x[i].style.fontSize = '1.8rem';
        x[i].style.fontFamily = "Montserrat,Verdana,Arial,sans-serif";
        //  x[i].style.textAlign = "Justify";
        x[i].style.color = "#656565";
    }
    for (i = 0; i < y.length; i++) {
        y[i].style.fontSize = '1.8ren';
        y[i].style.fontFamily = "Montserrat,Verdana,Arial,sans-serif";
        y[i].style.textAlign = "Justify";
        y[i].style.color = "#656565";
    }
    for (i = 0; i < z.length; i++) {
        z[i].style.color = "#65A3FF";
    }
    for (i = 0; i < e.length; i++) {
        e[i].style.fontSize = '1.8rem';
        e[i].style.fontStyle = 'italic';
        e[i].style.fontWeight = 'bold';
    }
</script>
<script>
    $(document).ready(function () {
        var params = {
            page: "Blog",
            step: "singleBlogCommentContent",
            idBlog: <?=$singleBlog["ID"]?>
        };
        ajaxCall("singleBlogCommentContent", params);
    });
</script>