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

        <form class="form-control" method="post" action="<?=base_url()?>/panel/pages_p/editu">
            <input type="hidden" name="id" value="<?=$pages_p->id?>">
            <label>Tytuł:</label>
            <input class="form-control" type="text" name="title" value="<?=$pages_p->title?>" required>
            <label>Treść:</label>
            <textarea name="text" id="editor1" rows="10" cols="80">
            	<?=$pages_p->text?>
            </textarea>
             <?php if($pages_p->parent_id==0):?>
           <label>Ścieżka obrazka:</label>
         <input class="form-control" id="ckfinder-input-1" type="text" name="img"  value="<?=$pages_p->img?>" >
         <a href="#" id="ckfinder-popup-1" class="btn btn-primary">Wybierz z serwera</a>
         <?php endif;?>
            <label>Podstrona do:</label>
            <select name="parent_id" class="form-control">
             <?php if($pages_p->parent_id ==0):?>  <option value="0" >brak</option><?php endif;?>

             <?php foreach($pages_p_all as $item):?>
             <?php if(acl("pages_p") or acl("p_".$item->id)):?>

             <?php if($item->parent_id==0 and $pages_p->id!=$item->id):?>
             <option value="<?=$item->id?>" <?=$item->id==$pages_p->parent_id ? ' selected' :"" ?>><?=$item->title?></option>

             <?php foreach($pages_p_all as $item2):?>
             <?php if($item2->parent_id==$item->id):?>
             <?php if($pages_p->id!=$item2->id):?>
             <option value="<?=$item2->id?>" <?=$item2->id==$pages_p->parent_id ? ' selected' :"" ?>>--<?=$item2->title?></option>
             <?php endif; ?><?php endif; ?>
             <?php endforeach;?>
             <?php endif; ?>

             <?php endif; ?>
             <?php endforeach;?>
         </select>
         <label>Seolink:</label>
         <input class="form-control" type="text" name="symlink" value="<?=$pages_p->symlink?>" >

         <br>
         <input type="checkbox" name="published" value="1" <?=$pages_p->published==1 ? ' checked' :"" ?>>Opublikowany<br>
         <?php if($pages_p->parent_id==0):?>
         <br>
         <input type="checkbox" name="menushow" value="1" <?=$pages_p->menushow==1 ? ' checked' :"" ?>>Pokazuj w sekcji<br>
         <?php endif;?>
         <br>
         <?php if($pages_p->parent_id==0):?>
         <input type="checkbox" name="newsletter" value="1" <?=$pages_p->newsletter==1 ? ' checked' :"" ?>>Posiada newsletter<br>
         <?php endif;?>
         <br>
         <div class="podstrona">
            <label>Menu podstrony:</label>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nazwa:</th>
                        <th>Typ:</th>
                      <?php if(acl("pages_p")):?>  <th><a href="<?=base_url()?>/panel/pages_p/menu_add/<?=$pages_p->id?>" class="btn btn-sm btn-success">Dodaj</a><?php endif;?>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($links as $key=>$item):?>
                    <tr data-id="<?=$item->id?>" >
                        <td><?=$key+1?></td>
                        <td><?=$item->title?></td>
                        <td><?=$item->page_id==0 ? "Odnośnik" : "Podstrona"?></td>
                        <td><a href="<?=base_url()?>/panel/pages_p/menu_edit/<?=$item->id?>" class="btn btn-sm btn-primary">Edytuj</a>
                            <a href="<?=base_url()?>/panel/pages_p/menu_del/<?=$item->id?>" class="btn btn-sm btn-danger" onclick="return confirm('Czy napewno usunąć?')">Usuń</a></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
            <br>
            <a href="<?=base_url()?>/panel/pages_p" class="btn">Anuluj</a>

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

                $.post( "<?=base_url("panel/pages_p/setposition")?>",{"positions":list})
                .done(function( data ) {
                        //alert( "Data Loaded: " + data );
                    });
            }
        });
      };

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