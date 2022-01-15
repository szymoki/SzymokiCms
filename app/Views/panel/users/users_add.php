<div class="module">
	<div class="module-head">
		<h3>
		Użytkownicy</h3>
	</div>
	<div class="module-body">
    <p><?= $validation->listErrors() ?></p>

		<h3>Dodaj użytkownika</h3>

		<form class="form-control" method="post" action="<?=base_url()?>/panel/users/addu">
			<label>Nazwa użytkownika:</label>
			<input class="form-control" type="text" name="nick" required>
			<label>Imię i nazwisko:</label>
			<input class="form-control" type="text" name="name" required>
			<label>E-mail:</label>
			<input class="form-control" type="email" name="email" required>

			<label>Hasło:</label>
			<input class="form-control" type="password" name="password" placeholder="Minimum 6 znaków" required>
			<label>Powtórz hasło:</label>
			<input class="form-control" type="password" name="password2" required>
			<label>Ranga:</label>
			<select class="form-control" name="level">
				<option value="1">Użytkownik</option>
				<option value="0">Adminstrator</option>
			</select><Br>

			<label>Uprawnienia:</label>
			<?php foreach($acl_items as $key=>$item):?>
			<p style="margin-left: 10px;"><input  type="checkbox" name="acl[]" value="<?=$key?>" ><?=$item?></p>
			<?php endforeach;?>
			<label>Dostępne podstrony:</label>
			<?php foreach($acl__pages_items as $item):?>
			<p style="margin-left: 10px;"><input  type="checkbox" name="pages[]" value="<?=$item->id?>"><?=$item->title?></p>
			<?php endforeach;?>
			<label>Dostępne strony przedmiotowe:</label>
			<?php foreach($acl__pages_p_items as $item):?>
			<p style="margin-left: 10px;"><input  type="checkbox" name="pages_p[]" value="<?=$item->id?>"><?=$item->title?></p>
			<?php endforeach;?>

			<a href="<?=base_url()?>/panel/users" class="btn">Anuluj</a>

			<button class="btn btn-primary">Dodaj</button>
		</form>


	</div>
</div>