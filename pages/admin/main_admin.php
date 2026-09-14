<div class="container dmn__main">
    <div class="dmn__main__cards dmn__main__cards-blog pointer" onclick="goToAdminPage('Blog')">
        <h4 class="dmn__main__cards__title">Blog</h4>
        <svg class="dmn__main__cards__icon">
            <use xlink:href="<?=$root?>icon/icon.svg#icon-admin-blog" ></use>
        </svg><br/>
        <span>Total: <?=$indexblog->total?></span><br/>
        <span>Approved: <?=$indexblog->approved?></span><br/>
        <?php if ($indexblog->notapproved>0) {?>
        <span class="dmn__main__cards__text-red">Not Approved: <?=$indexblog->notapproved?></span><br/>
        <?php }?>
    </div>
    <div class="dmn__main__cards dmn__main__cards-test pointer" onclick="goToAdminPage('Testimonials')">
        <h4 class="dmn__main__cards__title">Testimonials</h4>
        <svg class="dmn__main__cards__icon">
            <use xlink:href="<?=$root?>icon/icon.svg#icon-admin-subscr" ></use>
        </svg><br/>
        <span>Number: <?=$indexTestimonials?></span><br/>
    </div>
    <?php /*
    <div class="dmn__main__cards dmn__main__cards-sub pointer" onclick="goToAdminPage('Subscribers')">
        <h4 class="dmn__main__cards__title">Subscribers</h4>
        <svg class="dmn__main__cards__icon">
            <use xlink:href="<?=$root?>icon/icon.svg#icon-admin-subscr" ></use>
        </svg><br/>
        <span>Total: <?=$indexSubscribers->total?></span><br/>
        <span>Full: <?=$indexSubscribers->both?> - NL: <?=$indexSubscribers->newsletter?> - MSG: <?=$indexSubscribers->messages?></span><br/>
        <span>No subscription: <?=$indexSubscribers->none?></span><br/>
    </div>  */ ?>
    <div class="dmn__main__cards dmn__main__cards-back pointer" onclick="goToAdminPage('Clients')">
        <h4 class="dmn__main__cards__title">Client Logos</h4>
        <svg class="dmn__main__cards__icon">
            <use xlink:href="<?=$root?>icon/icon.svg#icon-admin-backlinks" ></use>
        </svg><br/>
        <span>Number: <?=$indexBacklinks?></span><br/>
    </div>
</div>