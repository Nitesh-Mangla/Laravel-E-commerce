<!DOCTYPE html>
<html>
<head>
	<title>Payment</title>
</head>
<body>
	<form action="{{ url('/paytmResponse') }}" method="post">
		@csrf
		<input type="text" name="price" value="">
		<input type="submit" name="submit" value="pay">
	</form>
</body>
</html>