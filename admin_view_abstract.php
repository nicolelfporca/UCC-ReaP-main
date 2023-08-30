<?php
require './includes/config.php';
$pdo = Database::connection();
$id = $_POST['views'];

// Assuming $conn is your PDO connection
$sql = "SELECT * FROM `user` WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $abstract = $row['abstract'];
    $isType2 = $row['type'] == 2;

    $style = $isType2 ? 'width: 500px;' : 'font-size: 18px; text-align: left;';
    $content = $isType2 ? "<img src='./webimg/$abstract' height='600'>" : $abstract;

    ?>
    <table border="0" width='100%'>
        <tr align=center>
            <td style="<?php echo $style; ?>"><?php echo $content; ?></td>
        </tr>
    </table>
    <?php
}
?>