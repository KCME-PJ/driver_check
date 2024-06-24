<?php
function question_tbl()
{
    $tbl = null;
    $i = 0;
    $id_1 = 1;
    $id_2 = 2;
    $sql = <<<SQL
    SELECT * FROM questions ORDER BY RAND();
    SQL;
    try {
        $dbh = getDb();
        $stmt = $dbh->query($sql);
        foreach ($stmt as $row) {
            ++$i;
            $q_id = $row['q_id'];
            $question = $row['question'];
            $f_name = "btn_radio" . $q_id;      //radio button group の名前
            $id1_name = "radio_id" . $id_1;  //radio button group 内のID1つ目
            $id2_name = "radio_id" . $id_2;  //radio button group 内のID2つ目

            $id_1 += 2;
            $id_2 += 2;

            $tbl .= <<<EOD
                <tr>
                <th scope="row">$i</th>
                <td class="text-center">
                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                        <input type="radio" class="btn-check" name="$f_name" id="$id1_name" value="1" autocomplete="off" required>
                        <label class="btn btn-outline-primary" for="$id1_name"><i class="bi bi-circle"></i></label>
                        <input type="radio" class="btn-check" name="$f_name" id="$id2_name" value="0" autocomplete="off">
                        <label class="btn btn-outline-primary" for="$id2_name"><i class="bi bi-x-lg"></i></label>
                    </div>
                </td>
                <td>$question</td>
                </tr>
            EOD;
        }
        return $tbl;
    } catch (Exception $e) {
        print "ERR! : {$e->getMessage()}";
    } finally {
        $dbh = null;
    }
}
