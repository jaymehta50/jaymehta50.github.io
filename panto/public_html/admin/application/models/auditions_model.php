<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auditions_model extends CI_Model
{

	public $details;


	public function __construct()
	{
		parent::__construct();
		$this->load->database('default');
		$this->load->helper('date');

	}

	public function get_all_auditionees()
	{
		$this->db->select('*');
		$this->db->from('auditions');
		$this->db->join('audition_slots', 'auditions.slot_id = audition_slots.id', 'left');
		$this->db->order_by('auditions.id', "asc");
		$query = $this->db->get();
		if($query->num_rows()==0) return FALSE;
		else return $query;
	}

	public function get_all_orders()
	{
		$query = $this->db->get('dvd_orders');
		if($query->num_rows()==0) return FALSE;
		else return $query;
	}

	public function get_email_lists()
	{
		$this->db->select('list_id, list_name');
		$query = $this->db->get('email_lists');
		if($query->num_rows()==0) return FALSE;
		else return $query->result_array();
	}

	public function add_list($name, $emails)
	{
		$out = array();
		$temp = $this->multi_explode(array(",", " ", "<", ">", ";", ":"), $emails);
		foreach ($temp as $key => $value) {
			if(filter_var($value, FILTER_VALIDATE_EMAIL)) $out[] = $value;
		}
		$this->db->insert('email_lists', array('list_name' => $name, 'emails' => implode(", ", $out)));
	}

	public function update_list($id, $name, $emails)
	{
		$out = array();
		$temp = $this->multi_explode(array(",", " ", "<", ">", ";", ":"), $emails);
		foreach ($temp as $key => $value) {
			if(filter_var($value, FILTER_VALIDATE_EMAIL)) $out[] = $value;
		}
		$this->db->where("list_id", $id);
		$this->db->update('email_lists', array('list_name' => $name, 'emails' => implode(", ", $out)));
	}

	public function get_list($id)
	{
		$this->db->where("list_id", $id);
		$query = $this->db->get("email_lists");
		if($query->num_rows()==0) return FALSE;
		else return $query->row_array();
	}

	public function get_email($signup, $custom, $other_checkbox, $other_textarea)
	{
		$out = array();

		if($signup) {
			$first = TRUE;
			$this->db->select('email');
			foreach($signup as $type => $value) {
				if($first) $this->db->where($type, 1);
				else $this->db->or_where($type, 1);
				$first = FALSE;
			}
			$this->db->from('auditions');
			$this->db->order_by('email', "asc");
			$query = $this->db->get();
			$result = $query->result_array();

			foreach ($result as $value) {
				$out[] = $value['email'];
			}
		}

		if($custom) {
			$first = TRUE;
			$this->db->select('emails');
			foreach($custom as $type => $value) {
				if($first) $this->db->where("list_id", $type);
				else $this->db->or_where("list_id", $type);
				$first = FALSE;
			}
			$this->db->from('email_lists');
			$query = $this->db->get();
			$result = $query->result_array();

			foreach ($result as $value) {
				$out[] = $value['emails'];
			}
		}

		if($other_checkbox && $other_textarea<>"") {
			$temp = $this->multi_explode(array(",", " ", "<", ">", ";", ":"), $other_textarea);
			foreach ($temp as $key => $value) {
				if(filter_var($value, FILTER_VALIDATE_EMAIL)) $out[] = $value;
			}
		}

		return implode(", ", $out);
	}

	public function email_draft($data)
	{
		$details = array(
		   'date_created' => date("Y-m-d H:i:s") ,
		   'from' => $data['from'] ,
		   'to' => "producer@addies-panto.co.uk",
		   'subject' => $data['subject'],
		   'bcc' => $data['bcc'],
		   'content' => $data['body']
		);

		if($data['from']!="producer@addies-panto.co.uk") $details['to'] .= ", ".$data['from'];

		if($_SERVER['REMOTE_USER']=='jkm50') $details['to'] = "jkm50@cam.ac.uk";

		$this->db->insert('emails', $details);

		return $this->db->insert_id();
	}

	public function email_attachments($data, $id)
	{
		$this->db->where('email_id', $id);
		$out = array();
		foreach($data as $attachment) {
			$out[] = $attachment['full_path'];
		}
		$this->db->update('emails', array('attachments' => implode("%$%sep$%$", $out)));
	}

	public function get_email_by_id($id)
	{
		$this->db->from('emails');
		$this->db->where('email_id', $id);
		$query = $this->db->get();
		$result = $query->row_array();

		return $result;
	}

	public function email_sent($id, $debug)
	{
		$this->db->where('email_id', $id);
		$this->db->update('emails', array('date_sent' => date('Y-m-d H:i:s'), 'debug' => $debug));
	}

	public function multi_explode($delimiters,$string) {
	    $ready = str_replace($delimiters, $delimiters[0], $string);
	    $launch = explode($delimiters[0], $ready);
	    return $launch;
	}

}
