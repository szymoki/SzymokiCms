<div id="colorlib-intro">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 intro-wrap">
                <div class="intro-flex">
                    <?= $page_left_boxes ?>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="about-desc animate-box startup" style="">
                    <?= $text_startup ?>
                </div>
            </div>
        </div>
    </div>
    <div id="newsletter" class="colorlib-blog colorlib-light-grey">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center colorlib-heading animate-box">
                    <h3 style="margin-top:-50px;margin-bottom:-30px; font-weight:700; text-transform: uppercase;">Aktualności</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php foreach ($news as $key => $item): ?>
                    <div class="f-blog animate-box" style="padding-left: 1em">
                        <?php if ($item->mainphoto != ""): ?>
                        <a href="blog.html" class="blog-img" style="">
                        </a>
                        <?php endif; ?>
                        <div class="desc">
                            <h2><a href="<?= base_url() ?>/news/<?= $item->id ?>">
                                    <?= $item->title ?></a></h2>
                            <hr class="blue_line mt10 mb10" />
                            <p class="admin" style="">
                                <span> <a href="<?=base_url(" news/category/".$item->category)?>"> <?=$categories[$item->category] ?></a>
                                    <?= $item->edited_date ?></span> <i style="color:black;" class="icon-calendar"> </i>
                            </p>
                            <?= news($item->text) ?>
                            <?php if(read_many($item->text)):?>
                            <p><a href="<?= base_url() ?>/news/<?= $item->id ?>" class="color-1">
                                    <button class="btn pull-right ">
                                        Czytaj dalej
                                    </button>
                                </a><br></p>
                            <?php endif;?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <p><a href="<?= base_url() ?>/news/all" class="color-1">
                            <button class="btn pull-right ">
                                Pokaż wszystkie
                            </button>
                        </a><br></p>
                </div>
            </div>
        </div>
    </div>
    <?php if (true): ?>
    <div id="colorlib-counter" class="colorlib-counters" style="background-image: url(<?= base_url() ?>/themes/eskwela/images/img_bg_2.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="col-md-3 col-sm-6 animate-box">
                        <div class="counter-entry">
                            <span class="icon"><i class="flaticon-book"></i></span>
                            <div class="desc">
                                <span class="colorlib-counter js-counter" data-from="0" data-to="<?= $licznik["licznik1"] ?>" data-speed="5000"
                                    data-refresh-interval="50"></span>
                                <span class="colorlib-counter-label">Różnych zajęć pozalekcjnych</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 animate-box">
                        <div class="counter-entry">
                            <span class="icon"><i class="flaticon-student"></i></span>
                            <div class="desc">
                                <span class="colorlib-counter js-counter" data-from="0" data-to="<?= $licznik["licznik2"] ?>" data-speed="5000"
                                    data-refresh-interval="50"></span>
                                <span class="colorlib-counter-label">Uczniów</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 animate-box">
                        <div class="counter-entry">
                            <span class="icon"><i class="flaticon-professor"></i></span>
                            <div class="desc">
                                <span class="colorlib-counter js-counter" data-from="0" data-to="<?= $licznik["licznik3"] ?>" data-speed="5000"
                                    data-refresh-interval="50"></span>
                                <span class="colorlib-counter-label">Nauczycieli</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 animate-box">
                        <div class="counter-entry">
                            <span class="icon"><i class="flaticon-earth-globe"></i></span>
                            <div class="desc">
                                <span class="colorlib-counter js-counter" data-from="0" data-to="<?= $licznik["licznik4"] ?>" data-speed="5000"
                                    data-refresh-interval="50"></span>
                                <span class="colorlib-counter-label">Uczestników olimpiad</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if (zmienna("uczniowie_on") == "1"): ?>
    <div id="colorlib-testimony" class="testimony-img" style="background-image: url(<?= base_url() ?>/themes/eskwela/images/img_bg_2.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center colorlib-heading animate-box">
                    <h2>Co mówią nasi byli uczniowie</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <div class="row animate-box">
                        <div class="owl-carousel1">
                            <div class="item">
                                <div class="testimony-slide">
                                    <div class="testimony-wrap">
                                        <blockquote>
                                            <span>Sophia Foster</span>
                                            <p>Przyszłam do tej szkoły z wielkim strachem. Szkoła nauczyła mnie
                                                wszystkiego co mi postrzebne w życiu</p>
                                        </blockquote>
                                        <div class="figure-img" style="background-image: url(<?= base_url() ?>/themes/eskwela/images/person1.jpg);"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimony-slide">
                                    <div class="testimony-wrap">
                                        <blockquote>
                                            <span>John Collins</span>
                                            <p>Kiedyś nie umiałem matematyki, teraz już umiem</p>
                                        </blockquote>
                                        <div class="figure-img" style="background-image: url(<?= base_url() ?>/themes/eskwela/images/person2.jpg);"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimony-slide">
                                    <div class="testimony-wrap">
                                        <blockquote>
                                            <span>Adam Ross</span>
                                            <p>Kochałem ten piękny zapach na korytarzach.</p>
                                        </blockquote>
                                        <div class="figure-img" style="background-image: url(<?= base_url() ?>/themes/eskwela/images/person3.jpg);"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?= $page_strony_przedmiotowe ?>
</div>
</div>