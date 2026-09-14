
  <?php if ($strut->type=="Review") { ?>

<!-- Structured data -->
   
    <div itemscope itemtype="http://schema.org/Review" class="d-none">
        <a itemprop="url" href="<?=$root.$strut->url?>"><div itemprop="name"><strong><?=$strut->title?></strong></div>
        </a>
        <div itemprop="description"><?=$strut->descr?></div>
        <div itemprop="author" itemscope itemtype="http://schema.org/Person">Written by: <span itemprop="name"><?=$strut->auth?></span></div>
        <div><meta itemprop="datePublished" content="<?=$strut->written?>">Date published: <?=$strut->written?></div>  <!--date format mm/dd/yyyy-->
        <div><meta itemprop="dateUpdated" content="<?=$strut->upd?>">Date updated: <?=$strut->upd?></div>  <!--date format mm/dd/yyyy-->
    </div>
    
<!-- End of structured data <-->

  <?php } ?>         
  
  <?php if ($strut->type=="LocalBusiness") { ?>
   
<!-- Structured data -->

    <div itemscope itemtype="http://schema.org/LocalBusiness" class="d-none">
        <a itemprop="url" href="<?=$root.$strut->url?>"><div itemprop="name"><strong><?=$strut->title?></strong></div>
        </a>
        <div itemprop="description"><?=$strut->descr?></div>
        <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
            <span itemprop="streetAddress"><?=$strut->address?></span><br>
            <span itemprop="addressLocality"><?=$strut->Locality?></span><br>
            <span itemprop="addressRegion"><?=$strut->region?></span><br>
            <span itemprop="addressCountry"><?=$strut->country?></span><br>
        </div>
    </div>
    
<!-- End of structured data --> 
         
  <?php } ?> 
  
  <?php if ($strut->type=="Product") { ?>
   
<!-- Structured data -->      
    <div itemscope itemtype="http://schema.org/Product" class="d-none">
        <a itemprop="url" href="<?=$root.$strut->url?>"><div itemprop="name"><strong><?=$strut->title?></strong></div>
        </a>
        <div itemprop="description"><?=$strut->descr?></div>
        <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
            <span itemprop="price"><?=$strut->price?></span>
            <meta itemprop="priceCurrency" content="<?=$strut->currency?>"/>
        </div>
    </div>
    
<!-- End of structured data -->
 
  <?php } ?> 
  