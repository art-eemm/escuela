<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Escuela_model extends CI_Model {

    public function get_all($tabla) {
        $this->db->where('estado', 1);
        return $this->db->get($tabla)->result();
    }

    public function get_alumnos_completo() {
        $this->db->select('a.*, g.nombre_grupo, c.nombre as carrera, t.nombre as turno, gr.nombre as grado');
        $this->db->from('alumnos a');
        $this->db->join('grupos g', 'a.id_grupo = g.id');
        $this->db->join('carreras c', 'g.id_carrera = c.id');
        $this->db->join('turnos t', 'g.id_turno = t.id');
        $this->db->join('grados gr', 'g.id_grado = gr.id');
        $this->db->where('a.estado', 1);
        return $this->db->get()->result();
    }

    public function get_grupos_completo() {
    $this->db->select('g.*, c.nombre as carrera, t.nombre as turno, gr.nombre as grado');
    $this->db->from('grupos g');
    $this->db->join('carreras c', 'g.id_carrera = c.id');
    $this->db->join('turnos t', 'g.id_turno = t.id');
    $this->db->join('grados gr', 'g.id_grado = gr.id');
    $this->db->where('g.estado', 1);
    return $this->db->get()->result();
}

    public function insertar($tabla, $data) {
        return $this->db->insert($tabla, $data);
    }

    public function actualizar($tabla, $id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($tabla, $data);
    }

    public function desactivar($tabla, $id) {
        $this->db->where('id', $id);
        return $this->db->update($tabla, ['estado' => 0]);
    }
}