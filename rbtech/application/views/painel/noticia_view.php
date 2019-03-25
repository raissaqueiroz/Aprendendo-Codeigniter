<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <div class="container-fluid">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-2 my-5">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <!--Corpo do Menu-->
                        <div class="collapse navbar-collapse ml-5" id="navbarSite">
                            <ul class="navbar-nav ml-auto text-center d-flex flex-column">
                                <li class="nav-item"><a class="nav-link" href="<?= base_url('noticia/cadastrar'); ?>">INSERIR</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?= base_url('noticia/listar'); ?>">LISTAR</a></li>
                            </ul>
                        </div>
                    </nav>
                    <!--/Menu-->
                </div>
                <div class="col-6 my-5">
                    <?= $h2; ?>
                    <?php
                        if($msg = get_msg()){
                            echo "<div class='alert alert-primary'>".$msg."</div>";
                        }
                        switch($tela){
                            case 'listar':
                                if(isset($noticias) && sizeof($noticias) > 0){
                                    ?>
                                    <div class="table-responsive">
                                        <table class="table bodered light">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-left">Titulo</th>
                                                    <th scope="col" class="text-right">Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                foreach($noticias as $linha){
                                                    ?>
                                                    <tr>
                                                        <td class="text-left"><?= $linha->titulo; ?></td>
                                                        <td class="text-right"><?= anchor('noticia/editar/'.$linha->id, 'Editar'); ?> | <?= anchor('noticia/excluir/'.$linha->id, 'Excluir'); ?> | <?= anchor('post/'.$linha->id, 'Ver', array('target' => '_blank')); ?></td>
                                                    </tr>
                                                    <?php 
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php
                                } else {
                                    echo "<div class='alert alert-primary'><p class='text-center'>Nenhuma Noticia Cadastrada</p></div>";
                                }
                                break;
                            case 'cadastrar':
                                echo form_open_multipart('', array('class'=>'d-flex flex-column'));
                                echo form_label('Titulo: ', 'titulo');
                                echo form_input('titulo', set_value('titulo'), array('autofocus' => 'autofocus'));
                                echo form_label('Conteúdo: ', 'conteudo');
                                echo form_textarea('conteudo', to_html(set_value('conteudo')), array('class' => 'editorhtml'));
                                echo form_label('Imagem da Noticia: ', 'imagem');
                                echo form_upload('imagem');
                                echo form_submit('salvar', 'Salvar Noticia', array('class' => 'btn btn-primary my-5 align-self-center'));
                                echo form_close();

                                break;
                            case 'editar':
                                echo form_open_multipart('', array('class'=>'d-flex flex-column'));
                                echo form_label('Titulo: ', 'titulo');
                                echo form_input('titulo', set_value('titulo', to_html($noticia->titulo)), array('autofocus' => 'autofocus'));
                                echo form_label('Conteúdo: ', 'conteudo');
                                echo form_textarea('conteudo', to_html(set_value('conteudo', to_html($noticia->conteudo))), array('class' => 'editorhtml'));
                                echo form_label('Imagem da Noticia: ', 'imagem');
                                echo form_upload('imagem');
                                echo "<p><small> Imagem Atual: </small><br/><img src='".base_url('dist/uploads/'.$noticia->imagem)."' style='width: 40%; height: 40%;'/> </p>";
                                echo form_submit('salvar', 'Salvar Noticia', array('class' => 'btn btn-primary my-5 align-self-center'));
                                echo form_close();
                                break;
                            case 'excluir':
                                echo form_open_multipart('', array('class'=>'d-flex flex-column'));
                                echo form_label('Titulo: ', 'titulo');
                                echo form_input('titulo', set_value('titulo', to_html($noticia->titulo)), array('autofocus' => 'autofocus'));
                                echo form_label('Conteúdo: ', 'conteudo');
                                echo form_textarea('conteudo', to_html(set_value('conteudo', to_html($noticia->conteudo))), array('class' => 'editorhtml'));
                                echo "<p><small> Imagem: </small><br/><img src='".base_url('dist/uploads/'.$noticia->imagem)."' style='width: 40%; height: 40%;'/> </p>";
                                echo form_submit('excluir', 'Excluir', array('class' => 'btn btn-primary my-5 align-self-center'));
                                echo form_close();
                                break;
                            default: echo "Tela não inserida";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
