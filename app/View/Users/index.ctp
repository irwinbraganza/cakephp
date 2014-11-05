
<h2><?php echo __('Users'); ?></h2>
 <table>
    <thead>
        <tr>
            <th style="text-align: center;"><?php echo $this->Paginator->sort('firstname', 'First Name');?></th>
            <th style="text-align: center;"><?php echo $this->Paginator->sort('lastname', 'Last Name');?></th>
            <th style="text-align: center;"><?php echo $this->Paginator->sort('upload', 'Profile Pic');?></th>
            <th style="text-align: center;"><?php echo $this->Paginator->sort('dob', 'Date of Birth');?></th>

             <th style="text-align: center;"><?php echo $this->Paginator->sort('country_id', 'Country');?></th>
            <th style="text-align: center;"><?php echo $this->Paginator->sort('state_id', 'State');?></th>
            <th style="text-align: center;"><?php echo $this->Paginator->sort('city_id', 'City');?></th>
            
            
            <th style="text-align: center;"><?php echo $this->Paginator->sort('username', 'E-Mail');?></th>
            <th style="text-align: center;"><?php echo $this->Paginator->sort('contact', 'Contact');?></th>
            <th style="text-align: center;"><?php echo $this->Paginator->sort('doj', 'Joining Date');?></th>
            <th style="text-align: center;" class="actions"><center><?php echo __('Actions'); ?></center></th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <?php $count=0; ?>
        <?php foreach($users as $user): ?>                
        <?php $count ++;?>
        <?php if($count % 2): echo '<tr>'; else: echo '<tr class="zebra">' ?>
        <?php endif; ?>
            
            <td style="text-align: center;"><?php echo $user['User']['firstname']; ?></td>
            <td style="text-align: center;"><?php echo $user['User']['lastname']; ?></td>
            <td style="text-align: center;"><?php echo $this->Html->image('uploads/users/'.$user['User']['upload'], array('width'=>'100px','height'=>'115px')); ?></td>
            <td style="text-align: center;"><?php echo date("d-M-Y", strtotime($user['User']['dob'])); ?></td>
            <td style="text-align: center;"><?php echo $this->Html->link($user['Country']['name'], array('controller' => 'countries', 'action' => 'view',$user['User']['country_id'])); ?></td>
            <td style="text-align: center;"><?php echo $this->Html->link($user['State']['name'], array('controller' => 'states', 'action' => 'view',$user['User']['state_id'])); ?></td>
            <td style="text-align: center;"><?php echo $this->Html->link($user['City']['name'], array('controller' => 'cities', 'action' => 'view',$user['User']['city_id'])); ?></td>
            
            <td style="text-align: center;"><?php echo $user['User']['username']; ?></td>
            <td style="text-align: center;"><?php echo $user['User']['contact']; ?></td>
            <td style="text-align: center;"><?php echo date("d-M-Y", strtotime($user['User']['doj'])); ?></td>
            <td class="actions"><!-- 
            <?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?>
            <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id'])); ?>
            
            <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), array(), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> -->
            


            <?php echo $this->Html->image('view.png', array(
            'width'=>'15px','height'=>'15px',
            "alt" => "Edit",
            'url' => array('action' => 'view',  $user['User']['id'])
            ));?>

            <?php echo $this->Html->image('edit.gif', array(
            'width'=>'15px','height'=>'15px',
            "alt" => "Edit",
            'url' => array('action' => 'edit',  $user['User']['id'])
            ));?>
            
            <?php echo $this->Form->postLink(
              $this->Html->image('delete.png', array('alt' => __('Delete'),'width'=>'15px','height'=>'15px')), //le image
              array('action' => 'delete', $user['User']['id']), //le url
              array('escape' => false), //le escape
              __('Are you sure you want to delete # %s?', $user['User']['id']) //le confirm
            ); ?>
            
            </td>
        </tr>
        <?php endforeach; ?>
        <?php unset($user); ?>
    </tbody>
 </table>

    <p>
        <?php
            echo $this->Paginator->counter(array(
             'format' => __('Page {:page} of {:pages},
             showing {:current} records out of {:count} total, 
             starting on record {:start}, 
             ending on {:end}')
            ));
        ?>  
    </p>
    <div class="paging">
        <?php
            echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
            echo $this->Paginator->numbers(array('separator' => ''));
            echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
        ?>
    </div>

