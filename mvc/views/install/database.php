
<div class="panel panel-default">
    <div class="panel-heading-install">
		<ul class="nav nav-pills">
		  	<li><a href="<?=base_url('install/index')?>"><span class="fa fa-check"></span> Checklist</a></li>
		  	<li><a href="<?=base_url('install/purchase_code')?>"><span class="fa fa-check"></span> Purchase Code</a> </li>
		  	<li class="active"><a href="<?=base_url('install/database')?>">Database</a></li>
		  	<li><a href="#">Timezone</a></li>
		  	<li><a href="#">Site Config</a></li>
		  	<li><a href="#">Done!</a></li>
		</ul>
    </div>
    <div class="panel-body ins-bg-col">
    	<h4>Database Config</h4>
    	
    	<form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
			<?php 
			if(form_error('host')) 
			    echo "<div class='form-group has-error' >";
			else     
			    echo "<div class='form-group' >";
			?>
				<label for="host" class="col-sm-2 control-label">
				    <p>Hostname</p>
				</label>
				<div class="col-sm-6">
				    <input type="text" class="form-control" id="host" name="host" value="<?=set_value('host')?>" >
				</div>
				<span class="col-sm-4 control-label">
				    <?php echo form_error('host'); ?>
				</span>
			</div>

			<?php 
			if(form_error('database')) 
			    echo "<div class='form-group has-error' >";
			else     
			    echo "<div class='form-group' >";
			?>
				<label for="database" class="col-sm-2 control-label">
				    <p>Database</p>
				</label>
				<div class="col-sm-6">
				    <input type="text" class="form-control" id="database" name="database" value="<?=set_value('database')?>" >
				</div>
				<span class="col-sm-4 control-label">
				    <?php echo form_error('database'); ?>
				</span>
			</div>

			<?php 
			if(form_error('user')) 
			    echo "<div class='form-group has-error' >";
			else     
			    echo "<div class='form-group' >";
			?>
				<label for="user" class="col-sm-2 control-label">
				    <p>Username</p>
				</label>
				<div class="col-sm-6">
				    <input type="text" class="form-control" id="user" name="user" value="<?=set_value('user')?>" >
				</div>
				<span class="col-sm-4 control-label">
				    <?php echo form_error('user'); ?>
				</span>
			</div>

			<?php 
			if(form_error('password')) 
			    echo "<div class='form-group has-error' >";
			else     
			    echo "<div class='form-group' >";
			?>
				<label for="password" class="col-sm-2 control-label">
				    <p>Password</p>
				</label>
				<div class="col-sm-6">
				    <input type="password" class="form-control" id="password" name="password" value="<?=set_value('password')?>" >
				</div>
				<span class="col-sm-4 control-label">
				    <?php echo form_error('password'); ?>
				</span>
			</div>
	        <div class="form-group">
				<div class="row">
					 <div class="col-sm-4 col-sm-offset-1">
		                <a href="<?=base_url('install/index')?>" class="btn btn-default pull-right">Previous Step</a>
		            </div>
		            <div class="col-sm-4 col-sm-offset-3">
		                <input type="submit" class="btn btn-success" value="Next Step" >
		            </div>
				</div>
	        </div>
		</form>
    </div>
</div>