






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
      <iframe src="http://<?= base(); ?>/Application/Library/System/CLI/index.php" style="min-height: 350px; height:100%; width: 100%; min-width: 700px; border: none; padding:0px; margin:0px;"></iframe>
    </div>
  </div>


<style>


.terminal_section .content h1 {
  font-family: ' Helvetica Neue', helvetica, arial, sans-serif;
  margin: 0;
}
.terminal_section .content .openModal {
  display: inline-block;
  margin-top: 10px;
  border: solid #029173 2px;
  padding: 10px 20px;
  border-radius: 10px;
  -webkit-transition: all 0.25s;
  transition: all 0.25s;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  cursor: pointer;
}
.terminal_section .content .openModal:hover {
  color: white;
  background: #03BF94;
  -webkit-transition: all 0.25s;
  transition: all 0.25s;
}
.terminal_section.one {
  background: #B0CFE5;
}

.mac-window {

  border-radius: 5px;
  overflow: hidden;
  max-height: 90%;
  min-width: 400px;
  max-width: 80%;
  box-shadow: 0 15px 20px rgba(0, 0, 0, 0.25);
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translateY(-50%) translateX(-50%) scale(0);
          transform: translateY(-50%) translateX(-50%) scale(0);
  opacity: 0;
}
.mac-window.active {
  -webkit-transform: translateY(-50%) translateX(-50%) scale(1);
          transform: translateY(-50%) translateX(-50%) scale(1);
  opacity: 1;
  -webkit-transition: all 0.25s;
  transition: all 0.25s;
}
.mac-window.minimize {
  top: 125%;
  -webkit-transform: translateY(-50%) translateX(-50%) scale(1);
          transform: translateY(-50%) translateX(-50%) scale(1);
  opacity: 1;
  -webkit-transition: all 0.5s;
  transition: all 0.5s;
}
.mac-window.minimize:hover {
  top: 120%;
  -webkit-transition: all 0.5s;
  transition: all 0.5s;
}
.mac-window.maximize {
  height: 100%;
  max-height: 100%;
  width: 100%;
  max-width: 100%;
  -webkit-transform: translateY(-50%) translateX(-50%) scale(1);
          transform: translateY(-50%) translateX(-50%) scale(1);
}
.mac-window .title-bar {
  background: #d0cfd0;
  background: -webkit-linear-gradient(bottom, #c8c5c8, #eae7ea);
  background: linear-gradient(to top, #c8c5c8, #eae7ea);

  border-bottom: 1px solid #b4b4b4;
  width: 100%;
  overflow: auto;
  clear: both;
}
.mac-window .title-bar .buttons {
  height: 100%;
  width: 51px;
  float: left;
  margin-left: 9px;
}
.mac-window .title-bar .buttons .close, .mac-window .title-bar .buttons .minimize, .mac-window .title-bar .buttons .maximize {
  float: left;
  height: 10px;
  width: 10px;
  border-radius: 50%;
  margin-top: 5px;
  background: #fb4948;
  border: solid 1px rgba(214, 46, 48, 0.15);
  position: relative;
}
.mac-window .title-bar .buttons .close:before, .mac-window .title-bar .buttons .minimize:before, .mac-window .title-bar .buttons .maximize:before {
  content: '';
  position: absolute;
  height: 1px;
  width: 8px;
  background: #360000;
  top: 50%;
  left: 50%;
  -webkit-transform: translateY(-50%) translateX(-50%) rotate(45deg);
          transform: translateY(-50%) translateX(-50%) rotate(45deg);
  opacity: 0;
}
.mac-window .title-bar .buttons .close:after, .mac-window .title-bar .buttons .minimize:after, .mac-window .title-bar .buttons .maximize:after {
  content: '';
  position: absolute;
  height: 1px;
  width: 8px;
  background: #360000;
  top: 50%;
  left: 50%;
  -webkit-transform: translateY(-50%) translateX(-50%) rotate(-45deg);
          transform: translateY(-50%) translateX(-50%) rotate(-45deg);
  opacity: 0;
}
.mac-window .title-bar .buttons .minimize {
  background: #fdb225;
  margin-left: 8.5px;
  border-color: rgba(213, 142, 27, 0.15);
  position: relative;
}
.mac-window .title-bar .buttons .minimize:before {
  content: '';
  position: absolute;
  height: 1px;
  width: 8px;
  background: #864502;
  top: 50%;
  left: 50%;
  -webkit-transform: translateY(-50%) translateX(-50%);
          transform: translateY(-50%) translateX(-50%);
}
.mac-window .title-bar .buttons .minimize:after {
  display: none;
}
.mac-window .title-bar .buttons .maximize {
  float: right;
  background: #2ac833;
  border-color: rgba(30, 159, 32, 0.15);
}
.mac-window .title-bar .buttons .maximize:before {
  width: 6px;
  height: 6px;
  background: #0b5401;
  -webkit-transform: translateY(-50%) translateX(-50%);
          transform: translateY(-50%) translateX(-50%);
  border: solid #2ac833 1px;
  border-radius: 2px;
}
.mac-window .title-bar .buttons .maximize:after {
  width: 10px;
  height: 2px;
  background: #2ac833;
  -webkit-transform: translateY(-50%) translateX(-50%) rotate(45deg);
          transform: translateY(-50%) translateX(-50%) rotate(45deg);
}
.mac-window .title-bar .buttons:hover .close:before, .mac-window .title-bar .buttons:hover .minimize:before, .mac-window .title-bar .buttons:hover .maximize:before {
  opacity: 1;
}
.mac-window .title-bar .buttons:hover .close:after, .mac-window .title-bar .buttons:hover .minimize:after, .mac-window .title-bar .buttons:hover .maximize:after {
  opacity: 1;
}
.mac-window .title-bar .title {
  overflow: auto;
  height: 100%;
  text-align: center;
  margin-right: 60px;
  font-family: ' Helvetica Neue', helvetica, arial, sans-serif;
  line-height: 21px;
  font-size: 13px;
  font-weight: light;
  color: #222022;
}
.mac-window .window {
  background: white;
  /*
  max-height: 90vh;
  overflow-y: scroll; */
  height: 100%;
}

</style>
<script>
$(document).ready(function(){
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



</script>
