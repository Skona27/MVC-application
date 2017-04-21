<div class="panel panel-default">

	<div class="panel-heading">
    	Edytuj ustawienia strony
    </div>

	<div class="panel-body">
		<div class="row">
			<div class="col-xs-12">
				<form action="" method="post">
					<div class="form-group">
						<label for="name">Tytuł: </label>
						<input class="form-control" type="text" name="title" value="<?=$data['settings']->title?>" required>
						<p class="text-muted"><i class="fa fa-question-circle"></i> To jest tytuł Twojej strony. Jest on wyświetlany na pasku przeglądarki i w Google.</p>
					</div>
					<div class="form-group">
						<label for="keywords">Słowa kluczowe: </label>
						<textarea class="form-control" type="text" name="keywords" rows="7" required=""><?=$data['settings']->keywords?></textarea>
						<p class="text-muted"><i class="fa fa-question-circle"></i> Tutaj znajdują się słowa kluczowe dla Twojej strony. Możesz je edytować, lecz bądź ostrożny! Od tego zależy pozycjnowanie Twojej witryny.</p>
					</div>
					<div class="form-group">
						<label for="description">Opis: </label>
						<textarea class="form-control" type="text" name="description" required="" rows="7"><?=$data['settings']->description?></textarea>
						<p class="text-muted"><i class="fa fa-question-circle"></i> Tutaj znajduje się opis Twojej strony wyświetlany w Google.</p>
					</div>
					<div class="form-group">
						<label for="email">Email: </label>
						<input class="form-control" type="email" name="email" required="" value="<?=$data['settings']->email?>">
												<p class="text-muted"><i class="fa fa-question-circle"></i> Na ten adres email będą kierowane zapytania z koszyka oraz z formularza.</p>
					</div>
					<div class="form-group">
						<input type="hidden" name="token" value="<?=Token::generate()?>">
						<input type="submit" class="btn btn-primary btn-lg" value="Zapisz zmiany">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>