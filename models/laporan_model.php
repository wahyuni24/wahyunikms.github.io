<?php

class Laporan_model extends Model
{
  function Laporan_model()
  {
    parent::Model();
  }


function laporan_explicit($idpengguna){
	 $sql=" select *
    from pengguna as p
    inner join explicit as e on p.id_pengguna=e.id_pengguna
    where p.id_pengguna='".$idpengguna."'";

    return $this->db->query($sql);
	}
	}
	?>