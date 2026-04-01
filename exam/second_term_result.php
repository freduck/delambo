

<?php
// Database connection
require 'admin/config.php';
$host = 'localhost'; $db = 'de_lambo'; $user = 'root'; $pass = '';
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
try {
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
} catch (\PDOException $e) { die("Connection failed"); }

// Fetch all results ordered by name
$results = $pdo->query("SELECT * FROM second_term ORDER BY student_name ASC")->fetchAll();
$select = $conn->query('SELECT * FROM settings');

$school = $select->fetch_assoc();
// Group subjects by Student Name
$students = [];
foreach ($results as $row) {
    $students[$row['student_name']][] = $row;
}

function getGradeData($total) {
    if ($total <=100 && $total>=80 ) return ['bg' => '#dcfce7', 'text' => '#006400', 'grade' => 'A++'];
    if ($total >=80 && $total<=85) return ['bg' => '#f0fdf4', 'text' => '#228B22', 'grade' => 'A+'];
    if ($total >=75 && $total<80) return ['bg' => '#ecfeff', 'text' => '#00800', 'grade' => 'A'];
    if ($total >=70 && $total<75) return ['bg' => '#ecfeff', 'text' => '#90EE90', 'grade' => 'AB'];
    if ($total >= 65  && $total<70) return ['bg' => '#e0f2fe', 'text' => '#2E8B57', 'grade' => 'B'];
    if ($total >= 60  && $total<65) return ['bg' => '#fef9c3', 'text' => '#a16207', 'grade' => 'BC'];
    if ($total >= 55  && $total<=59) return ['bg' => '#e0f2fe', 'text' => '#0369a1', 'grade' => 'C'];
    if ($total >= 50  && $total<55) return ['bg' => '#e0f2fe', 'text' => '#0369a1', 'grade' => 'CD'];
    if ($total >= 40  && $total<50) return ['bg' => '#e0f2fe', 'text' => '#0369a1', 'grade' => 'D'];
    if ($total >= 40 && $total<=45) return ['bg' => '#ffedd5', 'text' => '#c2410c', 'grade' => 'E'];
    return ['bg' => '#fee2e2', 'text' => '#b91c1c', 'grade' => 'F'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprehensive Student Report</title>
    <style>
        body { font-family: 'Inter', sans-serif; background: #e2e8f0; padding: 50px 20px; color: #1e293b; margin: 0; }
        
        /* Top Navigation */
        .no-print-zone { 
            max-width: 600px; margin: 0 auto 40px; 
            display: flex; justify-content: space-between; align-items: center; 
            background: white; padding: 15px 25px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        }
        #searchBox { padding: 10px 15px; width: 300px; border: 1px solid #cbd5e1; border-radius: 6px; outline: none; }
        .print-btn { background: #2563eb; color: white; padding: 10px 25px; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; }

        /* Report Card - Large Centered Design */
        .report-wrapper { 
            background: white; 
            max-width: 650px; 
            margin: 0 auto 60px auto; 
            padding: 50px; 
            border-radius: 8px; 
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
            position: relative;
            border-top: 10px solid #1e293b;
        }
        hr{
            border:2px solid crimson;
        }
        .report-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 40px; border-bottom: 2px solid crimson; padding-bottom: 20px; }
        .school-brand h2 { margin: 0; font-size: 1.8rem; color: crimson; }
        .student-meta { margin-top: 10px; line-height: 1.6; }
        .student-photo { width: 110px; height: 120px; border-radius: 8px; object-fit: cover; border: 4px solid crimson; }

        /* Results Table */
        table { width: 100%; border-collapse: collapse; margin: 30px 0; }
        th { text-align: left; padding: 12px; background: #f8fafc; font-size: 0.75rem; text-transform: uppercase; color: #64748b; border-bottom: 2px solid crimson; }
        td { padding: 14px 12px; border-bottom: 1px solid crimson; font-size: 0.95rem; }
        .subject-name { font-weight: 700; color: #334155; }
        .grade-chip { padding: 4px 12px; border-radius: 4px; font-weight: 800; font-size: 0.8rem; }

        /* Remarks Section */
        .remarks-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-top: 20px; border-top: 2px solid #f1f5f9; padding-top: 30px; }
        .remark-item h4 { margin: 0 0 10px 0; font-size: 0.8rem; text-transform: uppercase; color: #94a3b8; letter-spacing: 0.5px; }
        .remark-content { background: #f8fafc; padding: 10px; border-radius: 8px; border: 1px solid crimson; font-style: italic; min-height: 30px; line-height: 1.5; color: #334155; }
.info h2{
text-align:center;
}
.address{
    text-align:center;
}
.marking h3{
text-align:center;
}

        @media print {
            .no-print-zone { display: none !important; }
            body { background: white; padding: 0; }
            .report-wrapper { max-width: 100%; border: none; box-shadow: none; padding: 20px; page-break-after: always; }
            #edit-button{
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="no-print-zone">
    <input type="text" id="searchBox" placeholder="🔍 Search student name..." onkeyup="searchStudent()">
    <button onclick="window.print()" class="print-btn">Print Result Sheet</button>
</div>

<div id="reportsContainer">
    <?php foreach ($students as $name => $subjectEntries): 
        $info = $subjectEntries[0]; // Extract base info
        $grandTotal = 0;
    ?>
    <div class="report-wrapper">
        <div class="info">
<img src="logo.png" alt="" style="width:60px; height: 60px;">
            <h2>
      
                <?php  echo $school['school_name'];?>
            </h2>
          <div class='address'> Address: <small><?php echo $school['address'];?></small> </div> 

        </div>
        <hr>
        <div class="report-header">
            

            <div class="school-brand">
                <h4>STUDENT RESULT SHEET</h4>
                <div class="student-meta">
                    <strong>NAME:</strong> <?= htmlspecialchars($name) ?><br>
                    <strong>TERM:</strong> <?= htmlspecialchars($info['term']) ?><br>
                    <strong>SESSION:</strong> 2025/2026
                </div>
            </div>
            <img src="admin/<?= htmlspecialchars($info['image'] ?: 'default.png') ?>" class="student-photo">
        </div>

        <table>
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Test 1</th>
                    <th>Test 2</th>
                    <th>Exam</th>
                    <th>Total</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($subjectEntries as $sub): 
                    $gradeInfo = getGradeData($sub['total']);
                    $grandTotal += $sub['total'];
                ?>
                <tr>
                    <td class="subject-name"><?= htmlspecialchars($sub['subject']) ?></td>
                    <td><?= $sub['test_1'] ?></td>
                    <td><?= $sub['test_2'] ?></td>
                    <td><?= $sub['exam'] ?></td>
                    <td><strong><?= $sub['total'] ?></strong></td>
                    <td>
                        <span class="grade-chip" style="background: <?= $gradeInfo['bg'] ?>; color: <?= $gradeInfo['text'] ?>">
                            <?= $sub['grade'] ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
<hr style=""><br>
<div style ="display:flex; gap:200px;">

    <div style="text-align: left; margin-top: 10px;">
                <p style="font-size: 1.1rem;"><strong>Number of Subjects:</strong> 
                    <span style="color: #2563eb; font-size: 1.3rem;">
                        <?php 
                        // $name = $name['student_name'];
                        $select2 = $conn->query("SELECT * FROM second_term WHERE student_name = '$name'");
                        if($select2->num_rows>0){
    
                            $count = $select2->num_rows;
                        }else{
                            $count = '';
                        }
                        
                        ?>
                        <?= $count; ?>
                    </span>
                </p>
            </div>
            <div style="text-align: right; margin-top: 10px;">
                <p style="font-size: 1.1rem;"><strong>Overall Average:</strong> 
                    <span style="color: #2563eb; font-size: 1.3rem;">
                        <?= number_format($grandTotal / count($subjectEntries), 2) ?>%
                    </span>
                </p>
            </div>
</div>

        <div class="remarks-grid">
            <div class="remark-item">
                <h4>Teacher's Comment</h4>
                <div class="remark-content">
                    "<?= htmlspecialchars($info['teacher_comment'] ?: 'No comment provided.') ?>"
                </div>
            </div>
            <div class="remark-item">
                <h4>Principal's Comment</h4>
                <div class="remark-content">
                    "<?= htmlspecialchars($info['principal_comment'] ?: 'No comment provided.') ?>"
                </div>
            </div>
        </div>

        <div style="margin-top: 50px; display: flex; justify-content: space-between;">
            <div style="border-top: 1px solid crimson; width: 200px; text-align: center; padding-top: 5px; font-size: 0.8rem;">Class Teacher Signature</div>
            <div style="border-top: 1px solid crimson; width: 200px; text-align: center; padding-top: 5px; font-size: 0.8rem;">Principal Signature</div>
        </div>
        <br>
        <hr> <br>
        <div class="marking">
            <h3>
                GRADING 
            </h3>
            <table>
                <tr>
                    <th>SCORE</th><th>GRADE</th>
                </tr>
                <tr>
                    <td>0-39</td>
                    <td>F</td>
                </tr>
                  <tr>
                    <td>40-44</td>
                    <td>E</td>
                </tr>
                 <tr>
                    <td>45-49</td>
                    <td>DE</td>
                </tr>
                <tr>
                    <td>50-54</td>
                    <td>D</td>
                </tr>
                <tr>
                    <td>55-59</td>
                    <td>C</td>
                </tr>
                <tr>
                    <td>60-64</td>
                    <td>BC</td>
                </tr>
                <tr>
                    <td>65-69</td>
                    <td>B</td>
                </tr>
                <tr>
                    <td>70-74</td>
                    <td>AB</td>
                </tr>
                <tr>
                    <td>75-79</td>
                    <td>A</td>
                </tr>
                <tr>
                    <td>80-85</td>
                    <td>A+</td>
                </tr>
                <tr>
                    <td>85-100</td>
                    <td>A++</td>
                </tr>
            </table>
            <hr>
        </div>
        <div style="margin-top:30px; margin-bottom: 30px;" id="edit-button">
             <a href="edit_student.php?name=<?= urlencode($name) ?>" 
             style="background: #f1f5f9; color: #2563eb; padding: 5px 12px; border-radius: 4px; text-decoration: none; font-size: 0.8rem; border: 1px solid #cbd5e1; font-weight: bold;">
             ✏️ Edit Marks
            </a>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<script>
function searchStudent() {
    let input = document.getElementById('searchBox').value.toLowerCase();
    let cards = document.getElementsByClassName('report-wrapper');
    for (let card of cards) {
        let studentName = card.querySelector('.student-meta strong').nextSibling.textContent.toLowerCase();
        card.style.display = studentName.includes(input) ? "block" : "none";
    }
}
</script>

</body>
</html>
