<aside id="colorlib-hero">
    <div class="flexslider">
        <ul class="slides">
            <?php foreach ($slider as $item): ?>
            <li style="background-image: url(<?= base_url() ?><?= $item->image_path ?>);">
                <div class="overlay"></div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 col-xs-12  slider-text">
                            <div class="slider-text-inner text-center">
                                <h1>
                                    <?= $item->text ?>
                                </h1>
                                <?php if($item->text!=""):?>
                                <p><a href="<?= $item->url ?>" class="btn btn-primary btn-lg btn-learn">
                                        <?= $item->btn_text ?></a></p>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</aside>