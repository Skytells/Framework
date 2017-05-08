<!DOCTYPE html>
<!-- {#CACHE:FLUSH!} || {#CACHE:EXCLUDE!}
	* You can use these tags to disable this page from caching.
	* Remove (#) from {#CACHE:FLUSH!} to flush cached files if this page requires cache to be cleared.
	* Remove (#) from {#CACHE:EXCLUDE!} to EXCLUDE this page from caching.
	* To remove cached files please pass this parameter to any page ( GET: ?Action=FlushCache )
	-->
<html>
<head>
	<link rel="icon" href="<?= SITEBASE; ?>/favicon.png">
	<meta charset="utf-8">
			 <meta http-equiv="X-UA-Compatible" content="IE=edge">
			 <meta name="viewport" content="width=device-width, initial-scale=1">
			 <title><?=l('PAGE_TITLE');?></title>
			 <!-- Fonts -->
			 <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
			 <!-- Styles -->
			 <style>
					 html, body {
							 background-color: #fff;
							 color: #636b6f;
							 font-family: 'Raleway', sans-serif;
							 font-weight: 100;
							 height: 100vh;
							 margin: 0;
					 }
					 .full-height {
							 height: 100vh;
					 }
					 .flex-center {
							 align-items: center;
							 display: flex;
							 justify-content: center;
					 }
					 .position-ref {
							 position: relative;
					 }
					 .top-right {
							 position: absolute;
							 right: 10px;
							 top: 18px;
					 }
					 .content {
							 text-align: center;
					 }
					 .title {
							 font-size: 84px;
					 }
					 .subtitle {
							 font-size: 40px;
					 }
					 .links > a {
							 color: #636b6f;
							 padding: 0 25px;
							 font-size: 12px;
							 font-weight: 600;
							 letter-spacing: .1rem;
							 text-decoration: none;
							 text-transform: uppercase;
					 }
					 .m-b-md {
							 margin-bottom: 30px;
					 }
			 </style>
</head>

	<body>
        <div class="flex-center position-ref full-height">

                <div class="top-right links">

                        <a href="<?= SITEBASE; ?>">Home</a>

                        <a href="https://developers.skytells.net/framework">Documentation</a>


                </div>


            <div class="content">
                <div class="title m-b-md">
                    Welcome to Skytells!
                </div>
								<div class="subtitle m-b-md" id="welcomeText">
									Bringing Data to Life!
								</div>

                <div class="links">
                    <a href="https://developers.skytells.net/framework">Documentation</a>
                    <a href="https://developers.skytells.net/framework/overview">Overview</a>
                    <a href="https://developers.skytells.net/framework/Packages">Packages</a>
                    <a href="https://developers.skytells.net/framework/License">License</a>
                    <a href="https://github.com/Skytells/Framework">GitHub</a>
                </div>

								<br>
								<small>© 2017 Dr. Hazem Ali, All rights reserved.</small>
            </div>

        </div>
				<script>
				var text = ["Hello", "Hola!", "Bonjour!",
										"Bienvenue!", "Skytells'da Hoşgeldiniz", "Benvenuto en Skytells!", "Skytells へようこそ！", "مرحبآ", "Ласкаво просимо!", "何かダイナミックなものを作ろう！",
										"Let's Build Somthing Amazing!", "Bringing Data to Life!", "Skytells is Free", "Skytells is Dynamic", "Skytells is Powerful", "Let's Build Somthing Amazing!"];
				var counter = 0;
				var elem = document.getElementById("welcomeText");
			    var s = setInterval(change, 1800);
			    function change() {
			     elem.innerHTML = text[counter];
			        counter++;
			        if(counter >= text.length) { counter = 0; clearInterval(s); }
			    }
				</script>
    </body>

</html>
