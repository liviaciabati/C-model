<?php
App::uses('AppController', 'Controller');
/**
 * Registers Controller
 **/
class RegistersController extends AppController {
	
	public $uses = array('Register');

	public function index() {
		
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		
		$params = $this->data;
		//echo "<pre>".print_r($this->data)."</pre>";

		$Parity = isset($params['Register']['parity']) ? $params['Register']['parity'] : null;
		$Prev_cs =  isset($params['Register']['previous_cs']) ? $params['Register']['previous_cs'] : null;
		$Multiples =  isset($params['Register']['multiples']) ? $params['Register']['multiples'] : null;
		$PIC =  isset($params['Register']['pic']) ? $params['Register']['pic'] : null;
		$FetPres =  isset($params['Register']['fetpres']) ? $params['Register']['fetpres'] : null;
		$PreTerm = isset($params['Register']['preterm']) ? $params['Register']['preterm'] : null;
		$Mat_Age =  isset($params['Register']['mat_age']) ? $params['Register']['mat_age'] : null;
		$Severity =  isset($params['Register']['severity']) ? $params['Register']['severity'] : null;
		$PlaPrev =  isset($params['Register']['placprev']) ? $params['Register']['placprev'] : null;
		$AbrPLac =  isset($params['Register']['abrplac']) ? $params['Register']['abrplac'] : null;
		$ChrHyp =  isset($params['Register']['chrhyp']) ? $params['Register']['chrhyp'] : null;
		$PreECLAM =  isset($params['Register']['preeclam']) ? $params['Register']['preeclam'] : null;
		$RenalD =  isset($params['Register']['renald']) ? $params['Register']['renald'] : null;
		$HIV =  isset($params['Register']['hiv']) ? $params['Register']['hiv'] : null;


		/*Condições modelos*/	
		if( $Parity!=null && $Prev_cs!=null && $Multiples!=null && $PIC!=null && $FetPres!=null && $PreTerm!=null 
		&& $Mat_Age==null && $Severity==null && $PlaPrev==null && $AbrPLac==null && $ChrHyp==null && $PreECLAM==null && $RenalD==null && $HIV==null ){
			/*C-Model v1.0*/
			$Beta = -3.392134;

			$x1 = -0.559968;
			$x2 = 2.842534;
			$x3 = 1.694844;
			$x4 = 2.747953;
			$x5 = 2.922391;
			$x6 = 0.368073;
			
			$Logit = $Beta + ($x1 * $Parity) + ($x2 * $Prev_cs) + ($x3 * $Multiples) + ($x4 * $PIC) + ($x5 * $FetPres) + ($x6 * $PreTerm);
			
			//echo "<br><br>C-Model v1.0 <br>"; 
			//echo $Logit . "<br>" ;
			
			$CSprobability = exp($Logit) / (1 + exp($Logit));
			
			//echo $CSprobability . "<br>" ;
			
		}else if( $Parity!=null && $Prev_cs!=null && $Multiples!=null && $PIC!=null && $FetPres!=null && $PreTerm!=null  && $Mat_Age!=null
		 && $Severity==null && $PlaPrev==null && $AbrPLac==null && $ChrHyp==null && $PreECLAM==null && $RenalD==null && $HIV==null ){
			/*C-Model v1.1*/
			$Beta = -
			3.992549;
			
			$x1 = -0.760441;
			$x2 = 2.873179;
			$x3 = 1.722743;
			$x4 = 2.708164;
			$x5 = 2.911992;
			$x6 = 0.364223;
			$x7 = 0.734265;
			
			$Logit = $Beta + ($x1 * $Parity) + ($x2 * $Prev_cs) + ($x3 * $Multiples) + ($x4 * $PIC) + ($x5 * $FetPres) + ($x6 * $PreTerm)
			+ ($x7 * $Mat_Age);	
			$CSprobability = exp($Logit) / (1 + exp($Logit));
			
			//echo "<br><br>C-Model v1.1 <br>";
			//echo $Logit;
			
		}else if( $Parity!=null && $Prev_cs!=null && $Multiples!=null && $PIC!=null && $FetPres!=null && $PreTerm!=null && $Mat_Age!=null && $Severity!=null 
		&& $PlaPrev==null && $AbrPLac==null && $ChrHyp==null && $PreECLAM==null && $RenalD==null && $HIV==null ){
			/*C-Model v1.2*/
			$Beta = -3.989357;
			
			$x1 = -0.76173;
			$x2 = 2.87813;
			$x3 = 1.721366;
			$x4 = 2.686502;
			$x5 = 2.9241;
			$x6 = 0.285275;
			$x7 = 0.728236;
			$x8 = 1.499462;
			
			$Logit = $Beta + ($x1 * $Parity) + ($x2 * $Prev_cs) + ($x3 * $Multiples) + ($x4 * $PIC) + ($x5 * $FetPres) + ($x6 * $PreTerm)
			+ ($x7 * $Mat_Age) + ($x8 * $Severity);	
			$CSprobability = exp($Logit) / (1 + exp($Logit));
			//echo "<br><br>C-Model v1.2 <br>";
			//echo $Logit;
		
		}else if( $Parity!=null && $Prev_cs!=null && $Multiples!=null && $PIC!=null && $FetPres!=null && $Mat_Age!=null && $Severity!=null 
		&& $PlaPrev!=null && $AbrPLac!=null && $ChrHyp!=null && $PreECLAM!=null && $RenalD!=null && $HIV!=null ){
			/*C-Model v1.3*/
			$Beta = -4.015252;
			
			$x1 = -0.77531;
			$x2 = 2.922222;
			$x3 =1.834027;
			$x4 =2.634921;
			$x5 = 2.985162;
			//$x6 = 0;
			$x7 = 0.71104;
			$x8 = 0.661417;
			$x9 = 3.796513;
			$x10 = 2.741255;
			$x11 = 0.561991;
			$x12 = 0.98718;
			$x13 = 1.301346;
			$x14 =	1.310211;
				
				
			$Logit = $Beta + ($x1 * $Parity) + ($x2 * $Prev_cs) + ($x3 * $Multiples) + ($x4 * $PIC) + ($x5 * $FetPres) + ($x7 * $Mat_Age)
			+ ($x8 * $Severity) + ($x9 * $PlaPrev) + ($x10 * $AbrPLac) + ($x11 * $ChrHyp) + ($x12 * $PreECLAM) + ($x13 * $RenalD) + ($x14 * $HIV);
			$CSprobability = exp($Logit) / (1 + exp($Logit));
			//echo "<br><br>C-Model v1.3 <br>"; 
			//echo $Logit;
	 	
		
		}else {
			/*Não se encaixou em nenhum dos modelos*/
			$this->Session->setFlash(__('All Obstetric Characteristics are required'),'flash_error');
			return $this->redirect('https://' . env('SERVER_NAME') .'/cmodel/registers/index');
			//return $this->redirect('https://' . env('SERVER_NAME') . $this->here);			
		}
		
		$this->Session->setFlash(__('Probability: '.number_format((float) $CSprobability*100 , 2, '.', '').'%'),'flash_success');
		return $this->redirect('https://' . env('SERVER_NAME') .'/cmodel/registers/index');
		//return $this->redirect(array('action' => 'index'));
		//return $this->redirect('https://' . env('SERVER_NAME') . $this->here);
		
	}
	

	
}
