<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', '');
$cakeVersion = __d('cake_dev', 'DC', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->fetch('meta');

		echo $this->Html->css('cake.generic');
		echo $this->fetch('css');



		//echo $this->Html->script('moment.min');
      	//echo $this->Html->script('jquery.min');
   	 	//echo $this->Html->script('fullcalendar');
   	 	//echo $this->Html->css('fullcalendar');
		

	  	echo $this->Html->script('jquery-1.10.2');
	    echo $this->Html->script('default');
		echo $this->fetch('script');
       

	    echo $this->Html->script('jquery-1.7.1.min');
        echo $this->Html->script('jquery.ui.core');
        echo $this->Html->script('jquery.ui.widget');
        echo $this->Html->script('jquery.ui.mouse');
        echo $this->Html->script('jquery.ui.resizable');
        echo $this->Html->script('jquery.ui.draggable');
        echo $this->Html->script('fullcalendar.min');
        echo $this->Html->script('gcal');
		echo $scripts_for_layout;

		echo $this->Html->css('fullcalendar');
   	                
	?>
   
</head>
<body>
	

	<div id="container">
		

    
		<div id="content">
		<?php
		function activateTab($selectedTab, $currentTab) {
				if ($selectedTab == $currentTab) {
					echo ' active';
				}
			}
		echo $this->Html->css('bootstrap');
		echo $this->Html->css('bootstrap-responsive');
		echo $this->fetch('css');
		echo $this->Html->script('bootstrap');
	  	echo $this->Html->script('jquery-1.10.2');
		echo $this->fetch('script');
		?>
		<div class="navbar navbar-fixed-top"><div class="navbar-inner">
		      <div class="container-fluid">
		        <a href="" class="brand">Diet Code</a>          
		        <ul class="nav">
		            <li class="active"><a href="/cakephp/dashboard">Home</a></li>
					<?php if (isset($user['User']['role']) && $user['User']['role'] === 'admin'):  ?>
		            <li>
		              <a href="/cakephp/users/index">Users</a>            
		            </li>



		            <li>
		              <a href="/cakephp/checkincheckouts/index">Check-in/Check-out</a>            
		            </li>

		            <li>
		              <a href="/cakephp/leaves/index">Leaves</a>            
		            </li>
		            
		          
		            <!-- New Cupcakes view-->
		            <li>
		              <a href="/cakephp/cupcakes/index">Cupcakes</a>            
		            </li>

		            <li>
		              <a href="/cakephp/holidays/index">Holidays</a>            
		            </li>


		            <li>
		              <a href="/cakephp/notifications/index">Notifications</a>            
		            </li>

		            <li class="dropdown">
		              <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">Data<b class="caret"></b></a>              
		              <ul class="dropdown-menu">
		                <li><a href="/cakephp/countries">Manage Countries</a></li>
		                <li><a href="/cakephp/countries/add">Add New Country</a></li>
		                <li class="divider"></li>
		                <li><a href="/cakephp/states">Manage States</a></li>
		                <li><a href="/cakephp/states/add">Add New State</a></li>
		                <li class="divider"></li>
		                <li><a href="/cakephp/cities">Manages Cities</a></li>
		                <li><a href="/cakephp/cities/add">Add New City</a></li>
		              </ul>
		            </li>
					<?php endif; ?>      
		            <li><a href="/cakephp/logout">Logout</a></li>
		        </ul>
		      </div>
		    </div>
		  </div>
			
			<?php
			 echo nl2br("\n");
       		 echo nl2br("\n");
			 echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'',
					array('target' => '_blank', 'escape' => false, 'id' => 'cake-powered')
				);
			?>
			<p>
				<?php echo $cakeVersion; ?>
			</p>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
  <?php  echo $this->Js->writeBuffer();?>
</body>
</html>
