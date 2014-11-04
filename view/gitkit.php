<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script type="text/javascript" src="//www.gstatic.com/authtoolkit/js/gitkit.js"></script>
		<link type="text/css" rel="stylesheet" href="//www.gstatic.com/authtoolkit/css/gitkit.css" />
		<script type="text/javascript">
			var config = {
				apiKey: 'AIzaSyCUtzG_YgouzzehAtmtW7jm4Ftedgvi2-I',
				signInSuccessUrl: '/webshop/src/',
				idps: ["google"],
				oobActionUrl: '/',
				siteName: 'Code shop'
			};
			// The HTTP POST body should be escaped by the server to prevent XSS
			window.google.identitytoolkit.start(
				'#gitkitWidgetDiv', // accepts any CSS selector
				config,
				'JAVASCRIPT_ESCAPED_POST_BODY');
		</script>
	</head>
	<body>
		<!-- Placeholder for the sign in page -->
		<div id="gitkitWidgetDiv"></div>
	</body>
</html>
