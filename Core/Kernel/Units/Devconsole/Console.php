<?
global $Framework, $ENV_STARTUP_TIME, $Settings, $db, $dbconfig, $BMEND, $ConnectedDBS;
$time_elapsed_secs = microtime(true) - $ENV_STARTUP_TIME;
$Framework['benchmark'] = substr($time_elapsed_secs - $BMEND, 0, 10);
$Framework['language'] = (isset($_SESSION[LANG_SESID])) ? $_SESSION[LANG_SESID] : "en_US";
$Framework['Settings'] = $Settings;
$Framework['totalCached'] = getTotalCached();
$Framework['homebase'] = Base();
$Framework['dbversion'] = (is_object($db)) ? $db->server_info : 'Unknown';
$Framework['dbcount'] = $ConnectedDBS;
$Datafile = __DIR__.'/data/Framework.json';
if (file_exists($Datafile)) { unlink($Datafile); }
file_put_contents($Datafile, json_encode($Framework, JSON_PRETTY_PRINT));
?>

<link href="<?= Base(); ?>/<?=COREDIRNAME;?>/Kernel/Units/Devconsole/assets/style.css" rel="stylesheet">
<div  id="macWindow"  class="mac-window">
  <div  class="title-bar" >
    <div class="buttons">
      <div class="close"></div>
      <div class="minimize"></div>
      <div class="maximize"></div>
    </div>
    <div class="title">
      Skytells Framework - Terminal
    </div>
  </div>
  <div class="window">
    <iframe src="<?= Base(); ?>/<?=COREDIRNAME;?>/Kernel/Units/Devconsole/CLI/index.php" style="min-height: 350px; height:100%; width: 100%; min-width: 700px; border: none; padding:0px; margin:0px;"></iframe>
  </div>
</div>
<span class="DevToolsfTab">
  <img src="<?= Base(); ?>/<?=COREDIRNAME;?>/Kernel/Units/Devconsole/images/devIcon.png" style="width: 24px; height: 24px;" title="Open Developer Tools">
</span>
 <DevToolsfooter id="DevToolsfooter">
   <iframe id="frmInner" scrolling="no" src="<?= Base(); ?>/<?=COREDIRNAME;?>/Kernel/Units/Devconsole/Inner.php?fwver=<?=FRAMEWORK_VERSION;?>&core=<?= Base().'/'.COREDIRNAME; ?>"
     style="height:100%; width: 100%;  border: none; padding:0px; margin:0px;">
   </iframe>

 </DevToolsfooter>




 <script type="text/javascript"> if(typeof jQuery=='undefined') {
    document.write('<script type="text/javascript" src="<?= Base(); ?>/<?=COREDIRNAME;?>/Kernel/Units/Devconsole/assets/js/jquery-1.7.1.min.js"></'+'script>');}
 </script>
 <? require __DIR__.'/assets/js/functions.js.php'; ?>
 <script>
 $(document).ready(function(){
   $('#frmInner').load(function(){
   var iframeBody = $('#frmInner').contents();
   iframeBody.find("#openTerminal").click(function(){
            $('.mac-window').addClass('active');
        });


   });
   $('.openModal').click(function(){
     $('.mac-window').addClass('active');
   });
   $('.close').click(function(){
     $('.mac-window').removeClass('active');
     $('.mac-window').removeClass('maximize');
     $('.mac-window').removeClass('minimize');
   });
   $('.minimize').click(function(){
     $('.mac-window').toggleClass('minimize');
     $('.mac-window').removeClass('maximize');
   });
   $('.maximize').click(function(){
     $('.mac-window').toggleClass('maximize');
     $('.mac-window').removeClass('minimize');
   });
 });

 function toggleTerminal() {
   $('.openModal').click(function(){
     $('.mac-window').addClass('active');
   });
   $('.close').click(function(){
     $('.mac-window').removeClass('active');
     $('.mac-window').removeClass('maximize');
     $('.mac-window').removeClass('minimize');
   });
   $('.minimize').click(function(){
     $('.mac-window').toggleClass('minimize');
     $('.mac-window').removeClass('maximize');
   });
   $('.maximize').click(function(){
     $('.mac-window').toggleClass('maximize');
     $('.mac-window').removeClass('minimize');
   });
 }

 </script>
