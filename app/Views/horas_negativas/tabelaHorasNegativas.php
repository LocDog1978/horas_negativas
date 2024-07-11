<div class="alert alert-primary" role="alert">
    Você selecionou: <h5 style="display: inline-block; margin: 0;"><b><?php echo $nome_posto; ?></b></h5>
</div>

<div class="d-flex justify-content-center mt-3">
    <button type="button" id="btnSalvar" class="btn btn-primary mb-5">Salvar</button>
</div>

<div id="successMessage" class="alert alert-success mt-3" style="display: none;"></div>

<div class="d-flex justify-content-center">
    <div class="table-responsive" style="width: 50%;">
        <table id="tabelaDados" class="table table-bordered table-hover table-sm" style="width: 100%;">
            <thead>
                <tr style="text-align: center; vertical-align: middle;">
                    <th>#</th>
                    <th>Data</th>
                    <th style="display: none;">Data invisível</th> <!-- Coluna invisível -->
                    <th>Diurno</th>
                    <th>Noturno</th>
                </tr>
            </thead>
            <tbody>
            <?php
            for ($i = 0; $i < count($periodo); $i++) {
                $data_invisivel = $periodo[$i];
                $input_diurno = $data_invisivel . "-d";
                $input_noturno = $data_invisivel . "-n";
                $diurno_valor = isset($horasNegativas[$data_invisivel]->diurno) ? $horasNegativas[$data_invisivel]->diurno : '';
                $noturno_valor = isset($horasNegativas[$data_invisivel]->noturno) ? $horasNegativas[$data_invisivel]->noturno : '';
                ?>
                <tr>
                    <td style="text-align: center; vertical-align: middle;">
                        <div style="display: flex; justify-content: center; align-items: center; height: 100%;">
                            <b><?php echo $i + 1; ?></b>
                        </div>
                    </td>
                    <td style="width: 150px; text-align: center; vertical-align: middle;">
                        <div style="display: flex; justify-content: center; align-items: center; height: 100%;">
                            <?php echo date("d/m/Y", strtotime($data_invisivel)); ?>
                        </div>
                    </td>
                    <td style="display: none;"><?php echo $data_invisivel; ?></td> <!-- Coluna invisível -->
                    <td><input type="number" name="<?php echo $input_diurno; ?>" id="<?php echo $input_diurno; ?>" class="form-control" value="<?php echo $diurno_valor; ?>" style="border: none; border-bottom: 1px solid #0072CE; border-radius: 0; width: 100%;"></td>
                    <td><input type="number" name="<?php echo $input_noturno; ?>" id="<?php echo $input_noturno; ?>" class="form-control" value="<?php echo $noturno_valor; ?>" style="border: none; border-bottom: 1px solid #0072CE; border-radius: 0; width: 100%;"></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-center mt-3">
    <button type="button" id="btnSalvar" class="btn btn-primary">Salvar</button>
</div>

<div id="successMessage" class="alert alert-success mt-3" style="display: none;"></div>

<script>
$(document).ready(function() {
    $('#btnSalvar').click(function() {
        let dados = [];

        // Percorre cada linha da tabela
        $('#tabelaDados tbody tr').each(function() {
            let linha = {};
            linha.id = $(this).find('td:first-child').text().trim(); // ID da linha
            linha.data = $(this).find('td:nth-child(2)').text().trim(); // Data da linha
            linha.data_invisivel = $(this).find('td:nth-child(3)').text().trim(); // Data da linha
            linha.diurno = $(this).find('input[type="number"]:eq(0)').val(); // Valor do input diurno
            linha.noturno = $(this).find('input[type="number"]:eq(1)').val(); // Valor do input noturno

            dados.push(linha);
        });

        $.ajax({
            url: '<?php echo base_url('cad_negativas/getHorasNegativas'); ?>',
            method: 'POST',
            data: { dados: dados, posto: '<?php echo $postoID; ?>' },
            success: function(response) {
                $('#successMessage').text(response.message).show();
                setTimeout(function() {
                    $('#successMessage').hide();
                }, 5000);
            },
            error: function(xhr, status, error) {
                console.error('Erro ao enviar dados:', error);
            }
        });
    });
});
</script>
