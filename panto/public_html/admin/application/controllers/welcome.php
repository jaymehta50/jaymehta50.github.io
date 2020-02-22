<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('auditions_model', 'auditions');
		$this->load->helper('file');
		$this->load->dbutil();
	}

	public function index()
	{
		$query = $this->auditions->get_all_auditionees();
		if(!$query) echo "Nobody has signed up yet!";
		else {
			$data['auditionees'] = $query->result_array();
			$this->load->view('welcome_message', $data);
		}
	}

	public function download_csv()
	{
		$query = $this->auditions->get_all_auditionees();
		if(!$query) echo "Nobody has signed up yet!";
		elseif ( write_file('/societies/panto/public_html/admin/assets/download.csv', $this->dbutil->csv_from_result($query))) header("Location: http://www.addies-panto.co.uk/admin/assets/download.csv");
		else echo "Hmm... Something went wrong here, please ask Jay!";
	}

	public function download_dvd_csv()
	{
		$query = $this->auditions->get_all_orders();
		if(!$query) echo "Nobody has signed up yet!";
		elseif ( write_file('/societies/panto/public_html/admin/assets/dvddownload.csv', $this->dbutil->csv_from_result($query))) header("Location: http://www.addies-panto.co.uk/admin/assets/dvddownload.csv");
		else echo "Hmm... Something went wrong here, please ask Jay!";
	}

	public function dvd_orders()
	{
		$query = $this->auditions->get_all_orders();
		if(!$query) echo "Nobody has bought a DVD yet!";
		else {
			$data['orders'] = $query->result_array();
			$this->load->view('dvd_orders', $data);
		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */