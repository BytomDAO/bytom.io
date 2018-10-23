<?php

require(dirname(__FILE__) . '/PHPExcel_Library.php');

class PHPExcel extends PHPExcelBase {

    private $_type = null;
    private $_url = null;
    private $_types = [ 'xlsx' => 'Excel2007', 'xls' => 'Excel5' ];
    
    private $_path = null;
    private $_filename = null;
    private $_extension = null;
    
    private $_cells = [ 'A', 'B', 'C', 'D', 'E', 'F' ,'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N' ,'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z' ];
    
    public function setPropertie($properties = array()){
        if (!empty($properties)) {
            foreach ($properties as $propertie => $value) {
                exec('$this->' . ucfirst($propertie) . '(' . $value . ')');
            }
        }
    }
    public function setCells($cells = array()){
        if (!empty($cells)) {
            foreach ($cells as $sheet => $cell) {
                if(!empty($cell['items'])){
                    if ($sheet > 0){
                        $this->createSheet();
                    }
                    $sheet = $this->setActiveSheetIndex($sheet);
                    if(!empty($cell['header'])){
                        foreach ($cell['header'] as $col => $header) {
                            $sheet->setCellValue($this->getColumn($col) . '1', $header);
                        }
                    }
                    foreach ($cell['items'] as $row => $items) {
                        foreach ($items as $col => $text) {
                            $record = (($row + 1) + 1);
                            $sheet->setCellValue($this->getColumn($col).$record, $text);
                        }
                    }
                    $this->getActiveSheet()->setTitle(!empty($cell['title']) ? $cell['title'] : 'Sheet');
                }
            }
        }
        
    }
    
    public function Output($obj = array(), $file = null, $format = 'S'){
        if (!empty($this->getFile($file))) {
            $writer = PHPExcel_IOFactory::createWriter($obj, $this->_type); // Excel2007 (xlsx), Excel5 (xls)
            if ($format == 'S') {
                $writer->save($this->_path);
                if ($this->_extension == 'xlsx') {
                    header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=utf-8');
                } else {
                    header('Content-type: application/vnd.ms-excel; charset=utf-8');
                }
                header('Content-Disposition: attachment; filename=' . $this->_filename . '.' . $this->_extension);
                readfile($this->_path);
            } else if ($format == 'D') {
                if ($this->_extension == 'xlsx') {
                    header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=utf-8');
                } else {
                    header('Content-type: application/vnd.ms-excel; charset=utf-8');
                }
                header('Content-Disposition: attachment; filename=' . $this->_filename . '.' . $this->_extension);
                $writer->save('php://output');
            } else if ($format == 'L') {
                $writer->save($this->_path);
                return '<p>Download Files: <a href="' . $this->_url . '" target="_blank">' . $this->_url . '</a></p>';
            }
        }
    }
   
    private function getColumn($col){
        $level = 0; // A
        if ( $col <= 25 ) {
            return $this->_cells[$col];
        }
        if ( $col > 25 && $col <= 50) {
            $col = $col - 26;
            return $this->_cells[$level] . $this->_cells[$col];
        }
    }
    
    private function getFile($file = nul){
        $rootDir = Yii::getAlias('@webroot') . '/';
        $files = explode('/', $file);
        $current = (count($files)-1);
        if (!empty($files[$current])) {
            list($this->_filename, $this->_extension) = explode('.', $files[$current]);
            $this->_type = $this->_types[$this->_extension];
            $this->_path = $rootDir . $file;
            $this->_url = Yii::$app->urlManager->createAbsoluteUrl('/') . $file;
            return true;
        }
        return false;
    }
    
	/**
	* This function will return the excel cell number when passing the column and row number
	* @param string $row The row number of the excel sheet
	* @param string $col The column number of the excel sheet
	* @return string The excel file's cell number
	*/
	public function getCellNo($row = '', $col = ''){
		
		if($row === '' || $col === ''){
			return 'A1';
		}
		
		$cells = [ 'A', 'B', 'C', 'D', 'E', 'F' ,'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N' ,'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z' ];

		if( $col <= 25 ) {
				return $cells[$col].$row;
		}
		if ( $col > 25 ) {
			$left = intval($col / 25) - 1;
			$right = intval($col % 25) - 1;
			if($right < 0){
				$right = 0;
			 }
			return $cells[$left].$cells[$right].$row;
		}
	}
  
	/**
	 * Transmits the proper headers to cause a download to occur and to identify the file properly
	 * @return nothing
	 */
	public function headers($filename = '') {
		if($filename === ''){
			$filename = 'Sample';
		}
		$result = strtolower(trim($filename));
		$result = str_replace("'", '', $result);
		$result = preg_replace('#[^a-z0-9_]+#', '-', $result);
		$result = preg_replace('#\-{2,}#', '-', $result);
		$file = preg_replace('#(^\-+|\-+$)#D', '', $result);
		
		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$file.'.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0

	}
}