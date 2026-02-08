<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Escuela_model');
    }


    public function index() {
        $data['alumnos'] = $this->Escuela_model->get_alumnos_completo();
        $data['grupos']   = $this->Escuela_model->get_grupos_completo();
        $data['carreras'] = $this->Escuela_model->get_all('carreras');
        $data['turnos'] = $this->Escuela_model->get_all('turnos');
        $data['grados'] = $this->Escuela_model->get_all('grados');

        $this->load->view('dashboard_view', $data);
    }

    public function guardar_alumno() {
        $data = array(
            'nombre' => $this->input->post('nombre'),
            'ap_paterno' => $this->input->post('ap_paterno'),
            'ap_materno' => $this->input->post('ap_materno'),
            'id_grupo' => $this->input->post('id_grupo'),
        );

        $id = $this->input->post('id_alumno');
        if($id) {
            $this->Escuela_model->actualizar('alumnos', $id, $data);
        } else {
            $this->Escuela_model->insertar('alumnos', $data);
        }
        redirect('dashboard');
    }

    public function guardar_grupo() {
        $data = array(
            'nombre_grupo' => $this->input->post('nombre_grupo'),
            'id_carrera'   => $this->input->post('id_carrera'),
            'id_turno'     => $this->input->post('id_turno'),
            'id_grado'     => $this->input->post('id_grado')
        );

        $id = $this->input->post('id_grupo');

        if($id) {
            $this->Escuela_model->actualizar('grupos', $id, $data);
        } else {
            $this->Escuela_model->insertar('grupos', $data);
        }
        redirect('dashboard');
    }

    public function guardar_carrera() {
        $data = array('nombre' => $this->input->post('nombre'));
        $this->Escuela_model->insertar('carreras', $data);
        redirect('dashboard');
    }

    public function eliminar($tabla, $id) {
        $this->Escuela_model->desactivar($tabla, $id);
        redirect('dashboard');
    }

}