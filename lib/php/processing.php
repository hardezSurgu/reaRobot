<?php
	require_once('robot.php');
	$myRobot = new Robot(0,0,'');
	$data = $_GET['cmds'];
	$v2return;
	$error='';
	for ($i=0;$i<sizeof($data);$i++){
		$temp = convert(trim($data[$i]));
		switch (strtoupper($temp)){
			case 'REPORT':
			$v2return = $myRobot->report();
			break;
			case 'PLACE':
			$params = getPlaceParams($data[$i]);
			if(!$myRobot->place($params[0],$params[1],$params[2])){
				$error = 'Robot cannot be placed out of board!';
			}
			break;
			case 'MOVE':
			if(!$myRobot->move()){
				$error = 'Robot is going to fall!';
			}
			break;
			case 'LEFT':
			$myRobot->left();
			break;
			case 'RIGHT':
			$myRobot->right();
			break;
		}
	}
	function convert($str){
		if (strpos($str, ' ') !== false) {
			$pieces = explode(" ", $str);
			return $pieces[0];
		}else{
			return $str;
		}
	}
	function getPlaceParams($str){
		$words = explode(" ", $str);
		$params = explode(",", $words[1]);
		return $params;
	}
	function sendBack(){
		global $error;
		global $v2return;
		if($error==''){
			echo json_encode($v2return);
		}else{
			echo json_encode($error);
		}
	}
	sendBack();
?>