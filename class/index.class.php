<?php

/**
* archivo de pruebas de conexion a base de datos
*/
class Index
{
	private $id;
	private $consultas;
	private $template;
	private $ruta;
	private $yo;
	private $dir;

	function __construct()
	{

		$this->dir = "temp/";

		# invocar archivo de configuracion

		$oConf    = new config();
	    $cfg      = $oConf->getConfig();
	   
		$db               = new mysqldb( $cfg['base']['dbhost'],
										$cfg['base']['dbuser'],
										$cfg['base']['dbpass'],
										$cfg['base']['dbdata'] );
		
		$this->consultas = new querys( $db );
	    $this->template  = new template();
	    $this->ruta      = $cfg['base']['template'];

	}

		private function control()
		{
			//return "modulo en construccion!!!!!!!!!!!";

			$data = ['@@@TITLE' => "DyT SOCMA Ltda.", '###LISTADO###' => $this::listado() ];
			return $this::despliegueTemplate( $data , 'index.html' );

		}

		private function listado()
		{
			$data = [ '###tr###' => $this::tr() ];
			return $this::despliegueTemplate( $data, 'listado/tabla.html' );
		}

		private function tr(){

			$code = "";
			$i    = 0;

			$arr = $this->consultas->listado();

			foreach ($arr['process'] as $key => $value) {
				# code...
			
				$this::creaQr($value['id'],$value['descripcion']);
				
				$filename = "{$this->dir}test-{$value['id']}.png";
			
				$data =[ '###num###' 		=> $i+1  ,
						 '###glosa###' 		=> $value['descripcion']	,
						 '###token###' 		=> $value['id'], 
						 '###filename###'  	=> $filename	
						];
				$code .= $this::despliegueTemplate( $data, 'listado/tr.html' );
				$i++;
			}

			return $code;

		}

		/**
		 * @return void
		 */
		private function creaQr($token = null,$description=null){

			if( !file_exists( $this->dir ))				
				mkdir( $this->dir);
				
			$filename = "{$this->dir}test-{$token}.png";

			$tamanio = 7;
			$level   = 'M';
			$frameSize = 3;
			$contenido = $description;

			QRcode::png($contenido,$filename,$level,$tamanio,$frameSize);


		}

	 /**
	  * despliegueTemplate(), metodo que sirve para procesar los templates
	  *
	  * @param  array   arrayData (array de datos)
	  * @param  array   tpl ( template )
	  * @return String
	  */
    private function despliegueTemplate($arrayData,$tpl){

     	  $tpl = $this->ruta.$tpl;

	      $this->template->setTemplate($tpl);
	      $this->template->llena($arrayData);

	      return $this->template->getCode();
	  }

	public function getCode(){

		return $this::control();
	}

}

?>
