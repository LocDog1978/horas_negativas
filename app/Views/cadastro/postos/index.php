<?php $this->extend('template/dgti_template'); ?>
<?php $this->section('content'); ?>

<div class="container">
    <form method="post" action="cadastrar-enquete.php">
        <label for="time"><strong>POSTOS</strong></label><br>

        <div class="row">
            <div class="col-sm-4">
                <select name="time" id="time" class="chosen-select">
                    <option value="">---Selecione---</option>
                    <?php 
                    foreach($listaPostos as $postos) {
                        echo '<option value="' . $postos->id . '">' . $postos->nome . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        
        <div class="mt-3">
            <input type="submit" value="Confirmar" class="btn btn-primary" />
            <input type="reset" value="Cancelar" class="btn btn-danger"/>
        </div>

    </form>
</div>

<?php $this->endSection('content'); ?>