<div class="module">
	<div class="module-head">
		<h3>
		Podstrony</h3>
	</div>
	<div class="module-body">
        <h3>Dodaj podstronę</h3>
        <script  src="/ckfinder/ckfinder.js"></script>
        <script  src="/js/ckeditor.js"></script>
        <script type="module" src="/ckeditor/ckeditor5-ckfinder/src/ckfinder.js"></script>

        <form>
            <textarea name="editor1" id="editor1" rows="10" cols="80">
                This is my textarea to be replaced with CKEditor.
            </textarea>

        </form>
        <script>
         ClassicEditor
         .create( document.querySelector( '#editor1' ), {
            plugins: [ CKFinder],

        // Enable the CKFinder button in the toolbar.
        toolbar: [ 'ckfinder'],

        ckfinder: {
            // Upload the images to the server using the CKFinder QuickUpload command.
            uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&responseType=json',

            // Define the CKFinder configuration (if necessary).
            options: {
                resourceType: 'Images'
            }
        }
    } )
         .then( editor => {
            console.log( editor );
        } )
         .catch( error => {
            console.error( error );
        } );
    </script>
</div>
</div>