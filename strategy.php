<?php
interface ShippingType{
    public function getCost(Order $order);
    public function getDate(Order $order);
}

class Air implements ShippingType{
    
    public function getCost(Order $order)
    {

        if ($order->getTotal() > 100){
            return 0;
        }
        return max(10, $order->getTotalWeight() * 1.5);
    }
    
    public function getDate(Order $order)
    {
        return "12.10.2004";
    }
}

class Ground implements ShippingType{
    public function getCost(Order $order)
    {
        if ($order->getTotal() > 100){
            return 0;
        }
        return max(20, $order->getTotalWeight() * 1.4);
    }
    
    public function getDate(Order $order)
    {
        return "12.10.2005";
    }
}

class Order{
    private $weight;
    private $count;
    private $shipping;
    private $cost;
    
    public function __construct(ShippingType $shippingType, $weight, $count, $cost)
    {
        $this->shipping = $shippingType;
        $this->count = $count;
        $this->weight = $weight;
        $this->cost = $cost;
    }
    public function getTotalWeight(){
        return $this->weight * $this->count;
    }
    public function getTotal(){
        return $this->cost * $this->count;
    }
    public function getShippingCost(){
        return $this->shipping->getCost($this);
    }
    public function getShippingDate(){
        return $this->shipping->getDate($this);
    }

}

$order = new Order(new Air(), 1, 2, 1);
echo($order->getShippingCost());
echo("\n");
echo($order->getShippingDate());



//////////SECOND////////////



// Интерфейс Стратегии
interface TaxStrategy {
    public function calculateTax($amount);
}

// Конкретная Стратегия для США
class USTaxStrategy implements TaxStrategy {
    public function calculateTax($amount) {
        return $amount * 0.07; // Простой пример налога
    }
}

// Конкретная Стратегия для ЕС
class EUTaxStrategy implements TaxStrategy {
    public function calculateTax($amount) {
        return $amount * 0.20; // Другая ставка налога
    }
}

// Контекст
class SalesOrder {
    private $strategy;

    public function __construct(TaxStrategy $strategy) {
        $this->strategy = $strategy;
    }

    public function calculateTax($amount) {
        return $this->strategy->calculateTax($amount);
    }
}

// Клиентский код
$orderUS = new SalesOrder(new USTaxStrategy());
echo $orderUS->calculateTax(100); // Расчёт налога в США

$orderEU = new SalesOrder(new EUTaxStrategy());
echo $orderEU->calculateTax(100); // Расчёт налога в ЕС