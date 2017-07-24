<?php
class Fotoheader extends AppModel {
	var $name = 'Fotoheader';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
        var $order = array("Fotoheader.modified" => "desc");
	var $hasMany = array();
}
?>