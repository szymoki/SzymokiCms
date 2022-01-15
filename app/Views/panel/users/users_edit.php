<div class="module">
	<div class="module-head">
		<h3>
		Użytkownicy</h3>
	</div>
	<div class="module-body">

		<h3>Edytuj użytkownika</h3>
    <p><?= $validation->listErrors() ?></p>
    
		<form class="form-control" method="post" action="<?=base_url()?>/panel/users/editu">
			<input type="hidden" name="id" value="<?=$user->id?>">
			<label>Nazwa użytkownika:</label>
			<input class="form-control" type="text" name="nick" value="<?=$user->nick?>" required>
			<label>Imię i nazwisko:</label>
			<input class="form-control" type="text" name="name" value="<?=$user->name?>" required>
			<label>E-mail:</label>
			<input class="form-control" type="email" name="email" value="<?=$user->email?>" required>

			<label>Hasło:</label>
			<input class="form-control" type="password" name="password" value="" >
			<label>Powtórz hasło:</label>
			<input class="form-control" type="password" name="password2" value="" >
			<label>Ranga:</label>
			<select class="form-control" name="level">
				<option value="1" <?=$user->level==1 ? "selected":""?> >Użytkownik</option>
				<option value="0" <?=$user->level==0 ? "selected":""?> >Adminstrator</option>
			</select><Br>


			<label>Uprawnienia:</label>
			<?php foreach($acl_items as $key=>$item):?>
			<p style="margin-left: 10px;"><input  type="checkbox" name="acl[]" value="<?=$key?>" <?=acl_user($key,$user->id)==true ? "checked" :"" ?> ><?=$item?></p>
			<?php endforeach;?>

			<label>Dostępne podstrony:</label>
			<?php foreach($acl__pages_items as $item):?>
			<p style="margin-left: 10px;"><input  type="checkbox" name="pages[]" value="<?=$item->id?>" <?=acl_user("p0_".$item->id,$user->id)==true ? "checked" :"" ?>><?=$item->title?></p>
			<?php endforeach;?>


			<label>Dostępne strony przedmiotowe:</label>
			<?php foreach($acl__pages_p_items as $item):?>
			<p style="margin-left: 10px;"><input  type="checkbox" name="pages_p[]" value="<?=$item->id?>" <?=acl_user("p_".$item->id,$user->id)==true ? "checked" :"" ?>><?=$item->title?></p>
			<?php endforeach;?>

			<a href="<?=base_url()?>/panel/users" class="btn">Anuluj</a>
			<button class="btn btn-primary">Zapisz</button>
		</form>
	</div>
</div>