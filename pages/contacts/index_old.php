<?php
function get_client_ip() {
$ipaddress = '';
if (isset($_SERVER['HTTP_CLIENT_IP']))
    $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
    $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
else if(isset($_SERVER['HTTP_X_FORWARDED']))
    $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
    $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
else if(isset($_SERVER['HTTP_FORWARDED']))
    $ipaddress = $_SERVER['HTTP_FORWARDED'];
else if(isset($_SERVER['REMOTE_ADDR']))
    $ipaddress = $_SERVER['REMOTE_ADDR'];
else
    $ipaddress = 'UNKNOWN';
return $ipaddress;
} 
$ip = get_client_ip();

?>

<section class="container">
  <div class="cols">
    <div class="col-2 contacts__how mb-7">
      <div class="contacts__how-1 mb-3">
        <h3 class="mb-5">How you can find us:</h3>
        <p>EMAIL:<br /><a href="mailto:infosensuspr.com">info@sensuspr.com</a></p>
        <p>TELEPHONE:<br />+370 624 39200</p>
        <p>WEB:<br /><a href="https://sensuspr.com">sensuspr.com</a></p>
      </div>
      <div class="contacts__how-2">
        <a href="#" target="_blank">
          <div class="contacts__how-2__socialcont">
            <svg class="contacts__how-2__social">
              <use xlink:href="<?=$root?>icon/icon.svg#icon-facebook"></use>
            </svg>
          </div>
        </a>
        <a href="#" target="_blank">
          <div class="contacts__how-2__socialcont">
            <svg class="contacts__how-2__social">
              <use xlink:href="<?=$root?>icon/icon.svg#icon-instagram"></use>
            </svg>
          </div>
        </a>
        <a href="#" target="_blank">
          <div class="contacts__how-2__socialcont">
            <svg class="contacts__how-2__social">
              <use xlink:href="<?=$root?>icon/icon.svg#icon-linkedin"></use>
            </svg>
          </div>
        </a>
      </div>
    </div>
    <div class="col-2" id="inforequestdiv">
      <h3 class=" mb-5">Get in touch:</h3>
      <form action="javascript:contact_submit()" class="mb-7" enctype="multipart/form-data" id="contact_form">
        <label for="name" class="form-control-label">Name</label>
        <input type="text" class="form-control md-3" name="username" id="name" placeholder="Name  (required)"
          maxlength="50" required>
        <label for="name" class="form-control-label">Email</label>
        <input type="email" class="form-control md-3" name="email" id="email" placeholder="Email (required)"
          maxlength="50" required>
        <label for="name" class="form-control-label">Telephone</label>
        <input type="text" class="form-control md-3" name="phone" id="phone" placeholder="Telephone" maxlength="50">
        <label for="name" class="form-control-label">Message</label>
        <textarea type="text" class="form-control" name="message" id="message" placeholder="Message (required)" rows="3"
          required></textarea>
        <button type="submit" name="invia" id="invia" class="btn btn-mid login__container__form__btn pointer">Send
          Message</button>
      </form>

    </div>
    <div id="inforequestdivFeedBack" class="contacts__requestanswer col-2">
      <h3>Thank you for contacting us!</h2>
        <p>Dear <span, id="sendername">
            </span,</p> <p>Your Request has been successfully sent.</p>
        <p>We will be in touch soon.</p>
    </div>
    <div id="inforequestNegativeFeedBack" class="contacts__requestanswer col-2">
      <h3>Message not sent</h3>
      <p>There was a problem with the server. Reload the page and retry</p>
      <p>If the proplem persists, please contact us at <a href="mailto:info@sensuspr.com">info@sensuspr.com</a></p>
    </div>
  </div>
</section>

<script>
  function contact_submit() {
    /*challengeField = grecaptcha.getResponse();
    if (challengeField == '') {
        $("#captchaStatus").html('<span style="color: red;">You did not Check the captcha. Please try again</span>');
        setTimeout(()=>{
            $("#captchaStatus").empty(); 
        }, 3000)
        return;
    }*/

    var params = {
      page: "contacts",
      step: "SendRequestInfo",
      name: $("#name").val(),
      email: $("#email").val(),
      phone: $("#phone").val(),
      message: $("#message").val(),
      //recaptcha_challenge_field : challengeField,
      ipaddress: "<?=$ip?>"
    };
    $.ajax({
      type: 'POST',
      url: window.applicationURL + "index.php?" + $.param(params) + "&ajax=true",
      success: function (response) {
        if (response.includes("success")) {
          submitformOk($("#name").val(), "success")
        } else {
          submitformOk($("#name").val(), "fail")
        }
      },
      error: function (request, status, error) {
        alert("ERROR: " + request.responseText);
      }
    });

  }

  function submitformOk(sendername, outcome) {
    $("#sendername").text(sendername);
    var divf = document.getElementById("inforequestdiv");
    var divOk = document.getElementById("inforequestdivFeedBack");
    var divNeg = document.getElementById("inforequestNegativeFeedBack");
    divf.style.display = "none";
    if (outcome == "success") {
      divOk.style.display = "block";
    } else {
      divNeg.style.display = "block";
    }
    document.getElementById("inforequestdivFeedBack").focus();
  }
  /*
      $(() => {

          $('.form-group').each((i, e) => {
              $('.form-control', e)
                  .focus(function() {
                      e.classList.add('not-empty');
                  })
                  .blur(function() {
                      this.value === '' ? e.classList.remove('not-empty') : null;
                  });
          });

      });*/
</script>