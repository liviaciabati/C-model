<?php $this->extend('_base');?>

	 <body class="skin-black  pace-done" /*style="min-height: 517px;"*/>
		<div class="pace pace-inactive">
			<div class="pace-progress" data-progress-text="100%" data-progress="99" style="width: 100%;">
				<div class="pace-progress-inner">
				</div>
			</div>
			<div class="pace-activity"></div>
		</div>
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="<?= $this->Html->url(array('controller' => 'registers', 'action' => 'index')) ?>" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                C-Model
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left" style="min-height: 517px;">
            <!-- Left side column. contains the logo and sidebar -->
			
			
			<?php echo $this->element('sidebar');?>
			
			
			<aside class="right-side" style="margin-top: -20px">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content');?>
			</aside>
			
        </div><!-- ./wrapper -->



    </body>


			
		