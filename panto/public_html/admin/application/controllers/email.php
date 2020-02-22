<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->load->model('auditions_model', 'auditions');
	}

	public function index()
	{
		$data['email_lists'] = $this->auditions->get_email_lists();
		$this->load->view('email_one', $data);
	}

	public function preview()
	{
		$this->form_validation->set_rules('acting', 'Who To Email', 'callback_interestareas');
		$this->form_validation->set_rules('email_subject', 'Email Subject', 'required');
		$this->form_validation->set_rules('body', 'Email Body', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$data['email_lists'] = $this->auditions->get_email_lists();
			$this->load->view('email_one', $data);
		}
		else
		{
			$data['from'] = $this->input->post('from');
			$data['bcc'] = $this->auditions->get_email($this->input->post('signup'), $this->input->post('custom'), $this->input->post('other_checkbox'), $this->input->post('other_textarea'));
			$data['subject'] = $this->input->post('email_subject');
			$data['body'] = str_replace("<p>", "<p style='color: #ffffff;font-size:1.2em;'>", $this->input->post('body'));
			$data['body'] = str_replace("<a", "<a style='color: #feb942;'", $data['body']);

			$data['draft_id'] = $this->auditions->email_draft($data);

			if($this->input->post('attach_file')) header("Location: http://www.addies-panto.co.uk/admin/email/email_preview/".$data['draft_id']."/1");
			else header("Location: http://www.addies-panto.co.uk/admin/email/email_preview/".$data['draft_id']);
		}
	}

	public function email_preview($draft_id = FALSE, $attach = FALSE)
	{
		if($this->input->post("file_upload_submit")) {
			$config['upload_path'] = '/societies/panto/public_html/admin/assets/attachments';
			$config['max_size'] = 10240;
			$config['allowed_types'] = "jpg|jpeg|png|bmp|pdf|xls|xlsx|doc|docx|ppt|pptx|zip|csv|mp3|txt|wma|ogg|mp4|avi";

			$this->load->library('upload');
			$this->upload->initialize($config);

			if ( ! $this->upload->do_multi_upload("email_attach"))
			{
				$data = array('error' => $this->upload->display_errors('<div class="error">','</div>'), 'draft_id' => $draft_id);
				$this->load->view('email_file_upload', $data);
			}
			else
			{
				$this->auditions->email_attachments($this->upload->get_multi_upload_data(), $draft_id);
				$data = $this->auditions->get_email_by_id($draft_id);
				$data['draft_id'] = $draft_id;
				$this->load->view('email_two', $data);
			}
		}
		elseif($attach==1) {
			$data['error'] = "";
			$data['draft_id'] = $draft_id;
			$this->load->view('email_file_upload', $data);
		}
		else {
			$data = $this->auditions->get_email_by_id($draft_id);
			$data['draft_id'] = $draft_id;
			$this->load->view('email_two', $data);
		}
		
	}

	public function send()
	{
		$data = $this->auditions->get_email_by_id($this->input->post('draft_id'));
		$email_body = $this->load->view('template',$data, TRUE);

		$fromname = "";
		switch($_SERVER['REMOTE_USER']) {
			case "jkm50":
				$fromname = " Stage Manager";
				break;
			case "rd412":
			case "jmc217":
case "ywl23":
case "rs646":
				$fromname = " Producers";
			 	break;
			case "mr530":
			case "jt434":
				$fromname = " Directors";
			 	break;
			case "cem73":
				$fromname = " Musical Director";
			 	break;
			case "cel48":
			case "rt359":
			case "ecd36":
			case "cc633":
			case "xec20":
				$fromname = " Choreographers";
				break;
			case "aprb3":
			case "aiv22":
			case "cs651":
				$fromname = " Make Up";
				break;
			case "kch30":
			case "hf269":
			case "lc501":
				$fromname = " Props";
				break;
			case "yct29":
				$fromname = " Art";
				break;
			case "hh357":
				$fromname = " Social";
				break;
		}

		$this->load->library('email');

		$config['useragent'] = 'Peter Pancreas';
		$config['bcc_batch_mode'] = FALSE;
		//$config['bcc_batch_size'] = 20;
		$config['mailtype'] = 'html';

		$this->email->initialize($config);

		$this->email->from($data['from'], "Peter Pancreas".$fromname);
		$this->email->to($data['to']);
		$this->email->bcc($data['bcc']);
		$this->email->subject($data['subject']);
		$this->email->set_header("Subject", $data['subject']);
		if($data['attachments']!="") {
			foreach (explode("%$%sep$%$", $data['attachments']) as $value) {
				$this->email->attach($value);
			}
		}

		$this->email->message($email_body);

		$this->email->send();

		$debug = $this->email->print_debugger();
		echo $debug;
		$this->auditions->email_sent($this->input->post('draft_id'), $debug);
	}

	public function template($id)
	{
		$data = $this->auditions->get_email_by_id($id);
		$this->load->view('template',$data);
	}

	public function add_list()
	{
		if($this->input->post('submit')) {
			$this->form_validation->set_rules('list_name', 'List Name', 'required');
			$this->form_validation->set_rules('emails', 'Email Addresses', 'required');

			if ($this->form_validation->run() == FALSE) $this->load->view('add_list');
			else {
				$this->auditions->add_list($this->input->post('list_name'), $this->input->post('emails'));
				header("Location: http://www.addies-panto.co.uk/admin/email/");
			}
		}
		$this->load->view('add_list');
	}

	public function edit_list($id = FALSE)
	{
		if(!$id) echo "ERROR";
		else {
			$data = $this->auditions->get_list($id);
			if(!$data) echo "ERROR";
			else {
				if($this->input->post('submit')) {
					$this->form_validation->set_rules('list_name', 'List Name', 'required');
					$this->form_validation->set_rules('emails', 'Email Addresses', 'required');

					if ($this->form_validation->run() == FALSE) $this->load->view('add_list', $data);
					else {
						$this->auditions->update_list($id, $this->input->post('list_name'), $this->input->post('emails'));
						header("Location: http://www.addies-panto.co.uk/admin/email/");
					}
				}
				else $this->load->view('add_list', $data);
			}
		}
	}

	public function interestareas()
	{
		if(!$this->input->post('signup') AND !$this->input->post('custom') AND !$this->input->post('other_checkbox')) {
			$this->form_validation->set_message('interestareas', 'You must select at least one group to email!');
			return FALSE;
		}
		else return TRUE;
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
