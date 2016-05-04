<?php

/**
 * Provide functions allow access without login in to a page and get data.
 *
 * @author giap.dq
 * @since 2015-11-12
 * 
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once (APPPATH . 'libraries/simple_html_dom.php');

class Crawler{
	
	function __construct()
	{
		$this->CI =& get_instance();
	}
	/**
	 * Reads entire page into a string
	 * 
	 * @param string $url
	 * @return string $str_html
	 */
	function get_url_content($url){
		$ch = curl_init();
		$timeout = 30;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$str_html = curl_exec($ch);
		curl_close($ch);
		
		return $str_html;
	}
	
	
	/**
	 * Parse string to get authentications information to login.
	 * 
	 * @param string $content
	 * @return array $login_info
	 *
	 */
	function parse_auth_info($url){
		// Get html dom from string
		$str_html = $this->get_url_content($url);
		$html = str_get_html ( $str_html );
		
		$login_info = array ();
		foreach ( $html->find ('dl.dl-horizontal') as $element ) {
			$login_info['username'] = $element->find ( 'dd', 0 )->plaintext;
			$login_info['password'] = $element->find ( 'dd', 1 )->plaintext;
		}
		
		$inputs = $html->find ('input[type=hidden]');
		foreach ( $inputs as $input ) {
			$login_info['token'] = $input->value;
		}
		
		$login_info['login'] = $html->find ('button', 0 )->plaintext;
		
		return $login_info;
	}

	/**
	 * Reads the required login page without does login
	 *
	 * @param string $url, array $login_info
	 * @return string $resp
	 */
	function get_login_url_content($url, $login_url){
		
		$ch = curl_init ();		
		curl_setopt ( $ch, CURLOPT_COOKIEJAR, './cookie.txt' );
		curl_setopt ( $ch, CURLOPT_COOKIEFILE, './cookie.txt' );
		//curl_setopt ( $ch, CURLOPT_VERBOSE, true );
		curl_setopt ( $ch, CURLOPT_URL, $login_url );
		curl_setopt ( $ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7' );
		curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, TRUE );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, TRUE );
		curl_setopt ( $ch, CURLOPT_POST, TRUE );
		$timeout = 30;
		curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
		curl_setopt ( $ch, CURLOPT_TIMEOUT, $timeout );
		curl_setopt ( $ch, CURLOPT_MAXREDIRS, 10 );
		
		$login_info = $this->parse_auth_info($login_url);
		$data = http_build_query ( $login_info );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
		curl_setopt ( $ch, CURLOPT_HEADER, 0 );
		$resp = curl_exec ( $ch );
		//echo "resp="; var_dump($resp);
		
		//curl_setopt ( $ch, CURLOPT_URL, $url );
		//$str_html = curl_exec ( $ch );
		curl_close ( $ch );
		//echo "str_html="; var_dump($str_html);
		return $resp;
	}

	/**
	 * Parse html string to get data
	 * 
	 * @param string $str_html
	 * @return array $data
	 */
	function parse_table_data($str_html){
		$html= str_get_html ( $str_html );

		$header = array ();
		$data = array();

		foreach ( $html->find( 'table tr.header th' ) AS $th ) {
			$header [] = $th->plaintext;
		}
		
		foreach($html->find('table tr.data') AS $row){
			$tmp = array();
			$index = 0;
			foreach($row->find('td') AS $column){
				$tmp[$header[$index++]] = $column->plaintext;
			}
			$data[] = $tmp;
		}
		
		return $data;
	}
	
	function parse_table_header($str_html){
		$html= str_get_html ( $str_html );
		
		$header = array ();
		
		foreach ( $html->find( 'table tr.header th' ) AS $th ) {
			$header [] = $th->plaintext;
		}
		return $header;
	}
	
	/**
	 * Crawler all data
	 * 
	 */
	function get_all_data($url_page, $url_login){
		$str_html = $this->get_url_content($url_login);
		$login_info = $this->parse_auth_info($url_login);
		$str_html = $this->get_login_url_content($url_page, $url_login);
		$data = $this->parse_table_data($str_html);
		return $data;
	}
	//function 
}