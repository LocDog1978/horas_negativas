<!-- home/tabela.php -->
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
            <tbody id="tabelaBody">
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
