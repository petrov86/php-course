<?php




 function put_contents_in_table($selected, $groups){

            $totalSum = 0.00;
			if (filesize('data.txt')==0)
			{	
				$EmptyMessage = "Няма намерени записи!!!";
				$EmptyRow = '<tr>
									<td colspan="6">'.$EmptyMessage.'</td>
							</tr>';
					echo  $EmptyRow;
			}
			
			else
			{
					$result =  file('data.txt');
					foreach ($result as $line_num => $value)
						{
							$columns=  explode('!', $value);                
							
							if ($selected == $columns[3])
								{             
									$totalSum += $columns[2];
									//$columns[2] = number_format($columns[2], 2);
									echo '<tr>
										<td>'.$columns[0].'</td>
										<td>'.$columns[1].'</td>
										<td>'.number_format($columns[2], 2).'</td>
										<td>'.$groups[trim($columns[3])].'</td>
										<td><form method="GET" action="form.php"><input type="hidden" name="edit" value='.$line_num .' ><input type="submit" value="edit"  /></form></td>
										<td><form method="GET"><input type="hidden" name="delete" value='.$line_num .' ><input type="submit" value="delete"  /></form></td>
										</tr>';
								}
							if ($selected == '0')
								{
									$totalSum += $columns[2];
									//$columns[2] = number_format($columns[2], 2);
									echo '<tr>
										<td>'.$columns[0].'</td>
										<td>'.$columns[1].'</td>
										<td>'.number_format($columns[2], 2).'</td>
										<td>'.$groups[trim($columns[3])].'</td>
										<td><form method="GET" action="form.php"><input type="hidden" name="edit" value='.$line_num .' ><input type="submit" value="edit"  /></form></td>
										<td><form method="POST" action="delete.php"><input type="hidden" name="delete" value='.$line_num .' ><input type="submit" value="delete"  /></form></td>
										</tr>';
								}
						}
					$totalSum = number_format($totalSum, 2);
					$finalRow = '<tr>
									<td>---</td>
									<td>---</td>
									<td>'.$totalSum.'</td>
									<td>---</td>
									<td>---</td>
									<td>---</td></tr>';
					echo  $finalRow;
			}
        }
        
  function printAlert($alert){
      echo "<script>alert('" .$alert. "');</script>";  
  }
?>
