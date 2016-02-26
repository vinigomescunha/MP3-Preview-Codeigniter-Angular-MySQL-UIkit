<?php

class Mp3 extends CI_Model {

	public function __construct() {

                $this->load->database();
        }

	public function getmp3() {

		return $this->db->order_by("id","desc")->get("mp3")->result_array();
	}

	public function insertmp3($arr) {

		$result = $this->db->insert('mp3', $arr);

		if($result)
			return $this->db->insert_id();
	}

}

