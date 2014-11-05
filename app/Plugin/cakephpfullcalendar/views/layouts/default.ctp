<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php __('CakePHP: the rapid development php framework:'); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
        
        echo $this->Html->script('jquery-1.7.1.min.js');
        echo $this->Html->script('jquery.ui.core.js');
        echo $this->Html->script('jquery.ui.widget.js');
        echo $this->Html->script('jquery.ui.mouse.js');
        echo $this->Html->script('jquery.ui.resizable.js');
        echo $this->Html->script('jquery.ui.draggable.js');
        
        echo $this->Html->script('fullcalendar.min.js');
        echo $this->Html->css('fullcalendar');
        
		echo $scripts_for_layout;
	?>

</head>
<body>
	<div id="container">
		<div id="header">
			<?php if ($this->Session->read('Auth.User')):?>
                <?=$this->Html->link('logout', array('controller' => 'users', 'action' => 'logout'), array('style' => 'color:#fff'))?>
            <?php else:?>
                <?=$this->Html->link('login', array('controller' => 'users', 'action' => 'login'), array('style' => 'color:#fff'))?>  or
                <?=$this->Html->link('register', array('controller' => 'users', 'action' => 'register'), array('style' => 'color:#fff'))?>  
            <?php endif?>
            
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $content_for_layout; ?>

		</div>
		<div id="footer"></div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>