<div class="panel panel-default">

	<div class="panel-heading">
    	Dodaj nowego użytkownika
    </div>

	<div class="panel-body">
		<div class="row">
			<div class="col-xs-12">
				<form action="" method="post">
					<div class="form-group">
						<label for="username">Login: </label>
						<input class="form-control" type="text" name="username" required>
										<p class="text-muted"><i class="fa fa-question-circle"></i> Podaj login nowego użytkownika.</p>

					</div>
					<div class="form-group">
						<label for="name">Imię i nazwisko: </label>
						<input class="form-control" type="text" name="name" required>
										<p class="text-muted"><i class="fa fa-question-circle"></i> Podaj dane osobowe nowego użytkownika.</p>

					</div>
					<div class="form-group">
						<label for="password">Podaj hasło: </label>
						<input class="form-control" type="password" name="password" required>
										<p class="text-muted"><i class="fa fa-question-circle"></i> Podaj hasło dla nowego użytkownika.</p>

					</div>
					<div class="form-group">
						<label for="password_again">Potwierdź hasło: </label>
						<input class="form-control" type="password" name="password_again" required>
										<p class="text-muted"><i class="fa fa-question-circle"></i> Wprowadź hasło ponownie w celu jego potwierdzenia.</p>

					</div>
					<div class="form-group">
						<input type="hidden" name="token" value="<?=Token::generate()?>">
						<input type="submit" class="btn btn-primary btn-lg" value="Dodaj użytkownika">
						<a class="btn-primary btn btn-lg pull-right" href="<?=Config::get('path/public').'admin/see_profile'?>">Wróć</a>
					</div>
				</form>
								<p class="text-muted"><i class="fa fa-question-circle"></i> Dodawanie nowych użytkowników może być ryzykowne! Będą oni mieli możliwość edytowania Twojego serwisu.</p>

			</div>
		</div>
	</div>
</div>