<?php

/*
* The MIT License (MIT)
*
* Copyright (c) 2014 J. Jégou <jejeavo@gmail.com>
*
* Permission is hereby granted, free of charge, to any person obtaining a copy
* of this software and associated documentation files (the "Software"), to deal
* in the Software without restriction, including without limitation the rights
* to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
* copies of the Software, and to permit persons to whom the Software is
* furnished to do so, subject to the following conditions:
*
* The above copyright notice and this permission notice shall be included in all
* copies or substantial portions of the Software.
*
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
* SOFTWARE.
*/

namespace Avoo\Elo\Model;

use Avoo\Elo\Configuration\ConfigurationInterface;
use Avoo\Elo\Configuration\Configuration;

/**
 * @author Jérémy Jégou <jejeavo@gmail.com>
 */
abstract class AbstractElo implements EloInterface
{
    /**
     * @var ConfigurationInterface $configuration
     */
    protected $configuration;

    /**
     * @var EloAggregationInterface $aggregation
     */
    protected $aggregation;

    /**
     * Construct
     *
     * @param ConfigurationInterface  $configuration
     * @param EloAggregationInterface $aggregation
     */
    public function __construct(ConfigurationInterface $configuration = null, EloAggregationInterface $aggregation = null) {

        if (is_null($configuration)) {
            $configuration = new Configuration();
        }

        if (is_null($aggregation)) {
            $aggregation = new EloAggregation();
        }

        $this->configuration = $configuration;
        $this->aggregation = $aggregation;
    }

    /**
     * Get configuration
     *
     * @return ConfigurationInterface $configuration
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * Estimate experience between player A - player B or player B - player A
     *
     * @param EloPlayerInterface $playerA
     * @param EloPlayerInterface $playerB
     *
     * @return float
     */
    private function calculateExperience($playerA, $playerB)
    {
        $difference = $playerB->getElo() - $playerA->getElo();
        $exp = $difference / 400;

        return 1/(1 + pow(10, $exp));
    }

    /**
     * Get estimate points
     *
     * @param bool $elo
     *
     * @return int
     */
    private function estimateRange($elo)
    {
        $estimatedRange = 80;

        if ($elo >= 1000 && $elo < 2000) {
            $estimatedRange = 50;
        }

        if ($elo >= 2000 && $elo <= 2400) {
            $estimatedRange = 30;
        }

        if ($elo > 2400) {
            $estimatedRange = 20;
        }

        return $estimatedRange;
    }

    /**
     * {@inheritdoc}
     */
    public function calculate(EloPlayerInterface $playerA, EloPlayerInterface $playerB, $winner)
    {
        if (!in_array($winner, array(0, 0.5, 1))) {
            throw new \RuntimeException(sprintf(
                'Invalid parameter, accept 0, 0.5 or 1, but %s given', $winner
            ));
        }

        $experienceA = $this->calculateExperience($playerA, $playerB);
        $experienceB = $this->calculateExperience($playerB, $playerA);

        $estimateA = $this->estimateRange($playerA->getElo());
        $estimateB = $this->estimateRange($playerB->getElo());

        $newEloA = (int) round($playerA->getElo() + $estimateA * ($winner - $experienceA));
        $newEloB = (int) round($playerB->getElo() + $estimateB * ((1 - $winner) - $experienceB));

        $this->aggregation->setWinner($winner);
        $this->aggregation->setOldEloA($playerA->getElo());
        $this->aggregation->setOldEloB($playerB->getElo());
        $this->aggregation->setNewEloA($newEloA);
        $this->aggregation->setNewEloB($newEloB);
        $this->aggregation->setDifferenceA($newEloA - $playerA->getElo());
        $this->aggregation->setDifferenceB($newEloB - $playerB->getElo());
        $this->aggregation->setPercentA(round($experienceA * 100, 2));
        $this->aggregation->setPercentB(round($experienceB * 100, 2));

        return $this->aggregation;
    }
} 
