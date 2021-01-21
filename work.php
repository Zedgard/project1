<?php
/*
 * Тестовое задание 
 */

$main_string = 'Online scammers have used crises and major events to con people for years. 
    The pandemic has created an appealing situation because the entire world is aware of the disease and the hardship its caused in everyones lives. 
    On top of that, the virus has pushed many work from from home offices, where they still have access to sensitive workplace information. 
    From a criminal perspective, it a great opportunity to get lots of people to act against their better judgment. 
    Scammers seized on this opportunity as soon as the pandemic took hold, offering snake oil cures that never materialized in exchange for credit card numbers. 
    They also tried to trick people into clicking on malicious links that put users at risk of ransomware attacks or identity theft.

Now vaccines give scammers another lure for their targets.

"These attacks prey on our desire for information in times of uncertainty," said Tony Pepper, CEO of cybersecurity firm Egress. 
The attacks, Egress says, can be "incredibly convincing," particularly to older people, who are at the top of lists for 
getting vaccines and may be waiting to hear from medical authorities.  

Setting up a scam
As early as November, researchers at cybersecurity firm Check Point noticed a significant increase in website domain names that reference vaccines. 
Scammers typically register a new domain name related to their con when setting up a phishing campaign to serve as a place to lure their targets.

The websites may contain legitimate-looking web forms meant to steal payment or health care information, or they might host malicious software that 
installs on your device when you visit. Malicious software, or malware, can leave you vulnerable to ransomware attacks, pop-up ads that make 
your device unusable and other intrusive attacks from hackers.';

/**
 * Возвращает массив из 5 наиболее часто встречающихся слов в этом тексте
 * @param type $string
 * @return type array
 */
function search_repeat_5words($string) {
    $words = explode(' ', mb_strtolower($string));
    $pattern = '[^\w0-9 ]';
    $find = array();
    $data_array = array();
    foreach ($words as $value) {
        $w = trim(mb_ereg_replace($pattern, '', $value));
        if (strlen($w) > 0) {
            $f = false;
            foreach ($find as $key => $value) {
                if ($key == $w) {
                    $f = true;
                }
            }
            if ($f) {
                $n = $data_array[$w] + 1;
                $data_array[$w] = $n;
            } else {
                $data_array[$w] = 1;
            }
            $find[] = $w;
        }
    }
    //print_r($data_array);
    arsort($data_array);
    return array_slice($data_array, 0, 5);
    //return arsort($data_array);
}
?>
<!doctype html>
<html>
    <head>
        <title>Задание</title>
        <meta charset='utf-8' />
    </head>
    <body>
        <div style="margin-bottom: 2vh;">
            <?
            $arr = search_repeat_5words($main_string);
            print_r($arr);
            ?>
        </div>
        <canvas height='500' width='500' id='canElm_1'>Обновите браузер</canvas>
        <input type="button" id="btnStart" value="start" />
        <script>
            var btn_start = document.getElementById("btnStart");
            var can_elm = document.getElementById("canElm_1");
            var ctx = can_elm.getContext('2d');
            // body size
            var mw = can_elm.width;
            var mh = can_elm.height;
            // center
            var cw = mw / 2;
            var ch = mh / 2;

            var TO_RADIANS = Math.PI / 180;
            //ctx.font = '18px serif';

            //ctx.fillText('w: ' + cw, 10, 50);

            console.log(cw);
            var o = '';

            function drawBox(w, h, pw, ph) {
                ctx.beginPath();
                ctx.fillStyle = 'rgb(200, 0, 0)';

                var cw = w / 2;
                var ch = h / 2;
                //ctx.translate(w + cw, р + ch);
                ctx.fillRect((pw - cw), (ph - ch), w, h);

            }
            drawBox(200, 100, cw, ch);
            
           
            

            function drawRotatedRect(x, y, width, height, degrees) {

                // first save the untranslated/unrotated context
                //ctx.save();

                ctx.beginPath();
                // move the rotation point to the center of the rect
                ctx.translate(x + width / 2, y + height / 2);
                // rotate the rect
                ctx.rotate(degrees * Math.PI / 90);

                // draw the rect on the transformed context
                // Note: after transforming [0,0] is visually [x,y]
                //       so the rect needs to be offset accordingly when drawn
                ctx.fillRect(-width / 2, -height / 2, width, height);

                ctx.fillStyle = "gold";
                ctx.fill();

                // restore the context to its untranslated/unrotated state
                ctx.restore();
               

            }

            var r = 5;
            btn_start.onclick = function () {
                console.log('rotate');
                r = r + 10;
                drawRotatedRect(10,10,100,20,r);
                //ctx.stroke();
               // ctx.fill();
               // ctx.stroke();
               ctx.restore();
            };
        </script>
    </body>
</html>