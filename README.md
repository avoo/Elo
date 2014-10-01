Elo
===
[![Build Status]
(https://scrutinizer-ci.com/g/avoo/Elo/badges/build.png?b=master)](https://scrutinizer-ci.com/g/avoo/Elo/build-status/master)
[![Scrutinizer Code Quality]
(https://scrutinizer-ci.com/g/avoo/Elo/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/avoo/Elo/?branch=master)
[![License]
(https://poser.pugx.org/avoo/elo/license.svg)](https://packagist.org/packages/avoo/elo)

This is a PHP library to calculate the Elo rank between two players.

Documentation
-------------

into your `composer.json` file:

``` json
{
    "require": {
        "avoo/elo": "@dev-master"
    }
}
```

Default Usage
-------------

You need to implement the class `Avoo\Elo\Model\EloPlayerInterface` on your own player class

``` php
use Avoo\Elo\Model\EloPlayerInterface;

class EloPlayer implements EloPlayerInterface
{
    /**
     * @var integer
     */
    protected $elo;

    /**
     * {@inheritdoc}
     */
    public function setElo($elo)
    {
        $this->elo = $elo;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getElo()
    {
        return $this->elo;
    }

    //... Your own code
}
```

You must have an instance of `playerA` and `playerB`, now just use the default `EloPoint` class

Exemple
-------

Consider the player A with 2300 elo and the player B 1800, the player A lose.

The default setup for winner is:
    - 0 Player A lose
    - 0.5 Draw
    - 1 Player A win

``` php
use Avoo\Elo\EloPoint;

$eloCalculator = new EloPoint();

$result = $eloCalculator->calculate($eloA, $eloB, 0);
```

The result class from calculate method is an `EloAggregationInterface`
