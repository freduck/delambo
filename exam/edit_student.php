<div class="report-wrapper">
    <div style="position: absolute; top: 20px; right: 20px;" class="no-print">
        <a href="edit_student.php?name=<?= urlencode($name) ?>" 
           style="background: #f1f5f9; color: #2563eb; padding: 5px 12px; border-radius: 4px; text-decoration: none; font-size: 0.8rem; border: 1px solid #cbd5e1; font-weight: bold;">
           ✏️ Edit Marks
        </a>
    </div>

    <div class="report-header">
        <div class="school-brand">
            <!-- <h2>ACADEMIC REPORT CARD</h2> -->
            


<?php
$host = 'localhost'; $db = 'de_lambo'; $user = 'root'; $pass = '';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
} catch (\PDOException $e) { die("Connection failed"); }

$student_name = $_GET['name'] ?? '';
if (!$student_name) die("Student not found.");

// Handle Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST['subjects'] as $id => $data) {
        $t1 = (float)$data['t1'];
        $t2 = (float)$data['t2'];
        $exam = (float)$data['exam'];
        $ca_total = $t1 + $t2;
        $total = $ca_total + $exam;

        // Grade Logic
        if ($total >= 75) $grade = "A";
         elseif ($total >= 70 && $total<=75) $grade = "AB";
        elseif ($total >= 65 && $total<=69) $grade = "B";
        elseif ($total >= 60 &&$total<=64) $grade = "BC";
        elseif ($total >= 55 && $total<=60) $grade = "C";
        elseif ($total >= 50 && $total<=55) $grade = "CD";
        elseif ($total >= 40 && $total<=49) $grade = "E";
        else $grade = "F";

        $stmt = $pdo->prepare("UPDATE second_term SET test_1=?, test_2=?, ca_total=?, exam=?, total=?, grade=?, teacher_comment=?, principal_comment=? WHERE id=?");
        $stmt->execute([$t1, $t2, $ca_total, $exam, $total, $grade, $_POST['teacher_comment'], $_POST['principal_comment'], $id]);
    }
    header("Location: student_report.php?updated=1");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM second_term WHERE student_name = ?");
$stmt->execute([$student_name]);
$entries = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Result - <?= htmlspecialchars($student_name) ?></title>
    <style>
        body { font-family: sans-serif; background: #f1f5f9; padding: 40px; }
        .edit-container { max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 10px; border: 1px solid #e2e8f0; text-align: left; }
        input[type="number"] { width: 60px; padding: 5px; }
        textarea { width: 100%; margin-top: 10px; padding: 10px; border-radius: 5px; border: 1px solid #cbd5e1; }
        .save-btn { background: #16a34a; color: white; padding: 12px 20px; border: none; border-radius: 6px; cursor: pointer; width: 100%; font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>

<div class="edit-container">
    <h2>Editing: <?= htmlspecialchars($student_name) ?></h2>
    <form method="POST">
        <table>
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Test 1</th>
                    <th>Test 2</th>
                    <th>CA Total</th>
                    <th>Exam</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($entries as $row): ?>
                <tr>
                    <td><strong><?= $row['subject'] ?></strong></td>
                    <td><input type="number" step="0.1" name="subjects[<?= $row['id'] ?>][t1]" value="<?= $row['test_1'] ?>"></td>
                    <td><input type="number" step="0.1" name="subjects[<?= $row['id'] ?>][t2]" value="<?= $row['test_2'] ?>"></td>
                    <td><input type="number" step="0.1" name="subjects[<?= $row['id'] ?>][t2]" value="<?= $row['ca_total'] ?>"></td>
                    <td><input type="number" step="0.1" name="subjects[<?= $row['id'] ?>][exam]" value="<?= $row['exam'] ?>"></td>
                    <td><input type="number" step="0.1" name="subjects[<?= $row['id'] ?>][t2]" value="<?= $row['total'] ?>"></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <label>Teacher's Comment</label>
        <textarea name="teacher_comment" rows="3"><?= htmlspecialchars($entries[0]['teacher_comment']) ?></textarea>

        <label>Principal's Comment</label>
        <textarea name="principal_comment" rows="3"><?= htmlspecialchars($entries[0]['principal_comment']) ?></textarea>

        <button type="submit" class="save-btn">Update All Records</button>
        <p style="text-align:center;"><a href="second_term_result.php" style="color: #64748b;">Cancel and Go Back</a></p>
    </form>
</div>

</body>
</html>