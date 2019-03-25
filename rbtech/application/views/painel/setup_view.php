<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <div class="container-fluid vh-100">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-6 m-auto my-5">
                    <?= $h2; ?>
                    <?php
                        if($msg = get_msg()){
                            echo "<div class='alert alert-primary'>".$msg."</div>";
                        }
                        echo form_open('', array('class'=>'d-flex flex-column'));
                        echo form_label('Nome para Login: ', 'login');
                        echo form_input('login', set_value('login'), array('autofocus' => 'autofocus'));
                        echo form_label('Email do Administrador do Site: ', 'email');
                        echo form_input('email', set_value('email'));
                        echo form_label('Senha: ', 'senha');
                        echo form_password('senha', set_value('senha'));
                        echo form_label('Repita a Senha: ', 'senhab');
                        echo form_password('senhab', set_value('senhab'));
                        echo form_submit('salvar', 'Salvar', array('class' => 'btn btn-primary my-5 align-self-center'));
                        echo form_close();
                    ?>
                </div>
            </div>
        </div>
    </div>
