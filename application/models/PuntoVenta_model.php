<?php
class PuntoVenta_model extends CI_Model {

  public function guardar_o_actualizar($data) {
    $this->db->where('nro_punto_venta', $data['nro_punto_venta']);
    $this->db->where('id_sucursal', $data['id_sucursal']);
    $existe = $this->db->get('puntos_venta_siat')->row();

    if ($existe) {
      $this->db->update('puntos_venta_siat', $data, [
        'nro_punto_venta' => $data['nro_punto_venta'],
        'id_sucursal' => $data['id_sucursal']
      ]);
    } else {
      $this->db->insert('puntos_venta_siat', $data);
    }
  }

  public function obtener_por_sucursal($id_sucursal) {
    return $this->db->get_where('puntos_venta_siat', ['id_sucursal' => $id_sucursal])->result();
  }

  public function obtener_todos() {
  return $this->db->get('puntos_venta_siat')->result();
}

}
