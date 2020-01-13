<?php

trait TaxCalculator {
    private $price;
    private $tax = 0.08;

    public function taxIncluded() {
        var_dump($this->price);
        return $this->price * (1 + $this->tax);
    }
}


class Book {
    use TaxCalculator;

    public $title;
    public $author;

    public function __construct($price, $title, $author) {
        $this->price = $price;
        $this->title = $title;
        $this->author = $author;
    }
}

class Pen {
    use TaxCalculator;

    public $color;
    public $type;

    public function __construct($price, $color, $type){
        $this->price = $price;
        $this->color = $color;
        $this->type = $type;
    }
}

$book = new Book(300, "銀河鉄道の夜", "宮沢賢治");
$pen = new Pen(100, "black", "sharp");

echo $book->taxIncluded().PHP_EOL;
echo $pen->taxIncluded().PHP_EOL;
