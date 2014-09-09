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

use Symfony\Component\HttpKernel\Exception\PreconditionFailedHttpException;

/**
 * @author Jérémy Jégou <jejeavo@gmail.com>
 */
abstract class AbstractElo implements EloInterface
{
    /**
     * @var integer $baseRange
     */
    protected $baseRange = 30;

    /**
     * @var integer $floor
     */
    protected $floor = 500;

    /**
     * @var integer $eloA
     */
    protected $eloA;

    /**
     * @var integer $eloB
     */
    protected $eloB;

    /**
     * @var EloPlayerInterface $elo1
     */
    protected $playerA;

    /**
     * @var EloPlayerInterface $elo2
     */
    protected $playerB;

    /**
     * @var integer $winner
     */
    private $winner;

    /**
     * Construct
     *
     * @param EloPlayerInterface $playerA
     * @param EloPlayerInterface $playerB
     */
    public function __construct(EloPlayerInterface $playerA, EloPlayerInterface $playerB)
    {
        $this->playerA = $playerA;
        $this->playerB = $playerB;
    }

    /**
     * Get player A
     *
     * @return EloPlayerInterface
     */
    public function getPlayerA()
    {
        return $this->playerA;
    }

    /**
     * Get player B
     *
     * @return EloPlayerInterface
     */
    public function getPlayerB()
    {
        return $this->playerB;
    }

    /**
     * Estimate experience between player A - player B or player B - player A
     *
     * @param bool $invert
     *
     * @return float
     */
    private function calculateExperience($invert = false)
    {
        $difference = $this->playerB->getElo() - $this->playerA->getElo();

        if ($invert) {
            $difference = $this->playerA->getElo() - $this->playerB->getElo();
        }

        $exp = $difference / 400;

        return 1/(1 + pow(10, $exp));
    }

    /**
     * Set floor for estimate experience
     *
     * @param $floor
     *
     * @return $this
     */
    public function setFloor($floor)
    {
        $this->floor = $floor;

        return $this;
    }

    /**
     * Set variant for estimate range
     *
     * @param $baseRange
     *
     * @return $this
     */
    public function setBaseRange($baseRange)
    {
        $this->baseRange = $baseRange;

        return $this;
    }

    /**
     * Get estimate points
     *
     * @param bool $invert
     *
     * @return int
     */
    private function estimateRange($invert = false)
    {
        $difference = $this->playerA->getElo() + $this->playerB->getElo();

        if ($invert) {
            $difference = $this->playerB->getElo() + $this->playerA->getElo();
        }

        $eloRange = ($difference) / 2;

        $floor = $this->floor;
        $estimatedRange = $this->baseRange;

        do {
            $floor += $this->floor;
            $estimatedRange -= 5;
        } while ($floor < $eloRange);

        return $estimatedRange;
    }

    /**
     * Set winner
     *   - 1 player A win
     *   - 0 player B win
     *   - 0,5 draw
     *
     * @param integer $winner
     *
     * @throws PreconditionFailedHttpException
     * @return $this
     */
    public function setWinner($winner)
    {
        if (!in_array($winner, array(0, 0.5, 1))) {
            throw new PreconditionFailedHttpException(sprintf(
                'Invalid parameter, accept 0, 1 or 2, but %s given', $winner
            ));
        }

        $this->winner = $winner;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function calculate($winner, $scoreA = null, $scoreB = null)
    {
        $this->setWinner($winner);

        $experienceA = $this->calculateExperience();
        $experienceB = $this->calculateExperience(true);

        $estimateA = $this->estimateRange();
        $estimateB = $this->estimateRange(true);

        $pointsA = (int) round($estimateA * ($this->winner - $experienceA));
        $pointsB = (int) round($estimateB * ((($this->winner > 0) ? $this->winner * -1 + 2 : 0.5) - $experienceB));

        $this->playerA->setDifference($pointsA);
        $this->playerB->setDifference($pointsB);

        $this->setNewElo();
    }

    /**
     * Calculate new elo
     *
     * @return $this
     */
    private function setNewElo()
    {
        $this->eloA = $this->playerA->getElo() + $this->playerA->getDifference();
        $this->eloB = $this->playerB->getElo() + $this->playerB->getDifference();

        return $this;
    }
} 
