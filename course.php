<?php
function getCourses($conn) {
    $sql = "SELECT * FROM course";
    $result = $conn->query($sql);
    $data = [];

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
}

function addCourse($conn, $data) {
    $course_name = $data['course_name'];
    $program_id = $data['program_id'];
    $dept_id = $data['dept_id'];

    $sql = "INSERT INTO course (course_name, program_id, dept_id) VALUES ('$course_name', '$program_id', '$dept_id')";
    switch ($conn->query($sql)) {
        case true:
            echo json_encode(["message" => "Course added successfully (๑>ᴗ<๑)!"]);
        break;

        default:
            echo json_encode(["error" => $conn->error]);
        break;
    }
}
?>
