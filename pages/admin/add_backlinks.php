<div class="container">
    <h3 class="dmn__main__title text--center"><b>Add a new BackLink</b></h3>
    <br />
    <div class="modal-body">
        <!-- inizio grigio -->
        <form name="form_backlinks" id="form_backlinks" method="post" enctype="multipart/form-data"
            action="javascript:fInsertBacklinks()">
            <!----------------------- Form cells -------------------->
            <div class="form-group">
                <div class="dmn__backlinks">
                    <div class="dmn__backlinks__left">
                        <label for="LINK_NAME" class="form-control-label">Link Name<a
                                style="cursor:normal; text-decoration:none;" title="">*</a></label>
                        <input type="text" class="form-control" data-provide="markdown" id="LINK_NAME" name="LINK_NAME"
                            placeholder="Link Name" maxlength="100" required />
                        <label for="CONTACT_NAME" class="form-control-label">Contact Name<a
                                style="cursor:normal; text-decoration:none;" title=""></a></label>
                        <input type="text" class="form-control" data-provide="markdown" id="CONTACT_NAME"
                            name="CONTACT_NAME" placeholder="Contact Name" maxlength="100" />
                        <label for="CONTACT_EMAIL" class="form-control-label">Contect Email<a
                                style="cursor:normal; text-decoration:none;" title=""></a></label>
                        <input type="email" class="form-control" data-provide="markdown" id="CONTACT_EMAIL"
                            name="CONTACT_EMAIL" placeholder="Contact Email" maxlength="100" />
                        <label for="COUNTY" class="form-control-label">Country<a
                                style="cursor:normal; text-decoration:none;" title=""></a></label>
                        <input type="text" class="form-control" data-provide="markdown" id="COUNTRY" name="COUNTRY"
                            placeholder="Country" maxlength="50" />
                        <label for="LINK" class="form-control-label">Link - including http:// -<a
                                style="cursor:normal; text-decoration:none;" title=""></a></label>
                        <input type="text" class="form-control" data-provide="markdown" id="LINK" name="LINK"
                            placeholder="Link to the Page include http://" maxlength="150" />
                        <br /><br />
                    </div>
                    <div class="dmn__backlinks__right">
                        <label for="TOP_LINK" class="form-control-label">Top Website:</label>
                        <select name="TOP_LINK" id="TOP_LINK" class="form-control">
                            <option value="0">Nomal</option>
                            <option value="1">Top</option>
                        </select>
                        <label for="titolo_evento" class="form-control-label">Backlink Description<a
                                style="cursor:normal; text-decoration:none;" title="">*</a></label>
                        <textarea type="text" class="form-control" data-provide="markdown" id="DESCRIPTION"
                            name="DESCRIPTION" placeholder="Backlink Description" rows="8" required></textarea>
                        <br /><br />
                    </div>
                </div>
                <div class="dmn__backlinks__imgcontainer">
                    <div class="dmn__backlinks__imgcontainer__element">
                        Add Backlink's Image (only JPG, PNG,GIF max dimension 3 mB):
                    </div>
                    <div class="dmn__backlinks__imgcontainer__element">
                        <input type="file" name="IMAGEBKL" id="IMAGEBKL" onchange="javascript:updateImage()"
                            class="dmn__backlinks__imgcontainer__imginput" />
                    </div>
                    <div class="dmn__backlinks__imgcontainer__element">
                        <div id="previewImg" class="display--none">
                            Preview -->&nbsp;&nbsp;&nbsp;
                            <img id="Updateimage" src="#" alt="Image to be updated"
                                class="dmn__backlinks__imgcontainer__imgupl" />
                        </div>
                    </div>
                </div>
                <br /><br />
            </div><!-- .fine box_corpo -->
            <hr>
            <div class="text--right" id="box_buttons">
                <button type="submit" class="btn btn-info dmn__backlinks__submitbtn" id="buttonTBacklinks">Add
                    Backlink</button>
            </div>
        </form>
    </div><!-- fine class="form-horizontal" style="margin:0;" -->
</div><!-- fine modal  add_evento -->
</div>

<script>
    // Chiamata per inserimento Evento
    function fInsertBacklinks() {

        var params = {
            page: "admin",
            step: "insertBacklinks",
            LINK_NAME: $("#LINK_NAME").val(),
            CONTACT_NAME: $("#CONTACT_NAME").val(),
            CONTACT_EMAIL: $("#CONTACT_EMAIL").val(),
            COUNTRY: $("#COUNTRY").val(),
            LINK: $("#LINK").val(),
            DESCRIPTION: $("#DESCRIPTION").val(),
            TOP_LINK: $("#TOP_LINK").val(),
            IMAGEBKL: $("#IMAGEBKL").val(),
            csrf: window.csrfToken
        };
        var options = {
            type: 'POST',
            url: window.applicationURL + "index.php?" + $.param(params) + "&ajax=true",
            success: viewFeedbackBacklinks
        };

        $("#form_backlinks").ajaxSubmit(options);
    }

    function viewFeedbackBacklinks(response, status) {

        var params = {
            page: "admin",
            step: "Backlinks"
        };
        ajaxCall("adminPageContent", params);
    }

    function updateImage() {
        const [file] = IMAGEBKL.files;
        if (file) {
            Updateimage.src = URL.createObjectURL(file);
            $("#previewImg").show(100);
            $("#previewImg").addClass("dmn__backlinks__imgcontainer__element--imgcont")
        }
    }
</script>