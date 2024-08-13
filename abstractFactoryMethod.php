<?php
interface Button{
    public function paint();
}

interface CheckBox{
    public function paint();
}

class WinButton implements Button{
    public function paint()
    {   
        echo("Paint winBtn");
    }
}

class WinCheckBox implements CheckBox{
    public function paint()
    {
        echo ("PAint WCB");
    }
}

class MacButton implements Button{
    public function paint()
    {
        echo ("Paint macBtn");
    }
}

class MacCheckBox implements CheckBox{
    public function paint()
    {
        echo ("PAint Mcb");
    }
}

interface GUIFactory{
    public function createButton();
    public function createCheckBox();
    public function getButton();
    public function getCheckbox();
}

class WinFactory implements GUIFactory{
    public function createButton()
    {
        return new WinButton();
    }
    public function createCheckBox()
    {
        return new WinCheckBox();
    }
    public function getCheckbox()
    {
        return 'WIN CB ';
    }
    public function getButton()
    {
        return 'WIN BTN ';
    }
}

class MacFactory implements GUIFactory{
    public function createButton()
    {
        return new MacButton();
    }
    public function createCheckBox()
    {
        return new MacCheckBox();
    }
    public function getCheckbox()
    {
        return 'MAC CB';
    }
    public function getButton()
    {
        return 'MAC BTN ';
    }
}

class Application{
    private $button;
    private $checkBox;
    private $factory;
    public function __construct(GUIFactory $guifactory) {
        $this->factory = $guifactory;
    }
    public function createUi(){
        $this->button = $this->factory->createButton(); 
        $this->checkBox = $this->factory->createCheckBox();
    }
    public function getBtn(){
        return $this->factory->getButton();
    }
    public function getCb(){
        return $this->factory->getCheckbox();
    }

}

class ApplicationConfigurator{
    private $config = 'mac';
    public function main()
    {
        switch ($this->config){
            case 'mac':{
                $factory = new MacFactory();

                break;
            }
            case 'win':{
                $factory = new WinFactory();

                break;
            }
            default:
                echo("Error OS");
                break;
        }

        $app = new Application($factory);
        echo ($app->getBtn());
        echo ($app->getCb());

    }
}


$app = new ApplicationConfigurator();
$app->main();