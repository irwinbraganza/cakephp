<?php
/**
 *
 * PHP 5
 *
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

?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	  		
	<title>
		<?php echo __('Office Solutions: Login Page'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('bootstrap3');
		echo $this->Html->css('jquery.confirmon');
	?>
<!--	<style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }
    </style> -->
	<?php
	echo $this->Html->css('bootstrap-responsive');
    echo $this->Html->css('auth');
  	echo $this->fetch('meta');
	echo $this->fetch('css');
  ?>
  <?php
    echo $this->Html->script('lib/jquery-1.10.2');
    echo $this->Html->script('lib/jquery.confirmon');
	echo $this->Html->script('lib/bootstrap');
    echo $this->Html->script('auth');
    echo $this->Html->script('notify');
    echo $this->Html->script('date');
	echo $this->fetch('script');
	?>
</head>
<body>
	<div class="container">
		<div id="content">
			<?php if ($this->Session->check('Message.flash')): ?>
	            <div class="alert alert-info">
	              <?php echo $this->Session->flash(); ?>
	            </div>
	      	<?php endif; ?>
			<?php echo $this->fetch('content'); ?>
		</div>
	</div>

</body>
</html>
