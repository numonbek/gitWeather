<?php
$status="";
$msg="";
$city="";
if(isset($_POST['submit'])){
    $city=$_POST['city'];
    $url="http://api.openweathermap.org/data/2.5/weather?q=$city&appid=09ec1830fd2e235b56f6d62bf163aca5&lang=ru";
    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    $result=curl_exec($ch);
    curl_close($ch);
    $result=json_decode($result,true);
    if($result['cod']==200){
        $status="yes";
    }else{
        $msg=$result['message'];
    }
}
?>
    
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=PT+Sans&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
        <title>Document</title>
    </head>

    <body>
        <div class="container">
            <div class="container2">
            <?php if($status=="yes"){?>
                <div class="block1">
                    <div class="country"><?php echo $result['name']?></div>
                    <div class="cilcy">
                        <a href="#"  class="cilcy_c" alt="cilcy">C</a>
                        <a href="#" class="cilcy_f" target="_parent" alt="F">F</a>
                    </div>

                </div>
                <!-- block1 -->

                <div class="block2">
                    <a href="index.php" target="_parent" class="change__country">Сменить город</a>
                    <img src="img/loacation.svg" class="location_img" alt="loacation">
                    <a href="#" class="my__loacation"> Мое местоположение</a>
                </div>
                <!-- block2 -->

                <div class="block3">

                 <div class="sun__item" alt="weather fill">  
                    <img src="http://openweathermap.org/img/wn/<?php echo $result['weather'][0]['icon']?>@4x.png" class="sun" alt="sun">
                 </div>
                
                    <div class="temperature">
                        <span><?php echo round($result['main']['temp']-273.15)?>°</span>
                    </div>

                </div>
                <div class="info_weather">
                <?php echo $result['weather'][0]['main']?>
                </div>
                <!-- block3 -->
                <div class="full_info">
                    <div class="veter">
                        <div class="veter__text">Ветер</div>
                        <div class="veter__inner"><?php echo $result['wind']['speed']?> м/c,</div>
                    </div>
                    <div class="davleniya">
                        <div class="davleniya__text">Давление</div>
                        <div class="davleniya__inner"><?php echo $result['main']['pressure']?> мм рт. ст.</div>
                    </div>
                    <div class="vlajnost">
                        <div class="vlajnost__text">Влажность</div>
                        <div class="vlajnost__inner"><?php echo $result['main']['humidity']?>%</div>
                    </div>
                    <div class="dojd">
                        <div class="dojd__text">Вероятность дождя</div>
                        <div class="dojd__inner"><?php echo $result['rain']?>%</div>
                    </div>
                </div>

            </div> <?php } ?>
        </div>



    </body>

    </html>