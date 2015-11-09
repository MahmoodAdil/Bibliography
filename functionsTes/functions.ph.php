
<?php 
public function checkTwoPasswords($input)
{
	if($input[0]  == $input[1] )
	{
		return 1;
	}
    else return 0;
}
;?>
