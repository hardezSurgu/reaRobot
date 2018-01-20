<?php 
	class Robot {
		var $dimensionX;
		var $dimensionY;
		var $x; 
		var $y;
		var $direction;
		var $isPlaced;
		function __construct($x, $y, $direction) {		
			$this->x = $x;		
			$this->y = $y;
			$this->direction = $direction;
			$this->isPlaced = false;
			$this->dimensionX = 5;
			$this->dimensionY = 5;
		}
		
   		function place($x, $y, $direction) {
			if($x<=($this->dimensionX-1) && $y<=($this->dimensionY-1)){
				$this->x = $x;
				$this->y = $y;
				$this->direction = $direction;
				$this->isPlaced = true;
				return true;
			}else {return false;}
		}
		
		function report(){
			if($this->isPlaced){
				return 'Robot is in Section ['.$this->x.','.$this->y.'] Faced to '.$this->direction;
			}else{
				return 'Robot is not placed yet!';
			}
		}
		
		function move(){
			$v2return = false;
			switch (strtoupper($this->direction)){
				case "NORTH":
				if(($this->y) <= ($this->dimensionY-2)){
					$this->y = (int)$this->y + 1;
					$v2return = true;
				}
				break;
				case "SOUTH":
				if($this->y > 0){
					$this->y= (int)$this->y - 1;
					$v2return = true;
				}
				break;
				case "EAST":
				if($this->x > 0){
					$this->x= (int)$this->x - 1;
					$v2return = true;
				}
				break;
				case "WEST":
				if(($this->x) <= ($this->dimensionX-2)){
					$this->x=(int)$this->x + 1;
					$v2return = true;
				}
				break;
			}
			return $v2return;
		}
		function left(){
			switch (strtoupper($this->direction)){
				case "NORTH":
				$this->direction = "WEST";
				break;
				case "SOUTH":
				$this->direction = "EAST";
				break;
				case "EAST":
				$this->direction = "NORTH";
				break;
				case "WEST":
				$this->direction = "SOUTH";
				break;
			}
		}
		function right(){
			switch (strtoupper($this->direction)){
				case "NORTH":
				$this->direction = "EAST";
				break;
				case "SOUTH":
				$this->direction = "WEST";
				break;
				case "EAST":
				$this->direction = "SOUTH";
				break;
				case "WEST":
				$this->direction = "NORTH";
				break;
			}
		}
	} 
?>