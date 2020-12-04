<?php
//App::import('Vendor', 'SimpleExcel',['file' => 'simple/SimpleExcel.php']);
App::import('Vendor','PHPExcel',array('file' => 'excel/PHPExcel.php')); 
App::import('Vendor','PHPExcelWriter',array('file' => 'excel/PHPExcel/Writer/Excel2007.php')); 
App::uses('AppController', 'Controller');

/**
 * Uploads Controller
 *
 * @property Upload $Upload
 * @property PaginatorComponent $Paginator
 */
class UploadsController extends AppController {

	public $uses = array('Upload'); 

	public function index() {


	}
/**
 * add method
 *
 * @return void
 */
	public function results() {
		if ($this->request->is('post')) {
			$this->Upload->create();
		;
			//d($this->request->data);		
			$csv_mimetypes = array(
		    'text/csv', 'text/plain', 'application/csv', 'text/comma-separated-values', 'application/excel', 'application/vnd.ms-excel', 'application/vnd.msexcel', 'text/anytext', 'application/octet-stream', 'application/txt', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
			);

			$file = $this->request->data['Upload']['file'];		
       			//echo "<br/> ".$type;	
			if (in_array($file['type'], $csv_mimetypes))
			{
				if ($this->uploadFile() && $this->Upload->save($this->request->data)) {
					$this->Session->setFlash(__('The upload has been saved.'),'flash_success');
					//return $this->redirect(array('url' => 'results'));
				} else {
					$this->Session->setFlash(__('The upload could not be saved. Please, try again.'),'flash_error');
					return $this->redirect(array('url' => 'index'));
				}
			}
			else{
					$this->Session->setFlash(__('teste '.$file['type'].'Wrong type file. Please, try again with "csv" or "xls".'),'flash_error');
					return $this->redirect(array('url' => 'index'));
			}

		}
	}

	function uploadFile() {
		$file = $this->request->data['Upload']['file'];
		if ($file['error'] === UPLOAD_ERR_OK) {
			//$id = String::uuid();
			$extension = pathinfo($file['name'], PATHINFO_EXTENSION);
			$date = date( "d-m-Y H.i.s");
			$filePath = APP.'uploads'.DS.$date.'.'.$extension;
			//echo '<br/><br/><br/><br/><br/>teste '.$extension;
			//$filePath = APP.'uploads'.DS.$file['name'];

			if (move_uploaded_file($file['tmp_name'], $filePath)) {	 
			  	$this->request->data['Upload']['filename'] = $file['name'];
			  	$this->request->data['Upload']['filesize'] = $file['size'];
			  	//echo $filePath;
			  	$this->read_csv( $filePath, $extension);
			
			  	return true;
			}
		}
		return false;
	}

