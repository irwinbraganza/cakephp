<?php
class Event extends AppModel{
    
    var $validate = array(
        'title' => array(
            'rule' => 'notEmpty',
            'message' => 'Title cannot be empty'
        )
    );
}