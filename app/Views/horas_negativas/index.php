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
        <label for="Data" class="form-label"><b>Data:</b></label>
        <input type="date" name="data" id="data" class="form-control">
        <div id="divError-mes" class="invalid-feedback"></div>
        <div id="divNotice-mes" class="notice-feedback"></div>
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        <label for="Diurno" class="form-label"><b>Diurno:</b></label>
        <input type="number" name="diurno" id="diurno" class="form-control">
        <div id="divError-diruno" class="invalid-feedback"></div>
        <div id="divNotice-diruno" class="notice-feedback"></div>
    </div>

    <div class="col-sm-4">
        <label for="Noturno" class="form-label"><b>Noturno:</b></label>
        <input type="number" name="noturno" id="noturno" class="form-control">
        <div id="divError-noturno" class="invalid-feedback"></div>
        <div id="divNotice-noturno" class="notice-feedback"></div>
    </div>
</div>


<!-- <div id=""></div>

<script>$('input[name="dates"]').daterangepicker();</script> -->


<div class="row">
    <div class="col-12 d-flex flex-row justify-content-end py-2 py-sm-4">
        <button name="btnLimpar" type="button" id="btnLimpar" value="true" class="btn btn-warning">Limpar</button>
        <button name="btnValidateHorasNegativas" type="button" id="btnValidateHorasNegativas" value="true" class="btn btn-primary">Salvar</button>
    </div>
</div>

</form>

</section>

<div id="tabelaHorasNegativas"></div>

<script>
    let baseUrl = "<?php echo base_url(); ?>";
</script>
<!-- Validation -->
<script type="text/javascript" src="<?php echo base_url('assets/js/validation/cadNegativasValidate.js'); ?>"></script>

<script>
    function checkSelects() {
        let postoSelected = $('#posto').val();
        let dataSelected = $('#data').val();

        if (postoSelected && dataSelected) {
            let form = $("#formCadNegativas")[0]; // Obtém o formulário DOM
            let formData = new FormData(form); // Cria um objeto FormData

            $.ajax({
                type: 'post',
                url: baseUrl + '/cad_negativas/getHorasNegativas',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $("#divLoading").show();
                },
                success: function (response) {
                    if (response.status === 'success') {
                        $('#diurno').val(response.diurno);
                        $('#noturno').val(response.noturno);
                    } else {
                        $('#diurno').val(null);
                        $('#noturno').val(null);
                    }
                },
                error: function () {
                    console.log('Erro durante a requisição AJAX.');
                },
                complete: function () {
                    $('#divLoading').hide();
                }
            });
        }
    }

    $('#posto, #data').change(function() {
        checkSelects();
    });

    $("#btnValidateHorasNegativas").on('click', function(e) {

        let posto = $('#posto').val();
        let data = $('#data').val();

        let parametros = {
            local: posto,
            data: data
        };

        $("#tabelaHorasNegativas").load("<?php echo base_url("cad_negativas/tabelaHorasNegativas"); ?>", parametros);
    });

</script>

<?php $this->endSection('content'); ?>