    function read_csv( $filePath, $extension ) { 

    	$headers = ["parity","previous_cs","multiples","pic", "fetpres", "preterm","mat_age","severity","placprev","abrplac", "chrhyp","preeclam","renald","hiv","delivery"];
        $headers2 = ["parity","previous c section","multiple pregnancy","pic","presentation","preterm birth","maternal age","organ dysfunction or icu","placenta praevia","abruptio placentae","chronic  hipertension","pre-eclampsia","renal disease","hiv","delivery"];
        $this->xls = new PHPExcel(); 
        $this->sheet = $this->xls->getActiveSheet(); 
        
        if($extension === "xls"){
			$inputFileType = 'Excel5';
		}
		else if($extension === "xlsx"){
			$inputFileType = 'Excel2007';
		}
        else{
	        $inputFileType = 'CSV';
	    }

		//$inputFileName = $filePath;
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load($filePath);
        
		$worksheet = $objPHPExcel->getActiveSheet();
		$followPattern = False;

		//array de contagem do modelo; indice 4 se refere a linhas que nao se encaixaram em nenhum modelo
		$modelo = [0, 0, 0, 0, 0];
		$probTotal = 0;
		$linhas = 0;
		$list = [];
		$totalPositivo = 0;
		$totalNegativo = 0;

		foreach ($worksheet->getRowIterator() as $row) 
		{
	    	$cellIterator = $row->getCellIterator();
	    	$cellIterator->setIterateOnlyExistingCells(false);
			//echo $row->getRowIndex() . "</br>";
			if($row->getRowIndex() == 1)
			{
		    	foreach ($cellIterator as $cell) {
				//echo $headers[PHPExcel_Cell::columnIndexFromString($cell->getColumn()) - 1] . "</br>";
				//echo $cell->getValue() . "</br>";
			        if (!is_null($cell)) {
			        	if( trim(strtolower($cell->getValue())) == trim($headers[PHPExcel_Cell::columnIndexFromString($cell->getColumn()) - 1])
			        	||  trim(strtolower($cell->getValue())) == trim($headers2[PHPExcel_Cell::columnIndexFromString($cell->getColumn()) - 1]) )
			        	{
			            	$followPattern = True;
			        		//echo "<br/>".$cell->getValue();
			        	}
			        	else{
			        		//echo "<br/>".$cell->getValue();
			        		$followPattern = False;
			        		break;
			        	}
			    	}
		        }
			}
			//echo "</br>" . ($followPattern);
			if($followPattern === True && $row->getRowIndex() > 1)
			{
			    $cellIterator = $row->getCellIterator();
			    $cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			    $param = []; 
			    $i = 0;

			    foreach ($cellIterator as $cell) {
		    		$param[$i] =  $cell->getValue();
		            //echo 'Cell: ' . $cell->getCoordinate() . ' - ' . $cell->getValue() . "</br>\r\n";
		            //echo $param[$i];
		            $i++;
			    }
 
		        $retorno = $this->calcProb($param);

		        if($retorno['Str_Erro'] !== ''){
					$this->Session->setFlash(__('The follow variables are out of bounds, please correct it and resubmit for results.' . $retorno['Str_Erro']),'flash_error');

					//DELETAR ESSE ARQUIVO
					return $this->redirect(array('url' => 'index'));
		        }

				//echo "<pre>".print_r($retorno)."</pre>";
		        if($retorno['Model'] == 0){
		        	$modelo[0]++; 
		        	//echo $modelo[0];
		        }
		        else if($retorno['Model'] == 1){
		        	$modelo[1]++;
		        	//echo $modelo[1];
		        }
		        else if($retorno['Model'] == 2){
		        	$modelo[2]++;
		        	//echo $modelo[2];
		        }
		        else if($retorno['Model'] == 3){
		        	$modelo[3]++;
		        	//echo $modelo[3];
		        }
		        else if($retorno['Model'] == 4){
		        	$modelo[4]++;
		        	//echo $modelo[4];
		        }

				$probTotal = $probTotal + $retorno['CSprobability'];
				//print_r($param);
				//echo ( ($param[$i-1] == "1" ? 'true' : 'false') . " ".(string)$param[$i-1] . "<br/>");
				if($param[$i-1] === "PC" || $param[$i-1] == "1")
				{
					$classe = 1;
					$totalPositivo++;
				}
				else
				{
					$classe = -1;
					$totalNegativo++;
				}

				array_push($list,['probs'=> $retorno['CSprobability']*100, 'classe' => $classe]);

				$linhas++;
				//echo "<br>". $linhas;
				//$retorno['CSprobability'] = $CSprobability;
				//$retorno['Model'] = $modelo;
			}
			else if($followPattern === False)
			{
				$this->Session->setFlash(__('The file does not have the right pattern, please correct it and resubmit for results.'),'flash_error');

				//DELETAR ESSE ARQUIVO
				return $this->redirect(array('url' => 'index'));
			}
		}

		//echo "<pre>".print_r($modelo)."</pre>";
		foreach ($modelo as &$val) {
			$val = $val/$linhas;
			//echo "<br>".$val;
		}
		$probTotal = $probTotal/$linhas;

		$downRange = $probTotal * 0.75;
		$upRange = $probTotal * 1.25;

		/*echo "<pre>".print_r($modelo)."</pre>";
		echo $probTotal."</br>";
		echo $linhas."</br>";
		echo $downRange."</br>";
		echo $upRange."</br>";*/
		$this->set('Modelo', $modelo);
		$this->set('total', $linhas);
		$this->set('probTotal', $probTotal);
		$this->set('downRange', $downRange);
		$this->set('upRange', $upRange);

		$listSorted = $list; 
		usort($listSorted, function($a, $b) {
			    return $a['probs'] - $b['probs'];
			});

		//$this->set('stringROC', $this->calcROC($listSorted, $totalPositivo, $totalNegativo));
		$this->calcROC($listSorted, $totalPositivo, $totalNegativo);
		//$this->areaUnderCurve($listSorted, $totalPositivo, $totalNegativo);
		$this->set('totalCsection', $totalPositivo);

		//echo "<br /><pre>".print_r($this->calcROC($list, $totalPositivo, $totalNegativo))."</pre>";
		//echo "<br />".($this->calcROC($list, $totalPositivo, $totalNegativo));
    } 

