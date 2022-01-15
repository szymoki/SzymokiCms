<div class="module">
    <div class="module-head">
        <h3>
            Twój profil</h3>
    </div>
    <div class="module-body">
        <h2> <img src="<?=base_url()?>/images/user.png">
            <?=$ses["name"]?>
        </h2>
        <h3>Zmiana hasła:</h3>
        <form method="post" action="<?=base_url(" panel/pass_change")?>"> <label>Podaj aktualne hasło:</label>
            <input class="form-control" type="password" name="old" required>
            <label>Podaj nowe hasło:</label>
            <input class="form-control" type="password" name="new" placeholder="Minimum 6 znaków" required>
            <label>Powtórz hasło:</label>
            <input class="form-control" type="password" name="new2" required><br>
            <button class="button btn-primary">Zapisz</button>
        </form>
        <p>
            <?= $validation->listErrors() ?>
        </p>
    </div>
</div>