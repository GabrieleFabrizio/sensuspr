<section class="back-black home__section">
  <div class="fadecontainer">
    <div class="fade-in-left  fade-animation">
      <div class="fgrid fgrid__left mb-7">
        <div class="fgrid__divleft">
          <p class="home__section__pretitle mb-7">We are...</p>
          <h2 class="mb-3">Listeners</h2>
          <p>
            Do you have unique things to share? Are you creating products and services that are making someone's life better?
            Then we would love to tell your story - and we will make sure the world listens.
          </p>
        </div>
      </div>
      <div class="fgrid fgrid__center mb-7">
        <a href="#home2">
          <svg class="fgrid__arrow__diag" id="home2">
            <use xlink:href="<?=$root?>icon/icon.svg#arrow-down-right"></use>
          </svg>
          <svg class="fgrid__arrow fgrid__arrow__small" id="home2">
            <use xlink:href="<?=$root?>icon/icon.svg#arrow-down"></use>
          </svg>
        </a>
      </div>
    </div>
    <div class="fadecontainer">
      <div class="fade-in-right  fade-animation">
        <div class="fgrid fgrid__right  mb-7">
          <div class="fgrid__divright">
            <h2 class="mb-3">Experts in PR</h2>
            <p>
            Expert storytellers at heart, we rely on the mastery of words and combine them with the right timing and
            newest technologies to make your message stand out from the crowd. We specialize in providing tailor-made PR and
            other communications services for innovative businesses - such as startups, private funds, lifestyle companies or
            travel organizations - that consider themselves to be businesses of the future.
            </p>
          </div>
        </div>
        <div class="fgrid fgrid__center  mb-7">
          <a href="#home3">
            <svg class="fgrid__arrow__diag" id="home3">
              <use xlink:href="<?=$root?>icon/icon.svg#arrow-down-left"></use>
            </svg>
            <svg class="fgrid__arrow fgrid__arrow__small" id="home2">
              <use xlink:href="<?=$root?>icon/icon.svg#arrow-down"></use>
            </svg>
          </a>
        </div>
      </div>
    </div>
    <div class="fadecontainer">
      <div class="fade-in-left  fade-animation  mb-10">
        <div class="fgrid fgrid__left">
          <div class="fgrid__divleft">
            <h2 class="mb-3">Result Driven</h2>
            <p>Our team of experienced communications professionals will offer you personalized attention, will listen to
            your needs and will make sure your voice travels far and wide, to the people who need to know about you - journalists,
            partners and customers.
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="fadecontainer">
      <div class="home__section__slogan fade-in-right  fade-animation mb-5">
        Innovative Dynamic Impactful
      </div>
      <div class="home__section__slogan fade-in-left  fade-animation">
        <a href="#home4">
          <svg class="fgrid__arrow">
            <use xlink:href="<?=$root?>icon/icon.svg#arrow-down"></use>
          </svg>

        </a>
      </div>
    </div>
</section>
<section class="home__section home__section__sidepad" id="home4">
  <div class="fadecontainer">
    <div class="fade-in-scalesm fade-animation">
      <p class="home__section__pretitle-b mb-7">What we do...</p>
      <?php
  $servicesSlogans = array(
    array("Boost your company's exposure",
    "We excel in providing customized PR solutions, including media relations, strategic communication, and brand
    management, to boost your company's image and achieve success",
    "Here is the list of services we provide<br />
    with informations and detailed descriptions."),
    array("International PR",
    "Expert organic communications to create global visibility, build reputation and showcase
    your expertise with the world's top media",
    "Here is the list of services we provide<br />
    with informations and detailed descriptions."),
    array("Unlocking the Power of Your Story",
    "At Sensus PR, we expertly harness your narrative and leverage it across various content formats, including your
    website, blog posts, white papers, op-ed articles, and more.",
    "Here is the list of services we provide<br />
    with informations and detailed descriptions."),
    array("Strategic Communications",
    "We blend creativity with strategic thinking and the needs of your brand to help
    deliver effective long-term PR strategies.",
    "Here is the list of services we provide<br />
    with informations and detailed descriptions."),
  );
    foreach ($servicesSlogans as $index => $sv) {
  ?>
      <div class="home__service mb-3">
        <h2 class="pointer" onclick="showService(<?=$index+1?>)"><?=$sv[0]?></h2>
        <div class="mb-3 home__service__hidden" id="service<?=$index+1?>">
          <div class="home__service__left text-justify">
            <?=$sv[1]?>
            <a href="services">
            <svg class="home__service__left__arrow fgrid__arrow fillbase">
              <use xlink:href="<?=$root?>icon/icon.svg#arrow-right"></use>
            </svg>
            </a>
          </div>
          <div class="home__service__right">
            <div class="mb-2">
              <?=$sv[2]?>
            </div>
            <a href="services">
              <svg class="fgrid__arrow fillbase">
                <use xlink:href="<?=$root?>icon/icon.svg#arrow-right"></use>
              </svg>
            </a>
          </div>
        </div>
      </div>
      <?php
    }
  ?>
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
          <h2 class="text-center mb-7">WHY SENSUS PR?</h2>
          <div class="text-justify">At Sensus PR, first we deeply listen to who you are, analyze your product
            or service
            and live with your brand as our own. Then we use our skills, passion and experience to tell your story to
            the
            world. Find out more about who we are and how we can help you!</div>
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

<section class="home__section home__section__success home__testimonials">
  <div class="fadecontainer">
    <h2 class="text-center mb-7 about__bigtitles  fade-in-left  fade-animation">What clients say about us:</h2>
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

<section class="home__section home__section__sidepad back-black" id="home4">
  <div class="fadecontainer">
    <h2 class="home__insights__title fade-in-left fade-animation">Insights</h2>
    <div class="home__insights__subtitle mb-7 fade-in-left fade-animation">Our latest posts. Read All
      <a href="<?=$root?>insights">
        <div class="home__insights__horarrow">
          <svg class="home__insights__smallarrow">
            <use xlink:href="<?=$root?>icon/icon.svg#arrow-right"></use>
          </svg>
        </div>
      </a>
    </div>
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
