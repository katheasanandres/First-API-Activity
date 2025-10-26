<?php
// Function to fetch all programs from the database
function getPrograms($conn) {
    // SQL query to select every record from the 'program' table
    $sql = "SELECT * FROM program";
    $result = $conn->query($sql);
    $data = [];

    // Loop through all fetched rows and store them in an array
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Convert the array into JSON format and display it
    echo json_encode($data);
}

// Function to insert a new program into the database
function addProgram($conn, $data) {
    // Extract program name, dept ID, and dept name from the input JSON data
    $program_name = $data['program_name'];
    $dept_id = $data['dept_id'];

    // SQL statement to insert the new program into the 'program' table
    $sql = "INSERT INTO program (program_name, dept_id) VALUES ('$program_name', '$dept_id')";

    // Execute the query and check the result
    switch ($conn->query($sql)) {
        case true:
            // If successful, return a success message in JSON
            echo json_encode(["message" => "Program added successfully (๑>ᴗ<๑)!"]);
        break;

        default:
            // If there's an error, return the MySQL error message
            echo json_encode(["error" => $conn->error]);
        break;
    }
}
?>
