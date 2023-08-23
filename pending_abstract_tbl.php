<?php
include './includes/config.php';

$pdo = Database::connection();

$status = 0;
$sql = "SELECT title, author, uploaded_by, status, id FROM user WHERE status = :status ";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':status', $status, PDO::PARAM_INT);
$data = [];

if ($stmt->execute()) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $stat = ($row['status'] == 0 ) ? 'PENDING' : 'APPROVED';
        $subarray = [
            '<td>' . $row['title'] . '</td>',
            '<td>' . $row['author'] . '</td>',
            '<td>' . $row['uploaded_by'] . '</td>',
            '<td>' . $stat . '</td>',
            '<td><button class="btn btn-primary" onclick="update(' . $row['id'] . ')"><i class="nav-icon fas fa-edit"></i></button></td>',
        ];
        $data[] = $subarray;
    }
}

$output = [
    'data' => $data,
];

echo json_encode($output);
?>
