<?php

$dsn = "mysql:host=localhost;charset=utf8;dbname=school";
$pdo = new PDO($dsn, 'root', '');


function all($table, $where)
{
    global $pdo;
    $sql = "SELECT * FROM `{$table}` {$where}";
    $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    return $rows;
}
function find($table, $arg)
{
    global $pdo;
    $sql = "SELECT * FROM `{$table}` WHERE ";

    if (is_array($arg)) {
        foreach ($arg as $key => $value) {
            $tmp[] = "`$key`='{$value}'";
        }


        // $sql = "SELECT * FROM `{$table}` WHERE " . join(" && ", $tmp);
        $sql .= join(" && ", $tmp);
    } else {
        // $sql = "SELECT * FROM `{$table}` WHERE `id`='{$arg}'";
        $sql .= "`id`='{$arg}'";
    }

    //echo $sql;

    $row = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);

    return $row;
}

function save($table, $array)
{
    //宣告全域變數
    global $pdo;
    // 判斷有無`id`有的話是 UPDATE 沒有的話是 INSERT
    if (isset($array['id'])) {
        //update
        // update($table, $array, $array['id']);
        //建立SQL語法
        $sql = "UPDATE `{$table}` SET ";

        //使用迴圈將欄位名稱和值組合成字串
        $tmp = array2sql($array);
        $sql .= join(",", $tmp);
        
        $sql .= " WHERE `id`='{$array}'";
        
        echo $sql;
        return $pdo->exec($sql);
    } else {
        //insert
        $sql = "INSERT INTO `{$table}` ";

    $sql .= "(`" . join("`,`", array_keys($array)) . "`)";

    $sql .= " VALUES('" . join("','", $array) . "')";

    //echo $sql;

    return $pdo->exec($sql);
    }
}

function update($table, $cols, $arg)
{
    global $pdo;
    $sql = "UPDATE `{$table}` SET ";

    foreach ($cols as $key => $value) {
        $tmp[] = "`$key`='{$value}'";
    }
    $sql .= join(",", $tmp);

    if (is_array($arg)) {
        foreach ($arg as $key => $value) {
            $tmpp[] = "`$key`='{$value}'";
        }

        $sql .= "WHERE " . join(" && ", $tmpp);
    } else {
        $sql .= "WHERE `id`='{$arg}'";
    }

    return $pdo->exec($sql);
}

function insert($table, $cols)
{
    global $pdo;

    $sql = "INSERT INTO `{$table}` ";

    $sql .= "(`" . join("`,`", array_keys($cols)) . "`)";

    $sql .= " VALUES('" . join("','", $cols) . "')";

    //echo $sql;

    return $pdo->exec($sql);
}

function del($table, $arg)
{
    global $pdo;
    $sql = "DELETE FROM `{$table}` WHERE ";

    if (is_array($arg)) {
        foreach ($arg as $key => $value) {
            $tmp[] = "`$key`='{$value}'";
        }

        $sql .= join(" && ", $tmp);
    } else {
        $sql .= " `id`='{$arg}'";
    }

    return $pdo->exec($sql);
}

// foreach 精簡function
function array2sql($array)
{
    foreach ($array as $key => $value) {
        $tmp[] = "`$key`='$value'";
    }

    return $tmp;
}

// 萬用function
function q($sql)
{
    global $pdo;
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * 在頁面上快速顯示陣列內容
 * direct dump
 * @param $array 輸入的參數需為陣列
 */
function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
