<?php $this->assign('title','Upload') ?>

<section class="content-header">
	<h1>
		Send database
		<small></small>
	</h1>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<!-- left column -->
		<div class="col-md-6">
			<!-- general form elements -->
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Submit database</h3>
				</div><!-- /.box-header -->
				<!-- form start -->
	
				<?php echo $this->FormTB->create('Upload', array(
					'inputDefaults' => array(
						'div' => 'form-group',
						'wrapInput' => false,
						'class' => 'form-control',
						'label' => false
					),
					'type'=>'file',
					'action' => 'results'
				)); ?>				
				<div class="box-body">
					<div class="form-group">
						<?= $this->FormTB->input('email', array('label'=>'E-mail','type' => 'email', 'class'=>'form-control' )) ?>
					</div>
					<div class="form-group">
						<label for="file">Select file</label>
						<?=$this->FormTB->input('file',['type'=>'file','class'=>'']) ?>
					</div>

		            <div class="form-group" style="margin-left:1.5em">
		                <?= $this->FormTB->input('allow',array('type' => 'checkbox','class'=>'form-control icheckbox_minimal' ,'label'=>'I agree that these data are stored and used for further development of C-Model', 'checked'=>'true')) ?>
		            </div>  
				</div><!-- /.box-body --> 
				<div class="box-footer">
				<?=$this->FormTB->button('<span class="glyphicon glyphicon-saved"></span> Send',['type'=>'submit','class'=>'btn btn-primary']) ?>
				</div>
				<?=$this->FormTB->end() ?>
			</div>
			</div><!-- /.box -->

		<div class="col-md-6">
			<!-- general form elements -->
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Pattern to submit a database</h3>
				</div><!-- /.box-header -->
				<div class="box-body">
				<b> To submit a file, please, follow the pattern: </b>
		            <dl>
		                <dt>Headers</dt>
		                <dd>The headers file must follow the sequence:
		                	<br/>"parity", "previous c section", "multiple pregnancy", "pic", "presentation", "preterm birth", "maternal age", "organ dysfunction or icu", "placenta praevia", "abruptio placentae", "chronic  hipertension", "pre-eclampsia", "renal disease", "hiv", "delivery";<br /> or <br />
		                	"parity", "previous_cs", "multiples", "pic", "fetpres", "preterm", "mat_age", "severity", "placprev", "abrplac", "chrhyp", "preeclam", "renald", "hiv", "delivery";</dd>
		                	<br /><br />
		                <dt>Variables</dt>
		            </dl>
		            <dl class="dl-horizontal">
						<dt>Parity  <br />(Parity)<dt>	
						<dd>0: 0 previous births <br />
						1: 1-2 previous births <br />
						2: >2 previous births<dd> <br />
						<dt>Previous C-section <br /> (Prev_CS)<dt>	
						<dd>0: 0 previous C-section <br />
						1: 1 previous C-section <br />
						2: >1  previous C-section<dd> <br />
						<dt>Multiple pregnancy  <br />(Multiples)<dt>	
						<dd>0: singleton pregnancy <br />
						1: multiple pregnancy<dd> <br />
						<dt>Provider-initiated childbirth  <br />(PIC)<dt>	
						<dd>0: spontaneous labour <br />
						1: Induced labour / Caesarean-section before labour<dd> <br />
						<dt>Presentation  <br />(FetPres)<dt>	
						<dd>0: cephalic <br />
						1: breech <br />
						2: other / transverse lie <br />
						<b>Obs. In twin gestation, use presentation of the first twin</b>
						<dd> <br />
						<dt>Preterm birth  <br />(PreTerm)<dt>	
						<dd>0: Gestational age ≥ 37weeks <br />
						1: Gestational age < 37 weeks<dd> <br />
						<dt>Maternal Age  <br />(Mat_Age)<dt>	
						<dd>0: <20 years <br />
						1: 20-34 years <br />
						2: >34 years<dd> <br />
						<dt>Organ Dysfunction or ICU admission  <br />(Severity)<dt>	
						<dd>0: absence of organ dysfunction or ICU admission <br />
						1: presence of organ dysfunction or ICU admission<dd> <br />
						<dt>Placenta Praevia  <br />(PlacPrev)<dt>	
						<dd>0: No <br />
						1: Yes<dd> <br />
						<dt>Abruptio Placentae  <br />(AbrPlac)<dt>	
						<dd>0: No <br />
						1: Yes<dd> <br />
						<dt>Chronic hypertension  <br />(ChrHyp)<dt>	
						<dd>0: No <br />
						1: Yes<dd> <br />
						<dt>Pre-eclampsia  <br />(PreECLAM)<dt>	
						<dd>0: Absence of Preeclampsia / Eclampsia <br />
						1: Presence of Preeclampsia <br />
						2: Presence of Eclampsia<dd> <br />
						<dt>Renal disease  <br />(RenalD)<dt>	
						<dd>0: No <br />
						1: Yes<dd> <br />
						<dt>HIV  <br />(HIV)<dt>	
						<dd>0: No <br />
						1: Yes<dd> <br />
						<dt>Delivery  <br />(delivery)<dt>	
						<dd>0: Vaginal delivery <br />
						1: C-section<dd> <br />
						<dt>Missing values  <br /><dt>	
						<dd>Leave the field blank<br /><dd> <br />
		            </dl>
	        </div>
		</div>
	</div>   <!-- /.row -->
</section><!-- /.content -->
            