<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	public function index()
	{
		$data['title'] = 'Dashboard';

		$this->render('index', $data);
	}
}
