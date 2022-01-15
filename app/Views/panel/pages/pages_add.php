<div class="module">
	<div class="module-head">
		<h3>
		Podstrony</h3>
	</div>
	<div class="module-body">
        <h3>Dodaj podstronę</h3>
        <?php if($alert==true):?>
        <?=validation_errors(); ?>
        <?php endif;?>
        <script  src="<?=base_url()?>/ckfinder/ckfinder.js"></script>
        <script  src="<?=base_url()?>/ckeditor/ckeditor.js"></script>

        <form class="form-control" method="post" action="<?=base_url()?>/panel/pages/addu">

            <label>Tytuł:</label>
            <input class="form-control" type="text" name="title" required>
            <label>Treść:</label>
            <textarea name="text" id="editor1" rows="10" cols="80">
            </textarea>

            <label>Podstrona do:</label>
            <select name="parent_id" class="form-control">
                <?php if(acl("pages")):?>  <option value="0">brak</option><?php endif;?>
             <?php foreach($pages as $item):?>
             <?php if($item->parent_id==0):?>
              <?php if(acl("pages") or acl("p0_".$item->id)):?>
             <option value="<?=$item->id?>"><?=$item->title?></option>
             <?php foreach($pages as $item2):?>
             <?php if($item2->parent_id==$item->id):?>
             <option value="<?=$item2->id?>">--<?=$item2->title?></option>
             <?php endif; ?>
             <?php endforeach;?>
             <?php endif; ?>
             <?php endif; ?>
             <?php endforeach;?>
         </select>
         <label>Seolink:</label>
         <input class="form-control" type="text" name="symlink" >
         <br>
         <input type="checkbox" name="published" value="1" checked>Opublikowany<br>
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