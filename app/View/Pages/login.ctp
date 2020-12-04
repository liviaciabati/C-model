<?php $this->layout = 'layout_login'; 
$this->assign('title','Login') ?> 
 
<body  style="background: #596778; margin-top: 20px;">

    <div class="form-box" id="login-box">
	
	<div class="header"><b>Acessar</b></div>


	<div class="body bg-white">	
		<br>
		<?= $this->Form->create('User',array('action'=>'login')) ?>
		<?= $this->Form->input('User.username',array('label'=>false,'placeholder'=>'Usuário','class'=>'sign-up-input')) ?>		
		<?= $this->Form->input('User.password',array('label'=>false,'placeholder'=>'Senha','class'=>'sign-up-input')) ?>
	</div>
	
	<div class="footer">                                                               
		<button type="submit" class="btn btn-primary btn-block">Logar</button>  

		<p><a href="#">Esqueci minha senha</a></p>
		
		<?= $this->Session->flash(); ?>
	</div>

	<?= $this->Form->end(); ?>
			

    </div>
		

</body>
