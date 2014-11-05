<?php
App::uses('AppModel', 'Model');
/**
 * Leave Model
 *
 */
class Leave extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
     var $name='Leave';
    var $belongsTo=array(
        'User'=>array(
            'classname'=>'User',
            'foreignKey'=>'user_id',
            'conditions'=>null,
            'fields'=>null),
        'Holiday'=>array(
            'classname'=>'Holiday',
            'foreignKey'=>'holiday_id',
            'conditions'=>null,
            'fields'=>null)
        );


    var $validate = array(
        'reason' => array(
           'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Reason Required'
        ))

        );
	
	 
}
