<?php
include 'db.php';

if (isset($_REQUEST['request'])) {
    $req = explode('/', rtrim($_REQUEST['request'], '/'));
} else {
    $req = array("errorcatcher");
}

header("Content-Type: application/json");

switch ($_SERVER['REQUEST_METHOD']) {

    # =========================
    # ======= GET ROUTES ======
    # =========================
    case 'GET':
        switch ($req[0]) {
            case 'getstudents':
                include 'student.php';
                getStudents($conn);
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
                echo json_encode(["error" => "Route not found (╥ ‸ ╥)"]);
                break;
        }
        break;


    # =========================
    # ======= POST ROUTES =====
    # =========================
    case 'POST':
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
                echo json_encode(["error" => "Route not found"]);
                break;
        }
        break;

    default:
        echo json_encode(["error" => "Invalid request method"]);
        break;
}
?>
