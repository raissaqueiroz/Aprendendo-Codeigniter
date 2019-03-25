<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

		<!-- RODAPÉ -->

        <div class="container-fluid bg-secondary">
			<div class="container">
				<div class="row">
					<div class="col-12 text-center text-white  my-3 mb-0">
						<h6 class="col-12">Todos os Direitos Reservados.</h3>
					</div>
				</div>
			</div>
		</div>
		<!-- /RODAPÉ -->

		<!--Bootstrap-->

		<!-- Primeiro o jQuery, depois o Popper.js, e depois o Bootstrap JS -->
  	    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="<?= base_url('dist/js/bootstrap.min.js') ?>"></script>

		<!--/Bootstrap-->
		<!--Script do Editor de texto-->
		<script src="<?= base_url('dist/js/jquery-te-1.4.0.min.js') ?>"></script>
		<script>
			$('.editorhtml').jqte();
		</script>
		<!--/Script do Editor de texto-->
    </body>
</html>