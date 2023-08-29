<?php
include './includes/config.php';

$pdo = Database::connection();

$roles = 2;
$sql = "SELECT * FROM login Where role = :roles";
$stmt = $pdo->prepare($sql);
$stmt -> bindParam(':roles', $roles, PDO::PARAM_INT);

$data = [];

if ($stmt->execute()) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
 
        $subarray = [
            '<td>' . $row['username'] . '</td>',
            '<td>' . $row['password'] . '</td>',
          
            '<td><button class="btn btn-primary" onclick="update_admin_password(' .$row['log_id'] . ')"><i class="nav-icon fas fa-edit"></i></button></td>',
        ];
        $data[] = $subarray;
    }
}

$output = [
    'data' => $data,
];

echo json_encode($output);
?>
