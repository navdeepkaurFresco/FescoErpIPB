<option value="">Select District</option>
<?php
	if (!empty($district)) 
	{
		foreach ($district as $row) 
		{
			echo '<option value = "'.$row['district_id'].'">'.$row['district_name'].'</option>';
		}
	}
?>