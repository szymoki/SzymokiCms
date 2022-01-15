<div class="module">
	<div class="module-head">
		<h3>
		Newsletter</h3>
	</div>
	<div class="module-body">
        <h3>Dodaj newsa</h3>
        <?php if($alert==true):?>
        <?=validation_errors(); ?>
        <?php endif;?>
        <script  src="<?=base_url()?>/ckfinder/ckfinder.js"></script>
        <script  src="<?=base_url()?>/ckeditor/ckeditor.js"></script>

        <form class="form-control" method="post" action="<?=base_url()?>/panel/news/addu">

            <label>Tytuł:</label>
            <input class="form-control" type="text" name="title" required>
            <label>Treść:</label>
            <textarea name="text" id="editor1" rows="10" cols="80">
            </textarea><br>
            <label>Kategoria:</label>
            <select class="form-control category" name="category">
                <?php if(acl("news")):?>
                <?php foreach($categories as $k=>$item):?>
                <option value="<?=$k?>"><?=$item?></option>
                <?php endforeach;?>
                <?php endif;?>
                <option disabled>--Strony przedmiotowe:--</option>
                <?php foreach($pages_p_categories as $k=>$item):?>
                <?php if(acl("p_".$item->id)):?>
                <option value="<?=$item->id*100?>"><?=$item->title?></option>
                <?php endif;?>
                <?php endforeach;?>
            </select>
            <Br>
            <input type="checkbox" name="published" value="1" checked>Opublikowany<br>
            <input type="hidden" name="mainpage" value="0" />
            <input type="checkbox" name="mainpage" value="1" checked>Pokaż na stronie głównej<br>

            <br>
            <a href="<?=base_url()?>/panel/news" class="btn">Anuluj</a>

            <button class="btn btn-primary">Zapisz</button>
        </form>


        <script>
            window.onload=function(){
                $(".category").change(function(){
                    console.log($(".category").val());
                    if($(".category").val()>100){

                        $("input[name=mainpage]").prop( "checked", false );
                    }else{
                        $("input[name=mainpage]").prop( "checked", true );
                    }
                });
            };

            CKEDITOR.on( 'dialogDefinition', function( ev ) {
                var dialogName = ev.data.name;
                var dialogDefinition = ev.data.definition;

                if ( dialogName == 'table' ) {
                    var info = dialogDefinition.getContents( 'info' );

        info.get( 'txtWidth' )[ 'default' ] = '100%';       // Set default width to 100%
        info.get( 'txtBorder' )[ 'default' ] = '0';         // Set default border to 0
    }
});
            var editor=CKEDITOR.replace( 'editor1' );
            CKFinder.setupCKEditor( editor );
        </script>
    </div>
</div>