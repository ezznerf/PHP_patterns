<?php
class Car{
    private $engine;
    private $seats;
    private $color;

    public function setEngine($engine){
        $this->engine = $engine;
    }

    public function setSeats($seats){
        $this->seats = $seats;
    }

    public function setColor($color){
        $this->color = $color;
    }

    public function __toString() {
        return "Car with engine: {$this->engine}, wheels: {$this->seats}, color: {$this->color}";
    }
}

interface Builder{
    public function buildEngine($engine);
    public function buildSeats($seats);
    public function buildColor($color);
    public function reset();
    public function getResult();
}

class CarBuilder implements Builder{
    private $car;

    public function __construct() {
        $this->car = new Car();
    }

    public function reset(){
        $this->car = new Car();
    }

    public function buildEngine($engine)
    {
        $this->car->setEngine($engine);
    }

    public function buildSeats($seats)
    {
        $this->car->setSeats($seats);
    }

    public function buildColor($color)
    {
        $this->car->setColor($color);
    }

    public function getResult()
    {
        return $this->car;
    }
}

//пример не реализван класс Manual
class CarManualBuilder implements Builder{
    private $manual;

    public function __construct() {
        $this->manual = new Car();
    }

    public function reset(){
        $this->manual = new Car();
    }

    public function buildColor($color)
    {
        $this->manual->setEngine("blue");
    }

    public function buildEngine($engine)
    {
        $this->manual->setEngine("V8");
    }

    public function buildSeats($seats)
    {
        $this->manual->setSeats('6');
    }

    public function getResult()
    {
        return $this->manual;
    }
}

class Director{
    public function buildSportCar(Builder $builder){
        $builder->reset();
        $builder->buildEngine('m52b30');
        $builder->buildColor('grey');
        $builder->buildSeats(4);
    }
    // public function buildOffRoadCar(Builder $builder){

    // }
}

class ApplicationBuilder{
    public function makeSportCar(){
        $director = new Director();

        $carBuilder = new CarBuilder();
        $director->buildSportCar($carBuilder);
        $car = $carBuilder->getResult();

        echo ($car->__toString());

    }
}

$app = new ApplicationBuilder();
$app->makeSportCar();