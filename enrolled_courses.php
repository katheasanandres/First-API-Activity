<?php
function getEnrollments($conn) {
    $sql = "SELECT * FROM enrolled_course";
    $result = $conn->query($sql);
    $data = [];

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
}

function addEnrollment($conn, $data) {
    $student_id = $data['student_id'];
    $course_id = $data['course_id'];

    $sql = "INSERT INTO enrolled_course (student_id, course_id) VALUES ('$student_id', '$course_id')";
    switch ($conn->query($sql)) {
        case true:
            echo json_encode(["message" => "Enrollment added successfully (๑>ᴗ<๑)!"]);
        break;

        default:
            echo json_encode(["error" => $conn->error]);
        break;
    }
}
?>
