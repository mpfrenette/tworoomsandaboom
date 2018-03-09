<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Two rooms and a boom wizard</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <style>

    .red{
    	background-color: #ffaa99;
    }
.blue{
    	background-color: #99f4ff;
    }

.gray{
    	background-color: #ccc;
    }
.purple{
    	background-color: #cc99ff;
    }
.green{
    	background-color: #72b272;
    }

    #result{
    	min-height: 400px;
    }
    </style>

    <script>


    function SetGame(number){

    	switch( number){

    		case 'sm1':
    			$('#lessten .toggle').prop('checked', false).change();
				$('#bury').prop('checked', true).change();	
			break;
    		case 'sm2':
    			$('#lessten .toggle').prop('checked', false).change();
				$('#extra').prop('checked', true).change();	
			break;

			case 'md1':
    			$('#moreten .toggle').prop('checked', false).change();
				$('#spy').prop('checked', true).change();	
				$('#agent').prop('checked', true).change();	
			break;
    		case 'md2':
    			$('#moreten .toggle').prop('checked', false).change();
				$('#secondary').prop('checked', true).change();	
				$('#privatewin').prop('checked', true).change();	
			break;
			case 'md3':
				$('#moreten .toggle').prop('checked', false).change();
				$('#cardswap').prop('checked', true).change();	
				$('#instantwins').prop('checked', true).change();	
			break;
			case 'md4':
				$('#moreten .toggle').prop('checked', false).change();
				$('#spy').prop('checked', true).change();	
				$('#agent').prop('checked', true).change();	
				$('#reveal').prop('checked', true).change();	
			break;
    		case 'lg1':
    		$('#more15 .toggle').prop('checked', false).change();
				$('#enemies').prop('checked', true).change();	
				$('#friends').prop('checked', true).change();	
			
			break;
			case 'lg2':
				$('#more15 .toggle').prop('checked', false).change();
				$('#leeches').prop('checked', true).change();	
				$('#haters').prop('checked', true).change();	
			
			break;
			case 'lg3':
				$('#more15 .toggle').prop('checked', false).change();
				$('#leeches').prop('checked', true).change();	
				$('#haters').prop('checked', true).change();	
				$('#enemies').prop('checked', true).change();	
				$('#friends').prop('checked', true).change();	
			
			break;
    		
    	}
    	UpdateForm();
    }


    function UpdateForm(){


    	if ( $("#players option:selected").val()  < 10){
    		$("#moreten").css('display', 'none');
    	}
    	else{
    		$("#moreten").css('display', 'block');
    	}

		if ( $("#players option:selected").val()  < 15){
    		$("#more15").css('display', 'none');
    	}
    	else{
    		$("#more15").css('display', 'block');
    	}

    	if ( $("#firstgame").prop('checked')){
    		$("#advancedcardsblock").css('display', 'none');
    	}
    	else{
    		$("#advancedcardsblock").css('display', 'block');
    	}

   	  	$("#result").html("Loading...");
	  	var data = $("#form").serializeArray();

    	$.post( "data.php", { action: "json", formdata: data } )
	     .done(function( data ) {

	  	$("#result").html(data);
	    
	  });



    }

    </script>

  </head>
  <body>

<?

/**
 * This function output a yes/no toggle for selecting cards
 * @param  [type] $label      [description]
 * @param  [type] $field      [description]
 * @param  string $default    [description]
 * @param  string $additional [description]
 * @return [type]             [description]
 */
function yesnotoggle($label, $field, $default = 'yes', $additional = ''){
    $content = '<div class="form-group">
    <label class="col-sm-2 col-md-2 control-label">'.$label.'</label>
    <div class="col-sm-1 col-md-1">


    <input type="checkbox" class="toggle" data-toggle="toggle" name="'.$field.'" id="'.$field.'"  onChange="UpdateForm(); return false;">';

    $content .= '
        </div>';

    if ( $additional){
    $content .= '<div class="col-sm-4 col-md-2">'. $additional . '</div>';


    }
    $content .= '</div>

    ';

    return $content;

}

?>


<div class="container-fluid">
  	<div class="row">
  		 <div class="col-md-12">
    <h1>Two rooms and a boom card wizard</h1>
    <p>You can use this simple wizard to help you pick which cards to use in your <a href="http://www.tuesdayknightgames.com/tworoomsandaboom" target="_blank">Two Rooms and a boom</a> games</p>


<form class="form-horizontal" id="form">


	
<?  ####################### number of players  ########################## ?>
<div class="form-group">
<label class="col-sm-2 col-md-2 control-label">Number of Players:</label>

	    <div class="col-sm-2 col-md-1">
  
<select class="form-control" name="players" id="players" onChange="UpdateForm();">
	<?php

