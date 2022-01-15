<div class="module">
	<div class="module-head">
		<h3>
		Galeria - albumy</h3>
	</div>
	<div class="module-body">

		

		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Nazwa albumu:</th>
					<th>Folder:</th>
					<th>Status:</th>
					<th><a href="<?=base_url()?>/panel/gallery/add" class="btn btn-sm btn-success">Dodaj</a>
						<a href="<?=base_url()?>/panel/pliki" class="btn btn-sm btn-primary">Zdjęcia</a>
					</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($gallery as $key=>$item):?>
				<tr data-id="<?=$item->id?>">
					<td><?=$key+1?></td>
					<td><?=$item->title?></td>
					<td><?=$item->folder?></td>
					<td> <?=$item->published==1 ? 'Aktywny' :"Nieaktywny" ?></td>
					<td><a href="<?=base_url()?>/panel/gallery/edit/<?=$item->id?>" class="btn btn-sm btn-primary">Edytuj</a>
						<a href="<?=base_url()?>/panel/gallery/del/<?=$item->id?>" class="btn btn-sm btn-danger" onclick="return confirm('Czy napewno usunąć?')">Usuń</a>

					</td>
				</tr>
				<?php endforeach;?>
			</tbody>
		</table>

	</div>
</div>

<script type="text/javascript">
                window.onload=function(){
                  $("tbody").sortable({

                    update: function(event, ui) { 
                        var list=[];
                        $("tbody tr").each(function() {
                            list.push($(this).attr("data-id"));
                        });
                        console.log(list);

                        $.post( "<?=base_url("panel/gallery/setposition")?>",{"positions":list})
                        .done(function( data ) {
                        //alert( "Data Loaded: " + data );
                    });
                    }
                });
              };
</script>