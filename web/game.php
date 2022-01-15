<?php
/**
 * Создание html кода ячейки поля (кнопки submit)
 * @param mixed $cell значение ячейки
 * @param int $index номер ячейки 
 * @return string
 */
function renderCell($cell, $index) {
    if($cell) { //если ячейка заполнена создаем скрытое hidden поле с его значением и неработающую кнопку с выбранным значением
        $value = $cell == 1 ? 'X' : '0';
        return "<input type='hidden' value='$cell' name='cells[$index]'>\n<input type='submit' value='$value' name='fake' disabled>\n";
    }
    return "<input type='submit' value='&nbsp;' name='choose[$index]'>\n"; //выводим submit для выбора
}

/**
 * Функция проверки линии в ячейках, что она заполнена
 * @param array $cells ячейки
 * @param int $i1 индекс 1й ячейки
 * @param int $i2 индекс 2й ячейки
 * @param int $i3 индекс 3й ячейки
 * @return bool
 */
function checkLine($cells, $i1, $i2, $i3) {
    return $cells[$i1] > 0 && $cells[$i1] == $cells[$i2] && $cells[$i2] == $cells[$i3];    
}
/**
 * Функция проверки победы
 * @param array $cells ячейки
 * @return bool
 */
function checkWin($cells) {
    return checkLine($cells, 1, 2, 3) //горизонтальная линия №1
        || checkLine($cells, 4, 5, 6) //горизонтальная линия №2
        || checkLine($cells, 7, 8, 9) //горизонтальная линия №3
        || checkLine($cells, 1, 4, 7) //вертикальная линия №1
        || checkLine($cells, 2, 5, 8) //вертикальная линия №2
        || checkLine($cells, 3, 6, 9) //вертикальная линия №3
        || checkLine($cells, 1, 5, 9) //диагональ №1
        || checkLine($cells, 3, 5, 7); //диагональ №2
}
/**
 * Функция проверки клеток на ничью
 * @param array $cells
 * @return bool
 */
function isDraw($cells) {
    return count(array_filter($cells)) == 9; //выясняем, что все клетки заполнены
}

$player = isset($_GET['player']) ? $_GET['player'] : 1; //загружаем какой игрок ходит или выбираем первого по-умолчанию

$cells = array_fill(1, 9, null); //заполняем массив ячеек игры 9 null-ами
if(isset($_GET['cells'])) { //принимаем с формы состояние всех ячеек
    foreach($_GET['cells'] as $index => $value) {  //обходим массив с формы
        $cells[$index] = $value; //сохраняем значения в ячейки
    }    
}

$win = null; //признак выигрыша игрока
$isDraw = false; //признак ничьи
//выбор игрока, если он был
if(isset($_GET['choose'])) {
    $choose = array_key_first($_GET['choose']); //извлекаем выбранный индекс ячейки
    $cells[$choose] = $player;
    if(checkWin($cells)) {
        $win = $player; //запоминаем какой игрок выиграл
    } elseif(isDraw($cells)) { //проверка на ничью
        $isDraw = true;
    }
    $player = $player == 1 ? 2 : 1; //передаем ход другому игроку
}

//дальше идет HTML код страницы:
?>
<!DOCTYPE html>
<html>
    <title>Игра "Крестики-нолики"</title>
    <!-- немного стилизации формы по центру и размера input!-->
    <style>
        form {
            width: 200px;
            margin: 10px auto;
            border: 1px solid #000;            
        }
        input {
            display: inline-block;
            width: 40px;
            height: 40px;
            margin: 10px;           
        }
        div {
            text-align: center;
        }

    </style>
    <body>
        <!-- форма с полем игры !-->
        <form>
            <!-- либо вывод победителя, либо вывод 9 ячеек в цикле !-->
            <?php
                if($win) {                    
                    echo "<div>Выиграл игрок №$win!</div>";
                } elseif($isDraw) {
                    echo "<div>Ничья!</div>";
                } else {
                    echo "<div>Ход игрока № $player:</div>\n <input type='hidden' name='player' value='$player'>"; //выводим показатель какой игрок ходит и скрытое поле с его номером
                    foreach($cells as $index => $cell) {
                        echo renderCell($cell, $index);
                    }
                }
            ?>
            <!-- ссылка на перезапуск игры !-->
            <div>
                <a href="game.php">Перезапуcтить игру</a>
            </div>
        </form>
    </body>
</html>