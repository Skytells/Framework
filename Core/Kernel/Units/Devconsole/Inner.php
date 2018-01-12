<?
$Datafile = __DIR__.'/data/Framework.json';
$Data = file_get_contents($Datafile);
$Data = json_decode($Data);

function micro_to_hrs($time) {

	$micro_time=sprintf("%06d",($time - floor($time)) * 1000000);
	$date=new DateTime( date('Y-m-d H:i:s.'.$micro_time,$time) );
	$f =  $date->format("H:i:s.u");
	return substr($f, 0, -4);
}
$Console = new stdClass;
$Console->Controllers = 'Loaded Controllers : '.count($Data->Runtime->Controllers).'<br>';
if (count($Data->Runtime->Controllers) > 0) {
foreach ($Data->Runtime->Controllers as $Object) {
		$Console->Controllers = $Console->Controllers. '<O class="red">$ ></O> PID : '.$Object->ProccessID.' -> '.$Object->Type.' [ ' . $Object->Name . ' ] Loaded at '.micro_to_hrs($Object->Timestamp).' from : ' . $Object->File . '<br>';
}
}

$Console->All = '<O class="red">$ ></O> Total Events : '.count($Data->Runtime->All).'<br>';
if (count($Data->Runtime->All) > 0) {
foreach ($Data->Runtime->All as $Object) {
	if ($Object->Type !== 'cLog') {
		$Console->All = $Console->All. '<O class="red">$ ></O> PID : '.$Object->ProccessID.' -> '.$Object->Type.' [ ' . $Object->Name . ' ] Loaded at '.micro_to_hrs($Object->Timestamp).' from : ' . $Object->File . '<br>';
	}elseif ($Object->Type == 'cLog') {
		$Console->All = $Console->All. '<O class="red">$ ></O> PID : '.$Object->ProccessID.' -> Console Message logged at '.micro_to_hrs($Object->Timestamp).' : ' . $Object->Message . '<br>';
	}
}
}

$Console->Models = 'Total Models : '.count($Data->Runtime->Models).'<br>';
if (count($Data->Runtime->Models) > 0) {
foreach ($Data->Runtime->Models as $Object) {
		$Console->Models = $Console->Models. '<O class="red">$ ></O> PID : '.$Object->ProccessID.' -> '.$Object->Type.' [ ' . $Object->Name . ' ] Loaded at '.micro_to_hrs($Object->Timestamp).' from : ' . $Object->File . '<br>';
}
}

if (count($Data->Runtime->Handlers) > 0) {
$Console->Handlers = 'Total Handlers : '.count($Data->Runtime->Handlers).'<br>';
foreach ($Data->Runtime->Handlers as $Object) {
		$Console->Handlers = $Console->Handlers. '<O class="red">$ ></O> PID : '.$Object->ProccessID.' -> '.$Object->Type.' [ ' . $Object->Name . ' ] Loaded at '.micro_to_hrs($Object->Timestamp).' from : ' . $Object->File . '<br>';
}
}

if (count($Data->Runtime->Libraries) > 0) {
$Console->Libraries = 'Total Libraries : '.count($Data->Runtime->Libraries).'<br>';
foreach ($Data->Runtime->Libraries as $Object) {
		$Console->Libraries = $Console->Libraries. '<O class="red">$ ></O> PID : '.$Object->ProccessID.' -> '.$Object->Type.' [ ' . $Object->Name . ' ] Loaded at '.micro_to_hrs($Object->Timestamp).' from : ' . $Object->File . '<br>';
}
}


if (count($Data->Runtime->Helpers) > 0) {
$Console->Helpers = 'Total Helpers : '.count($Data->Runtime->Helpers).'<br>';
foreach ($Data->Runtime->Helpers as $Object) {
		$Console->Helpers = $Console->Helpers. '<O class="red">$ ></O> PID : '.$Object->ProccessID.' -> '.$Object->Type.' [ ' . $Object->Name . ' ] Loaded at '.micro_to_hrs($Object->Timestamp).' from : ' . $Object->File . '<br>';
}
}

