<div class="users form">

<script type='text/javascript'>
    $(document).ready(function() {
       
            $('#user-dropdown-country').change(function(){ // when dropdown value gets changed function executes
            	var countryId = $("#user-dropdown-country option:selected").val();
				$("#state").load("<?=Router::url(array('controller' => 'users', 'action' => 'loads'))?>/"+countryId );
			});

			$('#state').change(function(){ // when dropdown value gets changed function executes
            	var stateId = $("#state option:selected").val();
				$("#city").load("<?=Router::url(array('controller' => 'users', 'action' => 'loadc'))?>/"+stateId );
			});
        });
</script>
<div class="container">
	
	<?php echo $this->Form->create('User',array('enctype'=>'multipart/form-data')); ?>
	<div id="checkin-box">      
		<div id="chb-header">          
			<div class="logo pull-left">
				<h1>DC Office App</h1>
				<h2>Edit Profile</h2>
			</div>
			<div class="time pull-right">
				<h1><?php echo date('l, d F Y');?></h1>
				<h3 class="timer"></h3>
			</div>
		</div>
		<div id="chb-content">          
			<h1>Enter your personal details</h1> 
			<p>Finalize and complete your profile</p>    
			<div class = "row profile">
				<div class = "col-md-4">
				</div>
				<div class = "col-md-4">
				
				<?php 
				echo $this->Form->input('id');
				echo $this->Form->input('upload', array('label' => 'Image','type' => 'file','label' => false));?>
				<div class = "upload-pic">
				<?php 
				echo __('Upload Picture');
				?>
<!-- 					<img src = "../img/128.jpg" class = "pic-display"></img></br>
					<a href = "#" class = "upload-pic">Upload Picture</a> -->
					</div>
				</div>
				<div class = "col-md-4">
				</div>
			</div> 
			<div id="checkin-form-2">            
				<div class = "row">
					<div class = "col-md-6">
						<?php echo $this->Form->input('firstname', array('class' => 'form-control input-margin', 'placeholder' => 'Your First Name sire', 'label' => false)); ?>
					</div>
					<div class = "col-md-6">
						<?php echo $this->Form->input('lastname', array('class' => 'form-control input-margin', 'placeholder' => 'Your Last Name Sire', 'label' => false)); ?>

					</div>
				</div>
				<div class = "row">
					<div class = "col-md-7">
						<h4> Date Of Birth</h4>
						<?php echo $this->Form->input('dob', array('class' => 'input-margin', 'label' => false, 'empty' => true, 'minYear' => date('Y') - 74, 'maxYear' => date('Y'))); ?>
					</div>
				</div>

				<div class ="row">
					<div class = "col-md-12">
						<?php echo $this->Form->input('contact', array('class' => 'form-control input-margin', 'placeholder' => 'Your phone number', 'label' => false)); ?>
					</div>
				</div>
				<div class ="row">
					<div class = "col-md-12">
						<?php echo $this->Form->input('country_id', array('id' => 'user-dropdown-country','class' => 'form-control input-margin','label' => false, 'empty' => 'Please select your country')); ?>
					</div>
				</div>
				<div class ="row">
					<div class = "col-md-12">
						<?php echo $this->Form->input('state_id', array('id' => 'state','class' => 'form-control input-margin', 'placeholder' => 'State', 'label' => false, 'empty' => 'Please select your state')); ?>
					</div>
				</div>
				<div class ="row">
					<div class = "col-md-12">
						<?php echo $this->Form->input('city_id', array('id' => 'city','class' => 'form-control input-margin', 'placeholder' => 'City', 'label' => false, 'empty' => 'Please select your city')); ?>
					</div>
				</div>



				<div class = "row">
					<div class = "col-md-6">
						<?php echo $this->Form->submit(__('Complete your profile'), array('class' => 'btn btn-primary btn-lg btn-block chb-btn')); ?><br />

					</div>
					<div class="col-md-6 link-deco">
						<?php echo $this->Html->link(__('Skip all this, take me to dashboard'), array( 'action' => 'admin')); ?>

					</div> 
				</div>
			</div>
		</div>
		
	</div>
	<?php echo $this->Form->end(); ?>
</div>
</div>
