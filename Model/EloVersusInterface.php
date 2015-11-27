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
interface EloVersusInterface
{
    /**
     * Set player A
     *
     * @param EloPlayerInterface $playerA
     *
     * @return $this
     */
    public function setPlayerA(EloPlayerInterface $playerA);

    /**
     * Get player A
     *
     * @return EloPlayerInterface
     */
    public function getPlayerA();

    /**
     * Set player B
     *
     * @param null|EloPlayerInterface $playerB
     *
     * @return $this
     */
    public function setPlayerB(EloPlayerInterface $playerB = null);

    /**
     * Get player B
     *
     * @return EloPlayerInterface
     */
    public function getPlayerB();

    /**
     * Set created at
     *
     * @param \DateTime $createdAt
     *
     * @return $this
     */
    public function setCreatedAt(\DateTime $createdAt);

    /**
     * Get created at
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Set winner
     *
     * @param float $winner
     *
     * @return $this
     */
    public function setWinner($winner = null);

    /**
     * Get winner
     *
     * @return float
     */
    public function getWinner();
}
