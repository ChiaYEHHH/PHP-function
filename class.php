<?php

// 物件導向的設計圖 藍圖
class Animal
{
    public $name = 'animal';
    protected $age = 12;
    private $weight = 20;


    // public function __construct($name)
    // {
    //     $this->name = $name;
    // }



    public function run()
    {
        echo $this->name;
        echo "ani is running";
    }

    // private 只可內部存取
    private function spee()
    {
        return 'high speed';
    }
}



// class Cat繼承 Animal 的public private
class Cat extends Animal
{
    public $name = 'cat';

    public function run()
    {
        echo "cat is running";
        echo $this->age;
        echo $this->speed();
    }

    // private 只可內部存取
    private function speed()
    {
        return 'low speed';
    }
}

// class Dog繼承 Animal 的public private
class Dog extends Animal
{
    public $name = 'dog';

    public function run()
    {

        echo $this->name;
        echo " is running";
        echo $this->age;
        echo $this->speed();
    }

    // private 只可內部存取
    private function speed()
    {
        return 'med speed';
    }
}

$ani = new Animal('john');
$ani->run();

// cat就是物件
$dog = new Dog();
// 執行 cat物件中的 name
echo $dog->name;
echo "<hr>";

// cat就是物件
$cat = new Cat();
// 執行 cat物件中的 name
echo $cat->name;

// echo $cat->age;
// echo $cat->weight;
