<div class="module">
	<div class="module-head">
		<h3>
		Newsletter</h3>
	</div>
	<div class="module-body">
		Sortuj po kategorii: <select class="categories">
			<option value="-">Wszystkie</option>
			<?php foreach($categories as $key=>$item):?>
			<option value="<?=$key?>" <?=$cat==$key ? "selected":""?>><?=$item?></option>
			<?php endforeach;?>
		</select>
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Tytuł:</th>
					<th>Data dodania:</th>
					<th>Data edycji:</th>
					<th>Kategoria:</th>
					<th>Edytowany przez:</th>
					<th>Status:</th>
					<th><a href="<?=base_url()?>/panel/news/add" class="btn btn-sm btn-success">Dodaj</a>
					</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($news as $item):?>
				<?php if(acl("p_".($item->category/100)) or acl("news")):?>
				<tr>
					<td><?=$item->id?></td>
					<td><?=$item->title?></td>
					<td><?=$item->create_date?></td>
					<td><?=$item->edited_date?></td>
					<td><?=$categories[$item->category]?></td>
					<td><?=get_user_name($item->edited_by)?></td>
					<td> <?=$item->published==1 ? 'Opublikowany' :"" ?></td>
					<td><a href="<?=base_url()?>/panel/news/edit/<?=$item->id?>" class="btn btn-sm btn-primary">Edytuj</a>
						<a href="<?=base_url()?>/panel/news/del/<?=$item->id?>" class="btn btn-sm btn-danger" onclick="return confirm('Czy napewno usunąć?')">Usuń</a>

					</td>
				</tr>
				<?php endif;?>
				<?php endforeach;?>
			</tbody>
		</table>
                <p><?= $pager->simpleLinks() ?></p>


	</div>
</div>

<script>
	window.onload=function(){
		$(".categories").change(function(){
			if($(".categories").val()=="-"){
				window.location.replace("<?=base_url("panel/news")?>");
			}else{
				window.location.replace("<?=base_url("panel/news/category/")?>/"+$(".categories").val());
			}
		});
	};

</script>