<div class="panel panel-default">
    <div class="panel-heading-install">
		<ul class="nav nav-pills">
		  	<li class="active"><a href="<?=base_url('install/index')?>">Checklist</a></li>
            <li><a href="#">Purchase Code</a></li>
		  	<li><a href="#">Database</a></li>
            <li><a href="#">Timezone</a></li>
		  	<li><a href="#">Site Config</a></li>
		  	<li><a href="#">Done!</a></li>
		</ul>
    </div>
    <div class="panel-body ins-bg-col">
    	<h4>Pre-Install Checklist</h4>
    	<?php  
    		foreach ($success as $succ) {
    		 	echo "<div class=\"alert alert-success\"><span class=\"fa fa-check-circle\"></span> ". $succ ."</div>";	
    		}

    		foreach ($errors as $er) {
    		 	echo "<div class=\"alert alert-danger\"><span class=\"fa fa-exclamation-circle\"></span> ". $er ."</div>";
    		}
    	?>
    	<div class="col-sm-12"><a href="<?=base_url('install/purchase_code')?>" class="btn btn-success pull-right">Next Step</a></div>
    </div>
</div>