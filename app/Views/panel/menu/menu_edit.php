<div class="module">
	<div class="module-head">
		<h3>
		Menu</h3>
	</div>
	<div class="module-body">

		<h3>Edytuj pozycję menu</h3>
		<?php if($alert==true):?>
		<?=validation_errors(); ?>
		<?php endif;?>
		<form class="form-control" method="post" action="<?=base_url()?>/panel/menu/editu">
			<input type="hidden" name="id" value="<?=$element->id?>">

			<label>Nazwa:</label>
			<input class="form-control" type="text" name="name" value="<?=$element->name?>" required>
			<label>Url:</label>
			<input class="form-control" type="text" name="url"  value="<?=$element->url?>" required>

			<label>Pozycja:</label>
			<input class="form-control" type="number" name="pozycja"  value="<?=$element->pozycja?>" required>

			<label>Podmenu:</label>
			<select class="form-control" name="parent_id">
				<option value="0" <?=$element->parent_id==0 ? "selected" :"" ?>>Brak</option>
				<?php foreach($menu as $item):?>
				<?php if($item->parent_id==0):?>
				<option value="<?=$item->id?>" <?=$element->parent_id==$item->id ? "selected" :"" ?>><?=$item->name?></option>
				<?php endif;?>
				<?php endforeach;?>
			</select>

			<label>Aktywny:</label>
			<select class="form-control" name="active">
				<option value="1" <?=$element->active==1 ? "selected" :"" ?>>Tak</option>
				<option value="0" <?=$element->active==0 ? "selected" :"" ?>>Nie</option>
			</select><Br>
			<a href="<?=base_url()?>/panel/menu" class="btn">Anuluj</a>
			<button class="btn btn-primary">Zapisz</button>
		</form>


	</div>
</div>