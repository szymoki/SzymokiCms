<div class="module">
	<div class="module-head">
		<h3>
		Podstrony - menu</h3>
	</div>
	<div class="module-body">
        <h3>Dodaj element menu do podstrony</h3>
        <?php if($alert==true):?>
        <?=validation_errors(); ?>
        <?php endif;?>
        <script  src="<?=base_url()?>/ckfinder/ckfinder.js"></script>
        <script  src="<?=base_url()?>/ckeditor/ckeditor.js"></script>

        <form class="form-control" method="post" action="<?=base_url()?>/panel/pages/addu_menu">
            <input type="hidden" name="id" value="<?=$parent_id?>">
            
            <label>Tytuł:</label>
            <input class="form-control" type="text" name="title" required>

            <label>Do podstrony:</label>
            <select name="page_id" class="form-control">
                <option value="0">Własny URL</option>
                <?php foreach($pages as $item):?>
                <?php if($item->parent_id==0):?>
                <option value="<?=$item->id?>"><?=$item->title?></option>
                <?php foreach($pages as $item2):?>
                <?php if($item2->parent_id==$item->id):?>
                <option value="<?=$item2->id?>">--<?=$item2->title?></option>
                <?php foreach($pages as $item3):?>
                <?php if($item3->parent_id==$item2->id):?>
                <option value="<?=$item3->id?>">----<?=$item3->title?></option>
                <?php endif; ?>
                <?php endforeach;?>
                <?php endif; ?>

                <?php endforeach;?>
                <?php endif; ?>
                <?php endforeach;?>
            </select>
            <br>
            lub
            <br>
            <label>URL:</label>
            <input class="form-control" type="text" name="url" value="">
            <label>Pozycja:</label>
            <input class="form-control" type="text" name="position" value="" >
            <br>
            <br>
            <br>
            <a href="<?=base_url()?>/panel/pages" class="btn">Anuluj</a>

            <button class="btn btn-primary">Zapisz</button>
        </form>
        <script>
            var editor=CKEDITOR.replace( 'editor1' );
            CKFinder.setupCKEditor( editor );
        </script>
    </div>
</div>