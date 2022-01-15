<div class="module">
	<div class="module-head">
		<h3>
		Użytkownicy</h3>
	</div>
	<div class="module-body">
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Imię i nazwisko:</th>
					<th>Nazwa użytkownika:</th>
					<th>Ostatnie logowanie</th>
					<th>Ostatnie IP</th>
					<th>Level</th>
					<th><a href="<?=base_url()?>/panel/users/add" class="btn btn-sm btn-success">Dodaj</a>
					</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($users as $key=>$item):?>
				<tr>
					<td><?=$key+1?></td>
					<td><?=$item->name?></td>
					<td><?=$item->nick?></td>
					<td><?=$item->last_login?></td>
					<td><?=$item->last_ip?></td>
					<td><?=($item->level==0 ? "Administrator" : "Użytkownik")?></td>
					<td><a href="<?=base_url()?>/panel/users/edit/<?=$item->id?>" class="btn btn-sm btn-primary">Edytuj</a>
						<a href="<?=base_url()?>/panel/users/delete/<?=$item->id?>" class="btn btn-sm btn-danger" onclick="return confirm('Czy napewno usunąć?')">Usuń</a>

					</td>
				</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</div>
</div>