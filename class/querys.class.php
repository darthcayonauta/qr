<?php
/**
* @author  Claudio Guzman Herrera
* @version 1.0
*/
class querys
{
	private $fecha_hoy;
	private $fecha_hora_hoy;
	private $error;

	function __construct($sql=null)
	{
		# code...
		if ( !is_null( $sql ) ){
			$this->sql   = $sql;
			$this->error = "Modulo no definido";
		}

		else{

			$oConf     = new config();
		  $cfg       = $oConf->getConfig();
		  $this->sql = new mysqldb( $cfg['base']['dbhost'],
				 					$cfg['base']['dbuser'],
									$cfg['base']['dbpass'],
									$cfg['base']['dbdata'] );

		$this->error = $cfg['base']['error'];
		}

		$this->fecha_hoy 		=  date("Y-m-d");
		$this->fecha_hora_hoy 	=  date("Y-m-d H:i:s");
	}


	public function listado()
	{
			$ssql = "SELECT * FROM test";
	
			$arr['sql']= $ssql;
			$arr['process']= $this->sql->select( $ssql );
			$arr['total-recs']= count( $arr['process'] );
		
			return $arr;
	
	}
}


