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
        "avoo/elo": "~0.2"
    }
}
```

Default Usage
-------------

You need to implement the class `Avoo\Elo\Model\EloPlayerInterface` on your own player class

``` php
use Avoo\Elo\Model\EloPlayerInterface;
use Avoo\Elo\Model\EloUserInterface;

class EloPlayer implements EloPlayerInterface
{
    /**
     * @var integer
     */
    protected $elo;

    /**
     * @var EloUserInterface $user
     */
    protected $user;

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

    /**
     * {@inheritdoc}
     */
    public function setUser(EloUserInterface $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getUser()
    {
        return $this->user;
    }

    //... Your own code
}
```

Consider the player A with 2300 elo and the player B 1800, the player A lose.

The default setup for winner is:
    - 0 Player A lose
    - 0.5 Draw
    - 1 Player A win

Example 1
---------

``` php
use Avoo\Elo\EloPoint;
use Avoo\Elo\EloVersusInterface;
use Avoo\Elo\EloAggregagtionInterface;

$eloCalculator = new EloPoint();

/** @var EloVersusInterface $match */
$eloPoint->calculate($match);

/** @var EloAggregationInterface $aggregation */
$aggregation = $eloPoint->getAggregation(); 
```

Example 2
---------

``` php
use Avoo\Elo\EloPoint;
use Avoo\Elo\EloVersusInterface;
use Avoo\Elo\EloAggregagtionInterface;

/** @var EloVersusInterface $match */
$eloCalculator = new EloPoint($match);
$eloPoint->calculate();

/** @var EloAggregationInterface $aggregation */
$aggregation = $eloPoint->getAggregation(); 
```

Override configuration
----------------------

You can override the default configuration for adjust your elo calculator

``` php
use Avoo\Elo\EloPoint;
use Avoo\Elo\EloVersusInterface;
use Avoo\Elo\EloAggregagtionInterface;
use Avoo\Elo\ConfigurationInterface;

/** @var ConfigurationInterface $configuration */
$configuration = new Configuration();

/**
 * Floor is the experience range calculator
 */
$configuration->setFloor(200);

/**
 * Base range is ratio number for calculate the new elo
 * In this case between 0 and 1700 elo point the range is 50, over it's 20
 * For example with 1500 elo point for both players, with 50 elo range, the new elo will be 18 and -18,
 * and for 20 elo range, the new elo will be 7 and -7
 */
$configuration->setBaseRange(array(
    0 => 50
    1700 => 20
));

/*
 * Base elo is the start elo point for a new player
 */
$configuration->setBaseElo(1000);

/** @var EloVersusInterface $match */
$eloCalculator = new EloPoint($match, $configuration);
$eloPoint->calculate();

/** @var EloAggregationInterface $aggregation */
$aggregation = $eloPoint->getAggregation();
```
