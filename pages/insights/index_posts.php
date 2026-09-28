<section class="ins__section" id="allins">
    <div class="ins__top">
        <div class="ins__top__main" id="main">
            <div class="ins__top__main__title">
                <h2 class="ins__maintitle mb-2">Latest topic</h2>
            </div>
            <div class="ins__top__main__latest">
                <?php
            //gets the first image from the blogpost
            preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', file_get_contents($root."docs/blog/".$Blog->latest["ID"]."_".$Blog->latest["FILENAME"]), $matches);
            $first_img = $matches [1] [0]; ?>
                <div class="ins__top__main__latest__wrap">
                    <div class="ins__top__main__latest__wrap-1">
                        <a href="<?=$root?>insights/<?=$Blog->latest["ID"]?>/<?=cleanname($Blog->latest["TITLE"])?>">
                            <img src="<?=$first_img?>" alt="<?=$Blog->latest["TITLE"]?>" class="ins__top__main__latest__img img-fluid">
                        </a>
                    </div>
                    <div class="ins__top__main__latest__wrap-2">
                        <a href="<?=$root?>insights/<?=$Blog->latest["ID"]?>/<?=cleanname($Blog->latest["TITLE"])?>">
                            <h5 class="ins__top__main__latest__title"><?=$Blog->latest["TITLE"]?></h5>
                        </a>
                        <p class="ins__top__main__latest__subtitle"><?=$Blog->latest["SUBTITLE"]?></p>
                        <div class="ins__top__main__latest__props">
                            <div class="ins__top__main__latest__props-item">
                                <svg class="ins__top__main__latest__props-icon">
                                    <use xlink:href="<?=$root?>icon/icon.svg#icon-blog-date"></use>
                                </svg>
                                <?=date('j F, Y', strtotime($Blog->latest["LAST_MODIFIED"]))?>
                            </div>
                            <div class="ins__top__main__latest__props-item">
                                <svg class="ins__top__main__latest__props-icon">
                                    <use xlink:href="<?=$root?>icon/icon.svg#icon-blog-author"></use>
                                </svg>
                                <?=$Blog->latest["AUTHOR_NAME"]?>
                            </div>
                            <div class="ins__top__main__latest__props-item">
                                <svg class="ins__top__main__latest__props-icon">
                                    <use xlink:href="<?=$root?>icon/icon.svg#icon-folder-open"></use>
                                </svg>
                                <?=ucfirst($Blog->latest["MAINCAT"])?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="ins__top__left">
            <div class="ins__top__left__title">
                <h2 class="ins__maintitle">Categories</h2>
            </div>
            <div class="ins__top__left__cat">
                <?php foreach ($Blog->categories as $cat) { ?>
                <a href="<?=$root?>insights/category/<?=$cat['LINK']?>#allins" class="ins__top__left__cat-element">
                    <?=ucfirst($cat['NAME'])?>
                </a>
                <?php }?>
                <a href="<?=$root?>insights#allins" class="ins__top__left__cat-element">
                    All
                </a>
            </div>
        </div>
    </div>
    <div class="ins__top__main__previous">
                <div class="ins__top__main__title">
                    <h2  class="ins__maintitle mb-2">Previous insights</h2>
                </div>
                <div class="cols ins__top__main__previous__wrapper">
                    <?php foreach($Blog->AllBlogs as $bp) {
                if ($bp['ID'] != $Blog->latest["ID"]) {
                    //gets the first image from the blogpost
                    preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', file_get_contents($root."docs/blog/".$bp["ID"]."_".$bp["FILENAME"]), $matches);
                    $post_img = $matches [1] [0];
                    ?>
                    <div class="col-2 cols ins__top__main__previous__wrapper__element">
                        <a href="<?=$root?>insights/<?=$bp["ID"]?>/<?=cleanname($bp["TITLE"])?>">
                            <div class="ins__top__main__previous__wrapper__img">
                                <img src="<?=$post_img?>" alt="<?=$bp["TITLE"]?>" class="ins__top__main__previous__wrapper__img-ins">
                            </div>
                            <h5 class="ins__top__main__previous__title"><?=$bp['TITLE']?></h5>
                            <p class="ins__top__main__previous__subtitle"><?=$bp['SUBTITLE']?></p>
                        </a>
                        <div class="ins__top__main__previous__props">
                            <div class="ins__top__main__latest__props-item">
                                <svg class="ins__top__main__latest__props-icon">
                                    <use xlink:href="<?=$root?>icon/icon.svg#icon-blog-date"></use>
                                </svg>
                                <?=date('j F, Y', strtotime($bp["LAST_MODIFIED"]))?>
                            </div>
                            <div class="ins__top__main__latest__props-item">
                                <svg class="ins__top__main__latest__props-icon">
                                    <use xlink:href="<?=$root?>icon/icon.svg#icon-blog-author"></use>
                                </svg>
                                <?=$bp["AUTHOR_NAME"]?>
                            </div>
                            <div class="ins__top__main__latest__props-item">
                                <svg class="ins__top__main__latest__props-icon">
                                    <use xlink:href="<?=$root?>icon/icon.svg#icon-folder-open"></use>
                                </svg>
                                <?=ucfirst($bp["MAINCAT"])?>
                            </div>
                        </div>
                    </div>
                    <?php }}?>
                </div>
            </div>
</section>