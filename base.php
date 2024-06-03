<?php

class DB
{
    protected $dsn = "mysql:host=localhost;charset=utf8;dbname=school";
    protected $pdo;
    protected $table;

    public function __construct($table)
    {
        $this->pdo = new PDO($this->dsn, 'root', '');
        $this->table = $table;
    }

    public function all(...$arg)
    {
        $sql = "select * from $this->table";

        if (!empty($arg[0]) && is_array($arg[0])) {
            foreach ($arg[0] as $key => $value) {
                $tmp[] = "`$key`='$value'";
                //$tmp[] = sprintf("`%s`='%s'", $key, $value);
            }
            $sql = $sql . " where " . implode(" && ", $tmp);
        }
        if (!empty($arg[1])) {
            $sql = $sql . $arg[1];
        }
        // echo $sql;
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    function find($arg)
    {
        $sql = "SELECT * FROM `{$this->table}` WHERE ";

        if (is_array($arg)) {
            $tmp = $this->array2sql($arg);
            // $sql = "SELECT * FROM `{$table}` WHERE " . join(" && ", $tmp);
            $sql .= join(" && ", $tmp);
        } else {
            // $sql = "SELECT * FROM `{$table}` WHERE `id`='{$arg}'";
            $sql .= "`id`='{$arg}'";
        }

        // 有問題echo $sql檢查
        echo $sql;
        echo "<br>";

        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    function save($array)
    {
        // 判斷有無`id`有的話是 UPDATE 沒有的話是 INSERT
        if (isset($array['id'])) {
            //update
            // update($table, $array, $array['id']);
            //建立SQL語法
            $sql = "UPDATE `{$this->table}` SET ";

            //使用迴圈將欄位名稱和值組合成字串
            $tmp = $this->array2sql($array);
            $sql .= join(",", $tmp);
            $sql .= " WHERE `id`='{$array['id']}'";

            echo $sql;
            echo "<br>";
        } else {
            //insert
            $sql = "INSERT INTO `{$this->table}` ";
            $sql .= "(`" . join("`,`", array_keys($array)) . "`)";
            $sql .= " VALUES('" . join("','", $array) . "')";

            echo $sql;
            echo "<br>";
        }
        return $this->pdo->exec($sql);
    }

    function del($arg)
    {
        $sql = "DELETE FROM `{$this->table}` WHERE ";

        if (is_array($arg)) {
            $tmp = $this->array2sql($arg);
            $sql .= join(" && ", $tmp);
        } else {
            $sql .= " `id`='{$arg}'";
        }

        return $this->pdo->exec($sql);
    }

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
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    function math($math, $col, ...$arg)
    {
        $sql = "SELECT $math(`$col`) FROM `{$this->table}`";
        $sql = $this->select($sql, ...$arg);

        //echo $sql;
        return $this->pdo->query($sql)->fetchColumn();
    }

    function count(...$arg)
    {
        $sql = "SELECT COUNT(*) FROM `{$this->table}`";
        $sql = $this->select($sql, ...$arg);

        return $this->pdo->query($sql)->fetchColumn();
    }

    

    protected function select($sql, ...$arg)
    {
        if (!empty($arg[0]) && is_array($arg[0])) {
            $tmp = $this->array2sql($arg[0]);
            $sql = $sql . " where " . implode(" && ", $tmp);
        }

        if (!empty($arg[1])) {
            $sql = $sql . $arg[1];
        }

        return $sql;
    }

    
}

function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

$Student = new DB('students');
// echo "<pre>";
// print_r($Student->all());
// echo "</pre>";


$Student = new DB('students');

$Dept = new DB('dept');
$dept = $Dept->find(3);
// update
dd($dept);
$dept['name'] = '墊子';
dd($dept);
$Dept->save($dept);


// insert
// $data = ['code' => 504, 'name' => '美容美髮科'];
// $Dept->save($data);
