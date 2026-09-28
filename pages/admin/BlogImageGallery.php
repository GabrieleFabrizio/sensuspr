<div class="container" style="margin-top:3rem;">
    <h3 class="dmn__blog__newmodify__subtitle">BLOG IMAGES LIBRARY</h3>
    <form name="fileUploader" id="fileUploader" method="post" enctype="multipart/form-data" action="javascript:fAddBlogImageGallery()">
        <div class="dmn__blog__newmodify__gallery">
            <label for="image_upload_box" class="form-control-label">File/Image (only JPG images allowed, Max 1mb)</label>
            <input type="file" name="FILE_INV" id="FILE_INV" class="dmn__blog__newmodify__gallery__btninput"/>
            <button type="submit" class="btn btn-secondary dmn__blog__newmodify__gallery__btnadd" id="buttonBlogGallery">Add Image to library</button>  
        </div>  
    </form>
    <p class="text--center">
        IMAGES (Right Click and Copy Url to insert in TEXT area):
    </p>
    <div id="minMax" class="dmn__blog__newmodify__gallery__minigallery">
        <?php 
        $count = 1;
        foreach($imageBLog->files as $filename){ ?>
            <div class="dmn__blog__newmodify__gallery__minigallery__element">
                <img src="<?=$filename?>" title="<?=$filename?>" alt="<?=$filename?>" class="dmn__blog__newmodify__gallery__minigallery__img" onclick="openImageModal('<?=$filename?>')"/>  
            </div>
        <?php 
        $count = $count + 1;
        if ($count > 10) {
            echo '</div>';
            echo '<div id="minMax" class="dmn__blog__newmodify__gallery__minigallery">';
            $count = 1;
        }
                } ?>
    </div>
    <div class="paginator">
        <ul class="paginator__general">
            <?php for($i = 0; $i<=($imageBLog->fileNumber/40);$i++) { ?>
            <li class="blogImageGalleryPager paginator__pagerelement paginator__pagerelement--numb" idx=<?=$i+1?>><a href="#">
                    <?=$i+1?></a></li>
            <?php } ?>
        </ul>
    </div>
</div>

<!-- The Modal -->
<div id="myModal" class="dmn__blog__newmodify__gallery__modal">

    <!-- Modal content -->
    <div class="dmn__blog__newmodify__gallery__modal__content">
        <div class="dmn__blog__newmodify__gallery__modal__close pointer" onclick="closeModal()">&times;</div>
        <h3 id="imgName"></h3>
        <br/>
        <div id="imgToDelete" class="dmn__blog__newmodify__gallery__modal__content__imgcont"></div>
        <div Style="display:block; margin-top:20px;">
            <button type="button" class="btn btn-danger dmn__blog__newmodify__gallery__modal__btn" id="deleteModButton" onclick="deleteImage('pippo')">Delete</button>
            <button type="button" class="btn btn-secondary dmn__blog__newmodify__gallery__modal__btn" onclick="closeModal()"> Close </button>
        </div>

    </div>

</div>

<script>
    $(".blogImageGalleryPager").click(function() {
        selectedPage = $(this).attr("idx");

        var params = {
            page: "admin",
            step: "BlogImageGallery",
            PAGENUMBER: selectedPage
        };
        ajaxCall("GalleryLibrary", params);

        $('html, body').animate({
            scrollTop: $("#GalleryLibrary").offset().top
        }, 200);

    });

</script>

<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    //var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on any image, open the modal
    function openImageModal(imgAddress) {
        $('#imgName').text(imgAddress);
        $("#imgToDelete").empty();
        $("#imgToDelete").append('<img src="' + imgAddress + '" class="dmn__blog__newmodify__gallery__modal__content__img">');
        $("#deleteModButton").attr("onclick", "deleteImage('" + imgAddress + "')");
        modal.style.display = "block";
    }

    // When the user clicks ok button and closes it
    function closeModal() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Delete the image selected in the modal
    function deleteImage(imgToDelete) {
        modal.style.display = "none";
        var cleanImgName = imgToDelete.substring('./img/blog/'.length);
        var r = confirm("Do you really want to delete the image -->  " + cleanImgName);
        if (r == true) {
            fDeleteBlogImageGallery(cleanImgName);
        }
    }

</script>
