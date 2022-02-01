<!DOCTYPE html>
<html lang="pt-BR" itemscope itemtype="http://schema.org/WebPage">
	<head>  	
	    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
	    <meta charset="UTF-8"> 
	    <title>@yield('title', 'Pague Fácil')</title>
	    <meta name="apple-mobile-web-app-capable" content="yes">
	    <meta name="viewport" content="width=device-width,initial-scale=1">
	    <meta name="robots"   content="index,follow,noodp"/>
	    <meta name="language" content="portuguese"/>	    
	    <meta name="csrf-token" content="{!!csrf_token()!!}"/>  
	    <meta name="base-url" content="{!!url('/')!!}"/>
	    @yield('style')
	    <link rel="shortcut icon" href="{!!secure_asset("img/favicon.png")!!}" type="image/png">   
	</head>
	<body @class($bodyClass)>
		@yield('content')
		@yield('script')
	</body>
</html>