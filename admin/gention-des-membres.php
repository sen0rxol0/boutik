<?php 

$res = $pdo->query('SELECT * FROM membre');

$content .= '<table>'
for ($i = 0; i < $res->columnCount(); i++) {
    $col = $res->getColumnMeta($i);
    $content .= '<tr>' . $col['name'] . '</tr>';
}

$content .= '</table>';
// if ($res->columnCount() >= 1) {
//     for ($i = 0; i < $res->columnCount(); i++) {
//         $col = $res->getColumnMeta($i);
//         $content .= ""

//     }
// }

?>