<?php 
    global $admin;
?>
<div class="container">
    <div id="adminPage">
        <div id="MANAGEBACKLINKS" class="text-center dmn__main__inline">
        <h3 class="dmn__main__title">
            MANAGE BACKLINKS [<?= isset($backlinks) && is_array($backlinks) ? count($backlinks) : 0 ?>]
        </h3>
            <div class="insert" href="#" title="Add new Backlink">
                <svg class="dmn__main__addicon">
                    <use xlink:href="<?=$root?>icon/icon.svg#icon-plus"></use>
                </svg>
            </div>
        </div>
        <div class="row">
        </div>

        <div class="text-left">
            <table class="table table--primary">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Modify</th>
                        <th>Delete</th>
                        <th>Image</th>
                        <th>Link Name</th>
                        <th>Contact Name</th>
                        <th>Contact Email</th>
                        <th>Country</th>
                        <th>Descritpion</th>
                        <th>Link</th>
                        <th>Top-Lik</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $page = 1;
                    $pageSize = 10;
                    $numberOfPages = 0; // Default to 0 pages

                    if (isset($backlinks) && is_array($backlinks)) {
                        $numberOfPages = ceil(count($backlinks) / $pageSize); // Use ceil to avoid fractional pages
                    } else {
                        $backlinks = []; // Ensure $backlinks is an array to avoid further checks
                    }

                    $idx = 0;

                    if (!empty($backlinks)) {
                        foreach ($backlinks as $row) {
                            $idx++;
                    ?>
                    <tr id="comm_<?=$row['ID']?>" idx="<?=$idx?>">
                        <td>
                            <?=$row['ID']?>
                        </td>
                        <td class="text--center">
                            <a class="pointer update" href="#" idbacklink="<?=$row['ID']?>" oper="upd">
                                <svg class="dmn__blog__openicon">
                                    <use xlink:href="<?=$root?>icon/icon.svg#icon-folder-open"></use>
                                </svg>
                            </a>
                        </td>
                        <td class="text--center">
                            <a class="pointer delete" href="#" idbacklink="<?=$row['ID']?>" oper="del">
                                <svg class="dmn__blog__deleteicon">
                                    <use xlink:href="<?=$root?>icon/icon.svg#icon-cancel"></use>
                                </svg>
                            </a>
                        </td>
                        <?php
                            if (file_exists('imgs/backlinks/BKL_'.$row['ID'].'.jpg')) {
                                $link = 'BKL_'.$row['ID'].'.jpg';
                            } else {
                                $link = 'default.png';
                            }
                        ?>
                        <td><img src="<?=$root?>imgs/backlinks/<?=$link?>?<?=rand(1,32000)?>" class="img-responsive"
                                style="max-width:60px;max-height:60px"></td>
                        <?php /* il ?<?=rand(1,32000)?> serve a dare un valore random di update al file image in modo da
                        forzare il browser a non utilizzare l'immagine nella cash - se no non mostrerebbe
                        l'aggiornamento dell'immagine dopo un modify user*/?>
                        <td>
                            <?=$row['LINK_NAME']?>
                        </td>
                        <td>
                            <?=$row['CONTACT_NAME']?>
                        </td>
                        <td>
                            <?=$row['CONTACT_EMAIL']?>
                        </td>
                        <td>
                            <?=$row['COUNTRY']?>
                        </td>
                        <td>
                            <?=substr($row['DESCRIPTION'],0,80).'...'?>
                        </td>
                        <td>
                            <?=$row['LINK']?>
                        </td>
                        <td class="text--center">
                            <?=$row['TOP_LINK']?>
                        </td>

                    </tr>
                    <?php }
                        } ?>
                </tbody>
            </table>
        </div>
        <div class="paginator">
            <ul class="paginator__genera">
                <?php for($i = 0; $i<=$numberOfPages-1;$i++) { ?>
                <li class="ublishedPager paginator__pagerelement paginator__pagerelement--numb" idx=<?=$i+1?>><a href="#">
                        <?=$i+1?></a></li>
                <?php } ?>

            </ul>
        </div>
    </div>
</div>
<br /><br />
<script>
    // azioni nella sezione Commenti
    $(".delete").click(function () {
        // richiesta di  conferma            
        var r = confirm("Do you really want to delete this Backlinks?");
        if (r == true) {

            target = "comm_" + $(this).attr("idbacklinks");
            var step = $(this).attr("step")
            var params = {
                page: "admin",
                step: "delete_backlinks",
                idbacklink: $(this).attr("idbacklink")
            };
            ajaxCall(target, params);

            //refresh of the page
            var params = {
            page: "admin",
            step: "Backlinks"
            };
            ajaxCall("adminPageContent", params); 

        }
    });



    $(".update").click(function () {
        //$("#feedbackInvestment").html('');
        var params = {
            page: "admin",
            step: "upd_backlinks",
            idBkl: $(this).attr("idbacklink")
        };

        ajaxCall("adminPageContent", params);
    });



    $(".insert").click(function () {
        $("#feedbackInvestment").html('');
        var params = {
            page: "admin",
            step: "add_backlinks"
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