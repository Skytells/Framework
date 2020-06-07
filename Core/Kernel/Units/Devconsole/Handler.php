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
  $Console->Controllers = 'Loaded Controllers : '.count((array)$Data->Runtime->Controllers).'<br>';
  if (count((array)$Data->Runtime->Controllers) > 0) {
    foreach ($Data->Runtime->Controllers as $Object) {
    		$Console->Controllers = $Console->Controllers. '<O class="red">$ ></O> PID : '.$Object->ProccessID.' -> '.$Object->Type.' [ ' . $Object->Name . ' ] Loaded at '.micro_to_hrs($Object->Timestamp).' from : ' . $Object->File . '<br>';
      }
  }

  $Console->All = '<O class="red">$ ></O> Total Events : '.count((array)$Data->Runtime->All).'<br>';
  if (count((array)$Data->Runtime->All) > 0) {
    foreach ($Data->Runtime->All as $Object) {
    	if ($Object->Type !== 'cLog') {
    		$Console->All = $Console->All. '<O class="red">$ ></O> PID : '.$Object->ProccessID.' -> '.$Object->Type.' [ ' . $Object->Name . ' ] Loaded at '.micro_to_hrs($Object->Timestamp).' from : ' . $Object->File . '<br>';
    	}elseif ($Object->Type == 'cLog') {
    		$Console->All = $Console->All. '<O class="red">$ ></O> PID : '.$Object->ProccessID.' -> Console Message logged at '.micro_to_hrs($Object->Timestamp).' : ' . $Object->Message . '<br>';
    	}
    }
  }

  $Console->Models = 'Total Models : '.count((array)$Data->Runtime->Models).'<br>';
    if (count((array)$Data->Runtime->Models) > 0) {
    foreach ($Data->Runtime->Models as $Object) {
    		$Console->Models = $Console->Models. '<O class="red">$ ></O> PID : '.$Object->ProccessID.' -> '.$Object->Type.' [ ' . $Object->Name . ' ] Loaded at '.micro_to_hrs($Object->Timestamp).' from : ' . $Object->File . '<br>';
    }
  }

  if (count((array)$Data->Runtime->Handlers) > 0) {
    $Console->Handlers = 'Total Handlers : '.count((array)$Data->Runtime->Handlers).'<br>';
    foreach ($Data->Runtime->Handlers as $Object) {
    		$Console->Handlers = $Console->Handlers. '<O class="red">$ ></O> PID : '.$Object->ProccessID.' -> '.$Object->Type.' [ ' . $Object->Name . ' ] Loaded at '.micro_to_hrs($Object->Timestamp).' from : ' . $Object->File . '<br>';
    }
  }

  if (count((array)$Data->Runtime->Libraries) > 0) {
    $Console->Libraries = 'Total Libraries : '.count((array)$Data->Runtime->Libraries).'<br>';
    foreach ($Data->Runtime->Libraries as $Object) {
    		$Console->Libraries = $Console->Libraries. '<O class="red">$ ></O> PID : '.$Object->ProccessID.' -> '.$Object->Type.' [ ' . $Object->Name . ' ] Loaded at '.micro_to_hrs($Object->Timestamp).' from : ' . $Object->File . '<br>';
    }
  }


  if (count((array)$Data->Runtime->Helpers) > 0) {
    $Console->Helpers = 'Total Helpers : '.count((array)$Data->Runtime->Helpers).'<br>';
    foreach ($Data->Runtime->Helpers as $Object) {
    		$Console->Helpers = $Console->Helpers. '<O class="red">$ ></O> PID : '.$Object->ProccessID.' -> '.$Object->Type.' [ ' . $Object->Name . ' ] Loaded at '.micro_to_hrs($Object->Timestamp).' from : ' . $Object->File . '<br>';
    }
  }
