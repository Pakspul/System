<?php

namespace System;

final class Stopwatch
{
    /**
     * @var float
     **/
    private $beginTime;

    /**
     * @var float
     **/
    private $endTime;

    /**
     * @var bool
     **/
    private $isRunning = false;

    public function isRunning(): bool
    {
        return $this->isRunning;
    }

    public function getElapsed(): float
    {
        $endtime = ($this->isRunning) ? $this->getMicrotime() : $this->endTime;
        $elapsedTime = (float) ($endtime - $this->beginTime);

        return $elapsedTime;
    }

    /**
     * Starts, or resumes, measuring elapsed time for an interval.
     */
    public function start(): void
    {
        if ($this->isRunning) {
            throw new \Exception("Can't start a running stopwatch.");
        }

        $this->beginTime = $this->getMicrotime();
        $this->isRunning = true;
    }

    /**
     * Initializes a new Stopwatch instance, sets the elapsed time property to zero, and starts measuring elapsed time.
     */
    public static function startNew(): Stopwatch
    {
        $stopwatch = new Stopwatch();
        $stopwatch->start();

        return $stopwatch;
    }

    /**
     * Stops measuring elapsed time for an interval.
     */
    public function stop(): void
    {
        if (!$this->isRunning) {
            throw new \Exception("Can't stop a stopwatch that is not running.");
        }

        $this->endTime = $this->getMicrotime();
        $this->isRunning = false;
    }

    /**
     * Stops time interval measurement, resets the elapsed time to zero, and starts measuring elapsed time.
     */
    public function restart(): void
    {
        $this->beginTime = $this->getMicrotime();
        $this->isRunning = true;
    }

    private function getMicrotime(): float
    {
        return \microtime(true);
    }
}
