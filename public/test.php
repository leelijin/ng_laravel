<?php
interface discoutBase{
    public function getDiscount();
    public function getTotal();
}

class MostDis implements discoutBase{
    public function getDiscount()
    {
        return 0.8;
    }
    public function getTotal()
    {
        return 10;
    }
}

class HalfDis implements discoutBase{
    public function getDiscount()
    {
        return 0.5;
    }
    public function getTotal()
    {
        return 10;
    }
}

class count{
    protected $discount;
    public function pay(discoutBase $discount)
    {
        $this->discount=$discount;
        return $discount->getDiscount()*$discount->getTotal();
    }
}

echo (new count())->pay(new MostDis());
echo '|';
echo (new count())->pay(new HalfDis());