<?php
// the database connection file
include 'db.php';

// Check if there's a 'request' parameter in the URL (e.g., routes.php?request=getstudents)
if (isset($_REQUEST['request'])) {
    // Split the request by '/' to handle different routes
    $req = explode('/', rtrim($_REQUEST['request'], '/'));
} else {
    // Default value if no request is provided
    $req = array("errorcatcher");
}

// Set the content type to JSON since this is an API
header("Content-Type: application/json");

// Determine what kind of HTTP request was made (GET or POST)
switch ($_SERVER['REQUEST_METHOD']) {

// GET rqsts
    case 'GET':
        switch ($req[0]) {
            case 'getstudents':
                include 'student.php'; // include student functions
                getStudents($conn);    // call the function that fetches all students
                break;

            case 'getprograms':
                include 'program.php';
                getPrograms($conn);
                break;

            case 'getcourses':
                include 'course.php';
                getCourses($conn);
                break;

            case 'getdepartments':
                include 'department.php';
                getDepartments($conn);
                break;

            case 'getenrolled':
                include 'enrolled_courses.php';
                getEnrollments($conn);
                break;

            default:
                // Error message if the requested route doesn’t exist
                echo json_encode(["error" => "Route not found (╥ ‸ ╥)"]);
                break;
        }
        break;


// POST rqsts
    case 'POST':
        // Decode JSON input data from the body of the request
        $data = json_decode(file_get_contents("php://input"), true);

        switch ($req[0]) {
            case 'addstudent':
                include 'student.php';
                addStudent($conn, $data);
                break;

            case 'addprogram':
                include 'program.php';
                addProgram($conn, $data);
                break;

            case 'addcourse':
                include 'course.php';
                addCourse($conn, $data);
                break;

            case 'adddepartment':
                include 'department.php';
                addDepartment($conn, $data);
                break;

            case 'addenrolled':
                include 'enrolled_courses.php';
                addEnrollment($conn, $data);
                break;

            default:
                // Error if no matching POST route found
                echo json_encode(["error" => "Route not found"]);
                break;
        }
        break;

    // If the request method is neither GET nor POST
    default:
        echo json_encode(["error" => "Invalid request method"]);
        break;
}
?>
