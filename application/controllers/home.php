<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	   public function __construct(){

           	parent::__construct();

        $this->output->set_header('Expires: Sat, 06 Feb 2016 05:00:00 GMT');
        $this->output->set_header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', FALSE);
        $this->output->set_header('Pragma: no-cache');

       }

	public function index()
	{
		$this->load->view('home');
	}

}
