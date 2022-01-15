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

        <form class="form-control" method="post" action="<?=base_url()?>/panel/pages/editu_menu">
            <input type="hidden" name="id" value="<?=$id?>">
            <input type="hidden" name="parent_id" value="<?=$link->parent_id?>">

            <label>Tytuł:</label>
            <input class="form-control" type="text" name="title" value="<?=$link->title?>" required>

            <label>Do podstrony:</label>
            <select name="page_id" class="form-control">
                <option value="0">Własny adres URL</option>
                <?php foreach($pages_all as $item):?>
                <?php if($item->parent_id==0):?>
                <option value="<?=$item->id?>" <?=$item->id==$link->page_id ? ' selected' :"" ?>><?=$item->title?></option>

                <?php foreach($pages_all as $item2):?>
                <?php if($item2->parent_id==$item->id):?>
                <option value="<?=$item2->id?>" <?=$item2->id==$link->page_id ? ' selected' :"" ?>>--<?=$item2->title?></option>
                <?php foreach($pages_all as $item3):?>
                <?php if($item3->parent_id==$item2->id):?>
                <option value="<?=$item3->id?>" <?=$item3->id==$link->page_id ? ' selected' :"" ?>>--<?=$item3->title?></option>
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
            <input class="form-control" type="text" name="url" value="<?=$link->url?>">
            <label>Pozycja:</label>
            <input class="form-control" type="text" name="position" value="<?=$link->position?>" >
            <br>
            <br>
            <br>
            <a href="<?=base_url()?>/panel/pages/edit/<?=$parent_id?>" class="btn">Anuluj</a>

            <button class="btn btn-primary">Zapisz</button>
        </form>
        <script>
            var editor=CKEDITOR.replace( 'editor1' );
            CKFinder.setupCKEditor( editor );
        </script>
    </div>
</div>