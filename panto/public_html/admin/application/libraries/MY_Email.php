<?php

class MY_Email extends CI_Email {

	public function __construct()
    {
        parent::__construct();
    }

    public function set_header($header, $value){
	    $this->_headers[$header] = $value;
	}

}