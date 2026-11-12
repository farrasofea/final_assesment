<?php
include "header.php";
include "auth.php";
include "db.php";

if (isset($_POST['submit'])) {
    $student_name = $_POST['student_name'];
    $matric_no = $_POST['matric_no'];
    $subject_name = $_POST['subject_name'];
    $subject_code = $_POST['subject_code'];
    $test1 = $_POST['test1'];
    $test2 = $_POST['test2'];
    $final_exam = $_POST['final_exam'];

    $total_marks = $test1 + $test2 + $final_exam;

    //80-100 = A
    //65 - 79 = B
    //50 - 64 = C
    //40 - 49 = D
    //0 - 39 = F

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

    $sql = $conn->prepare("INSERT INTO results (student_name, matric_no, subject_name, subject_code, test1, test2, final_exam, total_marks, grade) 
VALUES ('$student_name', '$matric_no', '$subject_name', '$subject_code', $test1, $test2, $final_exam, $total_marks, '$grade')");

    if ($sql->execute()) {
        header("Location: index.php");
    }
}

$student_name = "";
$matric_no = "";
$subject_name = "";
$subject_code = "";
$test1 = "";
$test2 = "";
$final_exam = "";
?>

<h2>ADD RESULT</h2>


<?php
include "form.php";
include "footer.php";
?>