<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <div class="container-fluid vh-100">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-4 m-auto mt-3">
                    <?= $h2; ?>
                    <?php
                        if($msg = get_msg()){
                            echo "<div class='alert alert-primary'>".$msg."</div>";
                        }
                        echo form_open('', array('class'=>'d-flex flex-column'));
                        echo form_label('Usuário: ', 'login');
                        echo form_input('login', set_value('login'), array('autofocus' => 'autofocus'));
                        echo form_label('Senha: ', 'senha');
                        echo form_password('senha');
                        echo form_submit('entrar', 'Entrar', array('class' => 'btn btn-primary my-5 align-self-center'));
                        echo form_close();
                    ?>
                </div>
            </div>
        </div>
    </div>
