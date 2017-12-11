<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Image_model extends CI_Model {

	public function __construct()	{
	  $this->load->database(); 
	}

	public function getImages()
        {
            $query = $this->db->get('images');
		    return $query->result();
        }
}