?>

<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Titillium+Web:200,300,400" rel="stylesheet">
<script src="https://use.fontawesome.com/7cd1052013.js"></script>


<link rel="stylesheet" href="<?=$_REQUEST['core'];?>/Kernel/Units/Devconsole/assets/inner.css">
<div class="mdl-tabs vertical-mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
										  <div class="mdl-grid mdl-grid--no-spacing">
										    <div class="mdl-cell mdl-cell--1-col">
											      <div class="mdl-tabs__tab-bar">
											         <a href="#tab1-panel" class="mdl-tabs__tab is-active">
											      	     <span class="hollow-circle"></span>
 																 Summary
											         </a>
											         <a href="#dev-console" class="mdl-tabs__tab consolebtn" onclick="cview('All')">
											      	      <span class="hollow-circle"></span>
											      	      Console
											          </a>
                                <a href="#tab2-panel" class="mdl-tabs__tab">
                                     <span class="hollow-circle"></span>
                                     Warnings
                                 </a>
											     </div>
											   </div>
											   <div class="mdl-cell mdl-cell--11-col">


												      <div class="mdl-tabs__panel is-active" id="tab1-panel">
                                <div class="mdl-grid mdl-grid--no-spacing">


                                 <div class="mdl-cell mdl-cell--4-col">
                                  <i class="fa fa-codepen"></i><span class="darkgrey"> Framework Version &nbsp; : &nbsp; <O class="red"><?= $_REQUEST['fwver']; ?></O> <? if ($Data->Settings->ALLOW_TERMINAL == TRUE) { ?> &nbsp;(
																		<a href="#" title="Open Terminal" class="openModal" id="openTerminal">Terminal</a> ) <? } ?></span>
                                  <br>
                                  <i class="fa fa-code"></i> <span class="darkgrey">Current PHP Version : &nbsp; <O class="blue"><?= phpversion(); ?></O></span>
																	<br>
                                  <i class="fa fa-clock-o"></i> <span class="darkgrey"> System Benchmark &nbsp; &nbsp;: &nbsp; <O class="grey"><?= $Data->benchmark; ?> ms</O></span>
																	<br>
                                  <i class="fa fa-database"></i> <span class="darkgrey"> Database(s) Status  &nbsp;&nbsp; &nbsp;: &nbsp; <? $x = (isset($Data->db_connection) && $Data->db_connection == true) ? '<O class="green">Connected</O>' : '<O class="red">Not Connected</O>'; echo $x; $x = null;?></span>
                                 </div>




																 <div class="mdl-cell mdl-cell--4-col">
																	<i class="fa fa-asterisk"></i><span class="darkgrey"> Total Cached &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;: &nbsp; <O class="orange"><?= $Data->totalCached; ?></O> &nbsp;( <a target="_parent" class="darkgreen" href="<?=$Data->homebase;?>?action=flushcache">Flush</a> ) </span>
																	<br>
																	<i class="fa fa-language"></i> <span class="darkgrey">Active Language &nbsp;&nbsp; &nbsp;: &nbsp; <O class="blue"><?= $Data->language ?></O> &nbsp;( <a class="darkgreen" target="_parent" href="<?=$Data->homebase;?>?lang=fr_FR">Change</a> )</span>
																 	 <br>
																	<i class="fa fa-microchip"></i> <span class="darkgrey">MySQL Version  &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;: &nbsp; <? $x = (isset($Data->db_connection) && $Data->db_connection == true) ? '<O class="green">'.$Data->dbversion.'</O>' : '<O class="red">Unknown</O>'; echo $x; $x = null;?></span>
																	<br>
 																	<i class="fa fa-th-list"></i> <span class="darkgrey">Active Databases&nbsp;&nbsp;&nbsp;: &nbsp; <O class="orange"><?= $Data->dbcount; ?></O></span>

																 </div>


																 <div class="mdl-cell mdl-cell--4-col">
																	<i class="fa fa-jsfiddle"></i><span class="darkgrey"> Loaded Helpers &nbsp;&nbsp;: &nbsp; <O class="orange"><?= count($Data->Runtime->Helpers); ?></O> &nbsp;( <a  class="darkgreen" href="#" onclick="cview('Helpers')">Show</a> ) </span>
																	<br>
																	<i class="fa fa-modx"></i><span class="darkgrey"> Loaded Models &nbsp;&nbsp; : &nbsp; <O class="orange"><?= count($Data->Runtime->Models); ?></O> &nbsp;( <a  class="darkgreen" href="#" onclick="cview('Models')">Show</a> ) </span>
																 	 <br>
																	 <i class="fa fa-eercast"></i><span class="darkgrey"> Loaded Handlers : &nbsp; <O class="orange"><?= count($Data->Runtime->Handlers); ?></O> &nbsp;( <a  class="darkgreen" href="#" onclick="cview('Handlers')">Show</a> ) </span>
																	<br>
																	<i class="fa fa-dropbox"></i><span class="darkgrey"> Loaded Libraries &nbsp;: &nbsp; <O class="orange"><?= count($Data->Runtime->Libraries); ?></O> &nbsp;( <a  class="darkgreen" href="#" onclick="cview('Libraries')">Show</a> ) </span>

																 </div>

												      </div>
														</div>


                              <div class="mdl-tabs__panel" id="dev-console">
                                <div  id="debuggerResults" class="ta10" style="width: 100%;  overflow-x:auto;" >
                                	<?
																	foreach ($Data->Runtime->All as $Object) {
																		if ($Object->Type !== 'cLog') {
																			echo '<O class="red">$ ></O> PID : '.$Object->ProccessID.' -> '.$Object->Type.' [ ' . $Object->Name . ' ] Loaded at '.micro_to_hrs($Object->Timestamp).' from : ' . $Object->File . '<br>';
																		}elseif ($Object->Type == 'cLog') {
																			echo '<O class="red">$ ></O> PID : '.$Object->ProccessID.' -> Console Message logged at '.micro_to_hrs($Object->Timestamp).' : ' . $Object->Message . '<br>';
																		}
																	}
																	?>
                                </div>



      												</div>

												      <div class="mdl-tabs__panel" id="tab2-panel">

																<i class="fa fa-exclamation-triangle red" aria-hidden="true"></i> <span class="orange"> The Framework Developer Console may effect the UI's CSS.</O></span>
																<br>
      												</div>

											    </div>
										  </div>
									</div>




									<script type="text/javascript"> if(typeof jQuery=='undefined') {
										 document.write('<script type="text/javascript" src="<?=$_REQUEST['core'];?>/Kernel/Units/Devconsole/assets/js/jquery-1.7.1.min.js"></'+'script>');}
									</script>

									<script>
										function cview(type) {
											$( ".mdl-tabs__tab" ).each(function() {
											  $( this ).removeClass( "is-active" );
											});
											$( ".mdl-tabs__panel" ).each(function() {
											  $( this ).removeClass( "is-active" );
											});
												$('#dev-console').addClass('is-active');
												$('.consolebtn').addClass('is-active');
												if (type == 'All') {
													$('#debuggerResults').empty().html('<?= $Console->All; ?>');
												}
												if (type == 'Controllers') {
													$('#debuggerResults').empty().html('<?= $Console->Controllers; ?>');
												}
												if (type == 'Models') {
													$('#debuggerResults').empty().html('<?= $Console->Models; ?>');
												}
												if (type == 'Helpers') {
													$('#debuggerResults').empty().html('<?= $Console->Helpers; ?>');
												}
												if (type == 'Handlers') {
													$('#debuggerResults').empty().html('<?= $Console->Handlers; ?>');
												}
												if (type == 'Libraries') {
													$('#debuggerResults').empty().html('<?= $Console->Libraries; ?>');
												}
										}
										</script>
