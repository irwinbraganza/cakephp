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

<?php echo $this->Form->create('User',array('enctype'=>'multipart/form-data')); ?>
	<fieldset>
		<h3><u><?php echo __('Edit User'); ?></u></h3>
		<?php echo nl2br("\n"); ?>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('firstname',array('label' => 'First Name'));
		echo $this->Form->input('lastname',array('label' => 'Last Name'));
		echo $this->Form->input('upload', array('label' => 'Image','type' => 'file'));
		echo nl2br("\n");
		
		echo $this->Form->input('country_id',array('id' => 'user-dropdown-country','type'=>'select','empty'=>'Select Country'));
		echo "&nbsp&nbsp&nbsp". $this->Html->link('Add New Country',
			array('controller' => 'countries','action' => 'add', $this->Form->value('User.id')));
		echo nl2br("\n");
		echo nl2br("\n");
		echo nl2br("\n");
		echo $this->Form->input('state_id',array('id' => 'state','type'=>'select','empty'=>'Select State'));
		echo "&nbsp&nbsp&nbsp". $this->Html->link('Add New State',
			array('controller' => 'states','action' => 'add', $this->Form->value('User.id')));
		echo nl2br("\n");
		echo nl2br("\n");
		echo nl2br("\n");
		echo $this->Form->input('city_id',array('id' => 'city','type'=>'select','empty'=>'Select City'));
		echo "&nbsp&nbsp&nbsp".$this->Html->link('Add New City',
			array('controller' => 'cities','action' => 'add', $this->Form->value('User.id')));
		echo nl2br("\n");
		echo nl2br("\n");
		echo nl2br("\n");
		echo $this->Form->input('dob', array(
		    'label' => 'Date of birth',
		    'dateFormat' => 'DMY',
		    'minYear' => date('Y', strtotime("now")) - 80,
		    'maxYear' => date('Y', strtotime("now")) - 14
		));
				echo $this->Form->input('doj', array(
		    'label' => 'Date of Joining',
		    'dateFormat' => 'DMY',
		    'minYear' => date('Y', strtotime("now")) - 10,
		    'maxYear' => date('Y', strtotime("now"))
		));
		echo $this->Form->input('leavestart',array('type' => 'hidden'));
		echo $this->Form->input('leavemid',array('type' => 'hidden'));
		echo $this->Form->input('leaveend',array('type' => 'hidden'));
		echo $this->Form->input('gracetime');
		echo $this->Form->input('contact');
		echo $this->Form->input('role',array('options' => array('member' => 'Member','admin' => 'Administrator')));
		echo $this->Form->input('Designation');
		echo $this->Form->input('leavesremaining',array('label' => 'Leaves Balance'));
		echo $this->Form->input('leavesentitled',array('label' => 'Total Leaves Available'));
		echo $this->Form->input('cupcakespending',array('label' => 'Cupcakes Pending'));
		echo $this->Form->input('cupcakesbought',array('label' => 'Cupcakes Bought'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>


<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('User.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
		
	</ul>
</div>
