<div class="panel panel-default">

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<i class="fa fa-line-chart fa-fw"></i>
						14 days recap
					</div>
					<div class="panel-body">
						<div id="morris-line-chart"></div>
					</div>						
				</div>   
			</div>					
		</div> 
	 			
		
        <div class="row">
        	<div class="col-lg-6">
        		<div class="panel panel-default">
					<div class="panel-heading">
						<i class="fa fa-comment fa-fw"></i>
						Last 14 days
					</div>
					<div class="panel-body">
						<div class="row">
						
							<div class="col-lg-6">
		                        <div class="panel panel-primary text-center no-boder blue">
		                            <div class="panel-left pull-left blue">
		                                <i class="fa fa-eye fa-5x"></i>
		                                
		                            </div>
		                            <div class="panel-right">
										<h3><?=$data['sum_stats']['all_visits']?></h3>
		                               <strong> Views</strong>
		                            </div>
		                        </div>
		                    </div>

		                    <div class="col-lg-6">
		                        <div class="panel panel-primary text-center no-boder blue">
		                            <div class="panel-left pull-left blue">
		                                <i class="fa fa-users fa-5x"></i>
		                                
		                            </div>
		                            <div class="panel-right">
										<h3><?=$data['sum_stats']['all_visitors']?></h3>
		                               <strong> Visitors</strong>
		                            </div>
		                        </div>
		                    </div>
						</div>

						<div class="row">	

							<div class="col-lg-6">
		                        <div class="panel panel-primary text-center no-boder blue">
		                            <div class="panel-left pull-left blue">
		                                <i class="fa fa-mouse-pointer fa-5x"></i>
		                                
		                            </div>
		                            <div class="panel-right">
										<h3><?=$data['sum_stats']['per_user']?></h3>
		                               <strong> Clicks per visitor</strong>
		                            </div>
		                        </div>
		                    </div>

		                    <div class="col-lg-6">
		                        <div class="panel panel-primary text-center no-boder blue">
		                            <div class="panel-left pull-left blue">
		                                <i class="fa fa-user fa-5x"></i>
		                                
		                            </div>
		                            <div class="panel-right">
										<h3><?=$data['sum_stats']['all_unique']?></h3>
		                               <strong> Unique visitors</strong>
		                            </div>
		                        </div>
		                    </div>

						</div>
					</div>						
				</div>   
        	</div>
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    	<i class="fa fa-pie-chart fa-fw"></i>
                        Percentage of new and returning visitors
                    </div>
                    <div class="panel-body">
                        <div id="morris-donut-chart"></div>
                    </div>
                </div>
            </div>

        </div>
		<div class="row">
		<div class="col-md-12">
		
			</div>		
		</div> 	
        <!-- /. ROW  -->

</div>
