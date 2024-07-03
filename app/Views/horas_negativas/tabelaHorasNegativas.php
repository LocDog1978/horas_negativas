<table class="table table-bordered">
    <tr>
        <thead>
            <th>Data</th>
            <th>Diruno</th>
            <th>Noturno</th>
        </thead>
    </tr>
    <tr>
        <tbody>
            <?php foreach($period as $day) : ?>
                <td><?php echo $day->day;?></td>
                <td><?php echo $day->diurno;?></td>
                <td><?php echo $day->noturno;?></td>
            <?php endforeach; ?>
        </tbody>
    </tr>
</table>