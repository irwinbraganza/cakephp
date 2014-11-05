<?php
App::uses('AppModel', 'Model');
/**
 * CheckinCheckout Model
 *
 */
class CheckinCheckout extends AppModel {

/**
 * Validation rules
 *
 * @var array
 * 
 * 
 * 
 */
    var $name='CheckinCheckout';
    var $belongsTo=array(
        'User'=>array(
            'classname'=>'User',
            'foreignKey'=>'user_id',
            'conditions'=>null,
    'fields'=>null
        ));
    
	public $validate = array(
		'uid' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'pin' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'date_time' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),

		'newpin' => array(
            'required' => array(
                'rule' => array('equalTo','reenternewpin'),
                'message' => 'Enter New Pin'
            )
        ),
         
        'reenternewpin' => array(
            'equaltofield' => array(
            'rule' => array('equaltofield','newpin'),
            'message' => 'Both pins must be same.',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            )
        )
    );

function equaltofield($check,$otherfield)
    {
        //get name of field
        $fname = '';
        foreach ($check as $key => $value){
            $fname = $key;
            break;
        }
        return $this->data[$this->name][$otherfield] === $this->data[$this->name][$fname];
    } 

	
}
