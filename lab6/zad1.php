<?php
class NoweAuto
{
    public string $model;
    public float $cena, $kurs;

    public function __construct(string $model, float $cena, float $kurs)
    {
        $this->model = $model;
        $this->cena = $cena;
        $this->kurs = $kurs;
    }

    public function ObliczCene()
    {
        return $this->cena * $this->kurs;
    }
}

class AutoZDodatkami extends NoweAuto
{
    public float $alarm, $radio, $klimatyzacja;

    public function __construct(
        string $model,
        float $cena,
        float $kurs,
        float $alarm,
        float $radio,
        float $klimatyzacja,
    ) {
        parent::__construct($model, $cena, $kurs);
        $this->alarm = $alarm;
        $this->radio = $radio;
        $this->klimatyzacja = $klimatyzacja;
    }

    public function ObliczCene()
    {
        return parent::ObliczCene() + $this->alarm + $this->radio + $this->klimatyzacja;
    }
}


class Ubezpieczenie extends AutoZDodatkami
{
    public float $procentUbezpieczenia;
    public int $lataPosiadania;


    public function __construct(
        string $model,
        float $cena,
        float $kurs,
        float $alarm,
        float $radio,
        float $klimatyzacja,
        float $procentUbezpieczenia,
        int $lataPosiadania,
    ) {
        parent::__construct($model, $cena, $kurs, $alarm, $radio, $klimatyzacja);
        $this->procentUbezpieczenia = $procentUbezpieczenia;
        $this->lataPosiadania = $lataPosiadania;
    }

    public function ObliczCene()
    {
        return $this->procentUbezpieczenia * (parent::ObliczCene() * ((100 - $this->lataPosiadania) / 100));
    }
}

function main()
{
    echo "NoweAuto: ";
    $bazoweAuto = new NoweAuto("BMW", 100000, 4.5);
    echo $bazoweAuto->ObliczCene() . "\n";

    echo "AutoZDodatkami: ";
    $autoZDodatkami = new AutoZDodatkami("BMW", 100000, 4.5, 1000, 2000, 3000);
    echo $autoZDodatkami->ObliczCene() . "\n";

    echo "Ubezpieczenie: ";
    $ubezpieczenie = new Ubezpieczenie("BMW", 100000, 4.5, 1000, 2000, 3000, 0.1, 2);
    echo $ubezpieczenie->ObliczCene() . "\n";
}

main();
