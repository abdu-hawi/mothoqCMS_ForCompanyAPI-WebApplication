<html>
    <head>
        <title>Testing QR code</title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script type="text/javascript">
					$(document).ready(function() {
            var nric = $('#text').val();
                var url = 'https://api.qrserver.com/v1/create-qr-code/?data=' + nric + '&amp;size=50x50';
                $('#barcode').attr('src', url);
					});
        </script>
    </head>
    <body>
        <input id="ttp://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" type="text" hidden
            value="blue" style="Width:20%"
         /> 

      <img id='barcode'
            src="https://api.qrserver.com/v1/create-qr-code/?data=HelloWorld&amp;size=100x100" 
            alt="" 
            title="HELLO" 
            width="50" 
            height="50" />
    </body>
</html>