    function calcProb($params)
    {
    	$error_log = '';

    	if(is_int(intval($params[0])) && intval($params[0]) <= 2){
			$Parity 	= (int)  $params[0];
    	}
    	else if(is_int(intval($params[0])) && intval($params[0]) > 2)
    	{
    		$Parity = null;
    		$error_log = $error_log .'<br/>Parity';
    	}

		if(is_int(intval($params[1])) && (int)$params[1] <= 2){
			$Prev_cs 	= $params[1] ;
    	}
    	else if(is_int(intval($params[1])) && (int)$params[1] > 2)
    	{
    		$Prev_cs = null;
    		$error_log = $error_log .'<br/>Previous C-section';
    	}
    	if(is_int(intval($params[2])) && (int)$params[2] <= 1){
			$Multiples 	= $params[2] ;
    	}
    	else if(is_int(intval($params[2])) && (int)$params[2] > 1)
    	{
    		$Multiples = null;
    		$error_log = $error_log .'<br/>Multiple pregnancy';
    	}
    	if(is_int(intval($params[3])) && (int)$params[3] <= 1){
			$PIC 		= $params[3] ;
    	}
    	else if(is_int(intval($params[3])) && (int)$params[3] > 1)
    	{
    		$PIC = null;
    		$error_log = $error_log .'<br/>Provider-initiated childbirth';
    	}
    	if(is_int(intval($params[4])) && (int)$params[4] <= 2){
			$FetPres 	= $params[4] ;
    	}
    	else if(is_int(intval($params[4])) && (int)$params[4] > 2)
    	{
    		$FetPres = null;
    		$error_log = $error_log .'<br/>Presentation';
    	}
    	if(is_int(intval($params[5])) && (int)$params[5] <= 1){
			$PreTerm 	= $params[5] ;
    	}
    	else if(is_int(intval($params[5])) && (int)$params[5] > 1)
    	{
    		$PreTerm = null;
    		$error_log = $error_log .'<br/>Preterm birth';
    	}
    	if(is_int(intval($params[6])) && (int)$params[6] <= 2){
			$Mat_Age 	= $params[6] ;
    	}
    	else if(is_int(intval($params[6])) && (int)$params[6] > 2)
    	{
    		$Mat_Age = null;
    		$error_log = $error_log .'<br/>Maternal Age';
    	}
    	if(is_int(intval($params[7])) && (int)$params[7] <= 1){
			$Severity 	= $params[7] ;
    	}
    	else if(is_int(intval($params[7])) && (int)$params[7] > 1)
    	{
    		$Severity = null;
    		$error_log = $error_log .'<br/>Organ Dysfunction or ICU admission';
    	}
    	if(is_int(intval($params[8])) && (int)$params[8] <= 1){
			$PlaPrev 	= $params[8] ;
    	}
    	else if(is_int(intval($params[8])) && (int)$params[8] > 1)
    	{
    		$PlaPrev = null;
    		$error_log = $error_log .'<br/>Placenta Praevia ';
    	}
    	if(is_int(intval($params[9])) && (int)$params[9] <= 1){
			$AbrPLac 	= $params[9] ;
    	}
    	else if(is_int(intval($params[9])) && (int)$params[9] > 1)
    	{
    		$AbrPLac = null;
    		$error_log = $error_log .'<br/>Abruptio Placentae';
    	}
    	if(is_int(intval($params[10])) && (int)$params[10] <= 1){
			$ChrHyp 	= $params[10];
    	}
    	else if(is_int(intval($params[10])) && (int)$params[10] > 1)
    	{
    		$ChrHyp = null;
    		$error_log = $error_log .'<br/>Chronic hypertension';
    	}
    	if(is_int(intval($params[11])) && (int)$params[11] <= 2){
			$PreECLAM = $params[11];
    	}
    	else if(is_int(intval($params[11])) && (int)$params[11] > 2)
    	{
    		$PreECLAM = null;
    		$error_log = $error_log .'<br/>Pre-eclampsia';
    	}
    	if(is_int(intval($params[12])) && (int)$params[12] <= 1){
			$RenalD = $params[12];
    	}
    	else if(is_int(intval($params[12])) && (int)$params[12] > 1)
    	{
    		$RenalD = null;
    		$error_log = $error_log .'<br/>Renal Disease';
    	}
    	if(is_int(intval($params[13])) && (int)$params[13] <= 1){
			$HIV = $params[13];
    	}
    	else if(is_int(intval($params[13])) && (int)$params[13] > 1)
    	{
    		$HIV = null;
    		$error_log = $error_log .'<br/>HIV';
    	}


		///echo "<pre>".print_r($params)."</pre>";
		/*Condições modelos*/	
		if( $Parity!==null && $Prev_cs!==null && $Multiples!==null && $PIC!==null && $FetPres!==null && $Mat_Age!==null && $Severity!==null 
		&& $PlaPrev!==null && $AbrPLac!==null && $ChrHyp!==null && $PreECLAM!==null && $RenalD!==null && $HIV!==null ){
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
			$modelo = 3;
			//echo "<br><br>C-Model v1.3 <br>"; 
			//echo $Logit;
	 	
		} else if( $Parity!==null && $Prev_cs!==null && $Multiples!==null && $PIC!==null && $FetPres!==null && $PreTerm!==null && $Mat_Age!==null && $Severity!==null 
		//&& $PlaPrev===null && $AbrPLac===null && $ChrHyp===null && $PreECLAM===null && $RenalD===null && $HIV===null 
		){
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
			$modelo = 2;
			//echo "<br><br>C-Model v1.2 <br>";
			//echo $Logit;
		
		}else if( $Parity!==null && $Prev_cs!==null && $Multiples!==null && $PIC!==null && $FetPres!==null && $PreTerm!==null  && $Mat_Age!==null
		 //&& $Severity===null && $PlaPrev===null && $AbrPLac===null && $ChrHyp===null && $PreECLAM===null && $RenalD===null && $HIV===null 
		 ){
			/*C-Model v1.1*/
			$Beta = -3.992549;
			
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
			$modelo = 1;
			
		}else if( $Parity!==null && $Prev_cs!==null && $Multiples!==null && $PIC!==null && $FetPres!==null && $PreTerm!==null 
		//&& $Mat_Age===null && $Severity===null && $PlaPrev===null && $AbrPLac===null && $ChrHyp===null && $PreECLAM===null && $RenalD===null && $HIV===null 
		){
			/*C-Model v1.0*/
			$Beta = -3.392134;

			$x1 = -0.559968;
			$x2 = 2.842534;
			$x3 = 1.694844;
			$x4 = 2.747953;
			$x5 = 2.922391;
			$x6 = 0.368073;
			
			$Logit = $Beta + ($x1 * $Parity) + ($x2 * $Prev_cs) + ($x3 * $Multiples) + ($x4 * $PIC) + ($x5 * $FetPres) + ($x6 * $PreTerm);
			$CSprobability = exp($Logit) / (1 + exp($Logit));
			$modelo = 0;
			
			//echo "<br><br>C-Model v1.0 <br>"; 
			//echo $Logit . "<br>" ;
			
			//echo $CSprobability . "<br>" ;
			
		}
		else {
			/*Não se encaixou em nenhum dos modelos*/
			$Logit = 0;
			$modelo = 4;
			$CSprobability = 0;
		}
		//echo " </br> Logit" . $Logit;
		//echo " </br> modelo" .  $modelo;
		//echo " </br> CSprobability" .  $CSprobability*100  	."</br>" ;

		//retorno['Logit'] = $Logit;
		$retorno['CSprobability'] = $CSprobability;
		$retorno['Model'] = $modelo;
		$retorno['Str_Erro'] = $error_log;

		return $retorno;
		//echo "<pre>".print_r($retorno)."</pre>";
		//$this->set('Logit',$Logit);
		//$this->set('CSprobability',$CSprobability*100);
		//$this->set('Model', $modelo);
	}
	
