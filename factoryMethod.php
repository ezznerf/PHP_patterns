<?php
interface Transport{
    public function getName();
}

class Airplane implements Transport{
    public function getName()
    {
        return "Airplane Class ";
    }
}

class Ship implements Transport{
    public function getName()
    {
        return "Ship Class";
    }
}

abstract class Creator{
    abstract public function factory();
    public function operation(){
        $product = $this->factory();
        return "THIS work with ". $product->getName();
    }
}

class AirplaneTransport extends Creator{
    public function factory()
    {
        return new Airplane();
    }
}

class ShipTransport extends Creator{
    public function factory(){
        return new Ship();
    }
}

function client(Creator $creator){
    echo($creator->operation() . PHP_EOL);
}

$airplane = new AirplaneTransport();
client($airplane);

$ship = new ShipTransport();
client($ship);