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
 * Interface EloAggregationInterface
 */
interface EloAggregationInterface
{
    /**
     * Set winner
     *
     * @param null|EloPlayerInterface $winner
     *
     * @return $this
     */
    public function setWinner(EloPlayerInterface $winner = null);

    /**
     * Get winner
     *
     * @return EloPlayerInterface
     */
    public function getWinner();

    /**
     * Set loser
     *
     * @param null|EloPlayerInterface $loser
     *
     * @return $this
     */
    public function setLoser(EloPlayerInterface $loser = null);

    /**
     * Get loser
     *
     * @return EloPlayerInterface
     */
    public function getLoser();

    /**
     * Set old elo from player A
     *
     * @param $oldEloA
     *
     * @return $this
     */
    public function setOldEloA($oldEloA);

    /**
     * Get old elo from player A
     *
     * @return integer|null
     */
    public function getOldEloA();

    /**
     * Set old elo from player B
     *
     * @param $oldEloB
     *
     * @return $this
     */
    public function setOldEloB($oldEloB);

    /**
     * Get old elo from player B
     *
     * @return integer|null
     */
    public function getOldEloB();

    /**
     * Set new elo from player A
     *
     * @param integer $newEloA
     *
     * @return $this
     */
    public function setNewEloA($newEloA);

    /**
     * Get new elo from player A
     *
     * @return integer
     */
    public function getNewEloA();

    /**
     * Set new elo from player B
     *
     * @param integer $newEloB
     *
     * @return $this
     */
    public function setNewEloB($newEloB);

    /**
     * Get new elo from player B
     *
     * @return integer
     */
    public function getNewEloB();

    /**
     * Set difference point for player A
     *
     * @param integer $differenceA
     *
     * @return $this
     */
    public function setDifferenceA($differenceA);

    /**
     * Get difference point for player A
     *
     * @return integer|null
     */
    public function getDifferenceA();

    /**
     * Set difference point for player B
     *
     * @param integer $differenceB
     *
     * @return $this
     */
    public function setDifferenceB($differenceB);

    /**
     * Get difference point for player B
     *
     * @return integer|null
     */
    public function getDifferenceB();

    /**
     * Set percent win for player A
     *
     * @param float $percentA
     *
     * @return $this
     */
    public function setPercentA($percentA);

    /**
     * Get percent win for player A
     *
     * @return float|null
     */
    public function getPercentA();

    /**
     * Set percent win for player B
     *
     * @param float $percentB
     *
     * @return $this
     */
    public function setPercentB($percentB);

    /**
     * Get percent win for player B
     *
     * @return float|null
     */
    public function getPercentB();
}
