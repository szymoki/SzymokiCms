<div class="module">
    <script src="/ckfinder/ckfinder.js"></script>
    <div class="module-head">
        <h3>
        Szablon</h3>
    </div>
    <div class="module-body">
        <h3>Edytuj pięciokąt</h3>
        <?php if($alert==true):?>
        <?=validation_errors(); ?>
        <?php endif;?>
        <script  src="<?=base_url()?>/ckfinder/ckfinder.js"></script>
        <script  src="<?=base_url()?>/js/ckeditor.js"></script>

        <form class="form-control" method="post" action="<?=base_url()?>/panel/szablon/save_p">
          <input type="hidden" name="id" value="<?=$id?>">
          <label>Tytuł:</label>
          <input class="form-control" type="text" name="title" value="<?=$pieciokat->title?>" required>
          <label>Treść:</label>
          <textarea name="text" id="editor1" rows="10" cols="80">
            <?=$pieciokat->text?>
        </textarea>
        <label>Ikonka:</label>
        <select name="icon">
            <?php foreach($icons as $item):?>
            <option <?=$pieciokat->icon==$item ? ' selected' :""?>><?=$item?></option>
            <?php endforeach?>
        </select>
        <br>
        <label>Odnośnik:</label>
        <input class="form-control" type="text" name="url" value="<?=$pieciokat->url?>" required>
        <br>
        <a href="<?=base_url()?>/panel/szablon" class="btn">Anuluj</a>

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