for( $i = 6; $i <= 30; $i++){

 echo '<option value="'.$i.'">'.$i.' players</option>';

}
  
?>
</select>

    </div>
  </div>

<? 


echo yesnotoggle('First Game:', 'firstgame');


echo '<div style="display: none;" id="advancedcardsblock">';


echo '
<div class="panel panel-default" id="lessten">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Base Options</a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse">
            <div class="panel-body">';


echo '<p>Pre-Set Games:&nbsp;';
echo '<a href="#" onClick="SetGame(\'sm1\'); return false;" class="btn btn-primary">Bury</a>&nbsp;';
echo '<a href="#" onClick="SetGame(\'sm2\'); return false;" class="btn btn-primary">Extra Conditions</a>';
echo '</p>';

echo yesnotoggle('Bury a card:', 'bury', 'no', 'Will add alternates');
echo yesnotoggle('Drunk:', 'drunk', 'no', 'Will add 1 additional card');
echo yesnotoggle('Extra conditions:', 'extra', 'no', 'Will add Doctor/Engineer');


echo ' </div>
        </div>
    </div>';

echo '<div style="display: none;" id="moreten">

<div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse10">Recommended for 10 players or more</a>
            </h4>
        </div>
        <div id="collapse10" class="panel-collapse collapse">
            <div class="panel-body">';

echo '<p>Pre-Set Games:&nbsp;';
echo '<a href="#" onClick="SetGame(\'md1\'); return false;" class="btn btn-primary">Privacy Pack</a>&nbsp;';
echo '<a href="#" onClick="SetGame(\'md2\'); return false;" class="btn btn-primary">Special Wins</a>&nbsp;';
echo '<a href="#" onClick="SetGame(\'md3\'); return false;" class="btn btn-primary">Share Surprises</a>&nbsp;';
echo '<a href="#" onClick="SetGame(\'md4\'); return false;" class="btn btn-primary">Psychological Game (16 players min)</a>';
echo '</p>';


echo yesnotoggle('Zombie:', 'zombie', 'no');
echo yesnotoggle('Spy and Coy:', 'spy', 'no');
echo yesnotoggle('Agent and Shy guy:', 'agent', 'no');
echo yesnotoggle('Ambassadors:', 'ambassadors', 'no');
echo yesnotoggle('Traveling Goals:', 'traveling', 'no', 'Will add Agoraphobe/Traveller');
echo yesnotoggle('instant wins:', 'instantwins', 'no', 'Will add Dr. Boom/Tuesday Knight');
echo yesnotoggle('Secondary Win:', 'secondary', 'no', 'Will add Bomb-bot/Queen');
echo yesnotoggle('Private Win:', 'privatewin', 'no', 'Will add Clone/Robot');
echo yesnotoggle('Relationship Cards:', 'relationship', 'no', 'Will add Cupid/Eris');
echo yesnotoggle('Reveal Pack:', 'reveal', 'no', 'Will add Criminal, Dealer and Psychologists');
echo yesnotoggle('Card Swap:', 'cardswap', 'no', 'Will add Hot Potato/Leprechaun');

echo ' </div>
        </div>
    </div>';

echo '</div>';

echo '<div style="display: none;" id="more15">
<div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse15">Recommended for 15 players or more</a>
            </h4>
        </div>
        <div id="collapse15" class="panel-collapse collapse">
            <div class="panel-body">';
echo '<p>Pre-Set Games:&nbsp;';
echo '<a href="#" onClick="SetGame(\'lg1\'); return false;" class="btn btn-primary">Dual Pairs</a>&nbsp;';
echo '<a href="#" onClick="SetGame(\'lg2\'); return false;" class="btn btn-primary">Leeches and Haters</a>&nbsp;';
echo '<a href="#" onClick="SetGame(\'lg3\'); return false;" class="btn btn-primary">Super Gray</a>&nbsp;';

echo '</p>';


echo yesnotoggle('Leeches:', 'leeches', 'no', 'Will add Intern/Victim');
echo yesnotoggle('Haters:', 'haters', 'no', 'Will add Rival/Survivor');
echo yesnotoggle('Pairs of Enemies:', 'enemies', 'no', 'Will add Wife/Mistress and Moby/Ahab');
echo yesnotoggle('Pairs of Friends:', 'friends', 'no', 'Will add Romeo/Juliet, Butler/Maid');
echo ' </div>
        </div>
    </div>';


////////////////////////////////////////////////////////////



echo '</div>';

?>

</div>

</div>
</div>
  	<div class="row" ><div class="col-sm-12" id="result">

</div>
  	</div>

<p>This page was made by <a href="http://www.frenette.info" target="_blank">Martin-Pierre Frenette</a>, in two hours on May 30th and 31st 2016. No data is saved anywhere other than in the access logs.</p>

</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script>UpdateForm();</script>
  </body>
</html>