<footer id="colorlib-footer">
    <div class="container">
        <div class="flex-row row-pb-md">
            <div class="justify-content-center">
                <div class="col-md-3 colorlib-widget">
                    <h4>Sponsorzy:</h4>
                    <p>
                        <?=$text_sponsorzy?>
                    </p>
                </div>
                <div class="col-md-3 colorlib-widget">
                    <h4>Szybki dostęp</h4>
                    <p>
                        <ul class="colorlib-footer-links">
                            <?php foreach ($page_config->page_footer_menu as $item): ?>
                            <li><a href="<?=$item["url"]?>"><i class="icon-check"></i>
                                    <?=$item["name"]?></a></li>
                            <?php endforeach;?>
                        </ul>
                    </p>
                </div>
                <div class="col-md-3 colorlib-widget">
                    <h4>Przydatne linki</h4>
                    <p>
                        <ul class="colorlib-footer-links">
                            <?php foreach ($page_config->page_footer_menu2 as $item): ?>
                            <li><a title="<?=$item["title"]?>" href="
                                    <?=$item["url"]?>" target="_blank"><i class="icon-check"></i>
                                    <?=$item["name"]?></a></li>
                            <?php endforeach;?>
                        </ul>
                    </p>
                </div>
                <div class="col-md-3 colorlib-widget">
                    <h4>Informacje kontaktowe</h4>
                    <ul class="colorlib-footer-links">
                        <li>ul. Stanisława Staszica 5 <br> 37-450 Stalowa Wola</li>
                        <li><a href="tel://158426945"><i class="icon-phone"></i> 15 842 69 45</a></li>
                        <li><a href="mailto:liceum@loken.pl"><i class="icon-envelope"></i> liceum@loken.pl</a></li>
                        <li><a href="http://loken.pl"><i class="icon-location4"></i> loken.pl</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="copy">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>
                        <small class="block">&copy; LOKEN
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            <script>
                            document.write(new Date().getFullYear());
                            </script>
                            Wszelkie prawa zatrzeżone | Szablon <a href="https://colorlib.com" target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </small><br>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>