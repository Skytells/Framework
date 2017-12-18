
<style>
  .bg-none{
    background:none;
    background-color:none;
  }
   .devToolscol-1 {width: 8.33%;}
   .devToolscol-2 {width: 16.66%;}
   .devToolscol-3 {width: 25%;}
   .devToolscol-4 {width: 33.33%;}
   .devToolscol-5 {width: 41.66%;}
   .devToolscol-6 {width: 50%;}
   .devToolscol-7 {width: 58.33%;}
   .devToolscol-8 {width: 66.66%;}
   .devToolscol-9 {width: 75%;}
   .devToolscol-10 {width: 83.33%;}
   .devToolscol-11 {width: 91.66%;}
   .devToolscol-12 {width: 100%;}
   .devToolsFontGreen{
   color:green;
   }
   .devToolsFontRed{
   color:red;
   }
   .devToolsFontOrange{
   color:orange;
   }
   DevToolsfooter {

   position: fixed;
   left: 0;
   right: 0;
   bottom: 0;
   max-height: 0px;
   height: 140px;
   background-color: #fafafa;
   -webkit-transition: max-height 0.2s;
   transition: max-height 0.2s;
   border-top: solid 1px #ddd;
   display: none;
   font-family: "Source Code Pro", Menlo, Monaco, fixed-width;
   font-size: 12px;
   }
   .DevToolsfTab {


   position: fixed;

   left: 0;
   bottom: 0;
   padding: 0.5rem 1.7rem;
   background-color: #fafafa;
   border: solid 1px #ddd;
   border-bottom: 0;
   border-radius: 4px 4px 0 0;
   -webkit-transition: bottom 0.2s;
   transition: bottom 0.2s;
   cursor: pointer;
   }
   .DevToolsfTab.active {

     position: fixed;
     padding: 0.5rem 1.7rem;
     background-color: #fafafa;
     bottom: 114px;
      height: 10px;
   z-index: 9994;
   padding: 0.9rem 2rem;

   }
   .DevToolsfTab.active + DevToolsfooter {
     -webkit-box-shadow: 0px 0px 16px rgba(0,0,0,.2);
               -moz-box-shadow: 0px 0px 16px rgba(0,0,0,.2);
                          box-shadow: 0px 0px 16px rgba(0,0,0,.2);
   max-height: 95px;
   padding: 1.0rem;
   padding-left: 1px;
   padding-top:3px;
   position: fixed;

   display:inline-block;
   -webkit-transition: max-height 0.2s;
   transition: max-height 0.2s;
   }
   .DevTabreports{
   padding-top:6px; padding-left:2px;
   }
   }
</style>
<span class="DevToolsfTab"><img src="<?= Base(); ?>/<?=COREDIRNAME;?>/Ecosystem/Resources/System/images/devIcon.png" style="width: 24px; height: 24px;" title="Open Developer Tools"></span>
<DevToolsfooter id="DevToolsfooter">

</DevToolsfooter>

<script type="text/javascript">
if(typeof jQuery == 'undefined'){
        document.write('<script type="text/javascript" src="<?= Base(); ?>/<?=COREDIRNAME;?>/Ecosystem/Resources/System/js/jquery-1.7.1.min.js"></'+'script>');
  }
</script>


<script>
   jQuery(function($){
       $('.DevToolsfTab').on('click', function(){
           $(this).toggleClass('active');
       });
   })
</script>
