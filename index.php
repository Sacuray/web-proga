<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Лабораторная работа по веб-программированию №1</title>
    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    ?>
    <style>
        img {
            max-width:100%;
            height:auto;
        }
        .notChoosedButton{
            background-color: white;
            border-style: dashed;
            border-color: black;

        }

        .choosedButton{
            background-color: gold;
            border-style: solid;
            border-color: brown;
        }
        body {
            background: silver;
            font-family: Consolas, "Courier New", monospace;
            font-size: 16px;
        }

        header, footer, .black-box {
            width: 75%;
            margin: 64px auto;
            padding: 64px;
            background: darkgreen;
            color: white;
        }

        header {
            font-family: Palatino, serif;
            font-size: 18px;
            color: #cde;
        }


        h1 {
            text-align: center;
            font-size: 24px;
        }

        h2 {
            font-size: 22px;
        }

        .centered {
            text-align: center;
        }


        .screen {
            mix-blend-mode: screen;
        }

        .necessary::before {
            font-size: larger;
            font-weight: bold;
            color: red;
            content: "*";
        }

        input {
            margin-bottom: 24px;
            font-size: inherit;
            font-family: inherit;
        }

        input[type="text"], input[type="password"] {
            padding: 4px;
            background: rgba(0, 0, 0, 0.5);
            border: 2px solid white;
            color: inherit;
            min-width: 256px;
        }

        input[type="submit"], input[type="reset"], button {
            margin: 16px 0 16px 0;
            padding: 16px;
            background: darkgoldenrod;
            font-weight: bold;
            border: 2px solid brown;
            color: inherit;
            text-align: center;
            transition-duration: 0.5s;
            transition-timing-function: linear;
            cursor: pointer;
        }


        #areas {
            transition-duration: 0.5s;
            transition-timing-function: ease-in-out;
            cursor: crosshair;
        }

        #areas:hover {
            opacity: 0.8;
        }

        table {
            margin-top: 8px;
        }

        table, th, td {
            border-collapse: collapse;
            border: 2px solid white;
            padding: 16px;
        }

        #previous-results, #previous-results th, #previous-results td {
            background: #eee;
            border: 2px solid black;
            color: black;
            font-style: italic;
        }

        #previous-results th {
            text-align: center;
            background: #aaa;
            font-style: normal;
        }

        #previous-results tr:nth-child(2n) td {
            background: #ccc;
        }


    </style>
    <script type="text/javascript">
        function validateInputs() {
            let y = document.forms["dotForm"]["y"].value;
            if (typeof +y !== 'number' || !isFinite(+y)) {
                alert("Ошибка: Значение Y должно быть числом.");
                return false;
            }
            else if (y <= -3 || y >= 3) {
                alert("Ошибка: Значение Y должно входить в интервал (-3; 3) (не включая граничные значения).");
                return false;
            }
        }
    </script>
</head>
<body>
<header>
    <h1>Лабораторная работа №1
        <br>по дисциплине &laquo;Веб-программирование&raquo;
    </h1>
    <h2>Выполнил</h2>
    <p>
        <b><i>студент</i></b> Орехов Сергей Владимирович <i>#311721</i><br>
        группа P32102<br>
        вариант № 9900
    </p>
    <h2>Принял</h2>
    <p><b>преподаватель</b> Письмак Алексей Евгеньевич
    </p>
</header>
<div class="black-box">
    <h2>Форма для ввода данных</h2>
    <p>Скрипт проверяет, попадает ли точка на координатной плоскости в заданную область, изображённую на рисунке ниже.</p>
    <img src="chart.png" id="areas" class="screen" width="33%">
    <form name="calculate" action="#" method="POST" onsubmit="return validate_form()">
        <p>Выберите значение R</p>
        <select name="R" required="required">
            <option value="">Выберите вариант</option>
            <option>1</option>
            <option>1.5</option>
            <option>2</option>
            <option>2.5</option>
            <option>3</option>
        </select>
        <p>Введите значение Y</p>
        <input name="Y" type="text" required ="required">
        <p>Введите значение X</p>
        <input id = "X" name="X" type="hidden" required = "required">
        <div id="input X">
            <input class="notChoosedButton" id = '-4' type="button" value="-4" onclick="choose_x(-4)">
            <input class="notChoosedButton" id = '-3' type="button" value="-3" onclick="choose_x(-3)">
            <input class="notChoosedButton" id = '-2' type="button" value="-2" onclick="choose_x(-2)">
            <input class="notChoosedButton" id = '-1' type="button" value="-1" onclick="choose_x(-1)">
            <input class="notChoosedButton" id = '0' type="button" value="0" onclick="choose_x(0)">
            <input class="notChoosedButton" id = '1' type="button" value="1" onclick="choose_x(1)">
            <input class="notChoosedButton" id = '2' type="button" value="2" onclick="choose_x(2)">
            <input class="notChoosedButton" id = '3' type="button" value="3" onclick="choose_x(3)">
            <input class="notChoosedButton" id = '4' type="button" value="4" onclick="choose_x(4)">
        </div>
        <script type = "text/javascript">
            let old_id = 0;
            let xIsChoosed = false;
            function choose_x(val) {
                document.getElementById(old_id).className = 'notChoosedButton';
                document.getElementById(val).className = 'choosedButton';
                document.getElementById("X").value = val;
                old_id = val;
                xIsChoosed = true;
            }
            function validate_form(){
                let valid = true;

                if((document.calculate.Y.value > 3 || document.calculate.Y.value < -3)){
                    alert("Введите значение Y от -3 до 3.");
                    valid = false;

                }
                if(isNaN(document.calculate.Y.value)){
                    alert("Введите значение Y от -3 до 3.");
                    valid = false;
                }
                if(!xIsChoosed){
                    alert("Выберете значение X.");
                }
                return valid;
            }

        </script>
        <input type="submit" value="Рассчитать попадание">
        <input type="reset" value="Очистить форму">
    </form>
