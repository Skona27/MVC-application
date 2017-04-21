<div class="panel panel-default">

	<div class="panel-heading">
    	Dodaj swoje zdjęcia
    </div>

	<div class="panel-body">
		<form action="" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<input type="file" name="Files[]" class="form-control" multiple>
			</div>

			<input type="hidden" name="token" value="<?=Token::generate()?>">
			<input type="submit" class="btn btn-primary btn-lg" value="Wyślij">
		</form>
	</div>

</div>