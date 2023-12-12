<?php
include './includes/config.php';

$pdo = Database::connection();


$sql = "SELECT * from cover_title ";
$stmt = $pdo->prepare($sql);
// $stmt->bindParam(':status', $status, PDO::PARAM_INT);
$data = [];

if ($stmt->execute()) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $stat = ($row['status'] == 0) ? 'PENDING' : 'APPROVED';
        $badgeColor = ($row['status'] == 1) ? 'success' : 'danger';
        $subarray = [
            '<td>' . $row['cover_title'] . '</span> </td>',
            '<td><span class="badge  badge-' . $badgeColor . '">' . $stat . '</td>',
            '<td>
             <button class="btn btn-primary" onclick="Edit_title(' . $row['id'] . ')"><i class="nav-icon fas fa-eye"></i></button></td>
            </td>',
        ];
        $data[] = $subarray;
    }
}

$output = [
    'data' => $data,
];

echo json_encode($output);
?>