	function calcROC($list, $totalPositivo, $totalNegativo)
	{
		//echo "<br /> positivo  " .  $totalPositivo;
		//echo "<br /> negativo  " .  $totalNegativo;
		if($totalPositivo > 0 && $totalNegativo > 0)
		{
			$falsePositive = 0;
			$truePositive = 0;
			$falsePositivePrev = 0;
			$truePositivePrev = 0;
			$roc = [];
			$area = 0;
			$probPrev = -99999;
			$i = 0;

			while ($i < count($list))
			{
				if($list[$i]['probs'] != $probPrev)
				{
					array_push($roc, [$falsePositive/$totalNegativo, $truePositive/$totalPositivo]);
					//$probPrev = $list[$i]['probs'];

					//echo "<br/> falsePositive, falsePositivePrev, truePositive, truePositivePrev ".$falsePositive.", ".$falsePositivePrev.", ".$truePositive.", ".$truePositivePrev;
					$area += $this->trapezoide($falsePositive, $falsePositivePrev, $truePositive, $truePositivePrev);
					//echo "<br /> area:  ".$area;
					$probPrev = $list[$i]['probs'];
					$falsePositivePrev = $falsePositive;
					$truePositivePrev = $truePositive;
				}

				if($list[$i]['classe'] > 0)
				{
					$truePositive++;
				}
				else
				{
					$falsePositive++;
				}
				$i++;
			}
			array_push($roc, [$falsePositive/$totalNegativo, $truePositive/$totalPositivo]);

			$area = $area + $this->trapezoide(1, $falsePositivePrev, 1, $truePositivePrev);
			$area = $area/($totalPositivo * $totalNegativo);
			//convert to string for the chart
			$stringRoc = "";
			$j = 0;
			foreach ($roc as $key => $value) {
				$stringRoc = $stringRoc."[".$value[1].", ". $value[0]."],";
			}

			$this->set('stringROC', $stringRoc);
			$this->set('area', $area);

			return $stringRoc;
		}
	}

