<div class="panel panel-default">

	<div class="panel-heading">
    	Zobacz swoje dane
    </div>

	<div class="panel-body">
		<div class="row">
			<div class="col-xs-12">
				<h4><b>Twój login:</b></h4> <?=$data['username']?>
				<h4><b>Imię i nazwisko:</b></h4> <?=$data['name']?>
				<h4><b>Data dołączenia:</b></h4> <?=$data['joined']?>
				<h4><b>Grupa:</b></h4> <?=$data['group']?>
			</div>
		</div>
		<div class="row" style="margin-top: 15px;">
			<div class="col-xs-12">
				<a class="btn btn-primary btn-lg" href="<?=Config::get('path/public').'admin/edit_profile'?>">Edytuj profil</a>
				<a class="btn btn-primary btn-lg" href="<?=Config::get('path/public').'admin/change_password'?>">Zmień hasło</a>
				<p class="text-muted"><i class="fa fa-question-circle"></i> Tutaj znajdują się informacje o Twoim profilu. Możesz je w łatwy sposób edytować.</p>

			</div>
		</div>
	</div>
</div>