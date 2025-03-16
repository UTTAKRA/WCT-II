<?php
session_start();

if (!isset($_SESSION['students'])) {
    $_SESSION['students'] = [];
}

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    if ($data["action"] === "add") {
        $id = empty($_SESSION['students']) ? 1 : max(array_column($_SESSION['students'], 'id')) + 1;

        $_SESSION['students'][] = [
            "id" => $id, 
            "name" => $data["name"], 
            "age" => $data["age"], 
            "contact" => $data["contact"]
        ];
    } elseif ($data["action"] === "edit") {
        foreach ($_SESSION['students'] as &$student) {
            if ($student["id"] == $data["id"]) {
                $student["name"] = $data["name"];
                $student["age"] = $data["age"];
                $student["contact"] = $data["contact"];
                break;
            }
        }
    } elseif ($data["action"] === "delete") {
        $_SESSION['students'] = array_values(array_filter($_SESSION['students'], fn($student) => $student["id"] != $data["id"]));
    }

    echo json_encode(["status" => "success"]);
} else {
    usort($_SESSION['students'], fn($a, $b) => $a['id'] <=> $b['id']);
    echo json_encode($_SESSION['students']);
}
?>