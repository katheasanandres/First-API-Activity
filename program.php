<?php
function getPrograms($conn) {
    $sql = "SELECT * FROM program";
    $result = $conn->query($sql);
    $data = [];

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
}

function addProgram($conn, $data) {
    $program_name = $data['program_name'];
    $dept_id = $data['dept_id'];

    $sql = "INSERT INTO program (program_name, dept_id) VALUES ('$program_name', '$dept_id')";
    switch ($conn->query($sql)) {
        case true:
            echo json_encode(["message" => "Program added successfully (๑>ᴗ<๑)!"]);
        break;

        default:
            echo json_encode(["error" => $conn->error]);
        break;
    }
}
?>