</div>
<div class='black-box' id='answers-box'><h2>Ответ</h2>
    <?php
    date_default_timezone_set('Europe/Moscow');
    function isDotInsideOrOnEdgeOfArea($x, $y, $r){
        $res = false;
        if ($x >= 0.0){
            if($y >= 0.0 and ($x*$x + $y*$y) <= ($r*$r)/4.0){
                $res = true;
            }
            if($y <= 0.0 and $x <= $r and $y >= -$r){
                $res =true;
            }
        }
        else{
            if($y <= 0.0 and $x + $y >= -$r/2.0){
                $res = true;
            }
        }
        return $res;
    }

    function validateQuery($x, $y, $r){
        if (!is_numeric($x) || !is_numeric($y) || !is_numeric($r)) {
            return false;
        }
        if ($y > 3 || $y < -3) {
            return false;
        }
        if($x > 4  || $x < -4 || !is_int($x)){return false;}
        if($r > 3 || $r < -3 || !is_int($r * 2)){return false;}
        return true;
    }

    $t_start = microtime(true);

    if (isset($_POST["X"]) && isset($_POST["Y"]) && isset($_POST["R"])) {
        $r = $_POST["R"];
        $y = $_POST["Y"];
        $x = $_POST["X"];
        if(validateQuery($x, $y, $r)) echo "Полученные данные некорректны";
        else{
            if(isDotInsideOrOnEdgeOfArea($x, $y, $r)) echo "Точка находится <u>внутри</u> или <u>на границе</u> области.";
            else echo "Точка находится <u>за пределами</u> заданной области.";
            $file = fopen("database.csv", "a+");
            if(filesize("database.csv") == 0) {
                fwrite($file, "date_time,x,y,r,dot_position\n");
            }
            fwrite(
                $file,
                date_format(date_create(), "d.m.Y г.; H:i")
                .",".$x
                .",".strval(floatval($y))
                .",".$r
                .",".var_export(isDotInsideOrOnEdgeOfArea($x, $y, $r), true)."\n"
            );
            fclose($file);

            $t_end = microtime(true);
        }

    }

    else echo "<p>Результат вычислений будет отображён <u>в этом блоке</u>.<br></p>
				<p>Введите данные и нажмите кнопку &laquo;Отправить&raquo;, чтобы получить ответ.</p>";

    $file = fopen("database.csv", "a+");
    if(filesize("database.csv")) {
        echo "<table id='previous-results'>
					<tr>
						<th>Время запроса</th>
						<th>Координата <i>X</i></th>
						<th>Координата <i>Y</i></th>
						<th>Радиус <i>R</i></th>
						<th>Положение точки относительно области</th>
					</tr>";
        fgets($file);
        while(true) {
            $str = fgets($file);
            if ($str === false) break;
            $arr = explode(',', $str);
            echo "<tr>";
            for($i=0; $i<4; $i++) {
                echo "<td>".$arr[$i]."</td>";
            }
            echo "<td>".(stripos($arr[4], "true") !== false ?"Внутри или на границе области":"Снаружи области")."</td>";
            echo "</tr>";
        }
        fclose($file);
        echo "</table>";
    }

    $t_end = microtime(true);
    echo "<p>Продолжительность исполнения: примерно ".number_format($t_end - $t_start, 6,'.',' ')." с.</p>";
    echo "<p>Время на момент окончания обработки: ".date_format(date_create(), "d.m.Y г.; H:i").".</p>";
    ?>
</div>
<footer class="centered">
    <img src="https://itmo.ru/file/pages/213/logo_osnovnoy_russkiy_belyy.png" title="|/iTMO" width="20%">
    <p>Санкт-Петербург, 2022</p>
</footer>
</body>
</html>