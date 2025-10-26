<?php
// Function to retrieve all student records from the database
function getStudents($conn) {
    // SQL query to fetch all records from the 'student' table
    $sql = "SELECT * FROM student";
    $result = $conn->query($sql);

    // Initializes an array to store the results
    $data = [];

    // Loop through each row returned by the query and add it to the array
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Convert the array of data to JSON format and output it
    echo json_encode($data);
}

// Function to add a new student record into the database
function addStudent($conn, $data) {
    // Extract the student name and program ID from the input JSON data
    $student_name = $data['student_name'];
    $program_id = $data['program_id'];

    // SQL query to insert a new student record
    $sql = "INSERT INTO student (student_name, program_id) VALUES ('$student_name', '$program_id')";

    // Execute the query and check if it succeeded or failed
    switch ($conn->query($sql)) {
        case true:
            // Success message if the query executes correctly
            echo json_encode(["message" => "Student added successfully (๑>ᴗ<๑)!"]);
        break;

        default:
            // Error message if the query fails, showing the MySQL error
            echo json_encode(["error :(" => $conn->error]);
        break;
    }
}
?>
