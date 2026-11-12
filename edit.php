<?php
include 'db.php';
include 'auth.php';
include 'header.php';

//fallback, ?? equal to if else
$id = $_GET['id'] ?? 0;

$sql = $conn->prepare("SELECT * FROM results WHERE result_id = $id");
$sql->execute();

$row = $sql->get_result()->fetch_assoc();
/*$row = [id, student_name, matric_no, subject_name...]
         [1, Ali, HJU223943, Math...,
         2, Ahmad, HJU223944, Science...]
*/

$student_name = $row['student_name'];
$matric_no = $row['matric_no'];
$subject_name = $row['subject_name'];
$subject_code = $row['subject_code'];
$test1 = $row['test1'];
$test2 = $row['test2'];
$final_exam = $row['final_exam'];

if (isset(($_POST['submit']))) {
    $student_name = $_POST['student_name'];
    $matric_no = $_POST['matric_no'];
    $subject_name = $_POST['subject_name'];
    $subject_code = $_POST['subject_code'];
    $test1 = $_POST['test1'];
    $test2 = $_POST['test2'];
    $final_exam = $_POST['final_exam'];

    $total_marks = $test1 + $test2 + $final_exam;

    if($total_marks >= 80){
        $grade = 'A';
    } elseif($total_marks >= 65){
        $grade = 'B';
    } elseif($total_marks >= 50){
        $grade = 'C';
    } elseif($total_marks >= 40){
        $grade = 'D';
    } else {
        $grade = 'E';
    }

    $sql = $conn->prepare("UPDATE results SET
    student_name = '$student_name',
    matric_no = '$matric_no',
    subject_name = '$subject_name',
    subject_code = '$subject_code',
    test1 = $test1,
    test2 = $test2,
    final_exam = $final_exam,
    total_marks = $total_marks,
    grade = '$grade'
    WHERE result_id = $id");

    
    if ($sql->execute()) {
        header("Location: index.php");
    }

}

?>

<h2>Edit Result</h2>

<?php
include 'form.php';
include 'footer.php';
?>