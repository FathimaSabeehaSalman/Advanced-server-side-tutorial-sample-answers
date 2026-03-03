<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Todo_model');
        $this->load->library('session');
        $this->load->helper(array('url','form'));

        $this->initialize_user();
    }

    private function initialize_user()
    {
        if (!$this->session->userdata('user_id')) {
            $user_id = uniqid('user_');
            $this->session->set_userdata('user_id', $user_id);

            log_message('info', 'New User ID Generated: ' . $user_id);
        } else {
            log_message('info', 'Existing User ID: ' . $this->session->userdata('user_id'));
        }
    }

    public function index()
    {
        $user_id = $this->session->userdata('user_id');

        $data['todos'] = $this->Todo_model->get_todos($user_id);

        $this->load->view('todo_view', $data);
    }

    public function add()
    {
        $user_id = $this->session->userdata('user_id');
        $title = $this->input->post('action_title');

        if (!empty($title)) {
            $this->Todo_model->add_todo($user_id, $title);
        }

        redirect('todo');
    }

	public function delete($id)
	{
		$user_id = $this->session->userdata('user_id');	
		$this->Todo_model->delete_todo($id, $user_id);
		redirect('todo');
	}
}
