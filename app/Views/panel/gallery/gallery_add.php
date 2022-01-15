<div class="module">
    <script src="/ckfinder/ckfinder.js"></script>
    <div class="module-head">
      <h3>
      Galeria</h3>
  </div>
  <div class="module-body">
    <h3>Dodaj nowy album</h3>
    <?php if($alert==true):?>
    <?=validation_errors(); ?>
    <?php endif;?>
    <script  src="<?=base_url()?>/ckfinder/ckfinder.js"></script>
    <script  src="<?=base_url()?>/ckeditor/ckeditor.js"></script>

    <form class="form-control" method="post" action="<?=base_url()?>/panel/gallery/addu">


        <label>Tytuł albumu :</label>
        <input class="form-control" type="text" name="title" required>
        <label>Krótki opis:</label>
        <textarea class="form-control" type="text" name="text"  ></textarea>

        
        <br>
        <input type="checkbox" name="published" value="1" checked>Opublikowany<br>
        <label>Katalog ze zdjęciami:</label>
        <select name="folder">
            <option value="new">Utwórz nowy</option>
            <?php foreach($foldery as $item):?>
            <option><?=$item?></option>
            <?php endforeach;?>
        </select>

        <br>
        <a href="<?=base_url()?>/panel/gallery" class="btn">Anuluj</a>

        <button class="btn btn-primary">Zapisz</button>
    </form>
    <script>
       ClassicEditor
       .create( document.querySelector( '#editor1' )).then( editor => {
        console.log( editor );
    } )
       .catch( error => {
        console.error( error );
    } );


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
