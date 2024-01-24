<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function index()
	{
		$this->load->view('welcome_message');
	}

	function api_show()
	{
		$this->db->order_by('id', 'desc');
		$dataSensor = $this->db->get('table_sensor', 1)->row_array();
		$dataSensor['created_at'] = date('H:i', strtotime($dataSensor['created_at']));

		$this->output->set_content_type('application/json')->set_output(json_encode($dataSensor));
	}

	function api_save()
	{
		$dataPostSensor = [
			's_suhu' => $this->input->post('suhu'),
			's_ph' => $this->input->post('ph'),
			's_kelembapan' => $this->input->post('kelembapan'),
			's_kekeruhan' => $this->input->post('kekeruhan'),
		];

		$insert = $this->db->insert('table_sensor', $dataPostSensor);
		if ($insert) {
			$response = [
				'status' => 'OK',
				'message' => "Data Saved"
			];
		} else {
			$response = [
				'status' => 'error',
				'message' => "Data Not Saved"
			];
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	function api_config(){
		$configTelegram = $this->db->get_where('config_telegram',['status'=>1])->row();
		$configSensor = $this->db->get('config_sensor')->result();
		foreach ($configSensor as $item) {
			$dataSensor[$item->sensor]=[
				'atas'=>doubleval($item->atas),
				'bawah'=>doubleval($item->bawah),
			];
		}
		$newToken = explode(":",$configTelegram->token);
		$result=[
			'telegram'=>[
				'chatid'=> strval($configTelegram->chat_id),
				'token'=> $configTelegram->token,
			],
			'sensor'=>$dataSensor
		];
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
		
	}
}
