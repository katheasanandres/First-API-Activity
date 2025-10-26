<?php
// Function to get all courses from the database
function getCourses($conn) {
    // SQL query to select all records from the 'course' table
    $sql = "SELECT * FROM course";
    $result = $conn->query($sql);
    $data = [];

    // Loop through each fetched record and store it in the $data array
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Convert the data array to JSON format and return it as output
    echo json_encode($data);
}


// Function to add a new course to the database
function addCourse($conn, $data) {
    // Extract data sent from the request body
    $course_name = $data['course_name'];
    $program_id = $data['program_id'];
    $dept_id = $data['dept_id'];

    // SQL query to insert a new record into the 'course' table
    $sql = "INSERT INTO course (course_name, program_id, dept_id) VALUES ('$course_name', '$program_id', '$dept_id')";

    // Execute the query and check the result
    switch ($conn->query($sql)) {
        case true:
            // Success response when course is added
            echo json_encode(["message" => "Course added successfully (๑>ᴗ<๑)!"]);
        break;

        default:
            // Error response when query fails
            echo json_encode(["error" => $conn->error]);
        break;
    }
}
?>
