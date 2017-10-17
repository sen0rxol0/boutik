<?php 

$res = $pdo->query('SELECT * FROM membre');

$content .= '<table class="table"><tr>'
for ($i = 0; i < $res->columnCount(); i++) {
    $col = $res->getColumnMeta($i);
    $content .= '<th>' . $col['name'] . '</th>';
}

$content .= '</tr></table>';
// if ($res->columnCount() >= 1) {
//     for ($i = 0; i < $res->columnCount(); i++) {
//         $col = $res->getColumnMeta($i);
//         $content .= ""

//     }
// }

?>