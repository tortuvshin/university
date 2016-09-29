
<div class="panel panel-default">
    <div class="panel-heading-install">
		<ul class="nav nav-pills">
		  	<li><a href="<?=base_url('install/index')?>"><span class="fa fa-check"></span> Checklist</a></li>
		  	<li><a href="<?=base_url('install/purchase_code')?>"><span class="fa fa-check"></span> Purchase Code</a> </li>
		  	<li><a href="<?=base_url('install/database')?>"><span class="fa fa-check"></span> Database</a></li>
		  	<li><a href="<?=base_url('install/timezone')?>"><span class="fa fa-check"> Timezone</a></li>
		  	<li class="active"><a href="<?=base_url('install/site')?>">Site Config</a></li>
		  	<li><a href="#">Done!</a></li>
		</ul>
    </div>
    <div class="panel-body ins-bg-col">
    	<h4>Site Config</h4>
    	
    	<form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
			<?php if(form_error('sname')) 
			    echo "<div class='form-group has-error' >";
			else     
			    echo "<div class='form-group' >";
			?>
				<label for="sname" class="col-sm-2 control-label">
				    <p>Site Title</p>
				</label>
				<div class="col-sm-6">
				    <input type="text" class="form-control" id="sname" name="sname" value="<?=set_value('sname')?>" >
				</div>
				<span class="col-sm-4 control-label">
				    <?php echo form_error('sname'); ?>
				</span>
			</div>

			<?php 
			    if(form_error('phone')) 
			        echo "<div class='form-group has-error' >";
			    else     
			        echo "<div class='form-group' >";
			?>
			    <label for="phone" class="col-sm-2 control-label">
			        <p>Phone</p>
			    </label>
			    <div class="col-sm-6">
			        <input type="text" class="form-control" id="phone" name="phone" value="<?=set_value('phone')?>" >
			    </div>
			    <span class="col-sm-4 control-label">
			        <?php echo form_error('phone'); ?>
			    </span>
			</div>


			<?php 
			    if(form_error('email')) 
			        echo "<div class='form-group has-error' >";
			    else     
			        echo "<div class='form-group' >";
			?>
			    <label for="email" class="col-sm-2 control-label">
			        <p>Email</p>
			    </label>
			    <div class="col-sm-6">
			        <input type="text" class="form-control" id="email" name="email" value="<?=set_value('email')?>" >
			    </div>
			    <span class="col-sm-4 control-label">
			        <?php echo form_error('email'); ?>
			    </span>
			</div>


			<?php 
			    if(form_error('adminname')) 
			        echo "<div class='form-group has-error' >";
			    else     
			        echo "<div class='form-group' >";
			?>
			    <label for="adminname" class="col-sm-2 control-label">
			        <p>Admin Name</p>
			    </label>
			    <div class="col-sm-6">
			        <input type="text" class="form-control" id="adminname" name="adminname" value="<?=set_value('adminname')?>" >
			    </div>
			     <span class="col-sm-4 control-label">
			        <?php echo form_error('adminname'); ?>
			    </span>
			</div>

			<?php 
			    if(form_error('currency_code')) 
			        echo "<div class='form-group has-error' >";
			    else     
			        echo "<div class='form-group' >";
			?>
			    <label for="currency_code" class="col-sm-2 control-label">
			        <p>Currency Code</p>
			    </label>
			    <div class="col-sm-6">
			        <input type="text" class="form-control" id="currency_code" name="currency_code" value="<?=set_value('currency_code')?>" >
			    </div>
			     <span class="col-sm-4 control-label">
			        <?php echo form_error('currency_code'); ?>
			    </span>
			</div>

			<?php 
			    if(form_error('currency_symbol')) 
			        echo "<div class='form-group has-error' >";
			    else     
			        echo "<div class='form-group' >";
			?>
			    <label for="currency_symbol" class="col-sm-2 control-label">
			        <p>Currency Symbol</p>
			    </label>
			    <div class="col-sm-6">
			        <input type="text" class="form-control" id="currency_symbol" name="currency_symbol" value="<?=set_value('currency_symbol')?>" >
			    </div>
			     <span class="col-sm-4 control-label">
			        <?php echo form_error('currency_symbol'); ?>
			    </span>
			</div>

			<?php 
			    if(form_error('username')) 
			        echo "<div class='form-group has-error' >";
			    else     
			        echo "<div class='form-group' >";
			?>
			    <label for="username" class="col-sm-2 control-label">
			        <p>Username</p>
			    </label>
			    <div class="col-sm-6">
			        <input type="text" class="form-control" id="username" name="username" value="<?=set_value('username')?>" >
			    </div>
			     <span class="col-sm-4 control-label">
			        <?php echo form_error('username'); ?>
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
			        <input type="password" class="form-control" id="password" name="password" data-toggle="tooltip" data-placement="right" title="Tooltip on right" value="<?=set_value('password')?>" >
			    </div>
			     <span class="col-sm-4 control-label">
			        <?php echo form_error('password'); ?>
			    </span>
			</div>

			<?php 
			    if(form_error('address')) 
			        echo "<div class='form-group has-error' >";
			    else     
			        echo "<div class='form-group' >";
			?>
			    <label for="address" class="col-sm-2 control-label">
			        <p>Address</p>
			    </label>
			    <div class="col-sm-6">
			        <textarea name="address" class="form-control" id="address"><?=set_value('address')?></textarea>
			    </div>
			     <span class="col-sm-4 control-label">
			        <?php echo form_error('address'); ?>
			    </span>
			</div>

			<div class="form-group">
				<div class="row">
					 <div class="col-sm-4 col-sm-offset-1">
		                <a href="<?=base_url('install/timezone')?>" class="btn btn-default pull-right">Previous Step</a>
		            </div>
		            <div class="col-sm-4 col-sm-offset-3">
		                <input type="submit" class="btn btn-success" value="Next Step" >
		            </div>
				</div>
	        </div>

		</form>
    </div>
</div>