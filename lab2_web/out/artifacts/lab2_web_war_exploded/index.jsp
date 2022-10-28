<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<%@ page import="java.util.ArrayList" %>
<%@ page import="com.Bean" %>
<jsp:useBean id="results" class="com.Bean" scope="session"/>

<!DOCTYPE html>
<html lang="ru" xmlns:f="http://java.sun.com/jsp/core" xmlns:h="http://java.sun.com/jsp/html">
<head>
    <meta charset="UTF-8">
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
        .draw{
            position: relative;
        }



    </style>

</head>
<body onload="loaded()">
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
    <div class="draw">
        <img height="100%" width="50%" src="areas.svg" style="top: 0; position: absolute" id="draw"/>
        <img height="100%" width="50%" src="chart.svg" style="position: absolute"/>
        <svg style="width: 50%; text-align: center; position: relative; left: 0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" id="chart">

            <%
                ArrayList<Object[]> data = results.getSessionData();
                for (Object[] el: data) {%>

            <circle cx="<%=el[4]%>%" cy="<%=el[5]%>%" r="1%" fill="yellow"></circle>
            <%}%>


        </svg>
        <input id="chart_x" hidden type = "text" value="0">
        <input id="chart_y" hidden type = "text" value="0">
    </div>
    <h2>Форма для ввода данных</h2>
    <p>Скрипт проверяет, попадает ли точка на координатной плоскости в заданную область, изображённую на рисунке ниже.</p>
    <form name="calculate" action="index" method="POST" onsubmit="return validate_form()">
        <p>Выберите значение R</p>
        <select name="R" required="required">
            <option value="">Выберите вариант</option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
        </select>
        <p>Введите значение Y</p>
        <input id="Y" name="Y" type="text" required ="required">
        <p>Введите значение X</p>
        <input id = "X" name="X" type="hidden" required = "required">
        <div id="input X">
            <input class="notChoosedButton" id = '-3' type="button" value="-3" onclick="choose_x(-3)">
            <input class="notChoosedButton" id = '-2' type="button" value="-2" onclick="choose_x(-2)">
            <input class="notChoosedButton" id = '-1' type="button" value="-1" onclick="choose_x(-1)">
            <input class="notChoosedButton" id = '0' type="button" value="0" onclick="choose_x(0)">
            <input class="notChoosedButton" id = '1' type="button" value="1" onclick="choose_x(1)">
            <input class="notChoosedButton" id = '2' type="button" value="2" onclick="choose_x(2)">
            <input class="notChoosedButton" id = '3' type="button" value="3" onclick="choose_x(3)">
            <input class="notChoosedButton" id = '4' type="button" value="4" onclick="choose_x(4)">
            <input class="notChoosedButton" id = '5' type="button" value="5" onclick="choose_x(5)">
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

                if((document.getElementById("Y").value > 5.0 || document.getElementById("Y").value < -3.0)){
                    console.log(document.getElementById("Y").value)
                    alert("Введите значение Y от -3 до 5.");
                    valid = false;

                }
                if(isNaN(document.getElementById("Y").value)){
                    alert("Введите значение Y от -3 до 5!");
                    valid = false;
                }
                if(!xIsChoosed){
                    alert("Выберете значение X.");
                    valid = false;
                }
                return valid;
            }
            function loaded()
            {
                document.getElementById('chart').addEventListener("click", point_clicked, false);
            }

            function point_clicked(e)
            {
                var element = document.getElementById('chart');
                var click_x = e.clientX, click_y = e.clientY;
                var pos = element.getBoundingClientRect();
                var screen_x = pos.x, screen_y = pos.y;
                console.log(pos.width)
                var scale = (element.getBoundingClientRect().width / 100);
                var x = ((click_x - screen_x) / scale - 50) / 8;
                var y = -((click_y - screen_y) / scale - 50) / 8;
                console.log(click_x, click_y);
                console.log(screen_x, screen_y);
                console.log(x, y);
                document.getElementById('X').value = x;
                document.getElementById("Y").value = y;
                console.log(document.getElementById("Y").value);
                xIsChoosed = true;
                document.getElementById('submit').click();

            }

        </script>
        <input id = 'submit' type="submit" value="Рассчитать попадание">
        <input type="reset" value="Очистить форму">
    </form>
</div>

<footer class="centered">
    <img src="https://itmo.ru/file/pages/213/logo_osnovnoy_russkiy_belyy.png" title="|/iTMO" width="20%">
    <p>Санкт-Петербург, 2022</p>
</footer>
</body>
</html>