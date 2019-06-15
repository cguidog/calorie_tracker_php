<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>look-for-this-string</p>
    <p>test</p>
    <?php

?>
    <?php 

function certificate_shortcode($type) {
    extract(shortcode_atts(array(
        'type' => 'type'
    ), $type));
    
    switch ($type) {
        case 'matrimonio':
            return '<span>Certificado de Matrimonio (Valido solo por 6 meses)</span>';
            break;
        case 'nacimiento':
            return '<span>Certificado de Nacimiento (Valido solo por 6 meses)</span>';
            break;
		case 'marriage':
            return '<span>Marriage Certificate (Valid only for 6 months)</span>';
            break;
        case 'birth':
            return '<span>Birth Certificate (Valid only for 6 months)</span>';
            break;
    }
}

add_shortcode('certificate', 'certificate_shortcode');

?>

</body>
</html>