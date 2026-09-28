<?php 
    global $admin;
?>
<div id="adminPage">
    <div id="MANAGSUBSCRIBERS" class="text--center">
        <h3 class="dmn__main__title">
        MANAGE SUBSCRIBERS [
        <?= (isset($infodata->subscribers) && is_array($infodata->subscribers)) ? count($infodata->subscribers) : 0 ?>
        ]
        </h3>
    </div>
    <div class="container">
        <table class="table table--primary">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email.</th>
                    <th>Newsletter</th>
                    <th>Comments</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $conta = 0;
                // Check if $infodata->subscribers is set and is an array before looping
                if (isset($infodata->subscribers) && is_array($infodata->subscribers)) {
                    foreach ($infodata->subscribers as $subscriber) {
                        $conta++;
                        if ($subscriber['NEWSLETTER'] === 'Y') {
                            $newsliconClass = "dmn__subscribers__icon--approved";
                            $newlSymbol = "icon-checkmark";
                        } else {
                            $newsliconClass = "";
                            $newlSymbol = "icon-cancel";
                        }
                        if ($subscriber['MSGFOLLOW'] === 'Y') {
                            $msgiconClass = "dmn__subscribers__icon--approved";
                            $msgSymbol = "icon-checkmark";
                        } else {
                            $msgiconClass = "";
                            $msgSymbol = "icon-cancel";
                        }
                    ?>
                        <tr id="subscr_<?=$subscriber['ID']?>">
                            <td><?=$conta?></td>
                            <td><?=$subscriber['ID']?></td>
                            <td><?=$subscriber['NAME']?></td>
                            <td><?=$subscriber['EMAIL']?></td>
                            <td class="text--center">
                                <svg class="dmn__subscribers__icon <?=$newsliconClass?>">
                                    <use xlink:href="<?=$root?>icon/icon.svg#<?=$newlSymbol?>"></use>
                                </svg>
                            </td>
                            <td class="text--center">
                                <svg class="dmn__subscribers__icon <?=$msgiconClass?>">
                                    <use xlink:href="<?=$root?>icon/icon.svg#<?=$msgSymbol?>"></use>
                                </svg>
                            </td>
                            <td class="text--center">
                                <svg class="dmn__subscribers__icon dmn__subscribers__icon--delete delete pointer"
                                    id="delete_<?=$subscriber['ID']?>" onclick="subscriberDelete(<?=$subscriber['ID']?>)">
                                    <use xlink:href="<?=$root?>icon/icon.svg#icon-cancel"></use>
                                </svg>
                            </td>
                        </tr>
                    <?php 
                    }
                } else {
                    // Optionally, you can handle the case where no subscribers exist
                    echo "<tr><td colspan='7'>No subscribers found.</td></tr>";
                }
            ?>
            </tbody>
        </table>
        <br /><br />
    </div>
</div>

<script>
    function subscriberDelete(id) {
        var r = confirm("Do you really want to delete newsletter subscriber id: " + id + "?");
        if (r == true) {
            var params = {
                page: "admin",
                step: "DeleteSubscriber",
                idsubscriber: id
            };
            ajaxCallPlain(params);

            //refresh of the page
            var params = {
                page: "admin",
                step: "Subscribers"
            };
            ajaxCall("adminPageContent", params);

        }

    }

    function genExcList() {


        params = {
            page: "admin",
            step: "SubscribersToExcel"
        }

        $.ajax({
            url: window.applicationURL + "index.php?" + $.param(params) + "&ajax=true",
            success: function (response) {
                window.location = '<?=$root?>/docs/excel-users/SubscribersExcel.xls';
            },
            error: function (request, status, error) {
                alert("ERROR: " + request.responseText);

            }
        });


    }
</script>