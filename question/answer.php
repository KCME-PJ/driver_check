<?php
$d_id = filter_input(INPUT_POST, 'd_id');
$qa_1 = filter_input(INPUT_POST, 'btn_radio1');
$qa_2 = filter_input(INPUT_POST, 'btn_radio2');
$qa_3 = filter_input(INPUT_POST, 'btn_radio3');
$qa_4 = filter_input(INPUT_POST, 'btn_radio4');
$qa_5 = filter_input(INPUT_POST, 'btn_radio5');
$qa_6 = filter_input(INPUT_POST, 'btn_radio6');
$qa_7 = filter_input(INPUT_POST, 'btn_radio7');
$qa_8 = filter_input(INPUT_POST, 'btn_radio8');
$qa_9 = filter_input(INPUT_POST, 'btn_radio9');
$qa_10 = filter_input(INPUT_POST, 'btn_radio10');
$qa_11 = filter_input(INPUT_POST, 'btn_radio11');
$qa_12 = filter_input(INPUT_POST, 'btn_radio12');
$qa_13 = filter_input(INPUT_POST, 'btn_radio13');
$qa_14 = filter_input(INPUT_POST, 'btn_radio1');
$qa_15 = filter_input(INPUT_POST, 'btn_radio15');
$qa_16 = filter_input(INPUT_POST, 'btn_radio16');
$qa_17 = filter_input(INPUT_POST, 'btn_radio17');
$qa_18 = filter_input(INPUT_POST, 'btn_radio18');
$qa_19 = filter_input(INPUT_POST, 'btn_radio19');
$qa_20 = filter_input(INPUT_POST, 'btn_radio20');
$qa_21 = filter_input(INPUT_POST, 'btn_radio21');
$qa_22 = filter_input(INPUT_POST, 'btn_radio22');
$qa_23 = filter_input(INPUT_POST, 'btn_radio23');
$qa_24 = filter_input(INPUT_POST, 'btn_radio24');
$qa_25 = filter_input(INPUT_POST, 'btn_radio25');
$qa_26 = filter_input(INPUT_POST, 'btn_radio26');
$qa_27 = filter_input(INPUT_POST, 'btn_radio27');
$qa_28 = filter_input(INPUT_POST, 'btn_radio28');
$qa_29 = filter_input(INPUT_POST, 'btn_radio29');
$qa_30 = filter_input(INPUT_POST, 'btn_radio30');
$qa_31 = filter_input(INPUT_POST, 'btn_radio31');
$qa_32 = filter_input(INPUT_POST, 'btn_radio32');
$qa_33 = filter_input(INPUT_POST, 'btn_radio33');
$qa_34 = filter_input(INPUT_POST, 'btn_radio34');
$qa_35 = filter_input(INPUT_POST, 'btn_radio35');
$qa_36 = filter_input(INPUT_POST, 'btn_radio36');
$qa_37 = filter_input(INPUT_POST, 'btn_radio37');
$qa_38 = filter_input(INPUT_POST, 'btn_radio38');
$qa_39 = filter_input(INPUT_POST, 'btn_radio39');
$qa_40 = filter_input(INPUT_POST, 'btn_radio40');
$qa_41 = filter_input(INPUT_POST, 'btn_radio41');
$qa_42 = filter_input(INPUT_POST, 'btn_radio42');
$qa_43 = filter_input(INPUT_POST, 'btn_radio43');
$qa_44 = filter_input(INPUT_POST, 'btn_radio44');
$qa_45 = filter_input(INPUT_POST, 'btn_radio45');
$qa_46 = filter_input(INPUT_POST, 'btn_radio46');
$qa_47 = filter_input(INPUT_POST, 'btn_radio47');
$qa_48 = filter_input(INPUT_POST, 'btn_radio48');
$qa_49 = filter_input(INPUT_POST, 'btn_radio49');
$qa_50 = filter_input(INPUT_POST, 'btn_radio50');

