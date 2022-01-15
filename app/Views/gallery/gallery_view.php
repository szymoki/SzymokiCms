<div class="colorlib-blog colorlib-light-grey">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center colorlib-heading animate-box">
                <h2>Galeria</h2>
                <p>Albumy związane z naszą szkołą</p>
            </div>
        </div>
        <div class="row">
            <?php foreach ($albumy as $key => $item): ?>
            <div class="col-sm-6 col-md-3 animate-box">
                <div class="classes">
                    <a href="<?=base_url(" galeria/album/".$item->id)?>"> <div class="classes-img" style="background-image: url('<?=base_url(" galeria/get_thumb/".$item->id)?>');"> </div> </a> <div class="desc">
                        <h3><a href="<?=base_url(" galeria/album/".$item->id)?>"> <?=$item->title?></a></h3>
                        <p></p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <p>
        <?= $pager->links() ?>
    </p>
</div>
</div>