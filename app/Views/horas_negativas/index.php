<?php $this->extend('template/dgti_template'); ?>
<?php $this->section('content'); ?>

<section>

<form action="<?php echo base_url('cad_negativas/validate'); ?>" id="formCadNegativas" name="formCadNegativas" role="form" class="form-cadNegativas" method="post" accept-charset="utf-8">

<div class="row">
    <div class="col-sm-4">
        <label for="Postos" class="form-label"><b>Postos:</b></label>

            <div id="postoAux">
                <select name="posto" id="posto" class="chosen-select" data-placeholder="Selecione um posto">
                    <option></option>
                    <?php 
                    foreach($listaPostos as $postos) {
                        echo '<option value="' . $postos->id . '">' . $postos->nome . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div id="divError-posto" class="invalid-feedback"></div>
            <div id="divNotice-posto" class="notice-feedback"></div>
        </div>
    </div>
</div>

<div id=""></div>

<script>$('input[name="dates"]').daterangepicker();</script>


<div class="row">
    <div class="col-12 d-flex flex-row justify-content-end py-2 py-sm-0">
        <button name="btnLimpar" type="button" id="btnLimpar" value="true" class="btn btn-warning">Limpar</button>
        <button name="btnCancel" type="button" id="btnCancel" value="true" class="btn btn-danger">Cancelar</button>
        <button name="btnValidateHorasNegativas" type="button" id="btnValidateHorasNegativas" value="true" class="btn btn-primary">Salvar</button>
    </div>
</div>

</form>

</section>

<!-- Validation -->
<script type="text/javascript" src="<?php echo base_url('assets/js/validation/cadNegativasValidate.js'); ?>"></script>

<?php $this->endSection('content'); ?>