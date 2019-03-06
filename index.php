<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Scrape Comuniazo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.comuniazo.com/css/css.css?1551715058" type="text/css" media="screen">
</head>

<body>
    <?php 
        $money_20 = false;
        $money_40 = false;
        $money_9 = false;
        $user = '';
        
        if (isset($_GET['money'])) {
            if ($_GET['money'] == '20000000') {
                $money_20 = true;
            } elseif ($_GET['money'] == '40000000') {
                $money_40 = true;
            } elseif ($_GET['money'] == '9000000') {
                $money_9 = true;
            }
        }
        if (isset($_GET['user'])) {
            $user = $_GET['user'];
        }

    ?>

    <div class="content content-balance">
        <div class="wrapper">
            <img src="https://cdn.comuniazo.com/img/logo_new.png" style="margin: auto;margin-bottom: 20px;">

            <div class="text">
                <h1>¡Calcula el dinero de tus rivales en Comunio y obtén ventaja!</h1>
                <p>Podrás ver su saldo y puja máxima con solo introducir tu usuario de Comunio y el dinero inicial de tu
                    comunidad. Además, también podrás comprobar los jugadores libres y el mercado actual.</p>
            </div>
            <form id="form-balance" method="GET" class="form-balance">
                <input id="ajax-user" type="text" name="user" class="btn input" maxlength="10" placeholder="Usuario de Comunio" autocorrect="off" autocapitalize="off" spellcheck="false"  <?php if($user){ echo 'value="'.$user.'"'; } ?>>
                <div class="segment">
                    <input type="radio" name="money" value="20000000" id="seg-20m" <?php if($money_20){ echo 'checked=""'; } ?>>
                    <label class="btn" for="seg-20m">20M</label>

                    <input type="radio" name="money" value="40000000" id="seg-40m" <?php if($money_40){ echo 'checked=""'; } ?>>
                    <label class="btn" for="seg-40m">40M</label>

                    <input type="radio" name="money" value="9000000" id="seg-9m" <?php if($money_9){ echo 'checked=""'; } ?>>
                    <label class="btn" for="seg-9m">9M</label>
                </div>
                <button class="btn btn-green" type="submit" id="ajax-send" data-url="balance">Calcular</button>
            </form>


            <?php
                if (isset($_GET['money']) && isset($_GET['user'])){
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'https://www.comuniazo.com/ajax/balance?user='.$_GET['user'].'&money='.$_GET['money']);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-Requested-With: XMLHttpRequest"));
                    curl_setopt($ch, CURLOPT_HEADER, 0);

                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
                    curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd() . '/cookie.txt'); 
                    curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd() . '/cookie.txt'); 
                    $page = curl_exec($ch); 
                    curl_close($ch);

                    echo '<code>';
                    echo $page;
                    echo '</code>';
                }
            ?> 
        </div>
    </div>
</body>

</html>
