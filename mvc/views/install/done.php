
<div class="panel panel-default">
    <div class="panel-heading-install">
		<ul class="nav nav-pills">
		  	<li><a href="<?=base_url('install/index')?>"><span class="fa fa-check"></span> Checklist</a></li>
		  	<li><a href="<?=base_url('install/purchase_code')?>"><span class="fa fa-check"></span> Purchase Code</a></li>
		  	<li><a href="<?=base_url('install/database')?>"><span class="fa fa-check"></span> Database</a></li>
		  	<li><a href="<?=base_url('install/timezone')?>"><span class="fa fa-check"> Timezone</a></li>
		  	<li><a href="<?=base_url('install/site')?>"><span class="fa fa-check"> Site Config</a></li>
		  	<li class="active"><a href="#">Done!</a></li>
		</ul>
    </div>
    <div class="panel-body ins-bg-col">
    	<h4><span class="fa fa-check"></span> Installation completed!</h4>

    	<div class="alert alert-info">
    		<h5><span class="fa fa-info-circle"></span> You can login now using the following credential:</h5>

    		<p style="margin-top:25px;">
    		<h5>Username: <b><?=$this->session->userdata('username')?></b></h5>
			<h5>Password: <b><?=$this->session->userdata('password')?></b></h5> </p>
    	</div>

    	<div class="alert alert-warning">
    		<h5><span class="fa fa-exclamation-triangle"></span> Please click go to login then finish your job.</h5>
    	</div>

    	<form class="form-horizontal" role="form" method="post">
    		<input type="text" name="text" style="display:none;" />
			<div class="form-group">
				<div class="row">
					 <div class="col-sm-4 col-sm-offset-1">
		            </div>
		            <div class="col-sm-4 col-sm-offset-3">
		                <input type="submit" name="submit" class="btn btn-success" value="Go to Login" >
		            </div>
				</div>
	        </div>
		</form>
    </div>
</div>