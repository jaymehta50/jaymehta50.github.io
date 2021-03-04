<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('data_model');
    }

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['cutover'] = $this->data_model->get_cutover();
		$data['readiness'] = $this->data_model->get_readiness();
		$data['sscqs'] = $this->data_model->get_ssc_qs();
		$data['ssc'] = $this->data_model->get_ssc();
		$data['wards'] = $this->data_model->get_transcription();
		$data['how'] = $this->data_model->get_howto();

		$this->load->view('header');
		$this->load->view('loading');
		$this->load->view('home');
		$this->load->view('about');
		$this->load->view('cutover', $data);
		$this->load->view('gettingready', $data);
		$this->load->view('contact');
		$this->load->view('workflows', $data);
		$this->load->view('howto', $data);
		$this->load->view('footer');
	}

	public function rundataqrginsertjfdfsfdrkgnkudrhsfn()
	{
		$this->data_model->load_qrgs();
	}
}
