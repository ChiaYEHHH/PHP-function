<style>
    * {
        font-family: 'Courier New', Courier, monospace;
    }
</style>
<h1>自訂函式</h1>
<?php


$a = ['A', 'B', 'C', 'D', 'E'];
$b = [
    '姓名' => '葉珈珈',
    '學號' => '113012',
    '數學' => '85',
    '國文' => 67,
    '英文' => 56
];






// echo "<pre>";
// print_r($a);
// echo "</pre>";
// echo "<pre>";
// print_r($b);
// echo "</pre>";
// 直接用 dd function取代上面的pre
dd($a);
dd($b);


// direct dump 在頁面上快速顯示陣列內容
// @param $array 註解輸入的參數需為陣列
function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

echo "正三角形";

star();
star(10);
// function 呼叫時沒有設定，預設值$shape="正三角形 $stars=7
function star($shape = "正三角形", $stars = 7)
{
    switch ($shape) {
            // 
        case "正三角形":
        case 'triangle':

            echo '<br>';
            for ($i = 0; $i < $stars; $i++) {
                for ($k = 0; $k < $stars - 1 - $i; $k++) {
                    echo "&nbsp";
                }
                for ($j = 0; $j < $i * 2 + 1; $j++) {
                    echo "*";
                }
                echo '<br>';
            }
            break;
        case "菱形":
        case '3':

            $odd = ($stars % 2 == 0) ? $stars + 1 : $stars;
            $mid = (($odd + 1) / 2) - 1;
            $tmp = 0;
            $odd = ($stars % 2 == 0) ? $stars + 1 : $stars;
            $mid = (($odd + 1) / 2) - 1;
            for ($i = 0; $i < $stars; $i++) {
                if ($i <= $mid) {
                    $tmp = $i;
                } else {
                    $tmp = $tmp - 1;
                }
                for ($k = 0; $k < $mid - $tmp; $k++) {
                    echo "&nbsp";
                }
                for ($j = 0; $j < $tmp * 2 + 1; $j++) {
                    echo "*";
                }
                echo "<br>";
            }
            break;
    }
}
