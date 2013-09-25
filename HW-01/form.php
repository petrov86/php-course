<?php
mb_internal_encoding('UTF-8');
$pageTitle = 'Разход';
include 'includes/header.php';

if($_POST){
    $date = date('d/m/Y');
    $name=trim($_POST['name']);
    $name = str_replace('!', '', $name);
    $price=trim($_POST['price']);
    $price=  str_replace('!', '', $price);
	$price = str_replace(',', '.', $price);
    $price = (float)$price;
    $selectedGroup=$_POST['group'];
    $error=false;
      
    if(mb_strlen($name)<3){
        $alert = 'Името е прекалено късо';
        printAlert($alert);
        $error=true;
    }
    
    if($price<=0){
        $alert = 'Цената трябва да бъде по-голяма от "0.00"';
        printAlert($alert);
        $error=true;
    }    
    if(!array_key_exists($selectedGroup, $groups)){
        $alert = 'Невалидна група';
        printAlert($alert);
        $error=true;
    }
    
    if(!$error){
        $result=$date. '!'.$name.'!'.$price.'!'.$selectedGroup.'!'."\n";
        if ($_GET)
            {
                $arr = file('data.txt');
                $arr[$_GET["edit"]] = $result;
                $arr_to_string = implode($arr);
                if(file_put_contents('data.txt', $arr_to_string))
                {
                     $alert = 'Записа е редактиран успешно!';
                     printAlert($alert);
					 header("Location: index.php"); 
                }    
            }
       
        else if(file_put_contents('data.txt', $result, FILE_APPEND))
        {
             $alert = 'Записа е успешен!';
             printAlert($alert);
        }
    } 
}

?>

 <div id="header">
        <h2>
            <?php
                $newEntry = "Въведете нов разход";
                $editEntry = "Редактирайте разхода";
                if ($_GET) 
                {
                    echo $editEntry; 
                    //$_GET["edit"] is the line of the file that the user want to edit
                    $result =  file('data.txt');   
                    $columns = explode('!',$result[$_GET["edit"]]);                   
                    $oldName = $columns[1];
                    $oldPrice = $columns[2];
                    $oldId = $columns[3];
                    $oldGroup = $groups[$columns[3]];
                    //print_r($columns); 
                }
                else echo $newEntry;
            ?>
        </h2>
</div>
<div id="container">
   
    <div id="leftMenu">
        <h3><a href="index.php">Списък</a></h3>
    </div>
    <div id="center">
        <form method="POST">
            <div id="label"><label for="name">Име:</label>
            </div>
                <input type="text" name="name" <?php if ($_GET) echo 'value="' . $oldName .'"'; ?>" />
            <div id="label"><label for="price">Сума:</label>
            </div>
            <input type="text" name="price" <?php if ($_GET) echo 'value="' . $oldPrice .'"'; ?>"/>
            <?php if ($_GET)  ?>
            <div id="label"><label for="group">Вид:</label></div>
                <select name="group">
                    
                    <?php
                    if ($_GET) 
                        {
                            echo '<option selected="selected" value="'. $oldId .'">' . $oldGroup . '</option>';
                        }
                    foreach ($groups as $key=>$value) 
                        {
                            if ($key != $oldId)    
                            {
                                echo '<option value="'.$key.'">' . $value .
                                    '</option>';
                            }
                        }
                    ?>
                    
                </select>           
            <br/><br/>        
            <div><input type="submit" value="<?php 
                                                    if ($_GET) echo "Редактирай"; 
                                                    else echo "Добави";
                                                    ?>" class="buttonSmall" /></div>
        </form>
    </div>
</div>
<?php
include 'includes/footer.php';
?>
