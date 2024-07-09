<table class="table">
    <tr>
        <th>Data</th>
        <th>Diurno</th>
        <th>Noturno</th>
    </tr>

<?php
foreach ($period as $dia) {
    echo "<tr>";
        echo "<td>" . $dia->data . "</td>";
        echo "<td><input type=\"text\"></td>";
        echo "<td><input type=\"text\"></td>";
    echo "</tr>";
}
?>
</table>