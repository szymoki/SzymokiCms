<div class="module">
	<div class="module-head">
		<h3>
		Ustawienia szablonu</h3>
	</div>
	<div class="module-body">

		<?php if($alert==true):?>
		<?=validation_errors(); ?>
		<?php endif;?>
		<script  src="<?=base_url()?>/ckfinder/ckfinder.js"></script>
		<script  src="<?=base_url()?>/ckeditor/ckeditor.js"></script>

		<form class="form-control" method="post" action="<?=base_url()?>/panel/szablon/save">
			<h3>Treść startowa strony</h3>
			<textarea id="editor1" name="text_startup"><?=$zmienne->text_startup?></textarea>
			<br>
			<h3>Sekcja sponsorzy</h3>
			<textarea id="editor2" name="text_sponsorzy"><?=$zmienne->text_sponsorzy?></textarea>
			<h3>Licznik</h3>
			<label>Ilość lekcji:</label>
			<input class="form-control" type="number" name="licznik1" value="<?=$zmienne->licznik1?>" required>
			<label>Ilość uczniów:</label>
			<input class="form-control" type="number" name="licznik2" value="<?=$zmienne->licznik2?>" required>
			<label>Ilość nauczycieli:</label>
			<input class="form-control" type="number" name="licznik3" value="<?=$zmienne->licznik3?>" required>
			<label>Ilość uczestników olimpiad:</label>
			<input class="form-control" type="number" name="licznik4" value="<?=$zmienne->licznik4?>" required>
			<h3>Sekcje strony:</h3>
			<label>Licznik</label>
			<select name="licznik_on">
				<option <?=$zmienne->licznik_on==1 ? ' selected' :"" ?> value="1">ON</option>
				<option <?=$zmienne->licznik_on==0 ? ' selected' :"" ?> value="0">OFF</option>
			</select>
			<label>Byli uczniowie</label>
			<select name="uczniowie_on">
				<option <?=$zmienne->uczniowie_on==1 ? ' selected' :"" ?> value="1">ON</option>
				<option <?=$zmienne->uczniowie_on==0 ? ' selected' :"" ?> value="0">OFF</option>
			</select>
			<label>Boxy</label>
			<select name="boxy_on">
				<option <?=$zmienne->boxy_on==1 ? ' selected' :"" ?> value="1">ON</option>
				<option <?=$zmienne->boxy_on==0 ? ' selected' :"" ?> value="0">OFF</option>
			</select>



			<br>
			<a href="<?=base_url()?>/panel/szablon" class="btn">Anuluj</a>

			<button class="btn btn-primary">Zapisz</button>

			<h3>Edycja pięciokątów</h3>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Obrazek:</th>

						<th>Status:</th>
						<th>
						</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($pieciokaty as $id=>$item):?>
					<tr>
						<td><?=$id+1?></td>
						<td><?=$item->title?></td>
						<td><a href="<?=base_url()?>/panel/szablon/pieciokat_edit/<?=$id+1?>" class="btn btn-sm btn-primary">Edytuj</a>
						</td>
					</tr>
					<?php endforeach;?>
				</tbody>
			</table>
		</form>
		<script>
			var editor=CKEDITOR.replace( 'editor1' );
			CKFinder.setupCKEditor( editor );
			var editor2=CKEDITOR.replace( 'editor2' );
			CKFinder.setupCKEditor( editor2 );


			var button1 = document.getElementById( 'ckfinder-popup-1' );

			button1.onclick = function() {
				selectFileWithCKFinder( 'ckfinder-input-1' );
			};

			function selectFileWithCKFinder( elementId ) {
				CKFinder.modal( {
					chooseFiles: true,
					width: 800,
					height: 600,
					onInit: function( finder ) {
						finder.on( 'files:choose', function( evt ) {
							var file = evt.data.files.first();
							var output = document.getElementById( elementId );
							output.value = file.getUrl();
						} );

						finder.on( 'file:choose:resizedImage', function( evt ) {
							var output = document.getElementById( elementId );
							output.value = evt.data.resizedUrl;
						} );
					}
				} );
			}
		</script>



	</div>
</div>