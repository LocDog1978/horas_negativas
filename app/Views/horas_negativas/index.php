<?php $this->extend('template/dgti_template'); ?>
<?php $this->section('content'); ?>

<section>

<form action="<?php echo base_url('cad_negativas/validate'); ?>" id="formCadNegativas" name="formCadNegativas" role="form" class="form-cadNegativas" method="post" accept-charset="utf-8">

<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-3">
        <label for="Postos" class="form-label"><b>Postos:</b></label>

            <div id="postoAux">
                <select name="posto" id="posto" class="chosen-select" data-placeholder="Selecione um posto">
                    <option></option>
                    <?php foreach($listaPostos as $postos) {
                        echo '<option value="' . $postos->id . '">' . $postos->nome . '</option>';
                    } ?>
                </select>
            </div>
        <div id="divError-posto" class="invalid-feedback"></div>
        <div id="divNotice-posto" class="notice-feedback"></div>
    </div>
    <div class="col-sm-2">
        <label for="Mês" class="form-label"><b>Mês:</b></label>
        <div id="mesAux">
            <select name="mes" id="mes" class="chosen-select" data-placeholder="Selecione um Mês">
                <option></option>
                <option value="1">JANEIRO/FEVEREIRO</option>
                <option value="2">FEVEREIRO/MARÇO</option>
                <option value="3">MARÇO/ABRIL</option>
                <option value="4">ABRIL/MAIO</option>
                <option value="5">MAIO/JUNHO</option>
                <option value="6">JUNHO/JULHO</option>
                <option value="7">JULHO/AGOSTO</option>
                <option value="8">AGOSTO/SETEMBRO</option>
                <option value="9">SETEMBRO/OUTUBRO</option>
                <option value="10">OUTUBRO/NOVEMBRO</option>
                <option value="11">NOVEMBRO/DEZEMBRO</option>
                <option value="12">DEZEMBRO/JANEIRO</option>
            </select>
        </div>
        <div id="divError-mes" class="invalid-feedback"></div>
        <div id="divNotice-mes" class="notice-feedback"></div>
    </div>
    <div class="col-sm-2">
        <label for="Ano" class="form-label"><b>Ano:</b></label>
        <div id="anoAux">
            <select name="ano" id="ano" class="chosen-select" data-placeholder="Selecione um Ano">
                <option></option>
                <?php foreach ($anos as $ano): ?>
                    <option value="<?= $ano ?>"><?= $ano ?></option>
                <?php endforeach; ?>
            </select>     
        </div>
        <div id="divError-ano" class="invalid-feedback"></div>
        <div id="divNotice-ano" class="notice-feedback"></div>
    </div>
    <div class="col-sm-3"></div>
</div>

<div class="row">
    <div class="col-12 d-flex flex-row justify-content-end py-2 py-sm-4">     
    </div>
</div>

</form>

</section>

<div id="tabelaHorasNegativas"></div>

<script>
    let baseUrl = "<?php echo base_url(); ?>";
</script>

<!-- Validation -->
<script
    type="text/javascript"
    src="<?php echo base_url('assets/js/validation/cadNegativasValidate.js'); ?>"
    >
</script>

<?php $this->endSection('content'); ?>