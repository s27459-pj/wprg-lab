<?php
class Product
{
    private string $name;
    private float $price;
    private int $quantity;

    public function __construct(string $name, float $price, int $quantity)
    {
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    public function __toString()
    {
        return "Product: $this->name, Price: $this->price, Quantity: $this->quantity";
    }

    public function getName()
    {
        return $this->name;
    }
    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getPrice()
    {
        return $this->price;
    }
    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }
    public function setQuantity(float $quantity)
    {
        $this->quantity = $quantity;
    }
}

class Cart
{
    private array $products;

    public function __construct()
    {
        $this->products = [];
    }

    public function __toString()
    {
        $result = "Products in cart:\n";
        foreach ($this->products as $product) {
            $result .= $product . "\n";
        }
        $result .= "Total price: " . $this->getTotal() . "\n";
        return $result;
    }

    public function addProduct(Product $product)
    {
        array_push($this->products, $product);
    }

    public function removeProduct(Product $product)
    {
        $index = array_search($product, $this->products);
        if ($index !== false) {
            unset($this->products[$index]);
        }
    }

    public function getTotal()
    {

        $total = 0;
        foreach ($this->products as $product) {
            $total += $product->getPrice() * $product->getQuantity();
        }
        return $total;
    }
}

function main()
{
    $cart = new Cart();
    $product1 = new Product("Cheese", 10, 2);
    $product2 = new Product("Eggs", 20, 3);
    $product3 = new Product("Bread", 30, 4);

    $cart->addProduct($product1);
    $cart->addProduct($product2);
    $cart->addProduct($product3);

    echo $cart;
}

main();
