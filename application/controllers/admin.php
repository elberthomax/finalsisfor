<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("sisfor_model");
		$this->load->database();
	}
	public function index() {
		$this->load->view('admin/index');
	}
	public function login() {
		$this->load->view('login');
	}
	public function loginAction() {
		redirect(base_url("index.php/admin/index"));
	}
	public function customer() {
		$this->load->view('admin/customer');
	}
	
	public function company() {
		$data = array('data' => $this->sisfor_model->read());
		$this->load->view('admin/company',$data);
	}
	
	public function companyprocess(){
		$jenis = $this->input->post("jenis");
		if($jenis == "update"){
			$data = array(
					"id" => $this->input->post("id"),
					"nama" => $this->input->post("nama"),
					"no" => $this->input->post("no"),
					"email" => $this->input->post("email"),
					"alamat" => $this->input->post("alamat"),
					"type" => "Update");
			$this->companyGanti($data);
		}else if($jenis == "delete"){
			$this->companyDelete($this->input->post("id"));
		}
	}
	public function companyGanti($data){
		$this->load->view('admin/companyForm',$data);	
	}
	public function companyTambah(){
		$data = array("id" => "",
					"nama" => "",
					"no" => "",
					"email" => "",
					"alamat" => "",
			"type" => "Add");
		$this->load->view('admin/companyForm',$data);
	}
	public function companyAdd(){
		$data = array("nama" => $this->input->post("nama"),
					"no" => $this->input->post("no"),
					"email" => $this->input->post("email"),
					"alamat" => $this->input->post("alamat"));
		foreach ($data as $key => $text) {
			if($text == ""){
				redirect('/admin/company', 'location');
			}
		}
		$this->sisfor_model->add($data);
		redirect('/admin/company', 'location');
	}
	public function companyupdate(){
		$data = array("nama" => $this->input->post("nama"),
					"no" => $this->input->post("no"),
					"email" => $this->input->post("email"),
					"alamat" => $this->input->post("alamat"));
		foreach ($data as $key => $text) {
			if($text == ""){
				redirect('/admin/company', 'location');
			}
		}
		$this->sisfor_model->update($data,$this->input->post("id"));
		redirect('/admin/company', 'location');
	}
	public function companyDelete($id){
		$this->sisfor_model->delete($id);
		redirect('/admin/company', 'location');
	}
	public function library() {
		$this->load->view('admin/library');
	}
	public function libraryTambah(){
		$this->load->view('admin/libraryForm');	
	}
	public function product() {
		$this->load->view('admin/product');
	}
	public function productTambah(){
		$this->load->view('admin/productForm');	
	}
	public function post(){
		$this->load->view('admin/posts');	
	}
}
