<?php
interface DataSource{
    public function writeData($data);
    public function readData();
}

class Data implements DataSource{
    public function writeData($data)
    {
        return "data writed";
    }
    public function readData()
    {
        return "data readed";
    }
}

abstract class DataDecorator implements DataSource{
    protected $data;

    public function __construct(DataSource $data) {
        $this->data = $data;
    }
    
    public function writeData($data)
    {
        return $this->data->writeData($data);  
    }
    public function readData()
    {
        return $this->data->readData();
    }
}

class EncyptionDecorator extends DataDecorator{
    public function writeData($data)
    {
        // что то делаем с $data например шифруем
        return parent::writeData($data);
    }
    public function readData()
    {
        $data = parent::readData();
        // расшифровать $data;
        return $data;
    }
}

class CompressionDecorator extends DataDecorator{
    public function writeData($data)
    {
        // что то делаем с $data например сжать
        return parent::writeData($data);
    }
    public function readData()
    {
        $data = parent::readData();
        // раcпаковать $data;
        return $data;
    }
}

class Application{
    public function main(){
        $source = new Data();
        $source->writeData("test.txt");
        $source->readData();
        // В файл были записаны чистые данные.
        
        $source = new CompressionDecorator($source);
        $source->writeData("test.txt");
        // В файл были записаны сжатые данные.

        // и так же с шифрованием 
    }
}