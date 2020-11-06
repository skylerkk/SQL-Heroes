<!-- DIsplay all heroes -->

<?php  
include "functions.php";
$heroes = get_all_heroes();
$powers = NULL;
// echo $result->num_rows;


if ($heroes->num_rows > 0) {
        while($row = $heroes->fetch_assoc()){
            echo "<div class='card col-12' style='width: 18rem;'>";
                echo "<img src='{$row['image_url']}' class='card-img-top' alt=''>";
                echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>{$row['name']}</h5>";
                    echo "<p class='card-text'>{$row['biography']}</p>";
                    echo "<form method='post' action='herospage.php'>";
                        echo "<input value={$row['id']} name='heropage' type='hidden'></input>";
                        echo "<button type='submit' class='btn btn-secondary'>Go To Their Page!</button>";
                    echo "</form>";
                echo "</div>";
            echo "</div>";
        }
    }
else{
        echo "No heroes. It's over pack it up. You messed up and someone deleted all the heroes.";
}
echo "<br><nl>";
?>
<!-- Change hero name -->
<?php

$names = get_names();

echo "<form method='post' action=''>";
echo "<select name='selection'>";
if ($names->num_rows > 0){
    while($row = $names->fetch_assoc()){
        echo "<option value = '". $row['id'] ."'>" . $row['name'] . "</option>";
    }
}
echo "</select>";


?>

    <input name="new_name" type="text" placeholder="change hero name"> 
    <button class = 'btn btn-secondary' type="submit" name="new_name_submit">
        New Hero Name
    </button>
</form>

<!-- Add Hero Code -->
<?php

// if(isset($_POST['submit'])){
if($_POST['name'] != '' && $_POST['about_me'] != '' && $_POST['biography'] != ''){

    $conn = start_server();
    $sqlcommand = "INSERT INTO heroes (name, about_me, biography, image_url) VALUE ( '{$conn->real_escape_string($_POST['name'])}', '{$conn->real_escape_string($_POST['about_me'])}' , '{$conn->real_escape_string($_POST['biography'])}', NULL);";
    $insertHero = $conn->query($sqlcommand);
    if($insertHero){
        echo "Success! Row ID: {$conn->insert_id}";
    }else{
        die("Error : {$conn->errno} : {$conn->error}");
    }
    $newid = $conn->insert_id;
    $abilityquery = "INSERT INTO ability_hero (hero_id, ability_id) VALUE ('{$newid}', '{$conn->real_escape_string($_POST['powers'])}')";
    $ability = $conn->query($abilityquery);
    stop_server($conn);
    echo "<meta http-equiv='refresh' content='0'>";

}

else if($_POST['new_name'] != ''){
    $conn = start_server();
    $sqlcommand = "UPDATE heroes SET name = '{$conn->real_escape_string($_POST['new_name'])}' WHERE id = '{$conn->real_escape_string($_POST['selection'])}'";
    $update = $conn->query($sqlcommand);
    if($update){
        echo "Thank god";
    }
    else{
        die("Error: {$conn->errno} : {$conn->error}");
    }
    stop_server($conn);
    echo "<meta http-equiv='refresh' content='0'>";
}

else if(isset($_POST['delete_hero'])){
    $conn = start_server();
    $sqlcommand = "DELETE FROM heroes WHERE id = '{$conn->real_escape_string($_POST['deletion'])}'";
    $delete = $conn->query($sqlcommand);
    if($delete){
        echo "Thank god";
    }
    else{
        die("Error: {$conn->errno} : {$conn->error}");
    }
    $abilitycommand = "DELETE FROM ability_hero WHERE hero_id = '{$conn->real_escape_string($_POST['deletion'])}'";
    $deleteability = $conn->query($abilitycommand);
    stop_server($conn);
    echo "<meta http-equiv='refresh' content='0'>";
}
// }

?>

<form method="post" action="">
        <input name="name" type="text" value="" placeholder="hero name">
        <input name="about_me" type="text" value="" placeholder="hero about me">
        <input name="biography" type="text" value="" placeholder="hero biography">
        <?php 
            $powers = get_powers();
            echo "<form method='post' action=''>";
            echo "<select name='powers'>";
            if ($powers->num_rows > 0){
                while($row = $powers->fetch_assoc()){
                    echo "<option value = '". $row['id'] ."'>" . $row['ability'] . "</option>";
                }
            }
            echo "</select>";
        ?>
        <button class = 'btn btn-secondary'type="submit" name="new_hero">
        New Hero
    </button>
</form>

<?php
$names = get_names();


echo "<form method='post' action=''>";
echo "<select name='deletion'>";
if ($names->num_rows > 0){
    while($row = $names->fetch_assoc()){
        echo "<option value = '". $row['id'] ."'>" . $row['name'] . "</option>";
    }
}
echo "</select>";

?>

<button class = 'btn btn-secondary' type="submit" name="delete_hero">
Remove Hero
</button>
</form>