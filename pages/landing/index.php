<section class="back-black about__section about__section__sidepad">
  <div class="fadecontainer">
  <h2 class="text-center mb-7 landing__titles fade-in-left  fade-animation">Are you ready to become a desired brand?</h2>
  <p class="text-center mb-7 landing__intro mb-7 fade-in-left  fade-animation">Then we would be more than glad to hear your story and see how we can help!</p>
  </div>
</section>

<section class="home__section home__section__success">
  <div class="fadecontainer">
    <h2 class="home__insights__title text-center mb-7 about__bigtitles  fade-in-left  fade-animation">What clients say about us:</h2>
    <div id="slider" class="fade-in-scalesm fade-animation">
      <div class="slider__control_next">></div>
      <div class="slider__control_prev"><</div> 
      <ul>
          <?php
          foreach ($testimonials as $T) {
            ?>
            <li>
              <div class="slider__slide">
                <img src="<?=$root?>img/testimonials/T_<?=$T['ID']?>.jpg" alt="test.<?=$T['COMPANY']?>" class="slider__slide__img">
                <p class="slider__slide__text"><?=$T['TEXT']?></p>
                <?php if ($T['NAME']) { ?>
                <p class="slider__slide__name"><?=$T['NAME']?></p>
                <?php 
                          }
                          if ($T['POSITION']) { ?>
                <p class="slider__slide__role"><?=$T['POSITION']?></p>
                <?php } ?>
                <p class="slider__slide__company"><?=$T['COMPANY']?></p>
              </div>
            </li>
      <?php }?>
      </ul>
    </div>
  </div>
</section>

<section class="back-black home__section  home__section__sidepad2">
  <div class="fadecontainer">
    <div class="cols">
      <div class="home__why__col1 text-left">
        <img src="<?=$root?>img/logo-yellow.png" alt="Sensus PR" class="home__why__logo  fade-in-scalesm  fade-animation">
      </div>
      <div class="home__why__col2">
        <div class="fade-in-right  fade-animation mb-7">
          <h2 class="text-center mb-7">Who is invited?</h2>
          <div class="text-justify">Startups, tech companies, lifestyle and hospitality brands and organizations who want global exposure and strong thought leadership</div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
  if (!empty($clients)) {
?>
<section class="client-carusel">
    <div class="client-carusel__title home__section__sidepad2">
      <h2>Trusted by:</h2>
    </div>
    <div class="client-carusel__wrap">
        <?php 
      $image = "default.png";
        foreach ($clients as $cl) {
          if (file_exists('img/clients/CL_'.$cl['ID'].'.webp')) {
            $image = 'CL_'.$cl['ID'].'.webp'; }    
      ?>
      <div class="client-carusel__slide">
      <?php if ($cl['LINK'] != "") { ?>    
          <a href="<?=$cl['LINK']?>" target="_blank">
      <?php } ?>
        <div class="client-carusel__slide__inner">
            <img src="<?=$root?>img/clients/<?=$image?>" alt="<?=$cl['NAME']?>">
        </div>
        <?php if ($cl['LINK'] != "") { ?>
          </a>  
      <?php } ?>
      </div>
      <?php
        }
      ?>
    </div>
  </section>
  <?php } ?>

  <script>
  const sliderTrack = document.querySelector('.client-carusel__wrap');
  const slides = Array.from(document.querySelectorAll('.client-carusel__slide'));
  const slideWidth = slides[0].offsetWidth;
  let position = 0;
  let isHovered = false;
  let animationFrame;

  // Clone slides initially to create a seamless loop effect
  slides.forEach(slide => sliderTrack.appendChild(slide.cloneNode(true)));

  // Function to animate the slider automatically
  function slide() {
    if (!isHovered) {
      position -= 1; // Move left by 1px
      sliderTrack.style.transform = `translateX(${position}px)`;

      // Check if the first slide has completely exited the view
      if (Math.abs(position) >= slideWidth) {
        // Reset position and rearrange slides
        position += slideWidth; // Offset position back
        const firstSlide = sliderTrack.firstElementChild;
        sliderTrack.appendChild(firstSlide); // Move the first slide to the end
        sliderTrack.style.transform = `translateX(${position}px)`;
      }
    }

    animationFrame = requestAnimationFrame(slide);
  }

  slide(); // Start the sliding animation

  // Event listeners for pausing on hover over a slide with a link
  slides.forEach(slide => {
    const link = slide.querySelector('a');
    if (link) {
      slide.addEventListener('mouseenter', () => {
        isHovered = true; // Stop the automatic sliding
      });
      slide.addEventListener('mouseleave', () => {
        isHovered = false; // Resume the automatic sliding
      });
    }
  });
</script>
<section class="home__section home__section__sidepad" id="home4">
  <div class="fadecontainer">
    <h2 class="landing__regtitle fade-in-left fade-animation text-center">REGISTER TO THE WAITLIST</h2>
    <a href="https://oj6gflliji6.typeform.com/to/sfsUCmPL" target="_blank" class="landing__link text-center fade-in-right  fade-animation">
      >> Click Here <<
    </a>
    <?php
            $val=0;
            foreach ($Blog as $b) {
              $val++;
              if ($val % 2 !== 0) {
                $side = "right";
              } else { $side = "left";}
              //gets the first image from the blogpost
              preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', file_get_contents($root."docs/blog/".$b["ID"]."_".$b["FILENAME"]), $matches);
              $post_img = $matches [1] [0];
              
      ?>
    <div class="fadecontainer home__insights__wrap">
      <div class="fade-in-<?=$side?> home__insights__wrap__element text-center mb-7 fade-animation">
        <h2 class="home__insights__wrap__element__title mb-3"><?=$b['TITLE']?></h2>
        <p class=" mb-3"><?=$b['SUBTITLE']?></p>
        <div class="cols">
          <div class="home__insights__wrap__element__info text-right font-2">
            <svg class="home__insights__wrap__element__icons">
              <use xlink:href="<?=$root?>icon/icon.svg#icon-blog-author"></use>
            </svg>
            <?=$b["AUTHOR_NAME"]?>
          </div>
          <div class="home__insights__wrap__element__info text-left font-2">
            <svg class="home__insights__wrap__element__icons">
              <use xlink:href="<?=$root?>icon/icon.svg#icon-blog-date"></use>
            </svg>
            <?=date('j F, Y', strtotime($b["LAST_MODIFIED"]))?>
          </div>
        </div>
        <a href="<?=$root?>insights/<?=$b["ID"]?>/<?=cleanname($b["TITLE"])?>">
          <div class="home__insights__horarrow">
            <svg class="home__insights__smallarrow">
              <use xlink:href="<?=$root?>icon/icon.svg#arrow-right"></use>
            </svg>
          </div>
        </a>
      </div>
    </div>
    <?php }?>
</section>
