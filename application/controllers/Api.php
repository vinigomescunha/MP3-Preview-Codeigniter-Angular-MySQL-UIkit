<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->output->set_content_type('application/json');

	/* only allow post request */
        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            exit('No direct script access allowed');
        }

	/* load model mp3 in the constructor */
	$this->load->model('mp3');
    }

    public function index() {

	/* dont allow request in the index :P */
        return $this->output->set_content_type('application/json')->set_status_header(500)->set_output(json_encode( [ 'text' => 'Error 403', 'type' => 'Index Method not allowed' ] ));
    }

    public function upload( $index = null ){

	/* config upload *path *allowed types and max size - see php.ini too */
        $config = [
		'upload_path' => 'uploads/original/',
		'allowed_types' => 'mp3',
		'max_size' => '100000'
	];
	/* load upload library */
        $this->load->library('upload', $config);

	/* config size preview *start *end */
	$preview_config = [
		'path' => 'uploads/preview/',
		'start' => 1,
		'end' => 10
	];

	/* load mp3 library */
	$this->load->library('mp3_library');

        if ( !$this->upload->do_upload('file')) {

	     /* display error of upload */
            $data = array('error' => $this->upload->display_errors());
            $this->output->set_content_type('application/json')->set_status_header(200)->set_output(json_encode( $data ));
        } else {

	    /* get data of upload */
            $data = array('upload_data' => $this->upload->data());

	    /* set file to preview from upload FILE */
            $this->mp3_library->set('file', $data['upload_data']['full_path']/*$_FILES['file']['tmp_name']*/ )->set('output', $preview_config['path'] . $data['upload_data']['file_name'])->set('start', $preview_config['start'])->set('end', $preview_config['end']);

	    /* insert into variable return preview and original url */

	    $filename = $data['upload_data']['file_name'];
            $return = [
		'preview' => $this->mp3_library->extract_sample(),
            	'original' => $config['upload_path'] . $filename,
	    	'title' => $filename,
	    ];
	    $return['id'] = $this->mp3->insertmp3($return);
	    /* send output */
            $this->output->set_content_type('application/json')->set_status_header(200)->set_output(json_encode( $return ));
        }

    }

    public function listmp3() {
        
	/* get all mp3 from the model */
        $data = [ 'text' => $this->mp3->getmp3() ];
        $this->output->set_content_type('application/json')->set_status_header(200)->set_output(json_encode( $data ));
    }   



}

