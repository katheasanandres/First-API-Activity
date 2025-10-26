<?php
// Function to retrieve all departments from the database
function getDepartments($conn) {
    // SQL query to select all rows from the 'department' table
    $sql = "SELECT * FROM department";
    $result = $conn->query($sql);
    $data = [];

    // Fetch each department as an array and store it in $data
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Convert the array of departments into JSON format and output it
    echo json_encode($data);
}

// Function to add a new department record into the database
function addDepartment($conn, $data) {
    // Extract the department name from the received JSON data
    $dept_name = $data['dept_name'];

    // SQL query to insert a new department
    $sql = "INSERT INTO department (dept_name) VALUES ('$dept_name')";

    // Execute the query and handle the response
    switch ($conn->query($sql)) {
        case true:
            // Success message if insertion is successful
            echo json_encode(["message" => "Department added successfully (๑>ᴗ<๑)!"]);
        break;

        default:
            // Return MySQL error message if query fails
            echo json_encode(["error" => $conn->error]);
        break;
    }
}
?>
