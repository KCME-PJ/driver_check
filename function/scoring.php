<?php
function scoring($d_id)
{
    try {
        $sql_answer = <<<SQL
    SELECT * FROM answers WHERE d_id = ? ORDER BY create_at DESC LIMIT 1
    SQL;
        $dbh = getDb();
        $sth = $dbh->prepare($sql_answer);
        $sth->bindValue(1, $d_id, PDO::PARAM_INT);
        $sth->execute();
        $answer = $sth->fetch(PDO::FETCH_ASSOC);

        $total_correct = 0;
        $genre_correct = array_fill(1, 5, 0);

        for ($i = 1; $i <= 50; $i++) {
            $q_id = $i;
            $qa = "qa_" . $i;
            $user_answer = $answer["$qa"];

            $sql_question = <<<SQL
        SELECT answer, diagnosis FROM questions WHERE q_id = ?
        SQL;
            $sth = $dbh->prepare($sql_question);
            $sth->bindValue(1, $q_id, PDO::PARAM_INT);
            $sth->execute();
            $question = $sth->fetch(PDO::FETCH_ASSOC);

            if ($question) {
                $correct_answer = $question['answer'];
                $genre = $question['diagnosis'];

                if ($user_answer == $correct_answer) {
                    $total_correct++;
                    $genre_correct[$genre]++;
                }
            }
        }
        $result = [
            "genre_correct" => $genre_correct
        ];
        $check_day = $answer['create_at'];
        return array($total_correct, $check_day, $result);
    } catch (PDOException $e) {
        print "ERR! : {$e->getMessage()}";
    } finally {
        $pdo = null;
    }
}
