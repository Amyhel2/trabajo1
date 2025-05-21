<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cufd_model extends CI_Model
{
    /**
     * Guarda un nuevo CUFD en la base local.
     *
     * @param array $data
     * @return void
     */
    public function guardar(array $data)
    {
        $this->db->insert('codigos_cufd', $data);
    }

    /**
     * Devuelve todos los CUFD, ordenados del más reciente al más antiguo.
     *
     * @return array
     */
    public function obtener_todos(): array
    {
        return $this->db
            ->order_by('fecha_registro', 'DESC')
            ->get('codigos_cufd')
            ->result_array();
    }

    /**
     * Devuelve el CUFD vigente para la sucursal y punto de venta dados.
     *
     * @param int $nro_sucursal
     * @param int $nro_pv
     * @return array|null
     */
    public function obtener_vigente(int $nro_sucursal, int $nro_pv): ?array
    {
        $hoy = date('Y-m-d H:i:s');
        return $this->db
            ->where('nro_sucursal', $nro_sucursal)
            ->where('nro_punto_venta', $nro_pv)
            ->where('fecha_vigencia >=', $hoy)
            ->order_by('fecha_registro', 'DESC')
            ->limit(1)
            ->get('codigos_cufd')
            ->row_array();
    }
}
