<?php

global $publicKey;
global $privateKey;

$publicKey  = getenv('RECAPTCHA_PUBLIC_KEY')  ?: '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI';
$privateKey = getenv('RECAPTCHA_PRIVATE_KEY') ?: '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe';

?>
