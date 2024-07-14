<?php $this->extend('template/dgti_template'); ?>
<?php $this->section('content'); ?>

<style type="text/css">
    #sobre {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #f8f9fa;
        padding: 10px 20px;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        margin: 20px 0;
    }
    #sobre h5 {
        margin: 0;
        font-size: 1.25rem;
        color: #343a40;
    }
    .clickable-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #007bff;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        text-decoration: none;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transition: background-color 0.3s, transform 0.3s;
    }
    .clickable-icon:hover {
        background-color: #0056b3;
        transform: scale(1.1);
    }
    .clickable-icon i {
        color: white;
        font-size: 24px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }
    /* Estilos para o modal */
    .modal {
        display: none; /* Oculto por padrão */
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.4);
        padding-top: 60px;
    }
    .modal-content {
        background-color: #fff;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        border-radius: 10px;
        width: 60%;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }
    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
    .modal-content form {
        display: flex;
        flex-direction: column;
    }
    .modal-content label {
        margin-top: 10px;
        font-weight: bold;
    }
    .modal-content input {
        padding: 10px;
        margin-top: 5px;
        border-radius: 5px;
        border: 1px solid #ccc;
        width: 100%;
    }
    .modal-content button {
        margin-top: 20px;
        padding: 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .modal-content button:hover {
        background-color: #0056b3;
    }
</style>

<section id="sobre">
    <h5 class="mb-0">Saldos das horas negativas atuais <?php echo "(".$intervaloDias['dia_inicial'] . " e " . $intervaloDias['dia_final'] . ") " . $intervaloDias['mes_inicial_extenso'] . "/" . $intervaloDias['mes_final_extenso']; ?></h5>
    <a 
        href="#"
        class="clickable-icon"
        id="printBtn"
    >
        <i class="fa fa-print" aria-hidden="true" title="Imprimir"></i>
    </a>
</section>

<div class="d-flex justify-content-center">
    <div class="table-responsive" style="width: 100%;">
        <table id="tabelaDados" class="table table-bordered table-hover table-sm" style="width: 100%;">
            <thead>
                <tr style="text-align: center; vertical-align: middle;">
                    <th>POSTOS</th>
                    <th>HORAS DIURNAS</th>
                    <th>HORAS NOTURNAS</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($somatorioPeriodo as $somatorio): ?>
                    <tr>
                        <td><?= ($somatorio['posto'] == "TOTAL") ? "<b>".$somatorio['posto']."</b>" : $somatorio['posto'] ?></td>
                        <td><?= $somatorio['diurno'] ?></td>
                        <td><?= $somatorio['noturno'] ?></td>
                        <td><?= isset($somatorio['total']) ? $somatorio['total'] : ($somatorio['diurno'] + $somatorio['noturno']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- O Modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form id="printForm">
            <label for="documentNumber">Número do documento:</label>
            <input type="text" id="documentNumber" name="documentNumber" value="___NÚMERO___/2024" required>
            <label for="de">De:</label>
            <input type="text" id="de" name="de" value="DISEG" required>
            <label for="para">Para:</label>
            <input type="text" id="para" name="para" value="COSEG" required>
            <button type="button" id="submitPrint">Imprimir</button>
        </form>
    </div>
</div>

<script>
    // Obter o modal
    let modal = document.getElementById("myModal");

    // Obter o botão que abre o modal
    let btn = document.getElementById("printBtn");

    // Obter o elemento <span> que fecha o modal
    let span = document.getElementsByClassName("close")[0];

    // Quando o usuário clicar no botão, abre o modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // Quando o usuário clicar em <span> (x), fecha o modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // Quando o usuário clicar em qualquer lugar fora do modal, fecha o modal
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Submeter o formulário e gerar o relatório
    $('#submitPrint').click(function() {
        if ($("#printForm")[0].checkValidity()) { // Verifica se todos os campos required são preenchidos
            let documentNumber = $('#documentNumber').val();
            let de = $('#de').val();
            let para = $('#para').val();
            let url = '<?= base_url("relatorio") ?>' + '?documentNumber=' + documentNumber + '&de=' + de + '&para=' + para;

            window.open(url, '_blank');
            modal.style.display = "none";
        } else {
            // Se houver campos não preenchidos, dispara a validação do HTML5
            $('<input type="submit">').hide().appendTo('#printForm').click().remove();
        }
    });
</script>

<?php $this->endSection(); ?>
