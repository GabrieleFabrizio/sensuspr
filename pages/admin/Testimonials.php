<?php 
	global $admin;
?>

<div class="container">
    <div id="adminPage">
        <div id="MANAGETESTIMONIALS" class="text-center dmn__main__inline">
        <h3 class="dmn__main__title">
            MANAGE TESTIMONIALS [<?= isset($testimonials) && is_array($testimonials) ? count($testimonials) : 0 ?>]
        </h3>
            <div class="insert  pointer" href="#" title="Add new testimonial">
                <svg class="dmn__main__addicon">
                    <use xlink:href="<?=$root?>icon/icon.svg#icon-plus"></use>
                </svg>
            </div>
        </div>
        <div class="row">
        </div>

        <div class="text-left">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Display Order</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>company</th>
                        <th>Testimonial</th>
                        <th>Company Link</th>
                        <th>Modify</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                <?php
    $page = 1;
    $pageSize = 10;
    $numberOfPages = isset($testimonials) && is_array($testimonials) ? count($testimonials) / $pageSize + 1 : 0;
?>

<?php 
    if (isset($testimonials) && is_array($testimonials)) {
        $idx = 0;
        foreach ($testimonials as $row) {
            $idx++;
            if (file_exists("./img/testimonials/T_".$row['ID'].".jpg")) {
                $thumbLink = $root."img/testimonials/T_".$row['ID'].".jpg";
            } else {
                $thumbLink = $root."img/testimonials/default.png";
            }
?>
            <tr id="comm_<?=$row['ID']?>" class="PageRows" idx="<?=$idx?>">
                <td><?=$idx?></td>
                <td><?=$row['ID']?></td>
                <td><img src="<?=$thumbLink?>?<?=rand(1,32000)?>"
                        class="img-responsive" style="max-width:60px;max-height:60px"></td>
                <td><?=$row['DISORDER']?></td>
                <td><?=$row['NAME']?></td>
                <td><?=$row['POSITION']?></td>
                <td><?=$row['COMPANY']?></td>
                <td><?=$row['TEXT']?></td>
                <td><?=$row['LINK']?></td>
                <td class="text-center">
                    <a class="pointer update" href="#" idtestim="<?=$row['ID']?>" oper="upd">
                        <svg class="dmn__blog__openicon">
                            <use xlink:href="<?=$root?>icon/icon.svg#icon-folder-open"></use>
                        </svg>
                    </a>
                </td>
                <td class="text-center">
                    <a class="pointer delete" href="#" idtestim="<?=$row['ID']?>" oper="del">
                        <svg class="dmn__blog__deleteicon">
                            <use xlink:href="<?=$root?>icon/icon.svg#icon-cancel"></use>
                        </svg>
                    </a>
                </td>
            </tr>
<?php 
        }
    }
    ?>

                </tbody>
            </table>
        </div>
        <div class="paginator">
            <ul class="paginator__general">
                <?php for($i = 0; $i<=$numberOfPages-1;$i++) { ?>
                <li class="publishedPager paginator__pagerelement paginator__pagerelement--numb" idx=<?=$i+1?>><a href="#"><?=$i+1?></a></li>
                <?php } ?>

            </ul>
        </div>


    </div>
</div>

<script>

    // azioni nella sezione Commenti


    $(".delete").click(function () {
        // richiesta di  conferma            
        var r = confirm("Do you really want to delete this Testimonial?");
        if (r == true) {

            target = "comm_" + $(this).attr("idtestim");
            var step = $(this).attr("step")
            var params = {
                page: "admin",
                step: "delete_testimonial",
                idtestim: $(this).attr("idtestim")
            };
            ajaxCall(target, params);

        }

        var params = {
            page: "admin",
            step: "Testimonials"
        };
        ajaxCall("adminPageContent", params);

    });



    $(".update").click(function () {
        $("#feedbackInvestment").html('');
        var params = {
            page: "admin",
            step: "upd_testimonial",
            idtestim: $(this).attr("idtestim")
        };
        ajaxCall("adminPageContent", params);
    });



    $(".insert").click(function () {
        $("#feedbackInvestment").html('');
        var params = {
            page: "admin",
            step: "add_testimonial"
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

    $(".BlogPager").click(function () {
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