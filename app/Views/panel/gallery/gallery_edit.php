<div class="module">
    <script src="/ckfinder/ckfinder.js"></script>
    <div class="module-head">
        <h3>
        Galeria</h3>
    </div>
    <div class="module-body">
        <h3>Edytuj album</h3>
        <?php if($alert==true):?>
        <?=validation_errors(); ?>
        <?php endif;?>
        <script  src="<?=base_url()?>/ckfinder/ckfinder.js"></script>
        <script  src="<?=base_url()?>/ckeditor/ckeditor.js"></script>

        <form class="form-control" method="post" action="<?=base_url()?>/panel/gallery/editu">
            <input type="hidden" name="id" value="<?=$album->id?>">


            <label>Tytuł albumu :</label>
            <input class="form-control" type="text" name="title" value="<?=$album->title?>" required>
            <label>Krótki opis:</label>
            <textarea class="form-control" type="text" name="text"   ><?=$album->text?></textarea>

            
            <br>
            <input type="checkbox" name="published" value="1" <?=$album->published==1 ? ' checked' :"" ?>>Opublikowany<br>
            <label>Katalog ze zdjęciami:</label>
            <select name="folder">
                <option value="new">Utwórz nowy</option>
                <?php foreach($foldery as $item):?>
                <option <?=$album->folder==$item ? ' selected' :"" ?>><?=$item?></option>
                <?php endforeach;?>
            </select>

            <br>
            <a href="<?=base_url()?>/panel/gallery" class="btn">Anuluj</a>

            <button class="btn btn-primary">Zapisz</button>
        </form>




    </div>



</div>
