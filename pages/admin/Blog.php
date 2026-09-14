<?php 
    global $admin;

?>
<div class="container">
    <div id="adminPage">
        <div id="MANAGEBLOG" class="text-center dmn__main__inline">
            <h3 class="dmn__main__title">MANAGE BLOG POSTs [<?=count($infoData->Blogs)?>]
            </h3>
            <div class="insert pointer" href="#" title="Add new Post">
                <svg class="dmn__main__addicon">
                    <use xlink:href="<?=$root?>icon/icon.svg#icon-plus"></use>
                </svg>
            </div>
        </div>
        <div>
            <div id="feedBackBlog"><?=$infoData->RESULT?></div>
        </div>

        <div class="text-left">
            <table class="table table--green">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>DB ID</th>
                        <th>Primary Cat.</th>
                        <th class="visible-lg">Title</th>
                        <th class="hidden-xs hidden-sm">Subtitle</th>
                        <th class="visible-lg">Author Name</th>
                        <th class="hidden-xs hidden-sm">Post date</th>
                        <th>Edit</th>
                        <th>Put Offline</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                      $page = 1;
                      $pageSize = 10;
                      $numberOfPages =  count($infoData->Blogs)/$pageSize +1; 
                  ?>
                    <?php 
				$idx=0;
				foreach ($infoData->Blogs  as $row){
				$idx++;?>
                    <tr id="comm_<?=$row['ID']?>" class="PageRows" idx="<?=$idx?>">
                        <td><?=$idx?></td>
                        <td><?=$row['ID']?></td>
                        <td><?=$row['POSTCATEG1']?></td>
                        <td class=""><?=$row['TITLE']?></td>
                        <td class=""><?=$row['SUBTITLE']?></td>
                        <td class=""><?=$row['AUTHOR_NAME']?></td>
                        <td class=""><?=$row['POST_DATE']?></td>
                        <td class="text-center">
                            <a class="update" href="#" idcomm="<?=$row['ID']?>" oper="upd" title="Edit Post">
                                <svg class="dmn__blog__openicon">
                                    <use xlink:href="<?=$root?>icon/icon.svg#icon-folder-open"></use>
                                </svg>
                            </a>
                        </td>
                        <td class="text-center">
                            <a class="delete" href="#" idcomm="<?=$row['ID']?>" oper="del" title="move to draft">
                                <svg class="dmn__blog__deleteicon">
                                    <use xlink:href="<?=$root?>icon/icon.svg#icon-cancel"></use>
                                </svg>
                            </a>
                        </td>
                    </tr>
                    <?php }	?>
                </tbody>
            </table>
        </div>
        <div class="paginator">
            <ul class="paginator__general">
                <?php for($i = 0; $i<=$numberOfPages-1;$i++) { ?>
                <li class="publishedPager paginator__pagerelement paginator__pagerelement--numb" idx=<?=$i+1?>><a
                        href="#"><?=$i+1?></a></li>
                <?php } ?>

            </ul>
        </div>
        <hr />
        <br /><br /><br />
        <div id="DELETEDBLOG" class="text--center">
            <h3 class="dmn__main__title">DRAFT BLOG POSTs [<?= isset($infoData->DeletedBlogs) && is_array($infoData->DeletedBlogs) ? count($infoData->DeletedBlogs) : 0 ?>]</h3>

            <p>To put online:Edit and change the field "status".<br/>NOTE: If you will delete the post from here it will be permanently deleted </p>
        </div>
        <div>
            <div id="feedBackBlog"><?= $infoData->RESULT ?? '' ?></div>
        </div>
        <div class="text-left">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>DB ID</th>
                        <th>Primary Cat.</th>
                        <th class="visible-lg">Title</th>
                        <th class="hidden-xs hidden-sm">Subtitle</th>
                        <th class="visible-lg">Author Name</th>
                        <th class="hidden-xs hidden-sm">Post date</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $page = 1;
                    $pageSize = 10;
                    $numberOfDeletedPages = isset($infoData->DeletedBlogs) && is_array($infoData->DeletedBlogs) 
                        ? (count($infoData->DeletedBlogs) / $pageSize) + 1 
                        : 1; // Default to 1 page if DeletedBlogs is not set or not an array.
                    $idx=0;
                    foreach ($infoData->DeletedBlogs  as $row){
                    $idx++;
                ?>
                    <tr id="comm_<?=$row['ID']?>" class="PageDeletedRows" idx="<?=$idx?>">
                        <td><?=$idx?></td>
                        <td><?=$row['ID']?></td>
                        <td><?=$row['POSTCATEG1']?></td>
                        <td class=""><?=$row['TITLE']?></td>
                        <td class=""><?=$row['SUBTITLE']?></td>
                        <td class=""><?=$row['AUTHOR_NAME']?></td>
                        <td class=""><?=$row['POST_DATE']?></td>
                        <td class="text-center">
                            <a class="update" href="#" idcomm="<?=$row['ID']?>" oper="upd" title="Edit Post">
                                <svg class="dmn__blog__openicon">
                                    <use xlink:href="<?=$root?>icon/icon.svg#icon-folder-open"></use>
                                </svg>
                            </a>
                        </td>
                        <td class="text-center">
                            <a class="definitivedelete" href="#" idcomm="<?=$row['ID']?>" oper="del"
                                title="Definitive Delete">
                                <svg class="dmn__blog__deleteicon">
                                    <use xlink:href="<?=$root?>icon/icon.svg#icon-cancel"></use>
                                </svg>
                            </a>
                        </td>
                    </tr>
                    <?php }	?>
                </tbody>
            </table>
        </div>
        <div class="paginator">
            <ul class="paginator__general">
                <?php for($i = 0; $i<=$numberOfDeletedPages-1;$i++) { ?>
                <li class="deletePager paginator__pagerelement paginator__pagerelement--numb" idx=<?=$i+1?>><a
                        href="#"><?=$i+1?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
<script>
    $(".insert").click(function () {
        console.log('clicked insert');
        $("#managementPanel").html('');
        var params = {
            page: "admin",
            step: "add_blog"
        };
        ajaxCall("adminPageContent", params);
    });

    $(".delete").click(function () {
        target = "comm_" + $(this).attr("idcomm");
        var step = $(this).attr("step")
        var params = {
            page: "admin",
            step: "delete_blog",
            idBlog: $(this).attr("idcomm")
        };


        ajaxCall(target, params);
    });

    $(".definitivedelete").click(function () {
        target = "comm_" + $(this).attr("idcomm");
        var step = $(this).attr("step")
        var params = {
            page: "admin",
            step: "definitivedelete_blog",
            idBlog: $(this).attr("idcomm")

        };
        ajaxCall(target, params);
        $('html, body').animate({
            scrollTop: $("#DELETEDBLOG").offset().top
        }, 200);
    });

    $(".update").click(function () {
        $("#managementPanel").html('');
        var params = {
            page: "admin",
            step: "manageBlog",
            idBlog: $(this).attr("idcomm")
        };
        ajaxCall("adminPageContent", params);
    });


    $(".insert").click(function () {
        console.log('clicked insert');
        $("#managementPanel").html('');
        var params = {
            page: "admin",
            step: "add_blog"
        };
        ajaxCall("adminPageContent", params);
    });
</script>




<script>
    //PAGINATOR
    $(document).ready(function () {

        $(".PageRows").each(function (index) {
            indexOfRow = $(this).attr("idx");
            //alert(indexOfRow);
            if (indexOfRow <= 10) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });


        $(".PageDeletedRows").each(function (index) {
            indexOfRow = $(this).attr("idx");
            // alert(indexOfRow);
            if (indexOfRow <= 10) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });


        //PageDeletedRows
        //  PageRows  
    });

    $(".publishedPager").click(function () {
        selectedPage = $(this).attr("idx");
        // alert(selectedPage);
        $(".PageRows").each(function (index) {
            indexOfRow = $(this).attr("idx");
            //alert(indexOfRow);
            if (indexOfRow > (selectedPage - 1) * 10 && indexOfRow <= selectedPage * 10) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
        $('html, body').animate({
            scrollTop: $("#MANAGEBLOG").offset().top
        }, 200);
    });


    $(".deletePager").click(function () {
        selectedPage = $(this).attr("idx");
        // alert(selectedPage);
        $(".PageDeletedRows").each(function (index) {
            indexOfRow = $(this).attr("idx");
            //alert(indexOfRow);
            if (indexOfRow > (selectedPage - 1) * 10 && indexOfRow <= selectedPage * 10) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
        $('html, body').animate({
            scrollTop: $("#DELETEDBLOG").offset().top
        }, 200);
    });
</script>