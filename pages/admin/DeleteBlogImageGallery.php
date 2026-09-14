<div class="container-fluid example">
    <div class="row">
        <div class="col-xs-12">
            <section class="install">
                <div class="demo hasActive" >
                    <ul id="minMax" class="gallery list-unstyled clearfix lightSlider csSlide">
                        <?php foreach($imageBLog->files as $filename){ ?>
                            <li> <a href="javascript:void(0)">
                                 <img src="<?=$filename?>" style="height:150px;max-width:100%;display:block;vertical-align:middle"/>
                            </a> </li>
                          <?php } ?>
                    </ul>
                </div>
             </section>
        </div>
    </div>

</div>
<script>
     $('#minMax').lightSlider({
       minSlide:6,
      maxSlide:12,
      slideMargin:3,
      slideWidth:75
    }); 
</script>