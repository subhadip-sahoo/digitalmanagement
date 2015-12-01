<?php namespace App;
use Excel;
class UserListImport extends \Maatwebsite\Excel\Files\ExcelFile {
	protected $delimiter  = ',';
    protected $enclosure  = '"';
    protected $lineEnding = '\r\n';
    public function getFile()
    {
		$file_path = public_path('uploads').'/emp_'.date("d_m_Y").'.csv';
		return $file_path;	
    }

}