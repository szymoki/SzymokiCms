<div class="module">
	<div class="module-head">
		<h3>
		Strony przedmiotowe</h3>
	</div>
	<div class="module-body">
		<button  class="btn btn-sm btn-success onlymain">Pokaż tylko strony główne</button>
		<button  class="btn btn-sm btn-success onlyall" style="display: none;">Pokaż wszystko</button>



		<table class="table tableall"> 
			<thead>
				<tr>
					<th>#</th>
					<th>Tytuł:</th>
					<th>Data edycji:</th>
					<th>Edytowany przez:</th>
					<th>Status:</th>
					<th><a href="<?=base_url()?>/panel/pages_p/add" class="btn btn-sm btn-success">Dodaj</a>
					</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($pages_p as $item):?>
				<?php if($item->parent_id==0):?>
				<?php if(acl("pages_p") or acl("p_".$item->id)):?>

				<tr style="border-top: 2px solid grey;background-color: #dbdbdb">
					<td style="border-left: 2px solid grey"><a onclick='$(".child<?=$item->id?>").toggle()'>-</a>

						<span class="glyphicon glyphicon-chevron-down"></span>

					</td>
					<td style=""><?=$item->title?></td>
					<td><?=$item->edited_date?></td>
					<td><?=get_user_name($item->edited_by)?></td>
					<td> <?=$item->published==1 ? 'Opublikowana' :"" ?></td>
					<td><a href="<?=base_url()?>/panel/pages_p/edit/<?=$item->id?>" class="btn btn-sm btn-primary">Edytuj</a>
						<?php if(acl("pages_p")):?><a href="<?=base_url()?>/panel/pages_p/del/<?=$item->id?>" class="btn btn-sm btn-danger" onclick="return confirm('Czy napewno usunąć?')">Usuń</a><?php endif;?>

					</td>
				</tr>

				<?php foreach($pages_p as $item2):?>
				<?php if($item2->parent_id!=0 and $item->id==$item2->parent_id):?>
				<tr class="child<?=$item2->parent_id?>" style="background-color: whitesmoke;">
						<td style="border-left: 2px solid grey; background: linear-gradient(90deg, white 50%, whitesmoke 50%);"><a onclick='$(".child2<?=$item2->id?>").toggle()'>--</a>
					</td>
					<td><?=$item2->title?></td>
					<td><?=$item2->edited_date?></td>
					<td><?=get_user_name($item2->edited_by)?></td>
					<td> <?=$item2->published==1 ? 'Opublikowana' :"" ?></td>
					<td><a href="<?=base_url()?>/panel/pages_p/edit/<?=$item2->id?>" class="btn btn-sm btn-primary">Edytuj</a>
						<a href="<?=base_url()?>/panel/pages_p/del/<?=$item2->id?>" class="btn btn-sm btn-danger" onclick="return confirm('Czy napewno usunąć?')">Usuń</a>

					</td>
				</tr>


				<?php foreach($pages_p as $item3):?>
				<?php if($item3->parent_id!=0 and $item2->id==$item3->parent_id):?>
				<tr class=" child<?=$item2->parent_id?> child2<?=$item3->parent_id?>" style="background-color: #fafafa;">
					<td style="border-left: 2px solid grey;background-color: white;">---</td>
					<td><?=$item3->title?></td>
					<td><?=$item3->edited_date?></td>
					<td><?=get_user_name($item3->edited_by)?></td>
					<td> <?=$item3->published==1 ? 'Opublikowana' :"" ?></td>
					<td><a href="<?=base_url()?>/panel/pages_p/edit/<?=$item3->id?>" class="btn btn-sm btn-primary">Edytuj</a>
						<a href="<?=base_url()?>/panel/pages_p/del/<?=$item3->id?>" class="btn btn-sm btn-danger" onclick="return confirm('Czy napewno usunąć?')">Usuń</a>

					</td>
				</tr>
				<?php endif;?>
				<?php endforeach;?>

				<?php endif;?>
				<?php endforeach;?>

				<?php endif;//aclcheck end?>
				<?php endif;?>
				<?php endforeach;?>
			</tbody>
		</table>


		<table class="table tablemain" style="display: none;"> 
			<thead>
				<tr>
					<th>#</th>
					<th>Tytuł:</th>
					<th>Data edycji:</th>
					<th>Edytowany przez:</th>
					<th>Status:</th>
					<th><a href="<?=base_url()?>/panel/pages_p/add" class="btn btn-sm btn-success">Dodaj</a>
					</th>
				</tr>
			</thead>
			<tbody class="mainbody">
				<?php foreach($pages_p_main as $item):?>
				<?php if($item->parent_id==0):?>
				<?php if(acl("p_".$item->id)):?>
				<tr data-id="<?=$item->id?>">
					<td><a onclick='$(".child<?=$item->id?>").toggle()'>-</a>

						<span class="glyphicon glyphicon-chevron-down"></span>

					</td>
					<td><?=$item->title?></td>
					<td><?=$item->edited_date?></td>
					<td><?=get_user_name($item->edited_by)?></td>
					<td> <?=$item->published==1 ? 'Opublikowana' :"" ?></td>
					<td><a href="<?=base_url()?>/panel/pages_p/edit/<?=$item->id?>" class="btn btn-sm btn-primary">Edytuj</a>
							<?php if(acl("pages_p")):?><a href="<?=base_url()?>/panel/pages_p/del/<?=$item->id?>" class="btn btn-sm btn-danger" onclick="return confirm('Czy napewno usunąć?')">Usuń</a><?php endif;?>

					</td>
				</tr>
				<?php endif;?>			<?php endif;?>

				<?php endforeach;?>
			</tbody></table>
		</div>
	</div>

	<script type="text/javascript">
		window.onload=function(){
			
			<?php if(acl("pages")):?> 
			$(".mainbody").sortable({
				
				update: function(event, ui) { 
					var list=[];
					$(".mainbody tr").each(function() {
						list.push($(this).attr("data-id"));
					});
					console.log(list);

					$.post( "<?=base_url("panel/pages_p/setposition_pages")?>",{"positions":list})
					.done(function( data ) {
                        //alert( "Data Loaded: " + data );
                    });
				}
			});
			<?php endif;?>
			$(".onlymain").click(function(){
				$(".tableall").toggle();
				$(".onlymain").toggle();
				$(".onlyall").toggle();
				$(".tablemain").toggle();
			});
			$(".onlyall").click(function(){
				$(".tableall").toggle();
				$(".onlymain").toggle();
				$(".onlyall").toggle();
				$(".tablemain").toggle();
			});


		};
	</script>