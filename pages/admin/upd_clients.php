<div class="container">
  <h3 class="dmn__main__title text--center"><b>Edit Client: <?=$clientMod['NAME']?></b></h3><br />
  <div class="modal-body">
    <div class="well bs-component">
      <!-- inizio grigio -->
      <form name="form_clients" id="form_clients" method="post" enctype="multipart/form-data"
        action="javascript:fUpdateClients()">


        <!----------------------- Form cells -------------------->
        <div class="form-group">
          <div class="dmn__backlinks">
          <div class="dmn__backlinks">
                    <div class="dmn__backlinks__left">
                        <label for="NAME" class="form-control-label">Name<a
                                style="cursor:normal; text-decoration:none;" title=""></a></label>
                        <input type="text" class="form-control" data-provide="markdown" id="NAME"
                            name="NAME" placeholder="Contact Name" maxlength="300"
                            value="<?=$clientMod['NAME']?>" required/>
                        <label for="EMAIL" class="form-control-label">Contect Email<a
                                style="cursor:normal; text-decoration:none;" title=""></a></label>
                        <input type="email" class="form-control" data-provide="markdown" id="EMAIL"
                            name="EMAIL" placeholder="Contact Email" maxlength="300"
                            value="<?=$clientMod['EMAIL']?>" />
                        <label for="COUNTY" class="form-control-label">Country<a
                                style="cursor:normal; text-decoration:none;" title=""></a></label>
                        <input type="text" class="form-control" data-provide="markdown" id="COUNTRY" name="COUNTRY"
                            placeholder="Country" maxlength="300" value="<?=$clientMod['COUNTRY']?>"/>
                    </div>
                    <div class="dmn__backlinks__right">
                        <label for="LINK" class="form-control-label">Link - including http:// -<a
                                style="cursor:normal; text-decoration:none;" title=""></a></label>
                        <input type="text" class="form-control" data-provide="markdown" id="LINK" name="LINK"
                            placeholder="Link to the Page include http://" maxlength="300" value="<?=$clientMod['LINK']?>"/>
                        <br /><br />
                        <label for="VISORDER" class="form-control-label">Visualization order (must be an integer)<a
                                style="cursor:normal; text-decoration:none;" title=""></a></label>
                        <input type="text" class="form-control" data-provide="markdown" id="VISORDER" name="VISORDER"
                            placeholder="Visualization order (must be an integer)" value="<?=$clientMod['VISORDER']?>"/>
                        <br /><br />
                        <label for="titolo_evento" class="form-control-label">Client Description<a
                                style="cursor:normal; text-decoration:none;" title="">*</a></label>
                        <textarea type="text" class="form-control" data-provide="markdown" id="COMMENT"
                            name="COMMENT" placeholder="Client Description" rows="3" ><?= htmlspecialchars($clientMod['COMMENT']) ?></textarea>
                        <br /><br />
                    </div>
                </div>
          </div>
          <div class="dmn__backlinks__imgcontainer">
            <div class="dmn__backlinks__imgcontainer__element">
              Change Clients's Image (only WEBP, PNG or JPG, PNG max dimension 3 mB, squared image for best results):
              <img src="<?=$root?>img/clients/CL_<?=$clientMod['ID']?>.webp?<?=rand(1,32000)?>"
                class="dmn__backlinks__imgcontainer__imgupl"><br />
            </div>
            <div class="dmn__backlinks__imgcontainer__element">
              <input type="file" name="IMAGECL" id="IMAGECL" onchange="javascript:updateImage()"
                class="dmn__backlinks__imgcontainer__imginput" />
            </div>
            <div class="dmn__backlinks__imgcontainer__element">
              <div id="previewImg" class="display--none">
                Change Image to --> &nbsp;&nbsp;&nbsp;
                <img id="Updateimage" src="#" alt="Image to be updated" class="dmn__backlinks__imgcontainer__imgupl" />
              </div>
            </div>
          </div>
          <br /><br />
        </div><!-- .fine box_corpo -->
        <hr>
        <div class="text--right" id="box_buttons">
          <button type="submit" class="btn btn-info dmn__backlinks__submitbtn" id="buttonBacklinks">Update
            Client</button>
        </div>
      </form>
    </div>
  </div>
  <div>

    <script>
      // Chiamata per inserimento Evento
      function fUpdateClients() {

        var params = {
            page: "admin",
            step: "UpdateClients",
            IDT: "<?=$clientMod['ID']?>",
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
          success: viewFeedbackBacklinks
        };

        $("#form_clients").ajaxSubmit(options);

      }

      function viewFeedbackBacklinks(response, status) {
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