<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="pt-br">
 	<head>
		<meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta name="description" content="">
	    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
	    <meta name="generator" content="Jekyll v3.8.5">
	    <title><?= $titulo ?></title>

    	<!-- Bootstrap CSS -->
		<link rel="stylesheet" type="text/css" href="<?= base_url('dist/css/bootstrap.min.css')?>" >


    	<style>
	    	.bd-placeholder-img {
		        font-size: 1.125rem;
		        text-anchor: middle;
		        -webkit-user-select: none;
		        -moz-user-select: none;
		        -ms-user-select: none;
		        user-select: none;
		      }

	     	@media (min-width: 768px) {
	    		.bd-placeholder-img-lg {
	          		font-size: 3.5rem;
	        	}
	      	}
    	</style>
    	<!-- Estilização customizada do template -->
    	<link rel="stylesheet" type="text/css" href="<?= base_url('dist/css/dashboard.css') ?>">
    </head>
    <body>
    	<!--Menu do Topo-->
    	<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
			<a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">H4money</a>
  			<input class="form-control form-control-dark w-100" type="text" placeholder="Buscar: " aria-label="Search">
  			<ul class="navbar-nav px-3">
    			<li class="nav-item text-nowrap">
      				<a class="nav-link" href="#">Sign out</a>
    			</li>
  			</ul>
		</nav>
		<!--/Menu do Topo-->

		<!--Menu Lateral-->
		<div class="container-fluid">
  			<div class="row">
    			<nav class="col-md-2 d-none d-md-block bg-light sidebar">
      				<div class="sidebar-sticky">
        				<ul class="nav flex-column">
          					<li class="nav-item">
           						<a class="nav-link active" href="#">
              						<span data-feather="home"></span>
              						Dashboard <span class="sr-only">(current)</span>
            					</a>
          					</li>
          					<li class="nav-item">
            					<a class="nav-link" href="#">
            						<span data-feather="users"></span>
              						Clientes
            					</a>
          					</li>
          				</ul>
          
      				</div>
    			</nav>
    		</div>
    	</div>
		<!--/Menu Lateral-->	

			