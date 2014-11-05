<?php
class Event extends AppModel{
    var $name = 'Event';
    var $validate = array(
        'title' => array(
            'rule' => 'notEmpty',
            'message' => 'Title cannot be empty'
        )
    );
}