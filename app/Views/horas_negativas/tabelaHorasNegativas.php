<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horas Negativas</title>
    <style>
        .toast-container {
            z-index: 1060; /* valor maior que outros elementos da página */
        }
        .has-justificativa {
            position: relative;
        }
        .has-justificativa::after {
            content: '';
            position: absolute;
            top: 50%;
            right: -12px;
            transform: translateY(-50%);
            width: 8px;
            height: 8px;
            background-color: red;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <!-- Toast Container -->
    <div aria-live="polite" aria-atomic="true" class="position-relative">
        <div class="toast-container position-fixed top-0 end-0 p-3" id="toastContainer">
            <!-- Toast -->
            <div class="toast bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true" id="myToast">
                <div class="toast-header bg-success text-white">
                    <strong class="me-auto">Notificação</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" id="toastMessage">
                    <!-- A mensagem será inserida aqui pelo JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div id="alertSomatorio" class="alert alert-primary col-sm-4 text-center" role="alert">
                Você selecionou: <h5 style="display: inline-block; margin: 0;"><b><?php echo $nome_posto; ?></b></h5>
                <hr>
                Total Diurno: <?php echo $sum_diurno; ?>
                <br>
                Total Noturno: <?php echo $sum_noturno; ?>
                <br>
                Somatório Total: <?php echo $total_sum; ?>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-1">
        <button type="button" id="btnSalvarTop" class="btn btn-primary mb-2">Salvar</button>
    </div>

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
                        <th>Justificativa</th>
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
                    $justificativa_valor = isset($horasNegativas[$data_invisivel]->justificativa) ? $horasNegativas[$data_invisivel]->justificativa : '';
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
                        <td><input type="number" min="0" name="<?php echo $input_diurno; ?>" id="<?php echo $input_diurno; ?>" class="form-control" value="<?php echo $diurno_valor; ?>" style="border: none; border-bottom: 1px solid #0072CE; border-radius: 0; width: 100%;"></td>
                        <td><input type="number" min="0" name="<?php echo $input_noturno; ?>" id="<?php echo $input_noturno; ?>" class="form-control" value="<?php echo $noturno_valor; ?>" style="border: none; border-bottom: 1px solid #0072CE; border-radius: 0; width: 100%;"></td>
                        <td style="width: 150px; text-align: center; vertical-align: middle;">
                            <button type="button" class="btn btn-primary btn-justificativa <?php echo !empty($justificativa_valor) ? 'has-justificativa' : ''; ?>" data-bs-toggle="modal" data-bs-target="#justificativaModal" data-row="<?php echo $i; ?>" data-justificativa="<?php echo htmlspecialchars($justificativa_valor, ENT_QUOTES, 'UTF-8'); ?>">
                                <i class="fa fa-pencil"></i>
                            </button>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-1">
        <button type="button" id="btnSalvarBottom" class="btn btn-primary">Salvar</button>
    </div>

    <!-- Modal para Justificativa -->
    <div class="modal fade" id="justificativaModal" tabindex="-1" aria-labelledby="justificativaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="justificativaModalLabel">Justificativa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <textarea id="justificativaText" class="form-control" rows="4" placeholder="Digite a justificativa..."></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" id="saveJustificativaModal">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('assets/js/jquery-3.6.0.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>
    <script>
        $(document).ready(function() {
            let selectedRow = null;
            let justificativas = <?php echo json_encode(array_map(function($item) { return $item->justificativa ?? ''; }, $horasNegativas)); ?>;

            // Abrir modal e carregar justificativa existente, se houver
            $('.btn-justificativa').click(function() {
                selectedRow = $(this).data('row');
                let justificativa = $(this).data('justificativa');
                $('#justificativaText').val(justificativa || '');
            });

            // Prevenir que ENTER no modal acione o botão externo de salvar, mas permitir quebra de linha
            $('#justificativaText').keydown(function(event) {
                if (event.keyCode === 13 && !event.shiftKey) {
                    event.preventDefault();
                }
            });

            // Salvar justificativa no array ao clicar em "Salvar" no modal
            $('#saveJustificativaModal').click(function() {
                const justificativa = $('#justificativaText').val();
                justificativas[selectedRow] = justificativa;
                $(`.btn-justificativa[data-row="${selectedRow}"]`).data('justificativa', justificativa);
                if (justificativa) {
                    $(`.btn-justificativa[data-row="${selectedRow}"]`).addClass('has-justificativa');
                } else {
                    $(`.btn-justificativa[data-row="${selectedRow}"]`).removeClass('has-justificativa');
                }
                $('#justificativaModal').modal('hide');
            });

            // Enviar dados ao clicar nos botões "Salvar"
            $('#btnSalvarTop, #btnSalvarBottom').click(function() {
                let dados = [];

                $('#tabelaDados tbody tr').each(function(index) {
                    let linha = {};
                    linha.id = $(this).find('td:first-child').text().trim();
                    linha.data = $(this).find('td:nth-child(2)').text().trim();
                    linha.data_invisivel = $(this).find('td:nth-child(3)').text().trim();
                    linha.diurno = $(this).find('input[type="number"]:eq(0)').val();
                    linha.noturno = $(this).find('input[type="number"]:eq(1)').val();
                    linha.justificativa = justificativas[index] || '';

                    dados.push(linha);
                });

                $.ajax({
                    url: '<?php echo base_url('cad_negativas/getHorasNegativas'); ?>',
                    method: 'POST',
                    data: { dados: dados, posto: '<?php echo $postoID; ?>' },
                    success: function(response) {
                        $('#toastMessage').text(response.message);
                        let toastEl = document.getElementById('myToast');
                        let toast = new bootstrap.Toast(toastEl);
                        toast.show();
                        $('#alertSomatorio').html(`
                            Você selecionou: <h5 style="display: inline-block; margin: 0;"><b><?php echo $nome_posto; ?></b></h5>
                            <hr>
                            Total Diurno: <b>${response.somatorio_diurno}</b>
                            <br>
                            Total Noturno: <b>${response.somatorio_noturno}</b>
                            <br>
                            Somatório Total: <b>${response.somatorio_total}</b>
                        `);
                    },
                    error: function(xhr, status, error) {
                        console.error('Erro ao enviar dados:', error);
                    }
                });
            });

            // Inicializar tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();
        });
    </script>
</body>
</html>
