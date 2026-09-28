
<!-- Structured data -->

  <?php if ($strut->type=="Review") { ?>
           
  <div itemscope itemtype="http://schema.org/Review" class="hidden">
    <a itemprop="url" href="<?=$root.$strut->url?>"><div itemprop="name"><strong><?=$strut->title?></strong></div>
    </a>
    <div itemprop="description"><?=$strut->descr?></div>
    <div itemprop="author" itemscope itemtype="http://schema.org/Person">
    Written by: <span itemprop="name"><?=$strut->auth?></span></div>
    <div><meta itemprop="datePublished" content="<?=$strut->written?>">Date published: <?=$strut->written?></div>  <!--date format mm/dd/yyyy-->
    <div><meta itemprop="dateUpdated" content="<?=$strut->upd?>">Date updated: <?=$strut->upd?></div>  <!--date format mm/dd/yyyy-->
</div>
            
  <?php } ?>         
  
  <?php if ($strut->type=="LocalBusiness") { ?>
           
  <div itemscope itemtype="http://schema.org/LocalBusiness" class="hidden">
    <a itemprop="url" href="<?=$root.$strut->url?>"><div itemprop="name"><strong><?=$strut->title?></strong></div>
    </a>
    <div itemprop="description"><?=$strut->descr?></div>
    <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
    <span itemprop="streetAddress">Il Pirata - Murrebue and Mecufi Beach Resort - Ngoma beach - Mecufi</span><br>
    <span itemprop="addressLocality">PEMBA</span><br>
    <span itemprop="addressRegion">CABO DELGADO</span><br>
    <span itemprop="addressCountry">MOZAMBIQUE</span><br>
    </div>
  </div>
            
  <?php } ?> 
  
  <?php if ($strut->type=="Product") { ?>
           
  <div itemscope itemtype="http://schema.org/Product" class="hidden">
    <a itemprop="url" href="<?=$root.$strut->url?>"><div itemprop="name"><strong><?=$strut->title?></strong></div>
    </a>
    <div itemprop="description"><?=$strut->descr?></div>
    <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
    <span itemprop="price"><?=$strut->value?></span>
    <meta itemprop="priceCurrency" content="USD"/>
    </div>
  </div>
            
  <?php } ?> 
  <!-- End of structured data -->