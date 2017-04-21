<div class="panel panel-default">

	<div class="panel-heading">
    	Edytuj swój profil
    </div>

	<div class="panel-body">
		<div class="row">
			<div class="col-xs-12">
				<form action="" method="post">
					<div class="form-group">
						<label for="login">Login: </label>
						<input class="form-control" type="text" name="login" value="<?=$data['username']?>" required>
										<p class="text-muted"><i class="fa fa-question-circle"></i> Tutaj możesz zmienić swój login.</p>

					</div>
					<div class="form-group">
						<label for="name">Imię i nazwisko: </label>
						<input class="form-control" type="text" name="name" value="<?=$data['name']?>" required>
										<p class="text-muted"><i class="fa fa-question-circle"></i> Tutaj możesz zmienić swoje dane osobowe.</p>

					</div>
					<div class="form-group">
						<label for="password">Podaj hasło: </label>
						<input class="form-control" type="password" name="password" required>
										<p class="text-muted"><i class="fa fa-question-circle"></i> Wszelkie zmiany danych osobowych muszą zostać potwierdzone wprowadzeniem hasła.</p>

					</div>
					<div class="form-group">
						<input type="hidden" name="token" value="<?=Token::generate()?>">
						<input type="submit" class="btn btn-primary btn-lg" value="Zapisz zmiany">
						<a class="btn-primary btn btn-lg pull-right" href="<?=Config::get('path/public').'admin/see_profile'?>">Wróć</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>