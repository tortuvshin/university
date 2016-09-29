
<div class="panel panel-default">
    <div class="panel-heading-install">
		<ul class="nav nav-pills">
		  	<li><a href="<?=base_url('install/index')?>"><span class="fa fa-check"></span> Checklist</a></li>
		  	<li><a href="<?=base_url('install/purchase_code')?>"><span class="fa fa-check"></span> Purchase Code</a> </li>
		  	<li><a href="<?=base_url('install/database')?>"><span class="fa fa-check"></span> Database</a></li>
		  	<li class="active"><a href="<?=base_url('install/timezone')?>">Timezone</a></li>
		  	<li><a href="#">Site Config</a></li>
		  	<li><a href="#">Done!</a></li>
		</ul>
    </div>
    <div class="panel-body ins-bg-col">
    	<h4>Site Config</h4>
    	
    	<form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
			<?php if(form_error('timezone')) 
			    echo "<div class='form-group has-error' >";
			else     
			    echo "<div class='form-group' >";
			?>
				<label for="sname" class="col-sm-2 control-label">
				    <p>Timezone</p>
				</label>
				<div class="col-sm-7">
				    <?php
				    	$path = APPPATH."config/timezones_class.php";
				    	if(@include($path)) {
				    		$timezones_cls = new Timezones();
				    		$timezones = $timezones_cls->get_timezones();
				    		echo form_dropdown("timezone", $timezones, set_value("timezone"), "id='timezone' class='form-control'");
				    	}
				    ?>
				</div>
				<span class="col-sm-3 control-label">
				    <?php echo form_error('timezone'); ?>
				</span>
			</div>

			<div class="form-group">
				<div class="row">
					 <div class="col-sm-4 col-sm-offset-1">
		                <a href="<?=base_url('install/database')?>" class="btn btn-default pull-right">Previous Step</a>
		            </div>
		            <div class="col-sm-4 col-sm-offset-3">
		                <input type="submit" class="btn btn-success" value="Next Step" >
		            </div>
				</div>
	        </div>

		</form>
    </div>
</div>