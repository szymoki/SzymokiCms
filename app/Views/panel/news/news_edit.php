<div class="module">
	<div class="module-head">
		<h3>
		Newsletter</h3>
	</div>
	<div class="module-body">
        <h3>Edytuj newsa</h3>
        <?php if($alert==true):?>
        <?=validation_errors(); ?>
        <?php endif;?>
        <script  src="<?=base_url()?>/ckfinder/ckfinder.js"></script>
        <script  src="<?=base_url()?>/ckeditor/ckeditor.js"></script>

        <form class="form-control" method="post" action="<?=base_url()?>/panel/news/editu">
            <input type="hidden" name="id" value="<?=$news->id?>">
            <label>Tytuł:</label>
            <input class="form-control" type="text" name="title" value="<?=$news->title?>" required>
            <label>Treść:</label>
            <textarea name="text" id="editor1" rows="10" cols="80">
            	<?=$news->text?>
            </textarea>
            <br>
            <label>Kategoria:</label>
            <select class="form-control" name="category">
                <?php if(acl("news")):?>
                <?php foreach($categories as $k=>$item):?>
                <option value="<?=$k?>"  <?=$k==$news->category ? ' selected' :"" ?>><?=$item?></option>
                <?php endforeach;?>
                <?php endif;?>
                <option disabled>--Strony przedmiotowe:--</option>
                <?php foreach($pages_p_categories as $k=>$item):?>
                <?php if(acl("p_".$item->id)):?>
                <option value="<?=$item->id*100?>" <?=$item->id*100==$news->category ? ' selected' :"" ?> ><?=$item->title?></option>
                <?php endif;?>
                <?php endforeach;?>
            </select>
            <Br>
            <input type="hidden" name="published" value="0" />

            <input type="checkbox" name="published" value="1" <?=$news->published==1 ? ' checked' :"" ?>>Opublikowany<br>
            <!--<input type="checkbox" name="super" value="1" <?=$news->super==1 ? ' checked' :"" ?>>Przypnij na górze<br>-->
            <input type="hidden" name="mainpage" value="0" />
            <input type="checkbox" name="mainpage" value="1" <?=$news->mainpage==1 ? ' checked' :"" ?>>Pokaż na głównej stronie<br>

            <br>
            <a href="<?=base_url()?>/panel/news" class="btn">Anuluj</a>

            <button class="btn btn-primary">Zapisz</button>
        </form>
        <script>
            CKEDITOR.on( 'dialogDefinition', function( ev ) {
                var dialogName = ev.data.name;
                var dialogDefinition = ev.data.definition;

                if ( dialogName == 'table' ) {
                    var info = dialogDefinition.getContents( 'info' );

        info.get( 'txtWidth' )[ 'default' ] = '100%';       // Set default width to 100%
        info.get( 'txtBorder' )[ 'default' ] = '0';         // Set default border to 0
    }
});
            var editor=CKEDITOR.replace( 'editor1' );
            CKFinder.setupCKEditor( editor );

        </script>
    </div>
</div>