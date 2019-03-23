<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
</style>
<div class="container-fluid">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-6 m-auto my-5">
                <h2 class="display-4 my-5 mb-5 text-center"> Entre em Contato </h2>
                <?php
                    if($formerrors){
                        echo $formerrors;
                    }
                    //qual controller vai trabalhar a validação? : 
                    echo form_open('home/contato', array('class'=>'d-flex flex-column')); //controller/metodo
                    //label = campo, descrição
                    //input = name
                    echo form_label('Nome: ', 'nome');
                    echo form_input('nome', set_value('nome'));                    
                    echo form_label('Email: ', 'email');
                    echo form_input('email', set_value('email'));                   
                    echo form_label('Assunto: ', 'assunto');
                    echo form_input('assunto', set_value('assunto'));
                    echo form_label('Mensagem: ', 'mensagem');
                    echo form_textarea('mensagem', set_value('mensagem'));
                    echo form_submit('enviar', 'Enviar', array('class' => 'btn btn-primary my-5 align-self-end'));
                    echo form_close();
                ?>
            </div>
        </div>
    </div>
</div>