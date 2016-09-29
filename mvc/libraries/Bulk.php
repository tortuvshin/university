<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bulk {

	protected $username;
	protected $password;
	protected $url;
	protected $port;

	public function __construct () {
		$this->ci =& get_instance();
        $this->ci->load->model('smssettings_m');
        
        $bulk_bind = array();
        $get_bulks = $this->ci->smssettings_m->get_order_by_bulk();
        foreach ($get_bulks as $key => $get_bulk) {
            $bulk_bind[$get_bulk->field_names] = $get_bulk->field_values;
        }

        $this->username = $bulk_bind['bulk_username'];
        $this->password = $bulk_bind['bulk_password'];
        $this->url =  'https://bulksms.vsms.net/eapi/submission/send_sms/2/2.0';
        $this->port = 443;
	}

	public function show() {
		dump($this->username);
	}

	public function ping() {
		$pingurl =  'https://bulksms.vsms.net/eapi/submission/send_sms/2/2.0';
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $pingurl);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, 'username='.$this->username.'&password='.$this->password);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		$exp = explode("|", $result);
		if($exp[0] == 23) {
			return FALSE;
		}
		return TRUE;
	}

	public function send($to, $message) {
		$post_body = $this->unicode_sms($this->username, $this->password, $message, $to);
		$result = $this->send_message($post_body, $this->url, $this->port);
		if( $result['success'] ) {
		  return TRUE;
		} else {
			return FALSE;
		}
	}

	public function unicode_sms($username, $password, $message, $msisdn) {
  		$post_fields = array (
  			'username' => $username,
  			'password' => $password,
  			'message'  => $this->string_to_utf16_hex( $message ),
  			'msisdn'   => $msisdn,
  			'dca'      => '16bit'
  		);
  		return $this->make_post_body($post_fields);
	}

	function make_post_body($post_fields) {
	  	$stop_dup_id = $this->make_stop_dup_id();
	 	if ($stop_dup_id > 0) {
	    	$post_fields['stop_dup_id'] = make_stop_dup_id();
	  	}
	  	$post_body = '';
	  	
	  	foreach( $post_fields as $key => $value ) {
	    	$post_body .= urlencode( $key ).'='.urlencode( $value ).'&';
	  	}
	  	$post_body = rtrim( $post_body,'&' );
	  	return $post_body;
	}

	function make_stop_dup_id() {
  		return 0;
	}

	function string_to_utf16_hex($string) {
  		return bin2hex(mb_convert_encoding($string, "UTF-16", "UTF-8"));
	}

	public function send_message ( $post_body, $url, $port ) {
	  	$ch = curl_init( );
	  	curl_setopt ( $ch, CURLOPT_URL, $url );
	  	curl_setopt ( $ch, CURLOPT_PORT, $port );
	  	curl_setopt ( $ch, CURLOPT_POST, 1 );
	  	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
	  	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $post_body );
	  	// Allowing cUrl funtions 20 second to execute
	  	curl_setopt ( $ch, CURLOPT_TIMEOUT, 20 );
	  	// Waiting 20 seconds while trying to connect
	  	curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 20 );

  		$response_string = curl_exec( $ch );
  		$curl_info = curl_getinfo( $ch );

		$sms_result = array();
		$sms_result['success'] = 0;
		$sms_result['details'] = '';
		$sms_result['transient_error'] = 0;
		$sms_result['http_status_code'] = $curl_info['http_code'];
		$sms_result['api_status_code'] = '';
		$sms_result['api_message'] = '';
		$sms_result['api_batch_id'] = '';

  		if ( $response_string == FALSE ) {
    		$sms_result['details'] .= "cURL error: " . curl_error( $ch ) . "\n";
  		} elseif ( $curl_info[ 'http_code' ] != 200 ) {
    		$sms_result['transient_error'] = 1;
    		$sms_result['details'] .= "Error: non-200 HTTP status code: " . $curl_info[ 'http_code' ] . "\n";
  		} else {
    		$sms_result['details'] .= "Response from server: $response_string\n";
    		$api_result = explode( '|', $response_string );
    		$status_code = $api_result[0];
    		$sms_result['api_status_code'] = $status_code;
    		$sms_result['api_message'] = $api_result[1];
    		
    		if ( count( $api_result ) != 3 ) {
      			$sms_result['details'] .= "Error: could not parse valid return data from server.\n" . count( $api_result );
    		} else {

      			if ($status_code == '0') {
        			$sms_result['success'] = 1;
        			$sms_result['api_batch_id'] = $api_result[2];
        			$sms_result['details'] .= "Message sent - batch ID $api_result[2]\n";
      			} else if ($status_code == '1') {
        			$sms_result['success'] = 1;
        			$sms_result['api_batch_id'] = $api_result[2];
      			} else {
        			$sms_result['details'] .= "Error sending: status code [$api_result[0]] description [$api_result[1]]\n";
      			}
    		}
  		}
  		curl_close( $ch );

  		return $sms_result;
	}

}





























?>