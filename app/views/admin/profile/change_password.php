<div class="panel panel-default">

	<div class="panel-heading">
    	Zmień swoje hasło
    </div>

	<div class="panel-body">
		<div class="row">
			<div class="col-xs-12">
				<form action="" method="post">
					<div class="form-group">
						<label for="password">Obecne hasło: </label>
						<input class="form-control" type="password" name="password" required>
										<p class="text-muted"><i class="fa fa-question-circle"></i> Podaj obecne hasło w celu zweryfikowania tożsamości.</p>

					</div>
					<div class="form-group">
						<label for="password_new">Nowe hasło: </label>
						<input class="form-control" type="password" name="password_new" required>
										<p class="text-muted"><i class="fa fa-question-circle"></i> Podaj nowe hasło.</p>

					</div>
					<div class="form-group">
						<label for="password_again">Potwierdź nowe hasło: </label>
						<input class="form-control" type="password" name="password_again" required>
										<p class="text-muted"><i class="fa fa-question-circle"></i> Wprowadź nowe hasło ponownie w celu potwierdzenia.</p>

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