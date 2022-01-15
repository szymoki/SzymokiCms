<div class="module">
	<div class="module-head">
		<h3>
		Strony przedmiotowe</h3>
	</div>
	<div class="module-body">
        <h3>Dodaj stronę przedmiotową</h3>
        <?php if($alert==true):?>
        <?=validation_errors(); ?>
        <?php endif;?>
        <script  src="<?=base_url()?>/ckfinder/ckfinder.js"></script>
        <script  src="<?=base_url()?>/ckeditor/ckeditor.js"></script>

        <form class="form-control" method="post" action="<?=base_url()?>/panel/pages_p/addu">

            <label>Tytuł:</label>
            <input class="form-control" type="text" name="title" required>
            <label>Treść:</label>
            <textarea name="text" id="editor1" rows="10" cols="80">
            </textarea>
            <label>Ścieżka obrazka:</label>
            <input class="form-control" id="ckfinder-input-1" type="text" name="img" placeholder="Tylko strony przedmiotowe mają obrazek"  value="" >
            <a href="#" id="ckfinder-popup-1" class="btn btn-primary">Wybierz z serwera</a>
            <label>Podstrona do:</label>
            <select name="parent_id" class="form-control">
                <?php if(acl("pages_p")):?>  <option value="0">brak</option><?php endif;?>
                <?php foreach($pages_p as $item):?>
                <?php if(acl("pages_p") or acl("p_".$item->id)):?>
                <?php if($item->parent_id==0):?>
                <option value="<?=$item->id?>"><?=$item->title?></option>
                <?php foreach($pages_p as $item2):?>
                <?php if($item2->parent_id==$item->id):?>
                <option value="<?=$item2->id?>">--<?=$item2->title?></option>
                <?php endif; ?>
                <?php endforeach;?>
                <?php endif; ?><?php endif; ?>
                <?php endforeach;?>
            </select>

            <label>Seolink:</label>
            <input class="form-control" type="text" name="symlink" >
            <br>
            <input type="checkbox" name="published" value="1" checked>Opublikowany<br>
            <br>
            <br>
            <input type="checkbox" name="menushow" value="1">Pokazuj w sekcji<br>

            <input type="checkbox" name="newsletter" value="1" >Posiada newsletter<br>
            <br>
            <a href="<?=base_url()?>/panel/pages_p" class="btn">Anuluj</a>

            <button class="btn btn-primary">Zapisz</button>
        </form>
        <script>
         var editor=CKEDITOR.replace( 'editor1' );
         CKFinder.setupCKEditor( editor );


         var button1 = document.getElementById( 'ckfinder-popup-1' );

         button1.onclick = function() {
            selectFileWithCKFinder( 'ckfinder-input-1' );
        };

        function selectFileWithCKFinder( elementId ) {
            CKFinder.modal( {
                chooseFiles: true,
                width: 800,
                height: 600,
                onInit: function( finder ) {
                    finder.on( 'files:choose', function( evt ) {
                        var file = evt.data.files.first();
                        var output = document.getElementById( elementId );
                        output.value = file.getUrl();
                    } );

                    finder.on( 'file:choose:resizedImage', function( evt ) {
                        var output = document.getElementById( elementId );
                        output.value = evt.data.resizedUrl;
                    } );
                }
            } );
        }
    </script>
</div>
</div>