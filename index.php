<?php
  require 'phpqrcode/qrlib.php';

  include("class/mysqldb.class.php");
  include("class/querys.class.php");

  include( "class/template.class.php" );
  include( "class/index.class.php" );
  include("config.php");

  $ob_index = new Index();
  echo $ob_index->getCode();

 ?>