require_once '../db_access/database.php';
$sql = <<<SQL
INSERT INTO answers (d_id, qa_1, qa_2, qa_3, qa_4, qa_5, qa_6, qa_7, qa_8, qa_9, qa_10, qa_11, qa_12, qa_13, qa_14, qa_15, qa_16, qa_17, qa_18, qa_19, qa_20, qa_21, qa_22, qa_23, qa_24, qa_25, qa_26, qa_27, qa_28, qa_29, qa_30, qa_31, qa_32, qa_33, qa_34, qa_35, qa_36, qa_37, qa_38, qa_39, qa_40, qa_41, qa_42, qa_43, qa_44, qa_45, qa_46, qa_47, qa_48, qa_49, qa_50) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
SQL;
$dbh = getDb();
try {
    $sth = $dbh->prepare($sql);
    $sth->bindValue(1, $d_id, PDO::PARAM_INT);
    $sth->bindValue(2, $qa_1, PDO::PARAM_INT);
    $sth->bindValue(3, $qa_2, PDO::PARAM_INT);
    $sth->bindValue(4, $qa_3, PDO::PARAM_INT);
    $sth->bindValue(5, $qa_4, PDO::PARAM_INT);
    $sth->bindValue(6, $qa_5, PDO::PARAM_INT);
    $sth->bindValue(7, $qa_6, PDO::PARAM_INT);
    $sth->bindValue(8, $qa_7, PDO::PARAM_INT);
    $sth->bindValue(9, $qa_8, PDO::PARAM_INT);
    $sth->bindValue(10, $qa_9, PDO::PARAM_INT);
    $sth->bindValue(11, $qa_10, PDO::PARAM_INT);
    $sth->bindValue(12, $qa_11, PDO::PARAM_INT);
    $sth->bindValue(13, $qa_12, PDO::PARAM_INT);
    $sth->bindValue(14, $qa_13, PDO::PARAM_INT);
    $sth->bindValue(15, $qa_14, PDO::PARAM_INT);
    $sth->bindValue(16, $qa_15, PDO::PARAM_INT);
    $sth->bindValue(17, $qa_16, PDO::PARAM_INT);
    $sth->bindValue(18, $qa_17, PDO::PARAM_INT);
    $sth->bindValue(19, $qa_18, PDO::PARAM_INT);
    $sth->bindValue(20, $qa_19, PDO::PARAM_INT);
    $sth->bindValue(21, $qa_20, PDO::PARAM_INT);
    $sth->bindValue(22, $qa_21, PDO::PARAM_INT);
    $sth->bindValue(23, $qa_22, PDO::PARAM_INT);
    $sth->bindValue(24, $qa_23, PDO::PARAM_INT);
    $sth->bindValue(25, $qa_24, PDO::PARAM_INT);
    $sth->bindValue(26, $qa_25, PDO::PARAM_INT);
    $sth->bindValue(27, $qa_26, PDO::PARAM_INT);
    $sth->bindValue(28, $qa_27, PDO::PARAM_INT);
    $sth->bindValue(29, $qa_28, PDO::PARAM_INT);
    $sth->bindValue(30, $qa_29, PDO::PARAM_INT);
    $sth->bindValue(31, $qa_30, PDO::PARAM_INT);
    $sth->bindValue(32, $qa_31, PDO::PARAM_INT);
    $sth->bindValue(33, $qa_32, PDO::PARAM_INT);
    $sth->bindValue(34, $qa_33, PDO::PARAM_INT);
    $sth->bindValue(35, $qa_34, PDO::PARAM_INT);
    $sth->bindValue(36, $qa_35, PDO::PARAM_INT);
    $sth->bindValue(37, $qa_36, PDO::PARAM_INT);
    $sth->bindValue(38, $qa_37, PDO::PARAM_INT);
    $sth->bindValue(39, $qa_38, PDO::PARAM_INT);
    $sth->bindValue(40, $qa_39, PDO::PARAM_INT);
    $sth->bindValue(41, $qa_40, PDO::PARAM_INT);
    $sth->bindValue(42, $qa_41, PDO::PARAM_INT);
    $sth->bindValue(43, $qa_42, PDO::PARAM_INT);
    $sth->bindValue(44, $qa_43, PDO::PARAM_INT);
    $sth->bindValue(45, $qa_44, PDO::PARAM_INT);
    $sth->bindValue(46, $qa_45, PDO::PARAM_INT);
    $sth->bindValue(47, $qa_46, PDO::PARAM_INT);
    $sth->bindValue(48, $qa_47, PDO::PARAM_INT);
    $sth->bindValue(49, $qa_48, PDO::PARAM_INT);
    $sth->bindValue(50, $qa_49, PDO::PARAM_INT);
    $sth->bindValue(51, $qa_50, PDO::PARAM_INT);
    $sth->execute();
} catch (Exception $e) {
    print "ERR! : {$e->getMessage()}";
} finally {
    $dbh = null;
}
header('Location: ../user/index.php');
