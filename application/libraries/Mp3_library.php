<?php
/* load files */
require __DIR__."/getid3/getid3.php";

class Mp3_library {

	private $ci;
	private $data;
	//mp3 attributes
	public $file;
	public $output;
	public $start;
	public $end;

	public function __construct() {

		/* get ci instance */
		$this->ci = &get_instance();
	}

	public function set($i, $v) {

		/* set variables */
		$this->$i = $v;
		return $this;
	}

	public function extract_sample() {
	    /* extract sample/preview from mp3 */
	    /* get id3 from library */
	    $getID3 = new getID3;
	    $mp3info =  $getID3->analyze($this->file);

	    $frameSize = $mp3info['mpeg']['audio']['framelength'];
	    
	    $startOffSet = $mp3info['avdataoffset'];
	    $startBytes = $startOffSet + ((($this->start * 1000)/26) * $frameSize);
	    $endBytes   = $startOffSet + ((($this->end * 1000)/26) * $frameSize);

	    if($output = @fopen($this->output, 'wb')) {
		if ($source = @fopen($this->file, 'rb')) {        

		    fseek($source, $startBytes, SEEK_SET);
		    while (!feof($source) && (ftell($source) < $endBytes)) {
		    	fwrite($output, fread($source, 32768));
		   }
		   fclose($source);
	       }
	       fclose($output);

	       return $this->output;
	   }
	   return false;
	}
}
