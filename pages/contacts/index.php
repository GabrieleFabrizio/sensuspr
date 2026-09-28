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
// get public key for captcha
include ("./config/xcapkeys.php");
?>

<section class="container contacts fadecontainer">
  <div class="cols contacts__reverse fade-in-scalesm  fade-animation">
    <div class="col-2 contacts__how mb-7">
      <div class="contacts__how-1 mb-3">
        EMAIL:<br /><a href="mailto:infosensuspr.com">info@sensuspr.com</a>
      </div>
      <div class="contacts__how-2">
        <a href="https://www.facebook.com/sensuspr" target="_blank">
          <div class="contacts__how-2__socialcont">
            <svg class="contacts__how-2__social">
              <use xlink:href="<?=$root?>icon/icon.svg#icon-facebook"></use>
            </svg>
          </div>
        </a>
        <a href="https://www.linkedin.com/company/96241831/" target="_blank">
          <div class="contacts__how-2__socialcont">
            <svg class="contacts__how-2__social">
              <use xlink:href="<?=$root?>icon/icon.svg#icon-linkedin"></use>
            </svg>
          </div>
        </a>
      </div>
    </div>
    <div class="col-2" id="inforequestdiv">
      <form action="javascript:contact_submit()" class="mb-7" enctype="multipart/form-data" id="contact_form">
        <input type="text" class="form-control mb-5" name="username" id="name" placeholder="Name*" maxlength="50"
          required>
        <input type="email" class="form-control mb-5" name="email" id="email" placeholder="Email*" maxlength="50"
          required>
        <input type="text" class="form-control mb-5" name="phone" id="phone" placeholder="Telephone" maxlength="50">
        <textarea class="form-control mb-5" type="text" name="message" id="message" placeholder="Message*" rows="3"
          required></textarea>
        <div class="contacts__send">
          <div class="captchabox contact__captchabox mb-5">
            <label for="recaptcha" class="form-control-label">Antispam Check*</label><br /><br />
            <div class="g-recaptcha contact__g-recaptcha" data-sitekey="<?=$publicKey?>"></div>
            <div id="captchaStatus"></div>
          </div>
          <button type="submit" name="invia" id="invia" class="contacts__btn pointer mb-5">Send</button>
        </div>
      </form>
    </div>
    <div id="inforequestdivFeedBack" class="contacts__requestanswer col-2  mb-7">
      <h3>Thank you for contacting us!</h3>
      <p>Dear <span, id="sendername">
          </span,</p> <p>Your Request has been successfully sent.</p>
      <p>We will be in touch soon.</p>
    </div>
    <div id="inforequestNegativeFeedBack" class="contacts__requestanswer col-2  mb-7">
      <h3>Message not sent</h3>
      <p>There was a problem with the server. Reload the page and retry</p>
      <p>If the proplem persists, please contact us at <a href="mailto:info@sensuspr.com">info@sensuspr.com</a></p>
    </div>
    <div id="inforequestCaptchaError" class="contacts__requestanswer col-2  mb-7">
      <h3>Captcha keys are not verified</h3>
      <p>Reload the page and retry</p>
      <p>If the proplem persists, please contact us at <a href="mailto:info@sensuspr.com">info@sensuspr.com</a></p>
    </div>
  </div>
</section>

<script>
  function contact_submit() {
    challengeField = grecaptcha.getResponse();
    if (challengeField == '') {
      $("#captchaStatus").html('<span style="color: red;">You did not Check the captcha. Please try again</span>');
      setTimeout(() => {
        $("#captchaStatus").empty();
      }, 3000)
      return;
    }

    var params = {
      page: "contacts",
      step: "SendRequestInfo",
      name: $("#name").val(),
      email: $("#email").val(),
      phone: $("#phone").val(),
      message: $("#message").val(),
      recaptcha_challenge_field: challengeField,
      ipaddress: "<?=$ip?>"
    };
    $.ajax({
      type: 'POST',
      url: window.applicationURL + "index.php?" + $.param(params) + "&ajax=true",
      success: function (response) {
        if (response.includes("success")) {
          submitformOk($("#name").val(), "success")
        } else {
          if (response.includes("captcha-error")) {
            submitformOk($("#name").val(), "captcha-error")
          } else
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
    var divNegCapt = document.getElementById("inforequestCaptchaError");
    divf.style.display = "none";
    if (outcome == "success") {
      divOk.style.display = "block";
    } else {
      if (outcome == "captcha-error") {
        divNegCapt.style.display = "block";
      } else divNeg.style.display = "block";
    }
    document.getElementById("inforequestdivFeedBack").focus();
  }
</script>