<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Prosty CMS - Panel admina</title>
        <link type="text/css" href="<?=base_url()?>/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="<?=base_url()?>/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="<?=base_url()?>/css/theme.css" rel="stylesheet">
        <link type="text/css" href="<?=base_url()?>/images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
    </head>

<body>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                    <i class="icon-reorder shaded"></i></a><a class="brand" href="<?=base_url()?>/panel">
                    <img src="<?=base_url()?>/media/logo.png" alt="" width="45" height="45">
                    Prosty CMS - Panel admina</a>
                <div class="nav-collapse collapse navbar-inverse-collapse">
                    <ul class="nav pull-right">
                        <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?=base_url()?>/images/user.png" class="nav-avatar">
                                <?=$ses["name"]?>
                                <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?=base_url()?>/panel/profil">Twój profil</a></li>
                                <li class="divider"></li>
                                <li><a href="<?=base_url()?>/panel/logout">Wyloguj</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.nav-collapse -->
            </div>
        </div>
        <!-- /navbar-inner -->
    </div>
    <!-- /navbar -->
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="span3">
                    <div class="sidebar">
                        <ul class="widget widget-menu unstyled">
                            <li class="active"><a href="<?=base_url()?>/panel"><i class="menu-icon icon-dashboard"></i>Pulpit
                                </a></li>
                            <?php if(acl("news") or acl("news_pages")):?>
                            <li><a href="<?=base_url()?>/panel/news"><i class="menu-icon icon-bullhorn"></i>Newsletter </a>
                            </li>
                            <?php endif;?>
                            <li><a href="<?=base_url()?>/panel/pages"><i class="menu-icon icon-inbox"></i>Podstrony </a></li>
                            <li><a href="<?=base_url()?>/panel/pages_p"><i class="menu-icon icon-inbox"></i>Strony przedmiotowe </a></li>
                            <?php if(acl("files")):?>
                            <li><a href="<?=base_url()?>/panel/pliki"><i class="menu-icon icon-file"></i>Pliki </a></li>
                            <?php endif;?>
                            <?php if(acl("gallery")):?>
                            <li><a href="<?=base_url()?>/panel/gallery"><i class="menu-icon icon-file"></i>Galeria </a></li>
                            <?php endif;?>
                        </ul>
                        <!--/.widget-nav-->
                        <?php if(acl("szablon")):?>
                        <ul class="widget widget-menu unstyled">
                            <li><a href="<?=base_url()?>/panel/menu"><i class="menu-icon icon-tasks"></i>Menu </a></li>
                            <li><a href="<?=base_url()?>/panel/slider"><i class="menu-icon icon-list"></i>Slider </a></li>
                            <li><a href="<?=base_url()?>/panel/szablon"><i class="menu-icon icon-list"></i>Szablon </a></li>
                        </ul>
                        <?php endif;?>
                        <!--  
                            <ul class="widget widget-menu unstyled">
                                <li><a href="ui-button-icon.html"><i class="menu-icon icon-bold"></i> Buttons </a></li>
                                <li><a href="ui-typography.html"><i class="menu-icon icon-book"></i>Typography </a></li>
                                <li><a href="form.html"><i class="menu-icon icon-paste"></i>Forms </a></li>
                                <li><a href="table.html"><i class="menu-icon icon-table"></i>Tables </a></li>
                                <li><a href="charts.html"><i class="menu-icon icon-bar-chart"></i>Charts </a></li>
                            </ul>
/.widget-nav-->
                        <?php if($ses["level"]==0):?>
                        <ul class="widget widget-menu unstyled">
                            <!--
                                <li><a class="collapsed" data-toggle="collapse" href="#togglePages"><i class="menu-icon icon-cog">
                                </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                                </i>More Pages </a>
                                    <ul id="togglePages" class="collapse unstyled">
                                        <li><a href="other-login.html"><i class="icon-inbox"></i>Login </a></li>
                                        <li><a href="other-user-profile.html"><i class="icon-inbox"></i>Profile </a></li>
                                        <li><a href="other-user-listing.html"><i class="icon-inbox"></i>All Users </a></li>
                                    </ul>
                                </li>-->
                            <li><a href="<?=base_url()?>/panel/users"><i class="menu-icon icon-user"></i>Użytkownicy</a></li>
                        </ul>
                        <?php endif;?>
                        <ul class="widget widget-menu unstyled">
                            <!--
                                <li><a class="collapsed" data-toggle="collapse" href="#togglePages"><i class="menu-icon icon-cog">
                                </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                                </i>More Pages </a>
                                    <ul id="togglePages" class="collapse unstyled">
                                        <li><a href="other-login.html"><i class="icon-inbox"></i>Login </a></li>
                                        <li><a href="other-user-profile.html"><i class="icon-inbox"></i>Profile </a></li>
                                        <li><a href="other-user-listing.html"><i class="icon-inbox"></i>All Users </a></li>
                                    </ul>
                                </li>-->
                            <li><a href="<?=base_url()?>/panel/logout"><i class="menu-icon icon-signout"></i>Wyloguj </a></li>
                        </ul>
                    </div>
                    <!--/.sidebar-->
                </div>
                <!--/.span3-->
                <div class="span9">
                    <?=$panel_body?>
                </div>
                <!--/.span9-->
            </div>
        </div>
        <!--/.container-->
    </div>
    <!--/.wrapper-->
    <div class="footer">
        <div class="container">
            <b class="copyright">&copy; 2019 Szymon Haczyk (Edmin theme)</b> All rights reserved.
        </div>
    </div>
    <script src="<?=base_url()?>/scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>/scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>/scripts/flot/jquery.flot.js" type="text/javascript"></script>
    <script src="<?=base_url()?>/scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
    <script src="<?=base_url()?>/scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="<?=base_url()?>/scripts/common.js" type="text/javascript"></script>
    <script src="<?=base_url()?>/js/Chart.min.js"></script>
</body>