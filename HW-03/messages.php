<?php
$pageTitle='Messages';
include 'includes/header.php';
session_start();
if (!checkSession()) navigate("index.php");
?>


<div class="row">
    <br/>
    <div class="span3 offset12">
     <a href="logout.php"><input type="button" class="btn" value="Logout!" /></a>
    </div>
    <div class="span3 offset2">
        <a href="postmessage.php"><input type="button" class="btn" value="Add New Message!" /> </a>
    </div>
    <div class="span5 offset1">
        <?php
                $sql = "SELECT  messages.message_id, messages.message, messages.summary, messages.creation_date, users.username 
                        FROM messages JOIN users ON messages.user_id = users.id 
						ORDER BY messages.message_id DESC";
		$res =  mysqli_query($link, $sql);
                if (!$res) die( mysqli_error($link));
		while($row =  mysqli_fetch_assoc($res))
			{
				echo "<div>";
                                echo "<p>From: <b>" . $row["username"] . "</b> Posted at: " .$row["creation_date"]. "</p>";
                                echo "<h4>" . $row["summary"] . "</h4>";
                                echo $row["message"];
                                echo "</div>";
                                echo "<hr />";
			}
        ?>
    </div>
</div>

<?php
include 'includes/footer.php';
?>