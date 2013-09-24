<?php
$pageTitle='Списък';
include 'includes/header.php';

?>
<div id="header">
        <h2>Таблица на разходите</h2>
</div>
<div id="container">
    
    <div id="leftMenu">
        <h3><a href="form.php">Добави нов разход</a><br/></h3>
    </div>   
        <div id="center">
            <p><Form method="POST" action="">
                <select name="group">
                            <?php
                            $groups[0] = "Всички";
                            echo '<option selected="selected" value="'. 0 .'">' . $groups[0] . '</option>';
                            for($i=1; $i<count($groups); $i++)
                            {
                                echo '<option value="'.$i.'">' . $groups[$i] .
                                        '</option>';     
                            }

                            ?>
                </select> 
                <input type="submit" value="Филтрирай" class="buttonSmall"/>
            </Form><p/>
            <table  class="gridtable">
                <tr>
                    <th>Дата</th>
                    <th>Име</th>
                    <th>Сума</th>
                    <th>Вид</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php
                    if(file_exists('data.txt')){
                        $selected = '0';
                        if ($_POST)
                            {
                                $selected = $_POST['group'];
                                //echo $selected;
                                put_contents_in_table($selected, $groups);
                            }
                        else
                            {
                                put_contents_in_table($selected, $groups);
                            }
                    }
                ?>


            </table
        </div>
</div>
<?php
include 'includes/footer.php';
?>
