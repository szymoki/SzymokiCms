<div class="colorlib-blog colorlib-light-grey">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center colorlib-heading animate-box">
                <h2>Album -
                    <?=$album->title?>
                </h2>
                <p>
                    <?=$album->text?>
                </p>
            </div>
        </div>
        <div class="row">
            <?php foreach ($zdjecia as $key => $item): ?>
            <div class="col-sm-6 col-md-3 animate-box">
                <div class="classes">
                    <a href="<?=$item?>" target="_blank">
                        <div class="classes-img" style="background-image: url('<?=$item?>');">
                        </div>
                    </a>
                </div>
                <div class="desc">
                    <h3></h3>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>