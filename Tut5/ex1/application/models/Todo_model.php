<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todo_model extends CI_Model {
	public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function add_todo($user_id, $title)
    {
        $data = array(
            'user_id' => $user_id,
            'action_title' => $title
        );

        return $this->db->insert('todos', $data);
    }

    public function get_todos($user_id)
    {
		return $this->db
			->where('user_id', $user_id)
			->order_by('created_at', 'DESC')
			->get('todos')
			->result();
    }

	public function delete_todo($id, $user_id)
	{
		$this->db->where('id', $id);
		$this->db->where('user_id', $user_id);
		return $this->db->delete('todos');
	}
}
