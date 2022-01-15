<div class="module">
	<div class="module-head">
		<h3>
		Menu</h3>
	</div>
	<div class="module-body">
		<button  class="btn btn-sm btn-success onlymain">Pokaż tylko menu główne</button>
		<button  class="btn btn-sm btn-success onlyall" style="display: none;">Pokaż całe menu</button>

		<table class="table tableall">
			<thead>
				<tr>
					<th>#</th>
					<th>Nazwa:</th>
					<th>URL:</th>
					<th>Aktywny:</th>
					<th><a href="<?=base_url()?>/panel/menu/add" class="btn btn-sm btn-success">Dodaj</a>
					</th>
				</tr>
			</thead>
			<?php foreach($menu as $item):?>
			<?php if($item->parent_id==0):?>
			<tr>
				<td>-</td>
				<td><?=$item->name?></td>
				<td><?=$item->url?></td>
				<td><?=($item->active==0 ? "Nie" : "Tak")?></td></td>

				<td><a href="<?=base_url()?>/panel/menu/edit/<?=$item->id?>" class="btn btn-sm btn-primary">Edytuj</a>
					<a href="<?=base_url()?>/panel/menu/del/<?=$item->id?>" class="btn btn-sm btn-danger" onclick="return confirm('Czy napewno usunąć?')">Usuń</a>

				</td>
			</tr>
			<tbody data-id="<?=$item->id?>">
				<?php foreach($menu as $item2):?>
				<?php if($item2->parent_id!=0 and $item->id==$item2->parent_id):?>
				<tr data-id="<?=$item2->id?>" style="background-color: whitesmoke;">
					<td>--</td>
					<td><?=$item2->name?></td>
					<td><?=$item2->url?></td>
					<td><?=($item2->active==0 ? "Nie" : "Tak")?></td></td>

					<td><a href="<?=base_url()?>/panel/menu/edit/<?=$item2->id?>" class="btn btn-sm btn-primary">Edytuj</a>
						<a href="<?=base_url()?>/panel/menu/del/<?=$item2->id?>" class="btn btn-sm btn-danger" onclick="return confirm('Czy napewno usunąć?')">Usuń</a>

					</td>
				</tr>
				<?php endif;?>
				<?php endforeach;?>
			</tbody>
			<?php endif;?>
			<?php endforeach;?>
		</table>


		<table class="table tablemain" style="display: none;">
			<thead>
				<tr>
					<th>#</th>
					<th>Nazwa:</th>
					<th>URL:</th>
					<th>Aktywny:</th>
					<th><a href="/panel/menu/add" class="btn btn-sm btn-success">Dodaj</a>
					</th>
				</tr>
			</thead>
			<tbody data-id="0">
				<?php foreach($menu as $item):?>
				<?php if($item->parent_id==0):?>
				<tr data-id="<?=$item->id?>">
					<td>-</td>
					<td><?=$item->name?></td>
					<td><?=$item->url?></td>
					<td><?=($item->active==0 ? "Nie" : "Tak")?></td></td>

					<td><a href="<?=base_url()?>/panel/menu/edit/<?=$item->id?>" class="btn btn-sm btn-primary">Edytuj</a>
						<a href="<?=base_url()?>/panel/menu/del/<?=$item->id?>" class="btn btn-sm btn-danger" onclick="return confirm('Czy napewno usunąć?')">Usuń</a>

					</td>
				</tr>
				<?php endif;?>
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
				$("tbody[data-id="+$(event.target).attr("data-id")+"] tr").each(function() {
					list.push($(this).attr("data-id"));
				});
				console.log(list);

				$.post( "<?=base_url("panel/menu/setposition")?>",{"positions":list})
				.done(function( data ) {
                        //alert( "Data Loaded: " + data );
                    });
			}
		});

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