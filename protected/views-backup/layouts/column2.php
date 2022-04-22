<?php /* @var $this Controller #c8202e */ ?>
<?php $this->beginContent('//layouts/main'); ?>
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
<!--                 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> -->
<!--                     <span class="sr-only">Toggle navigation</span> -->
<!--                     <span class="icon-bar"></span> -->
<!--                     <span class="icon-bar"></span> -->
<!--                     <span class="icon-bar"></span> -->
<!--                 </button> -->
<!--                 <a class="navbar-brand" >MTrading Mobile</a> -->
            	<a href="<?php echo Yii::app()->request->baseUrl; ?>" class="navbar-brand"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo/logo_inverse.png" style="max-width: 50%; margin: -9px -7px 10px;"> </a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>(<?php echo Yii::app()->user->name; ?>)  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/user/profile"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
<!--                         <li><a href=""><i class="fa fa-gear fa-fw"></i> Settings</a> -->
<!--                         </li> -->
                        <li class="divider"></li>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/user/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
            <section class="sidebar-user-info" ng-class="{'mobile-is-visible': layoutOptions.sidebar.isMenuOpenMobile}">
    <div class="sidebar-user-info-inner">
        <a href="" class="user-profile">
            <img  width="60" height="60" class="img-circle img-corona" alt="user-pic" src="<?php echo Yii::app()->request->baseurl; ?>/images/noimage.jpg">

            <span class="side-designation text-ellipsis max-width-165 ng-binding">
                <strong class="text-ellipsis max-width-165 ng-binding"><?php echo Yii::app()->user->name; ?></strong>
                <?php echo Yii::app()->user->email; ?>
            </span>
        </a>

        <ul class="user-links list-unstyled">
            <li>
                <a href="/user/profile" title="Edit profile">
                    <i class="fa fa-user"></i>
                    Profile
                </a>
            </li>
            <li>
                <a href="/notification" title="Mailbox">
                    <i class="fa fa-bell"></i>
                    Notification
                </a>
            </li>
            <li class="logout-link">
                <a href="/user/logout"  title="Log out">
                    <i class="fa fa-power-off text-danger"></i>
                </a>
            </li>
        </ul>
    </div>
</section>
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
<!--                         <li> -->
<!--                             <a href="index.html"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a> -->
<!--                         </li> -->

                    <?php if(!Yii::app()->user->isAdmin()){
                    ?>
                    	<li class='sidebar-search' style="background:#C8202E ">
                    		<h4>Language: <span class="label label-danger" style="font-size: 16px;"><?php echo Profile::getLanguage(); ?></span></h4>
                    	</li>
                    <?php
					}?>
                        <?php
                        if(Yii::app()->user->isAdmin()){
                        ?>
                        <li>
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/user/admin"><i class="fa fa-users fa-fw"></i> Users</a>
                        </li>
                        <?php
                        }
                        ?>
                         <?php
                        if(Yii::app()->user->isAdmin()){
                        ?>
                         <li>
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/internetservice"><i class="fa fa-wifi fa-fw"></i> Internet Service</a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/promotion"><i class="fa fa-file-image-o fa-fw"></i> Promotion</a>
                        </li>
                         <li>
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/pushnotification"><i class="fa fa-bell fa-fw"></i> Push Notification</a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/iatscountry"><i class="fa fa-mobile fa-fw"></i> IATS</a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/category/admin"><i class="fa fa-cogs fa-fw"></i> Category</a>
                        </li>
                        <?php
                        }
                        ?>
                        <?php if(!Yii::app()->user->isGuest && !Yii::app()->user->isAdmin()){?>
                        <li>
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/content"><i class="fa fa-file-video-o fa-fw"></i> Contents</a>
                        </li>
                         <li>
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/news"><i class="fa fa-newspaper-o  fa-fw"></i> News</a>
                        </li>
                        <?php
                        }
                        ?>
						<?php if(!Yii::app()->user->isGuest && !Yii::app()->user->isAdmin()){?>
                         <li class="hide">
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/pushnotification"><i class="fa fa-thumb-tack  fa-fw"></i> Notifications</a>
                        </li>
                        <?php } ?>
                        <?php if(!Yii::app()->user->isGuest && !Yii::app()->user->isAdmin()){?>
                         <li>
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/feedback/admin"><i class="fa fa-rss fa-fw"></i> Feedbacks</a>
                        </li>
                        <?php } ?>

                        <?php
                        if(Yii::app()->user->isAdmin()){
                        ?>
                        <li>
                            <a><i class="fa fa-dashboard fa-fw"></i> Reports</a>
														<ul class="nav nav-second-level">
															<li class="hide">
														  	<a href="<?php echo Yii::app()->request->baseUrl; ?>/videoStats/totalSubscribers">Total New Subscriber</a>
														  </li>
														<li class="hide">
														  	<a href="<?php echo Yii::app()->request->baseUrl; ?>/videoStats/totalMta">Total MTA Subscriber only</a>
														  </li>
														<li class="hide">
														  	<a href="<?php echo Yii::app()->request->baseUrl; ?>/videoStats/admin">Custom</a>
														  </li>




                                                          	<li>
														  	<a href="<?php echo Yii::app()->request->baseUrl; ?>/report/subscribers">Subscribers</a>
														  </li>
															<li>
														  	<a href="<?php echo Yii::app()->request->baseUrl; ?>/report/languagepreference">Customer By Language</a>
														  </li>
															<li>
														  	<a href="<?php echo Yii::app()->request->baseUrl; ?>/report/activecustomer">Active Customers</a>
														  </li>
                                                          	<li>
														  	<a href="<?php echo Yii::app()->request->baseUrl; ?>/report/browsingpreference">Customer by Browsing Preference</a>
														  </li>
													</ul>
                        </li>
                        <?php
                        }
                        ?>
<?php
                        if(Yii::app()->user->isAdmin()){
                        ?>
                        <li>
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/sim/admin"><i class="fa fa-wifi fa-fw"></i> Sim Settings</a>
                        </li>
                        <?php
                        }
                        ?>
<!--                         <li> -->
<!--                        <img src="/mtrademobile/images/logo/logo.png" style="max-width: 86%;margin: 10px 16px 10px;"> -->
<!--                        </li> -->
<!--                         <li> -->
<!--                             <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Charts<span class="fa arrow"></span></a> -->
<!--                             <ul class="nav nav-second-level"> -->
<!--                                 <li> -->
<!--                                     <a href="flot.html">Flot Charts</a> -->
<!--                                 </li> -->
<!--                                 <li> -->
<!--                                     <a href="morris.html">Morris.js Charts</a> -->
<!--                                 </li> -->
<!--                             </ul> -->
                            <!-- /.nav-second-level -->
<!--                         </li> -->
<!--                         <li> -->
<!--                             <a href="tables.html"><i class="fa fa-table fa-fw"></i> Tables</a> -->
<!--                         </li> -->
<!--                         <li> -->
<!--                             <a href="forms.html"><i class="fa fa-edit fa-fw"></i> Forms</a> -->
<!--                         </li> -->
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
        	<div class="container-fluid">
               <?php echo $content; ?>
            </div>
        </div>

<?php $this->endContent(); ?>

