<?php
// Function to fetch all enrollment records
function getEnrollments($conn) {
    // SQL query to select all rows from the 'enrolled_course' table
    $sql = "SELECT * FROM enrolled_course";
    $result = $conn->query($sql);
    $data = [];

    // Loop through each row of the query result and add it to the array
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Convert the resulting array into JSON and output it
    echo json_encode($data);
}

// Function to add a new enrollment record
function addEnrollment($conn, $data) {
    // Extract student ID and course ID from the input data
    $student_id = $data['student_id'];
    $course_id = $data['course_id'];

    // SQL query to insert a new record into the 'enrolled_course' table
    $sql = "INSERT INTO enrolled_course (student_id, course_id) VALUES ('$student_id', '$course_id')";

    // Execute the query and handle the response
    switch ($conn->query($sql)) {
        case true:
            // If insertion succeeds, return a success message as JSON
            echo json_encode(["message" => "Enrollment added successfully (๑>ᴗ<๑)!"]);
        break;

        default:
            // If there's an error, return the MySQL error message as JSON
            echo json_encode(["error" => $conn->error]);
        break;
    }
}
?>
