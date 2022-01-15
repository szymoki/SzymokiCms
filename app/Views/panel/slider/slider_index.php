<div class="module">
	<div class="module-head">
		<h3>
		Slider</h3>
	</div>
	<div class="module-body">

		

		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Obrazek:</th>

					<th>Status:</th>
					<th><a href="<?=base_url()?>/panel/slider/add" class="btn btn-sm btn-success">Dodaj</a>
					</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($slider as $item):?>
				<tr>
					<td><?=$item->id?></td>
					<td><?=$item->image_path?></td>
					<td> <?=$item->active==1 ? 'Aktywny' :"Nieaktywny" ?></td>
					<td><a href="<?=base_url()?>/panel/slider/edit/<?=$item->id?>" class="btn btn-sm btn-primary">Edytuj</a>
						<a href="<?=base_url()?>/panel/slider/del/<?=$item->id?>" class="btn btn-sm btn-danger" onclick="return confirm('Czy napewno usunąć?')">Usuń</a>

					</td>
				</tr>
				<?php endforeach;?>
			</tbody>
		</table>

	</div>
</div>