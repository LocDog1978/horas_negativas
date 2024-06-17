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
    <div class="col-sm-4">
        <label for="Mês" class="form-label"><b>Mês:</b></label>
        <div id="mesAux">
            <select name="mes" id="mes" class="chosen-select" data-placeholder="Selecione um mês">
                <option></option>
                <option value="1">Janeiro</option>
                <option value="2">Fevereiro</option>
                <option value="3">Março</option>
                <option value="4">Abril</option>
                <option value="5">Maio</option>
                <option value="6">Junho</option>
                <option value="7">Julho</option>
                <option value="8">Agosto</option>
                <option value="9">Seembro</option>
                <option value="10">Outrubro</option>
                <option value="11">Novembro</option>
                <option value="12">Dezembro</option>
            </select>
        </div>
        <div id="divError-mes" class="invalid-feedback"></div>
        <div id="divNotice-mes" class="notice-feedback"></div>
    </div>
    <div class="col-sm-4">
        <label for="Ano" class="form-label"><b>Ano:</b></label>
        <div id="anoAux">
            <select name="ano" id="ano" class="chosen-select" data-placeholder="Selecione um ano">
                <option></option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
            </select>
        </div>
        <div id="divError-ano" class="invalid-feedback"></div>
        <div id="divNotice-ano" class="notice-feedback"></div>
    </div>
</div>


<!-- <div id=""></div>

<script>$('input[name="dates"]').daterangepicker();</script> -->


<div class="row">
    <div class="col-12 d-flex flex-row justify-content-end py-2 py-sm-4">
        <button name="btnLimpar" type="button" id="btnLimpar" value="true" class="btn btn-warning">Limpar</button>
        <button name="btnValidateHorasNegativas" type="button" id="btnValidateHorasNegativas" value="true" class="btn btn-primary">Exibir</button>
    </div>
</div>

</form>

</section>

<script>
    let baseUrl = "<?php echo base_url(); ?>";
</script>
<!-- Validation -->
<script type="text/javascript" src="<?php echo base_url('assets/js/validation/cadNegativasValidate.js'); ?>"></script>

<?php $this->endSection('content'); ?>