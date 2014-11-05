<?php
App::uses('AppModel', 'Model');
/**
 * Cupcake Model
 *
 */
class Cupcake extends AppModel {

    var $name = 'Cupcake';

    var $belongsTo = array(
        'User' => array(
            'classname' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => null,
			'fields' => null
    ));
}
