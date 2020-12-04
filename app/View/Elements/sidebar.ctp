            <aside class="left-side sidebar-offcanvas" style="min-height: 517px;">                
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <!--<div class="user-panel">
                        <div class="pull-left info">
                            <p>Hello, <?= $this->Session->read('Auth.User.username')?></p>
							
                            <a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'logout')) ?>"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>-->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li>
						
						
                            <a href="<?= $this->Html->url(array('controller' => 'registers', 'action'=> 'index')) ?>">
                                <i class="fa fa-keyboard-o"></i> <span>Calculator</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= $this->Html->url(array('controller' => 'uploads', 'action'=> 'index')) ?>">
                                <i class="fa fa-download"></i> <span>Send database</span> 
                            </a>
                        </li>
						<li>
                            <a href="<?= $this->Html->url(array('controller' => 'contact', 'action' => 'aboutus')) ?>">
                                <i class="fa fa-inbox"></i> <span>Contact</span> 
                            </a>
                        </li>
						
				
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>