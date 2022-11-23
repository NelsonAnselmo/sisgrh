<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class BackupController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}

    public function index(Request $request)
	{

		return view('beckup.beckup.index');

	}

    public function backup()
	{
		$mytime      = Carbon::now('Africa/Maputo');
		$mytimeormat = date("d-m-Y", strtotime($mytime));
		
		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$dbname = 'bdsisrh';
		$tables = '*';

		$link = mysqli_connect($dbhost,$dbuser,$dbpass, $dbname);
		mysqli_query($link, "SET NAMES 'utf8'");

		if($tables == '*')
		{
			$tables = array();
			$result = mysqli_query($link, 'SHOW TABLES');
			while($row = mysqli_fetch_row($result))
			{
				$tables[] = $row[0];
			}
		}
		else
		{
			$tables = is_array($tables) ? $tables : explode(',',$tables);
		}

		$return = '';
        //cycle through
		foreach($tables as $table)
		{
			$result = mysqli_query($link, 'SELECT * FROM '.$table);
			$num_fields = mysqli_num_fields($result);
			$num_rows = mysqli_num_rows($result);

			$return.= 'DROP TABLE IF EXISTS '.$table.';';
			$row2 = mysqli_fetch_row(mysqli_query($link, 'SHOW CREATE TABLE '.$table));
			$return.= "\n\n".$row2[1].";\n\n";
			$counter = 1;

        //Over tables
			for ($i = 0; $i < $num_fields; $i++) 
        {   //Over rows
        	while($row = mysqli_fetch_row($result))
        	{   
        		if($counter == 1){
        			$return.= 'INSERT INTO '.$table.' VALUES(';
        		} else{
        			$return.= '(';
        		}

                //Over fields
        		for($j=0; $j<$num_fields; $j++) 
        		{
        			$row[$j] = addslashes($row[$j]);
        			$row[$j] = str_replace("\n","\\n",$row[$j]);
        			if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
        			if ($j<($num_fields-1)) { $return.= ','; }
        		}

        		if($num_rows == $counter){
        			$return.= ");\n";
        		} else{
        			$return.= "),\n";
        		}
        		++$counter;
        	}
        }
        $return.="\n\n\n";
    }
    $fileName = public_path().'/storage/db-backup-'.$mytimeormat.'.sql';
    $handle = fopen($fileName,'w+');
    fwrite($handle,$return);

    return redirect()->back()->with('success', 'backup efectuado com sucesso !');

}

}
