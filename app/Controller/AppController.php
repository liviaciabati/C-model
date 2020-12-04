<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
#Kint: debugger bunitinho: https://github.com/raveren/kint.git
require_once(APP.'Vendor'.'/kint/Kint.class.php');
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $components = array(
			'Session',
	        'Auth' => array(
	            'loginRedirect' => array('controller' => 'pages', 'action' => 'display','home'),
	            'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'login')
			)
        );
		
	public $helpers = array('Html','Form','Paginator','Time',
		'HtmlTB'=>array('className'=>'TwitterBootstrap.BootstrapHtml'),
		'FormTB'=>array('className'=>'TwitterBootstrap.BootstrapForm'),
		'PaginatorTB'=>array('className'=>'TwitterBootstrap.BootstrapPaginator')
	);
		
	function beforeFilter() {
	/*	
		if($this->params->controller=='pages' &&( $this->params->pass[0]=='home' || $this->params->pass[0]=='calculadora' || $this->params->pass[0]=='upload')){
			$this->Auth->deny(array('controller' => 'pages', 'action' => 'display'));
		}else{
			$this->Auth->allow(array('controller' => 'pages', 'action' => 'display'));
		}
*/
		
		$this->Auth->allow();

    }
		
	
}


