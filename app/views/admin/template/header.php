<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <meta name="robots" content="none">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MVC - Administrator panel</title>
	<!-- Bootstrap Styles-->
    <link rel="stylesheet" href="<?=Config::get('path/public')?>css/bootstrap.css">
    <!-- Admin Styles-->
    <link rel="stylesheet" href="<?=Config::get('path/public')?>css/admin.css">
     <!-- FontAwesome Styles-->
    <link href="<?=Config::get('path/public')?>css/font-awesome.css" rel="stylesheet" />
     <!-- Google Fonts-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <!-- Custom CSS -->
   <?php 
    if(isset($data['css'])) {
      foreach($data['css'] as $css) {
        echo '<link href="' . Config::get('path/public') . 'css/' . $css . '" rel="stylesheet">';
      }
    }
  ?>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?=Config::get('path/public')?>admin/dashboard"><strong>MVC</strong></a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user"></i> <?=$data['username']?> <b class="caret"></b></a>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?=Config::get('path/public');?>admin/see_profile"><i class="fa fa-user fa-fw"></i> Zobacz profil</a>
                        </li>
                        <li><a href="<?=Config::get('path/public');?>admin/register_user"><i class="fa fa-gear fa-fw"></i> Dodaj użytkownika</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?=Config::get('path/public');?>admin/logout"><i class="fa fa-sign-out fa-fw"></i> Wyloguj się</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <a class="<?php if($data['active'] === 'dashboard') echo 'active-menu';?>" href="<?=Config::get('path/public')?>admin/dashboard"><i class="fa fa-dashboard"></i> Statystyki</a>
                    </li>
                    <?php if(Config::get('modules/gallery')): ?>
                    <li>
                        <a class="<?php if($data['active'] === 'gallery') echo 'active-menu';?>" href="#"><i class="fa fa-picture-o"></i> Galeria</a>
                        <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                            <li>
                                <a href="<?=Config::get('path/public')?>admin/add_images">Dodaj zdjęcia</a>
                            </li>
                            <li>
                                <a href="<?=Config::get('path/public')?>admin/delete_images">Usuń zdjęcia</a>
                            </li>
                         </ul>
                    </li>
                <?php endif; ?>
                    <li>
                        <a class="<?php if($data['active'] === 'settings') echo 'active-menu';?>" href="<?=Config::get('path/public')?>admin/settings"><i class="fa fa-gear"></i> Ustawienia</a>
                    </li>
                </ul>
            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        
        <div id="page-wrapper">

            <div class="header"> 
                <h1 class="page-header">
                <?=$data['page_header']?> <small><?=$data['page_desc']?></small>
                </h1>
                                                
            </div>

            <div id="page-inner"> <!-- PAGE INNER  -->
                <div class="row">
                    <div class="col-lg-12">

                            <?php
                            if (Session::exists('success')) {
                              echo '<div class="alert alert-success">';
                                echo  '<strong>Sukces! </strong>' . Session::flash('success');
                              echo  '</div>';
                            }

                            if (Session::exists('danger')) {
                              echo '<div class="alert alert-danger">';
                                echo  '<strong>Ostrzeżenie! </strong>' . Session::flash('danger');
                              echo  '</div>';
                            }
                            ?>