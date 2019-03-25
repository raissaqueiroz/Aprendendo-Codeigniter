<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang='pt-br'>
    <head>
        <meta charset="UTF-8">
        <title><?= $titulo ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Pojeto para aprimorar conhecimentos em CodeIgniter">
		<meta name="author" content="Raissa Queiroz">
		<meta name="robots" content="index, follow">
		<meta name="keywords" content="Palavras, Chaves">
    	<!-- Bootstrap CSS -->
		<link rel="stylesheet" type="text/css" href="<?= base_url('dist/css/bootstrap.min.css')?>" >
		<!-- JQuery Text Editor CSS -->
		<link rel="stylesheet" type="text/css" href="<?= base_url('dist/css/jquery-te-1.4.0.css')?>" >
    </head>
    <body>
        <div class="container-fluid bg-primary">
			<div class="container">
				<div class="row">
					<!--Menu-->
					<nav class="navbar navbar-expand-lg navbar-dark">
					
						<!--Logo-->
						<a class="navbar-brand h1 mb-0" href="#"><h1 class="lead"><?= $logo; ?></h1></a>
						<!--Botão do Menu-->
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSite">
							<span class="navbar-toggler-icon"></span>
						</button>
						<!--Corpo do Menu-->
						<div class="collapse navbar-collapse ml-5" id="navbarSite">
							<ul class="navbar-nav ml-auto text-center">
								<li class="nav-item"><a target="_blank" class="nav-link" href="<?= base_url(''); ?>">Ver Site</a></li>
								<li class="nav-item"><a class="nav-link" href="<?= base_url('noticia'); ?>">Noticias</a></li>
								<li class="nav-item"><a class="nav-link" href="<?= base_url('setup'); ?>">Configurações</a></li>
								<li class="nav-item"><a class="nav-link" href="<?= base_url('setup/logout'); ?>">Sair</a></li>

							</ul>
						</div>
					</nav>
					<!--/Menu-->
				</div>
			</div>
		</div>