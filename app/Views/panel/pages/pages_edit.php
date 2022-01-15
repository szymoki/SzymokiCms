<div class="module">
	<div class="module-head">
		<h3>
		Podstrony</h3>
	</div>
	<div class="module-body">
        <h3>Edytuj podstronę</h3>
        <?php if($alert==true):?>
        <?=validation_errors(); ?>
        <?php endif;?>
        <script  src="<?=base_url()?>/ckfinder/ckfinder.js"></script>
        <script  src="<?=base_url()?>/ckeditor/ckeditor.js"></script>

        <form class="form-control" method="post" action="<?=base_url()?>/panel/pages/editu">
            <input type="hidden" name="id" value="<?=$pages->id?>">
            <label>Tytuł:</label>
            <input class="form-control" type="text" name="title" value="<?=$pages->title?>" required>
            <label>Treść:</label>
            <textarea name="text" id="editor1" rows="10" cols="80">
            	<?=$pages->text?>
            </textarea>
            <label>Podstrona do:</label>
            <select name="parent_id" class="form-control">
                <?php if(acl("pages") or $pages->parent_id==0):?>
                <option value="0">brak</option>
                <?php endif;?>
                <?php foreach($pages_all as $item):?>
                <?php if($item->parent_id==0):?>
                <?php if(acl("pages") or acl("p0_".$item->id)):?>
                <option value="<?=$item->id?>" <?=$item->id==$pages->parent_id ? ' selected' :"" ?> <?=$item->id==$pages->id ? ' disabled' :"" ?>><?=$item->title?></option>

                <?php foreach($pages_all as $item2):?>
                <?php if($item2->parent_id==$item->id):?>
                <option value="<?=$item2->id?>" <?=$item2->id==$pages->parent_id ? ' selected' :"" ?> <?=$item->id?>" <?=$item2->id==$pages->id ? ' disabled' :"" ?> <?=$item->id==$pages->id ? ' disabled' :"" ?>>--<?=$item2->title?></option>
                <?php endif; ?>
                <?php endforeach;?>

                <?php endif; ?>
                <?php endif; ?>
                <?php endforeach;?>
            </select>
            <label>Seolink:</label>
            <input class="form-control" type="text" name="symlink" value="<?=$pages->symlink?>">

            <br>
            <input type="checkbox" name="published" value="1" <?=$pages->published==1 ? ' checked' :"" ?>>Opublikowany<br>
            <br>
            <div class="podstrona">
                <label>Menu podstrony:</label>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nazwa:</th>
                            <th>Typ:</th>
                            <th><a href="<?=base_url()?>/panel/pages/menu_add/<?=$pages->id?>" class="btn btn-sm btn-success">Dodaj</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($links as $key=>$item):?>
                        <tr data-id="<?=$item->id?>">
                            <td><?=$key+1?></td>
                            <td><?=$item->title?></td>
                            <td><?=$item->page_id==0 ? "Odnośnik" : "Podstrona"?></td>
                            <td><a href="<?=base_url()?>/panel/pages/menu_edit/<?=$item->id?>" class="btn btn-sm btn-primary">Edytuj</a>
                                <a href="<?=base_url()?>/panel/pages/menu_del/<?=$item->id?>" class="btn btn-sm btn-danger" onclick="return confirm('Czy napewno usunąć?')">Usuń</a></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <br>
                <a href="<?=base_url()?>/panel/pages" class="btn">Anuluj</a>

                <button class="btn btn-primary">Zapisz</button>
            </form>
            <script>
                window.onload=function(){
                  $("tbody").sortable({

                    update: function(event, ui) { 
                        var list=[];
                        $("tbody tr").each(function() {
                            list.push($(this).attr("data-id"));
                        });
                        console.log(list);

                        $.post( "<?=base_url("panel/pages/setposition")?>",{"positions":list})
                        .done(function( data ) {
                        //alert( "Data Loaded: " + data );
                    });
                    }
                });
              };
              var editor=CKEDITOR.replace( 'editor1' );
              CKFinder.setupCKEditor( editor );

          </script>
      </div>
  </div>