<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        <?=$title?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="I Liceum Ogólnokształcące im. Komisji Edukacji Narodowej w Stalowej Woli" />
    <meta name="keywords" content="liceum ogólnokształcące, ken, stalowa wola, liceum, loken, staszic" />
    <meta name="author" content="Szymon Haczyk - szymon.haczyk(at)icloud.com" />
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
    <script>
        WebFont.load({
        google: {
          families: ['Open Sans:400,700,800', 'Playfair Display:400,700']
      }
  });
</script>
    <link rel="apple-touch-icon" sizes="180x180" href="<?=site_url()?>/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=site_url()?>/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=site_url()?>/icons/favicon-16x16.png">
    <link rel="manifest" href="<?=site_url()?>/icons/site.webmanifest">
    <link rel="mask-icon" href="<?=site_url()?>/icons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <!-- Animate.css -->
    <link rel="stylesheet" href="<?= base_url() ?>/themes/eskwela/css/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="<?= base_url() ?>/themes/eskwela/css/icomoon.css">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="<?= base_url() ?>/themes/eskwela/css/bootstrap.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="<?= base_url() ?>/themes/eskwela/css/magnific-popup.css">
    <!-- Flexslider  -->
    <link rel="stylesheet" href="<?= base_url() ?>/themes/eskwela/css/flexslider.css">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="<?= base_url() ?>/themes/eskwela/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/themes/eskwela/css/owl.theme.default.min.css">
    <!-- Flaticons  -->
    <link rel="stylesheet" href="<?= base_url() ?>/themes/eskwela/fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="<?= base_url() ?>/themes/eskwela/css/paginacja.css">
    <!-- Theme style  -->
    <link rel="stylesheet" href="<?= base_url() ?>/themes/eskwela/css/style.css">
    <!-- Modernizr JS -->
    <script src="<?= base_url() ?>/themes/eskwela/js/modernizr-2.6.2.min.js"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="js/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <div class="colorlib-loader"></div>
    <div id="page">
        <nav class="colorlib-nav" role="navigation">
            <div class="upper-menu">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-4">
                        </div>
                        <div class="col-xs-6 col-md-push-2 text-right">
                            <p>
                                <ul class=" colorlib-social-icons">
                                    <li><a href="/panel" target="_blank">Panel admina</a></li>
                                </ul>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="top-menu">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div id="colorlib-logo"><a href="<?= base_url() ?>"><img style=" max-width: 70px; max-height: 70px;" src="<?= base_url() ?>/media/logo.png" alt="">
                                    <p style="">Prosty CMS</p>
                                </a></div>
                        </div>
                        <div class="col-lg-8 col-md-12 text-right menu-1">
                            <ul>
                                <?php foreach ($menu as $item): ?>
                                <?php if ($item->hasChildren == 1): ?>
                                <li class="<?= ($item->selected == 1 ? " active" : "" ) ?>
                                    <?= ($item->id == $active_menu ? "active" : "") ?> has-dropdown"><a href="<?= $item->url==" #" ? "#" :(substr($item->url, 0, 4) != "http" ? base_url($item->url) : $item->url) ?>">
                                        <?= $item->name ?></a>
                                    <ul class="dropdown">
                                        <?php foreach ($item->children as $it): ?>
                                        <li class="<?= ($it->id == $active_menu ? " active" : "" ) ?>"><a href="<?= (substr($it->url, 0, 4) != " http" ? base_url($it->url) : $it->url) ?>">
                                                <?= $it->name ?></a>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                                <?php elseif ($item->parent_id == 0): ?>
                                <li class="<?= ($item->id == $active_menu ? " active" : "" ) ?>">
                                    <a href="<?= (substr($item->url, 0, 4) != " http" ? base_url($item->url) : $item->url) ?>">
                                        <?= $item->name ?></a>
                                </li>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <?= $page_slider ?>
        <?= $page_body ?>
        <?= $page_footer ?>
    </div>
    <div class="gototop js-top">
        <a href="#" class="js-gotop"><i class="icon-arrow-up2"></i></a>
    </div>
    <?php if($show_news_down):?>
    <div class="gotonews js-top_news active">
        <a href="#" class="js-gotop_news"><i class="icon-arrow-down"></i> Aktualności </a>
        <?php if(isset($show_pages_p_down) && $show_pages_p_down):?>
        <a href="#" class="js-gotop_przedmioty"><i class="icon-arrow-down"></i> Przedmioty </a>
        <a href="#" class="js-gotop_pieciokaty"><i class="icon-arrow-down"></i> Gabinety </a>
        <?php endif;?>
    </div>
    <?php endif;?>
    <!-- jQuery -->
    <script src="<?= base_url() ?>/themes/eskwela/js/jquery.min.js"></script>
    <!-- jQuery Easing -->
    <script src="<?= base_url() ?>/themes/eskwela/js/jquery.easing.1.3.js"></script>
    <!-- Bootstrap -->
    <script src="<?= base_url() ?>/themes/eskwela/js/bootstrap.min.js"></script>
    <!-- Waypoints -->
    <script src="<?= base_url() ?>/themes/eskwela/js/jquery.waypoints.min.js"></script>
    <!-- Stellar Parallax -->
    <script src="<?= base_url() ?>/themes/eskwela/js/jquery.stellar.min.js"></script>
    <!-- Flexslider -->
    <script src="<?= base_url() ?>/themes/eskwela/js/jquery.flexslider-min.js"></script>
    <!-- Owl carousel -->
    <script src="<?= base_url() ?>/themes/eskwela/js/owl.carousel.min.js"></script>
    <!-- Magnific Popup -->
    <script src="<?= base_url() ?>/themes/eskwela/js/jquery.magnific-popup.min.js"></script>
    <script src="<?= base_url() ?>/themes/eskwela/js/magnific-popup-options.js"></script>
    <!-- Counters -->
    <script src="<?= base_url() ?>/themes/eskwela/js/jquery.countTo.js"></script>
    <!-- Main -->
    <script src="<?= base_url() ?>/themes/eskwela/js/main.js"></script>
</body>

</html>