<div class="content">
    <!-- <div class="btn-controls">
        <div class="btn-box-row row-fluid">
            <a href="#" class="btn-box big span4"><i class=" icon-random"></i><b><?=$visits_today?></b>
                <p class="text-muted">
                Odwiedzin dzisiaj</p>
            </a><a href="#" class="btn-box big span4"><i class="icon-user"></i><b><?=$visits_last_week?></b>
                <p class="text-muted">
                Odwiedzin w tym tygodniu</p>
            </a><a href="#" class="btn-box big span4"><i class="icon-group"></i><b>100%</b>
                <p class="text-muted">
                Zadowolonych uczniów</p>
            </a>
        </div>-->
    <!--/.module-->
    <div class="module">
        <div class="module-body">
            Witaj, zalogowałeś się do panelu administracyjnego serwisu LOKEN.PL
            <br><br>
            <div class="btn-group">
                <a href="<?=base_url(" panel/profil")?>" class="btn btn-primary">Ustawienia konta</a>
                <a href="#" onclick="alert('Skontaktuj się z 000 000 000')" class="btn btn-warning">Potrzebuje pomocy</a>
                <a href="<?=base_url(" panel/logout")?>" class="btn btn-danger">Wyloguj</a>
            </div>
        </div>
    </div>
</div>
<div class="module">
    <div class="module-head">
        <h3>
            Informacje od administratora:</h3>
    </div>
    <div class="module-body">
        Proszę zachować porządek w plikach i w tworzeniu nowych publikacji.
    </div>
</div>
<?php if($ses["level"]==0):?>
<div class="module">
    <div class="module-head">
        <h3>
            Logi systemu:</h3>
    </div>
    <div class="module-body">
        <pre style="overflow:scroll; height:250px;width: 100%;overflow-x: auto;"><?=$logs?></pre>
    </div>
</div>
<?php endif;?>
</div>
<!--/.content-->