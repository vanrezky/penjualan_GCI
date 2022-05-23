<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends MY_Controller {


	public function index()
	{
		$data['title'] = 'Dashboard';
		$this->render('slider/slider_index', $data);
	}

	public function data()
	{
		$data['title'] = 'Data';
		$this->render('slider/slider_data', $data);
	}
}