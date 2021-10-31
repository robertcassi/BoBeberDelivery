<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IndexModel extends CI_Model {

    function listar($table, $where = array(), $join = array(), $select = null) {
        if($select)
            $this->db->select('');
        $this->db->from($table);

        foreach($join as $key => $jn)
            $this->db->join($key, $jn);
        
        if($where)
            $this->db->where($where);

        $query = $this->db->get();
        return $query->result();
    }

    function carregaRegistro($table, $where) {
		$this->db->where($where);

        $query = $this->db->get($table);
        return $query->row(0);
    }

    function listaCategorias() {
        $sql = "select * from categorias WHERE atividade = 1 AND id IN (select categoria from produtos)";
        
        $query = $this->db->query($sql);        
        return $query->result();
    }

    function listaProdutos($id) {
        $sql = " SELECT P.*, UM.abreviacao, UM.nome as und_medida FROM `produtos` P
                    LEFT JOIN unidades_medidas UM ON UM.id = P.tipoUND
                WHERE P.categoria = $id
                    AND P.atividade = 1";
        
        $query = $this->db->query($sql);
        return $query->result();
    }

}

?>