<?php
function getDepartments($conn) {
    $sql = "SELECT * FROM department";
    $result = $conn->query($sql);
    $data = [];

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
}

function addDepartment($conn, $data) {
    $dept_name = $data['dept_name'];

    $sql = "INSERT INTO department (dept_name) VALUES ('$dept_name')";
    switch ($conn->query($sql)) {
        case true:
            echo json_encode(["message" => "Department added successfully (๑>ᴗ<๑)!"]);
        break;

        default:
            echo json_encode(["error" => $conn->error]);
        break;
    }
}
?>
