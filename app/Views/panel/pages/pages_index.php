<div class="module">
	<div class="module-head">
		<h3>
		Podstrony</h3>
	</div>
	<div class="module-body">
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Tytuł:</th>
					<th>Data edycji:</th>
					<th>Edytowany przez:</th>
					<th>Status:</th>
					<th><a href="<?=base_url()?>/panel/pages/add" class="btn btn-sm btn-success">Dodaj</a>
					</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($pages as $item):?>
				<?php if($item->parent_id==0):?>
					<?php if(acl("pages") or acl("p0_".$item->id)):?>
				<tr style="background-color: #dbdbdb">
					<td><a onclick='$(".child<?=$item->id?>").toggle()'>-</a>

						<span class="glyphicon glyphicon-chevron-down"></span>

					</td>
					<td><?=$item->title?></td>
					<td><?=$item->edited_date?></td>
					<td><?=get_user_name($item->edited_by)?></td>
					<td> <a href="<?=base_url()?>/<?=generate_page_url2($item)?>"><?=$item->published==1 ? 'Opublikowana' :"" ?></a></td>
					<td><a href="<?=base_url()?>/panel/pages/edit/<?=$item->id?>" class="btn btn-sm btn-primary">Edytuj</a>
						<?php if(acl("pages")):?><a href="<?=base_url()?>/panel/pages/del/<?=$item->id?>" class="btn btn-sm btn-danger" onclick="return confirm('Czy napewno usunąć?')">Usuń</a><?php endif;?>

					</td>
				</tr>

				<?php foreach($pages as $item2):?>
				<?php if($item2->parent_id!=0 and $item->id==$item2->parent_id):?>
				<tr class="child<?=$item2->parent_id?>" style="background-color: whitesmoke;">
					<td style="background: linear-gradient(90deg, white 50%, whitesmoke 50%);"><a onclick='$(".child2<?=$item2->id?>").toggle()'>--</a>
					</td>
					<td><?=$item2->title?></td>
					<td><?=$item2->edited_date?></td>
					<td><?=get_user_name($item2->edited_by)?></td>
					<td>  <a href="<?=base_url()?>/<?=generate_page_url2($item2)?>"><?=$item2->published==1 ? 'Opublikowana' :"" ?></a></td>
					<td><a href="<?=base_url()?>/panel/pages/edit/<?=$item2->id?>" class="btn btn-sm btn-primary">Edytuj</a>
						<a href="<?=base_url()?>/panel/pages/del/<?=$item2->id?>" class="btn btn-sm btn-danger" onclick="return confirm('Czy napewno usunąć?')">Usuń</a>

					</td>
				</tr>


				<?php foreach($pages as $item3):?>
				<?php if($item3->parent_id!=0 and $item2->id==$item3->parent_id):?>
				<tr class=" child<?=$item2->parent_id?> child2<?=$item3->parent_id?>" style="background-color: #fafafa;">
					<td style="background-color: white;">---</td>
					<td><?=$item3->title?></td>
					<td><?=$item3->edited_date?></td>
					<td><?=get_user_name($item3->edited_by)?></td>
					<td>  <a href="<?=base_url()?>/<?=generate_page_url2($item3)?>"><?=$item3->published==1 ? 'Opublikowana' :"" ?></a></td>
					<td><a href="<?=base_url()?>/panel/pages/edit/<?=$item3->id?>" class="btn btn-sm btn-primary">Edytuj</a>
						<a href="<?=base_url()?>/panel/pages/del/<?=$item3->id?>" class="btn btn-sm btn-danger" onclick="return confirm('Czy napewno usunąć?')">Usuń</a>

					</td>
				</tr>
				<?php endif;?>
				<?php endforeach;?>

				<?php endif;?>
				<?php endforeach;?>
				<?php endif;?>
				<?php endif;?>
				<?php endforeach;?>
			</tbody>
		</table>

	</div>
</div>