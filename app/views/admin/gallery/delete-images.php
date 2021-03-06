<div class="panel panel-default">

	<div class="panel-heading">
    	Usuń swoje zdjęcia
    </div>

    <div class="panel-body">
    	<?php if($data['images']): ?>
    		<div class="row">
	        	<form method="post">	
	        		<?php foreach ($data['images'] as $image): ?>
	        			<div class="col-lg-3 col-md-4 col-xs-6">
	        				<img class="thumbnail img-responsive" src="<?=$image['path']?>">

	        				<div class="checkbox">
		        				<label>
		        					<input type="checkbox" name="Delete[]" value="<?=$image['dir']?>"> Zaznacz
		        				</label>
	        				</div>

	        			</div>
	        		<?php endforeach; ?> 
	        		<div class="col-xs-12">
	        			<input type="hidden" name="token" value="<?=Token::generate()?>">
	        			<input type="submit" class="btn btn-primary btn-lg" value="Usuń">
	        		</div>
	        	</form>
	        </div>

    	<?php else: ?>  
    		<p>Nie masz żadnych zdjęć!</p> 
    	<?php endif; ?>  		
    </div>

</div>