	// function areaUnderCurve($list, $totalPositivo, $totalNegativo)
	// {
	// 	if($totalPositivo > 0 && $totalNegativo > 0){

	// 		$falsePositive = 0;
	// 		$truePositive = 0;
	// 		$falsePositivePrev = 0;
	// 		$truePositivePrev = 0;
	// 		$area = 0;
	// 		$i = 0;
	// 		$probPrev = -999999;

	// 		while ($i < count($list))
	// 		{

	// 			if($list[$i]['probs'] != $probPrev)
	// 			{
	// 				$area = $area + $this->trapezoide($falsePositive, $falsePositivePrev, $truePositive, $truePositivePrev);
	// 				$probPrev = $list[$i]['probs'];
	// 				$falsePositivePrev = $falsePositive;
	// 				$truePositivePrev = $truePositive;
	// 			}
	// 			if($list[$i]['classe'] > 0)
	// 			{
	// 				$truePositive++;
	// 			}
	// 			else
	// 			{
	// 				$falsePositive++;
	// 			}
	// 			$i++;
	// 		}
	// 		$area = $area + $this->trapezoide(1, $falsePositivePrev, 1, $truePositivePrev);
	// 		$area = $area/($totalPositivo * $totalNegativo);

	// 		$this->set('area', $area);
	// 		//echo $area;
	// 	}
	// }

	function trapezoide($x1, $x2, $y1, $y2)
	{
		//echo "<br/> x1, x2, y1, y2 </br>".$x1.", ".$x2.", ". $y1.", ".$y2;
		if($x1 > 0 && $x1===$x2)
		{
			$base = 1;
		}
		else {
			$base = abs($x1 - $x2);
		}
		
		$heigh = ($y1 + $y2)/2;
		$area = $base * $heigh;
		//echo "<br /> ".$area. " = " .$base." * ".$heigh." --- " ;
					
		return $area;
	}
}
