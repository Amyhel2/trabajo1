<?php
class Sucursal_model extends CI_Model {

  public function guardar_o_actualizar($data) {
    $this->db->where('codigo_sucursal', $data['codigo_sucursal']);
    $existe = $this->db->get('sucursales_siat')->row();

    if ($existe) {
      $this->db->update('sucursales_siat', $data, ['codigo_sucursal' => $data['codigo_sucursal']]);
    } else {
      $this->db->insert('sucursales_siat', $data);
    }
  }

  public function obtener_todas() {
    return $this->db->get('sucursales_siat')->result();
  }
}
