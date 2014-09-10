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

namespace Avoo\Elo\Configuration;


/**
 * @author Jérémy Jégou <jejeavo@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @var integer $floor
     */
    protected $floor = 500;

    /**
     * @var integer $baseRange
     */
    protected $baseRange = 50;

    /**
     * @var integer $baseElo
     */
    protected $baseElo = 1500;

    /**
     * Set floor for estimate experience
     *
     * @param integer $floor
     *
     * @return $this
     */
    public function setFloor($floor)
    {
        $this->floor = $floor;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getFloor()
    {
        return $this->floor;
    }

    /**
     * Set variant for estimate range
     *
     * @param integer $baseRange
     *
     * @return $this
     */
    public function setBaseRange($baseRange)
    {
        $this->baseRange = $baseRange;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getBaseRange()
    {
        return $this->baseRange;
    }

    /**
     * Set base elo for new player
     *
     * @param integer $baseElo
     *
     * @return $this
     */
    public function setBaseElo($baseElo)
    {
        $this->baseElo = $baseElo;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getBaseElo()
    {
        return $this->baseElo;
    }
} 
