    <?php 
        global $root;
    ?>
    <!-- Core JavaScript File -->
    <?php /*
    <script src="<?=$root?>template/js/hideloading.js"></script> */?>
    
     <script src="<?=$root?>template/js/ajaxbase.js"></script>
    <script src="<?=$root?>template/js/jquery.html5form-1.5-min.js"></script>
    <script src="<?=$root?>template/js/jquery.form.min.js"></script>
    <script src="<?=$root?>template/js/html5shiv.js"></script>
    <script src="<?=$root?>template/js/menuScrollResize.js"></script>
    <script src="<?=$root?>template/js/headermenu.js"></script>
    <script src="<?=$root?>template/js/headeranim.js"></script>
    <script src="<?=$root?>template/js/fadeins.js"></script>
    <script src="<?=$root?>template/js/client-carusel.js"></script>
    <script src="<?=$root?>template/js/slider.js"></script>
    <script src="<?=$root?>template/js/serviceanim.js"></script> 


    <!--   cookie consent script   
    <script-- src="<?=$root?>template/js/cookieConsent.js"></script-->

  <?php 
  /* usage: headerAnim(
      delay between title and subtitles refresh (in ms max 1500 suggested 700)
      target1.class,
      titles[arr],
      tagert2.class,
      target3.class,
      subtitles[[sancence1.1,sentence1.2],
      [sancence2.1,sentence2.2],
      [sancence3.1,sentence3.2],...]) 
      ** note it must be titles.lenght === subtitles.lenght 
      if target3 === "" in willl be skipped
      */
    global $theme;
    if ($theme['lenght']) {
    ?>
  <script>
    headerAnim(
      <?=$theme['lenght']?>,
      ".header__content__wrap__title__change",
      <?=$theme['titles']?>,
      '.header__content__wrap__subtitle',
      '.header__content__wrap__subtitle2',
      [
        <?=$theme['subtitles']?>
      ]
    );
    </script>
  <?php } ?>