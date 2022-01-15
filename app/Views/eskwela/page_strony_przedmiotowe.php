<div id="przedmioty" class="colorlib-classes colorlib-light-grey">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center colorlib-heading animate-box">
                <h2>Strony przedmiotowe</h2>
                <p>Nasza szkoła posiada bogatą oferte edukacyjną</p>
            </div>
        </div>
        <div class="row">
            <?php foreach($pages_p as $item):?>
            <?php if($item->parent_id==0):?>
            <div class="col-sm-6 col-md-3 animate-box">
                <div class="classes">
                    <a href="<?=generate_page_url($item," page_p")?>"> <div class="classes-img" style="background-image: url('<?=base_url($item->img)?>');">
                        </div></a>
                    <div class="desc">
                        <h3><a href="<?=generate_page_url($item," page_p")?>">
                                <?=$item->title?></a></h3>
                    </div>
                </div>
            </div>
            <?php endif;?>
            <?php endforeach;?>
        </div>
    </div>
</div>