<?php $this->assign('title','Result') ?>


<?php //d($this->params['named']['params']['Register']); ?>


<div  id="result">
	<div style="margin-top: -20px;">
		<h3>Result</h3>

		<!--<p><b>Logit:</b> <?= $Logit ?> </p>-->
		<p><b>Probability:</b> <?= number_format((float)$CSprobability, 5, '.', '');  ?>% </p>

	</div>
</div>


