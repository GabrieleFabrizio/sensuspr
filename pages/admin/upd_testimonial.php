<div class="container">
  <h3 class="dmn__main__title text--center"><b>Edit Testimonial: <?=$testimonialsMod['LINK_NAME']?></b></h3><br />
  <div class="modal-body">
    <div class="well bs-component">
      <!-- inizio grigio -->
      <form name="form_testimonials" id="form_testimonials" method="post" enctype="multipart/form-data"
        action="javascript:fUpdatetestimonials()">


        <!----------------------- Form cells -------------------->
        <div class="form-group">
          <div class="cols">
            <div class="col-2">
              <label for="NAME" class="form-control-label">Name<a style="cursor:normal; text-decoration:none;"
                  title="">*</a></label>
              <input type="LINK" class="form-control" data-provide="markdown" id="NAME" name="NAME" placeholder="Name"
                maxlength="50" value="<?=$testimonialsMod['NAME']?>" required />
              <label for="POSITION" class="form-control-label">Position in the company<a
                  style="cursor:normal; text-decoration:none;" title=""></a></label>
              <input type="text" class="form-control" data-provide="markdown" id="POSITION" name="POSITION"
                placeholder="Position in the company" maxlength="50" value="<?=$testimonialsMod['POSITION']?>" />
              <label for="COMPANY" class="form-control-label">Company Name<a
                  style="cursor:normal; text-decoration:none;" title=""></a></label>
              <input type="text" class="form-control" data-provide="markdown" id="COMPANY" name="COMPANY"
                placeholder="Company Name" maxlength="50" value="<?=$testimonialsMod['COMPANY']?>" />
              <label for="LINK" class="form-control-label">Company website Link<a
                  style="cursor:normal; text-decoration:none;" title=""></a></label>
              <input type="text" class="form-control" data-provide="markdown" id="LINK" name="LINK"
                placeholder="Link: include http://" value="<?=$testimonialsMod['LINK']?>" />
            </div>
            <div class="col-2">
              <label for="DISORDER" class="form-control-label">Display Order (1-10)<a
                  style="cursor:normal; text-decoration:none;" title=""></a></label>
              <input type="text" class="form-control" data-provide="markdown" id="DISORDER" name="DISORDER"
                placeholder="Order of display" maxlength="10" value="<?=$testimonialsMod['DISORDER']?>" />
              <label for="titolo_evento" class="form-control-label">Testimonial coment<a
                  style="cursor:normal; text-decoration:none;" title="">*</a></label>
              <textarea type="text" class="form-control" data-provide="markdown" id="TEXT" name="TEXT"
                placeholder="Testimonial comment" rows="7" required><?=$testimonialsMod['TEXT']?></textarea>
              <br /><br />
            </div>
          </div>
          <div class="dmn__backlinks__imgcontainer">
            <div class="dmn__backlinks__imgcontainer__element">
              Change Testimonial's Image (only JPG, PNG,GIF max dimension 3 mB, transparent Background will be translated to white):
              <img src="<?=$root?>img/testimonials/T_<?=$testimonialsMod['ID']?>.jpg?<?=rand(1,32000)?>"
                class="dmn__backlinks__imgcontainer__imgupl"><br />
            </div>
            <div class="dmn__backlinks__imgcontainer__element">
              <input type="file" name="IMAGEBKL" id="IMAGEBKL" onchange="javascript:updateImage()"
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
        <div class="text-right" id="box_buttons">
                <button type="submit" class="btn btn-mid pointer" id="buttonTBacklinks">Update
                    Testimonial</button>
            </div>
      </form>
      <br/><br>
    </div>
  </div>
  <div>

    <script>
      // Chiamata per inserimento Evento
      function fUpdatetestimonials() {

        var params = {
          page: "admin",
          step: "UpdateTestimonial",
          IDT: "<?=$testimonialsMod['ID']?>",
          NAME: $("#NAME").val(),
          POSITION: $("#POSITION").val(),
          COMPANY: $("#COMPANY").val(),
          LINK: $("#LINK").val(),
          DISORDER: $("#DISORDER").val(),
          TEXT: $("#TEXT").val(),
          IMAGEBKL: $("#IMAGEBKL").val(),
          csrf: window.csrfToken
        };
        var options = {
          type: 'POST',
          url: window.applicationURL + "index.php?" + $.param(params) + "&ajax=true",
          success: viewFeedbacktestimonials
        };

        $("#form_testimonials").ajaxSubmit(options);

      }

      function viewFeedbacktestimonials(response, status) {
        var params = {
          page: "admin",
          step: "Testimonials"
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