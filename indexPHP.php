<html>
<head>
	<title>Coding challenge - REA Group Asia</title>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="style.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="lib/js/bootbox.min.js"></script>
</head>
<body>
	<div class="centeredDiv w500 mTop2">
		<h1 >Lil Robo Steps | Version PHP</h1>
	</div>
	<div class="centeredDiv w500">
		<button type="button" onclick="move2JS()" class="btn btn-danger btn-md ">Switch to JS</button>
	</div>
	<div class="row w500 centeredDiv " id="tabletop">
	</div>
	<div class="row centeredDiv w500">
		<div class="panel panel-primary">
			<div class="panel-heading">Commands List</div>
			<div class="panel-body">
				<p>PLACE X,Y,F</p>
				<p>MOVE</p>
				<p>LEFT</p>
				<p>RIGHT</p>
				<p>REPORT</p>
			</div>
		</div>
		<div class="row ml1 row alert alert-danger col-lg-12" hidden id="msg2">
		</div>
		<form>
			<div class="form-group">
			  <label for="usr">Commands:</label>
			  <textarea rows="7" cols="50" class="form-control" id="cmds" name="cmds" placeholder="Enter commands here"></textarea>
			</div>
			<button id="execute" type="button" onclick="" class="btn btn-primary btn-md mTop2">Execute</button>
			<input type="submit" id="submit" hidden>
		</form>
		<div class="panel panel-success">
			<div class="panel-heading">Output</div>
			<div class="panel-body" id="results">
			</div>
		</div>
	</div>
</body>
</html>
<script>
	var directions = ["NORTH","SOUTH","EAST","WEST"];
	var commands = ["MOVE","LEFT","RIGHT","REPORT"];
	$('#execute').click(function() {
		$('#msg2').hide(); 
		var cmds = $('#cmds').val().split('\n');
		var data2send = { //Fetch form data
            'cmds'     : cmds
        };
		if(myVali(cmds)){
			$.ajax({
			  url: 'lib/php/processing.php',
			  data: data2send,
			  error: function() {
				$('#msg2').show();  
				$('#msg2').html('<p>An error has occurred</p>');
			  },
			  success: function(data) {
					$('#results').html(data);
			  },
			  type: 'GET'
			});
		}else{
			document.getElementById("msg2").innerHTML = 'One or more Commands are not correct! Note: You must start with Place Command.';
			$('#msg2').show(); 
		}
	});
	function myVali(data2send){
		var flag = 0;
		if(data2send[0].toUpperCase().includes("PLACE")){
			for(i=0;i<data2send.length;i++){
				//filter for PLACE
				if(data2send[i].indexOf(' ')>=0){
					words = data2send[i].split(' ');
					if (words[0].toUpperCase()!='PLACE'){
						flag++;
						console.log('place');
					}
					if(!(words[1].indexOf(',')>=0)){
						console.log('net zapiatoi');
						flag++;
					}else{
						params = words[1].split(',');
						if(params.length!=3){
							console.log('len='+params.length);
							flag++;
						}else{
							if(!(directions.indexOf(params[2].toUpperCase())>=0)){
								console.log('slovo');
								flag++;
							}
						}
					}
				}else {
					if(!(commands.indexOf(data2send[i].toUpperCase())>=0)){
						console.log('cmd_not_in_list');
						flag++;
					}
				}
			}
		}else {
			console.log('1st_not_place');
			flag++;
		}
		if (flag==0){
		return true;
		}else {return false;}
	}
	function clear(){
		document.getElementById("msg2").innerHTML = '';
		document.getElementById("msg2").style.display = 'none';
	}
	function move2JS(){
		window.location.href = "indexJS.html";
	}
</script>