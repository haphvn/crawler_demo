<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

/**
 * Crowler controller
 *
 * @author giap.dq (duongquygiap@gmail.com)
 * @since 2015-11-12
 */
class Test extends CI_Controller {
	private $timeout_message = 'Request timeout, please try again.';
	public function __construct() {
		parent::__construct ();
		$this->load->helper('url');
		$this->load->library ( 'crawler' );
	}
	public function index() {
		//echo FCPATH;
		// echo URL_LOGIN_PAGE;
		echo site_url();
		$this->load->view ( 'test/index' );
	}

	/**
	 * 
	 */
	public function task_1() {
		$str_html = $this->crawler->get_login_url_content(URL_PAGE, URL_LOGIN_PAGE);
		
		/*
		 * Check get content success
		 */
		if($str_html){
			$header = $this->crawler->parse_table_header($str_html);
			$data = $this->crawler->parse_table_data($str_html);
			$data = $this->group_data($data);
			$this->load->view ( 'test/task_1', array('data'=> $data, 'header'=> $header));
		}else{
			$this->load->view ( 'test/task_1', array('message'=> $this->timeout_message));
		}
		
	}

	/**
	 * 
	 */
	public function task_2() {
		$str_html = $this->crawler->get_login_url_content(URL_PAGE, URL_LOGIN_PAGE);
		
		/*
		 * Check get content success
		 */
		if($str_html){
			$header = $this->crawler->parse_table_header($str_html);
			$data = $this->crawler->parse_table_data($str_html);
			$this->load->view ( 'test/task_2', array('data'=> $data, 'header'=> $header));
		}else{
			$this->load->view ( 'test/task_2', array('message'=> $this->timeout_message));
		}
	}
	
	public function update() {
		//$data = $_REQUEST['data'];
		$json = $this->input->post('data');
		var_dump($json);
		//return;
 		$json = stripslashes($json);
 		$json = json_decode($json);
 		
 		//print_r($data);
 		$data = array();
 		foreach ($json AS $key => $value){
 			$data[$value->date][] = $value;
 		}
 		//print_r($data);
 		$this->load->view ( 'test/table_template.php', array('data'=> $data));
 		
 		//echo "ka ka ka";
	}
	/**
	 * Group date by date.
	 * 
	 * @param array $data
	 * @return array $group
	 */
	private function group_data($data = array()) {
		$group = array();
		foreach ( $data as $key => $item ) {
			$group [$item ['date']] [] = $item;
		}
		ksort ( $group, SORT_NUMERIC );
		return $group;
	}
}