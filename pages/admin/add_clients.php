<div class="container">
    <h3 class="dmn__main__title text--center"><b>Add a new Client</b></h3>
    <br />
    <div class="modal-body">
        <!-- inizio grigio -->
        <form name="form_clients" id="form_clients" method="post" enctype="multipart/form-data"
            action="javascript:fInsertClients()">
            <!----------------------- Form cells -------------------->
            <div class="form-group">
                <div class="dmn__backlinks">
                    <div class="dmn__backlinks__left">
                        <label for="NAME" class="form-control-label">Name<a
                                style="cursor:normal; text-decoration:none;" title=""></a></label>
                        <input type="text" class="form-control" data-provide="markdown" id="NAME"
                            name="NAME" placeholder="Contact Name" maxlength="300" required/>
                        <label for="EMAIL" class="form-control-label">Contect Email<a
                                style="cursor:normal; text-decoration:none;" title=""></a></label>
                        <input type="email" class="form-control" data-provide="markdown" id="EMAIL"
                            name="EMAIL" placeholder="Contact Email" maxlength="300" />
                        <label for="COUNTY" class="form-control-label">Country<a
                                style="cursor:normal; text-decoration:none;" title=""></a></label>
                        <input type="text" class="form-control" data-provide="markdown" id="COUNTRY" name="COUNTRY"
                            placeholder="Country" maxlength="300"/>
                    </div>
                    <div class="dmn__backlinks__right">
                        <label for="LINK" class="form-control-label">Link - including http:// -<a
                                style="cursor:normal; text-decoration:none;" title=""></a></label>
                        <input type="text" class="form-control" data-provide="markdown" id="LINK" name="LINK"
                            placeholder="Link to the Page include http://" maxlength="300" />
                        <br /><br />
                        <label for="VISORDER" class="form-control-label">Visualization order (must be an integer)<a
                                style="cursor:normal; text-decoration:none;" title=""></a></label>
                        <input type="text" class="form-control" data-provide="markdown" id="VISORDER" name="VISORDER"
                            placeholder="Visualization order (must be an integer)" />
                        <br /><br />
                        <label for="titolo_evento" class="form-control-label">Client Description<a
                                style="cursor:normal; text-decoration:none;" title="">*</a></label>
                        <textarea type="text" class="form-control" data-provide="markdown" id="COMMENT"
                            name="COMMENT" placeholder="Client Description" rows="3"></textarea>
                        <br /><br />
                    </div>
                </div>
                <div class="dmn__backlinks__imgcontainer">
                    <div class="dmn__backlinks__imgcontainer__element">
                        Add Clients's Image (only WEBP, PNG or JPG, PNG max dimension 3 mB, squared image for best results):
                    </div>
                    <div class="dmn__backlinks__imgcontainer__element">
                        <input type="file" name="IMAGECL" id="IMAGECL" onchange="javascript:updateImage()"
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
                    Client</button><br/><br/>
            </div>
        </form>
    </div><!-- fine class="form-horizontal" style="margin:0;" -->
</div><!-- fine modal  add_evento -->
</div>

<script>
    // Chiamata per inserimento Evento
    function fInsertClients() {

        var params = {
            page: "admin",
            step: "insertClients",
            NAME: $("#NAME").val(),
            EMAIL: $("#EMAIL").val(),
            COUNTRY: $("#COUNTRY").val(),
            LINK: $("#LINK").val(),
            COMMENT: $("#COMMENT").val(),
            VISORDER: $("#VISORDER").val(),
            IMAGECL: $("#IMAGECL").val(),
            csrf: window.csrfToken
        };
        var options = {
            type: 'POST',
            url: window.applicationURL + "index.php?" + $.param(params) + "&ajax=true",
            success: viewFeedbackClients
        };

        $("#form_clients").ajaxSubmit(options);
    }

    function viewFeedbackClients(response, status) {

        var params = {
            page: "admin",
            step: "Clients"
        };
        ajaxCall("adminPageContent", params);
    }

    function updateImage() {
        const [file] = IMAGECL.files;
        if (file) {
            Updateimage.src = URL.createObjectURL(file);
            $("#previewImg").show(100);
            $("#previewImg").addClass("dmn__backlinks__imgcontainer__element--imgcont")
        }
    }
</script>