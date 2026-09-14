<?php 
    global $admin;
?>
<div class="container">
    <div id="adminPage">
        <div id="MANAGEBACKLINKS" class="text-center dmn__main__inline">
        <h3 class="dmn__main__title">
            MANAGE CLIENTS LOGOS [<?= isset($clientLogos) && is_array($clientLogos) ? count($clientLogos) : 0 ?>]
        </h3>
            <div class="insert" href="#" title="Add new Client logo">
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
                        <th>Client's Name</th>
                        <th>Client's Email</th>
                        <th>Country</th>
                        <th>Comment</th>
                        <th>Link</th>
                        <th>Order</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $page = 1;
                    $pageSize = 10;
                    $numberOfPages = 0; // Default to 0 pages

                    if (isset($clientLogos) && is_array($clientLogos)) {
                        $numberOfPages = ceil(count($clientLogos) / $pageSize); // Use ceil to avoid fractional pages
                    } else {
                        $clientLogos = []; // Ensure $clientLogos is an array to avoid further checks
                    }

                    $idx = 0;

                    if (!empty($clientLogos)) {
                        foreach ($clientLogos as $row) {
                            $idx++;
                    ?>
                    <tr id="comm_<?=$row['ID']?>" idx="<?=$idx?>">
                        <td>
                            <?=$row['ID']?>
                        </td>
                        <td class="text--center">
                            <a class="pointer update" href="#" idclient="<?=$row['ID']?>" oper="upd">
                                <svg class="dmn__blog__openicon">
                                    <use xlink:href="<?=$root?>icon/icon.svg#icon-folder-open"></use>
                                </svg>
                            </a>
                        </td>
                        <td class="text--center">
                            <a class="pointer delete" href="#" idclient="<?=$row['ID']?>" oper="del">
                                <svg class="dmn__blog__deleteicon">
                                    <use xlink:href="<?=$root?>icon/icon.svg#icon-cancel"></use>
                                </svg>
                            </a>
                        </td>
                        <?php
                            if (file_exists('img/clients/CL_'.$row['ID'].'.webp')) {
                                $link = 'CL_'.$row['ID'].'.webp';
                            } else {
                                $link = 'default.png';
                            }
                        ?>
                        <td><img src="<?=$root?>img/clients/<?=$link?>?<?=rand(1,32000)?>" class="img-responsive"
                                style="max-width:60px;max-height:60px"></td>
                        <?php /* il ?<?=rand(1,32000)?> serve a dare un valore random di update al file image in modo da
                        forzare il browser a non utilizzare l'immagine nella cash - se no non mostrerebbe
                        l'aggiornamento dell'immagine dopo un modify user*/?>
                        <td>
                            <?=$row['NAME']?>
                        </td>
                        <td>
                            <?=$row['EMAIL']?>
                        </td>
                        <td>
                            <?=$row['COUNTRY']?>
                        </td>
                        <td>
                            <?=substr($row['COMMENT'],0,80).'...'?>
                        </td>
                        <td>
                            <?=$row['LINK']?>
                        </td>
                        <td class="text--center">
                            <?=$row['VISORDER']?>
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
        var r = confirm("Do you really want to delete this Client? "+ $(this).attr("idclient"));
        if (r == true) {

            target = "comm_" + $(this).attr("idclient");
            var step = $(this).attr("step")
            var params = {
                page: "admin",
                step: "delete_client",
                idclient: $(this).attr("idclient")
            };
            ajaxCall(target, params);

            //refresh of the page
            var params = {
            page: "admin",
            step: "Clients"
            };
            ajaxCall("adminPageContent", params);         }
    });



    $(".update").click(function () {
        //$("#feedbackInvestment").html('');
        var params = {
            page: "admin",
            step: "upd_clients",
            idBkl: $(this).attr("idclient")
        };

        ajaxCall("adminPageContent", params);
    });



    $(".insert").click(function () {
        $("#feedbackInvestment").html('');
        var params = {
            page: "admin",
            step: "add_clients"
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