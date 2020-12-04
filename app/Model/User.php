<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 */
class User extends AppModel {
	
	
		public $validate = array(
        'username' => array(
            'rule' => 'notEmpty',
			
        ),
        'password' => array(
            'rule' => 'notEmpty',
			
        )
    );
	
	public function beforeSave($options = array()){
		if(isset($this->data[$this->alias]['password'])){
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		return parent::beforeSave($options);
	}

}
