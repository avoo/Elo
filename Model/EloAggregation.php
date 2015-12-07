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


/**
 * @author Jérémy Jégou <jejeavo@gmail.com>
 */
class EloAggregation implements EloAggregationInterface
{
    /**
     * @var null|EloPlayerInterface $winner
     */
    protected $winner = null;

    /**
     * @var null|EloPlayerInterface $loser
     */
    protected $loser = null;

    /**
     * @var null|integer $oldEloA
     */
    protected $oldEloA = null;

    /**
     * @var null|integer $oldEloB
     */
    protected $oldEloB = null;

    /**
     * @var null|integer $newEloA
     */
    protected $newEloA = null;

    /**
     * @var null|integer $newEloB
     */
    protected $newEloB = null;

    /**
     * @var null|integer $differenceA
     */
    protected $differenceA = null;

    /**
     * @var null|integer $differenceB
     */
    protected $differenceB = null;

    /**
     * @var null|float $percentA
     */
    protected $percentA = null;

    /**
     * @var null|float $percentB
     */
    protected $percentB = null;

    /**
     * {@inheritdoc}
     */
    public function setWinner(EloPlayerInterface $winner = null)
    {
        $this->winner = $winner;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getWinner()
    {
        return $this->winner;
    }

    /**
     * {@inheritdoc}
     */
    public function setLoser(EloPlayerInterface $loser = null)
    {
        $this->loser = $loser;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getLoser()
    {
        return $this->loser;
    }

    /**
     * Set old elo from player A
     *
     * @param $oldEloA
     *
     * @return $this
     */
    public function setOldEloA($oldEloA)
    {
        $this->oldEloA = $oldEloA;

        return $this;
    }

    /**
     * Get old elo from player A
     *
     * @return integer|null
     */
    public function getOldEloA()
    {
        return $this->oldEloA;
    }

    /**
     * Set old elo from player B
     *
     * @param $oldEloB
     *
     * @return $this
     */
    public function setOldEloB($oldEloB)
    {
        $this->oldEloB = $oldEloB;

        return $this;
    }

    /**
     * Get old elo from player B
     *
     * @return integer|null
     */
    public function getOldEloB()
    {
        return $this->oldEloB;
    }

    /**
     * Set new elo from player A
     *
     * @param integer $newEloA
     *
     * @return $this
     */
    public function setNewEloA($newEloA)
    {
        $this->newEloA = $newEloA;

        return $this;
    }

    /**
     * Get new elo from player A
     *
     * @return integer
     */
    public function getNewEloA()
    {
        return $this->newEloA;
    }

    /**
     * Set new elo from player B
     *
     * @param integer $newEloB
     *
     * @return $this
     */
    public function setNewEloB($newEloB)
    {
        $this->newEloB = $newEloB;

        return $this;
    }

    /**
     * Get new elo from player B
     *
     * @return integer
     */
    public function getNewEloB()
    {
        return $this->newEloB;
    }

    /**
     * Set difference point for player A
     *
     * @param integer $differenceA
     *
     * @return $this
     */
    public function setDifferenceA($differenceA)
    {
        $this->differenceA = $differenceA;

        return $this;
    }

    /**
     * Get difference point for player A
     *
     * @return integer|null
     */
    public function getDifferenceA()
    {
        return $this->differenceA;
    }

    /**
     * Set difference point for player B
     *
     * @param integer $differenceB
     *
     * @return $this
     */
    public function setDifferenceB($differenceB)
    {
        $this->differenceB = $differenceB;

        return $this;
    }

    /**
     * Get difference point for player B
     *
     * @return integer|null
     */
    public function getDifferenceB()
    {
        return $this->differenceB;
    }

    /**
     * Set percent win for player A
     *
     * @param float|null $percentA
     *
     * @return $this
     */
    public function setPercentA($percentA)
    {
        $this->percentA = $percentA;

        return $this;
    }

    /**
     * Get percent win for player A
     *
     * @return float|null
     */
    public function getPercentA()
    {
        return $this->percentA;
    }

    /**
     * Set percent win for player B
     *
     * @param float|null $percentB
     *
     * @return $this
     */
    public function setPercentB($percentB)
    {
        $this->percentB = $percentB;

        return $this;
    }

    /**
     * Get percent win for player B
     *
     * @return float|null
     */
    public function getPercentB()
    {
        return $this->percentB;
    }
}
