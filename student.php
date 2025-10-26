<?php
function getStudents($conn) {
    $sql = "SELECT * FROM student";
    $result = $conn->query($sql);
    $data = [];

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
}

function addStudent($conn, $data) {
    $student_name = $data['student_name'];
    $program_id = $data['program_id'];

    $sql = "INSERT INTO student (student_name, program_id) VALUES ('$student_name', '$program_id')";
    switch ($conn->query($sql)) {
        case true:
            echo json_encode(["message" => "Student added successfully (๑>ᴗ<๑)!"]);
        break;

        default:
            echo json_encode(["error" => $conn->error]);
        break;
    }
}
?>
