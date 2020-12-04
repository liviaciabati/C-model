<?php $this->assign('title','Calculadora') ?>
<!-- Main content -->

<!-- <section class="content-header">
    <h1>
        C-Model
        <small></small>
    </h1>
</section> -->
<section class="content">
    <div class="box-body">                        
        <div class="callout callout-info">
            <h4>Select the relevant conditions to calculate the C-Section probability.</h4>
        </div>
    </div>
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Welcome to C-Model</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                       <p>Here you will find an easy way to calculate the probability of C-section.</p>
					   <p>The following boxes contain options for labor evaluation</p>
					   <p>Press the buttons that suit better the woman condition, then press the "Get Probability" button and wait for the result.</p>
                    </div>
                </div>
            <div class="box box-warning">
                <div class="box-header">
                    <h3 class="box-title">Obstetric Characteristics</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                   <?php echo $this->FormTB->create('Register', array('url' => 'add')); ?>

                        <?php echo $this->Form->label('Parity');?>
                        <!-- text input -->
                        <div class="form-group">
                            <div class="btn-group" data-toggle="buttons">
                                <?= $this->FormTB->input('parity',['label'=>false,'hiddenField'=>false,'type'=>'radio','options'=>[0=>'0',1=>'1 or 2',2=>'>2'],'radioLabelClass'=>'btn btn-default' ,'div'=>false]); ?>
                            </div>
                        </div>
                        
                        <label>Previous C-section</label>
                        <div class="form-group">
                            <div class="btn-group" data-toggle="buttons">
                                <?= $this->FormTB->input('previous_cs',['label'=>false,'hiddenField'=>false,'type'=>'radio','options'=>[0=>'0',1=>'1',2=>'>1'],'radioLabelClass'=>'btn btn-default' ,'div'=>false]); ?>
                            </div>
                        </div>

                        <label>Multiple pregnancy</label>
                        <div class="form-group">
                            <div class="btn-group" data-toggle="buttons">
                                <?= $this->FormTB->input('multiples',['label'=>false,'hiddenField'=>false,'type'=>'radio','options'=>[0=>'Singleton',1=>'Multiple'],'radioLabelClass'=>'btn btn-default' ,'div'=>false]); ?>
                            </div>

                        </div>

                            <label>Provider&#8211;initiated childbirth</label>
                        <div class="form-group">
                            <div class="btn-group" data-toggle="buttons">
                                <?= $this->FormTB->input('pic',['label'=>false,'hiddenField'=>false,'type'=>'radio','options'=>[0=>'Spontaneous labour',1=>'Induced / Caesarean section before labour'],'radioLabelClass'=>'btn btn-default' ,'div'=>false]); ?>
                            </div>
                        </div>

                        <label>Presentation</label>
                        <div class="form-group">
                            <div class="btn-group" data-toggle="buttons">
                                <?= $this->FormTB->input('fetpres',['label'=>false,'hiddenField'=>false,'type'=>'radio','options'=>[0=>'Cephalic',1=>'Breech',2=>'Other / transverse lie'],'radioLabelClass'=>'btn btn-default' ,'div'=>false]); ?>
                            </div>
                        </div>
                        
                        <label>Preterm birth</label>
                        <div class="form-group">
                            <div class="btn-group" data-toggle="buttons">
                                <?= $this->FormTB->input('preterm',['label'=>false,'hiddenField'=>false,'type'=>'radio','options'=>[0=>'Gestational age ≥ 37 weeks',1=>'Gestational age < 37 weeks'],'radioLabelClass'=>'btn btn-default' ,'div'=>false]); ?>
                            </div>
                        </div>
                   
                    </div>
                </div>
             </div><!-- /.box -->
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                
            </div><!-- /.box -->
            <div class="col-md-6">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">Demographics and Severity</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                       
                        <!-- text input -->
                        <label>Maternal Age</label>
                        <div class="form-group">
                            <div class="btn-group" data-toggle="buttons">
                                <?= $this->FormTB->input('mat_age',['label'=>false,'hiddenField'=>false,'type'=>'radio','options'=>[0=>'&lt20 years',1=>'20-34 years',2=>'>34 years'],'radioLabelClass'=>'btn btn-default' ,'div'=>false]); ?>
                            </div>
                        </div>
                        
                            <label>Organ Dysfunction or ICU admission</label>
                        <div class="form-group">
                            <div class="btn-group" data-toggle="buttons">
                                <?= $this->FormTB->input('severity',['label'=>false,'hiddenField'=>false,'type'=>'radio','options'=>[0=>'Absence of organ dysfunction or ICU admission',1=>'Presence of organ dysfunction or ICU admission'],'radioLabelClass'=>'btn btn-default' ,'div'=>false]); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Complications</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                
                            <label>Placenta Praevia</label>
                        <div class="form-group">
                            <div class="btn-group" data-toggle="buttons">
                                <?= $this->FormTB->input('placprev',['label'=>false,'hiddenField'=>false,'type'=>'radio','options'=>[0=>'No',1=>'Yes'],'radioLabelClass'=>'btn btn-default' ,'div'=>false]); ?>
                            </div>
                        </div>                              
                    
                        <!-- text input -->
                            <label>Abruptio Placentae</label>
                        <div class="form-group">
                            <div class="btn-group" data-toggle="buttons">
                                <?= $this->FormTB->input('abrplac',['label'=>false,'hiddenField'=>false,'type'=>'radio','options'=>[0=>'No',1=>'Yes'],'radioLabelClass'=>'btn btn-default' ,'div'=>false]); ?>
                            </div>
                        </div>
                        
                            <label>Chronic hypertension</label>
                        <div class="form-group">
                            <div class="btn-group" data-toggle="buttons">
                                <?= $this->FormTB->input('chrhyp',['label'=>false,'hiddenField'=>false,'type'=>'radio','options'=>[0=>'No',1=>'Yes'],'radioLabelClass'=>'btn btn-default' ,'div'=>false]); ?>
                            </div>
                        </div>

                        <label>Pre-eclampsia</label>    
                        <div class="form-group">
                            <div class="btn-group" data-toggle="buttons">
                                <?= $this->FormTB->input('preeclam',['label'=>false,'hiddenField'=>false,'type'=>'radio','options'=>[0=>'Absence of Preeclampsia / Eclampsia',1=>'Presence of Preeclampsia',2=>'Presence of Eclampsia'],'radioLabelClass'=>'btn btn-default' ,'div'=>false]); ?>
                            </div>
                        </div>

                        <label>Renal disease</label>
                        <div class="form-group">
                            <div class="btn-group" data-toggle="buttons">
                                <?= $this->FormTB->input('renald',['label'=>false,'hiddenField'=>false,'type'=>'radio','options'=>[0=>'No',1=>'Yes'],'radioLabelClass'=>'btn btn-default' ,'div'=>false]); ?>
                            </div>
                        </div>

                        <label>HIV</label>
                        <div class="form-group">
                            <div class="btn-group" data-toggle="buttons">
                                <?= $this->FormTB->input('hiv',['label'=>false,'hiddenField'=>false,'type'=>'radio','options'=>[0=>'No',1=>'Yes'],'radioLabelClass'=>'btn btn-default' ,'div'=>false]); ?>
                            </div>
                        </div>

                  
                </div><div class="box-footer text-black">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="clearfix">
                                <label>Disclaimer: The C-model estimates are not a substitute for clinical judgment</label>
                            </div>
                        </div> 
                    </div>                                                                     
                </div>
            </div>
            </div><!-- /.box -->
            <!--<div style="float:right; margin-right: 20px;">-->
            <div class="col-md-4" style="float:right;">
                <?= $this->FormTB->input('allow',array('type' => 'checkbox','class'=>'icheckbox_minimal' ,'label'=>'I agree that these data are stored and used for further development of C-Model', 'checked'=>'true')) ?>
            </div>              

            <div style="float:right;" class="col-md-2">
                <?php  echo $this->FormTB->button('<i class="fa fa-save"></i> Get probability', array('type' => 'submit','escape' => false,'class' => 'btn btn-primary')); ?>
            </div>
            <?=$this->FormTB->end() ?>
    </div>   <!-- /.row -->
</section><!-- /.content -->
    
<script type="text/javascript">

    $('#RegisterPreviousCs1').change(function()
    {
        if($('#RegisterParity0').parent().hasClass('active') || 
            (!$('#RegisterParity0').parent().hasClass('active') && !$('#RegisterParity1').parent().hasClass('active') && !$('#RegisterParity1').parent().hasClass('active')) && !$('#RegisterParity2').parent().hasClass('active') )
        {
            $('#RegisterParity0').parent().removeClass('active');
            $('#RegisterParity1').parent().addClass('active');
            $('#RegisterParity2').parent().removeClass('active');
        }
    });


    $('#RegisterPreviousCs2').change(function()
    {
        if($('#RegisterParity0').parent().hasClass('active') || 
            (!$('#RegisterParity0').parent().hasClass('active') && !$('#RegisterParity1').parent().hasClass('active') && !$('#RegisterParity1').parent().hasClass('active')) && !$('#RegisterParity2').parent().hasClass('active') )
        {
            $('#RegisterParity0').parent().removeClass('active');
            $('#RegisterParity1').parent().addClass('active');
            $('#RegisterParity2').parent().removeClass('active');
        }
    });
</script>