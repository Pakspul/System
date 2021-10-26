<?php

namespace System\Domain\Model;

abstract class AggregateRoot
{
    const METHOD_INVOKE_FORMAT = "on%s";

    protected $id;

    private $changes = [];
    private $reflector;

    private $version = -1;

    public function __construct(Identifier $id, array $events = null)
    {
        $this->id = $id;

        if ($events !== null) {
            if (empty($events)) {
                throw new \Exception("Parameter: 'events' cannot be empty.");
            }

            $this->loadsFromHistory($events);
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUncommittedChanges()
    {
        return $this->changes;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function markChangesAsCommitted()
    {
        $this->changes = [];
    }

    final public function loadsFromHistory(array $history)
    {
        foreach ($history as $event) {
            $this->applyChange($event, false);
            $this->version++;
        }
    }

    final protected function applyChange(Event $event, bool $isNew = true)
    {
        if ($this->reflector === null) {
            $this->reflector = new \ReflectionClass(static::class);
        }

        $eventName = (new \ReflectionClass($event))->getShortName();
        $eventName = preg_replace("/([a-z]+)(V[0-9]+)/", "$1", $eventName);
        $methodName = sprintf(self::METHOD_INVOKE_FORMAT, $eventName);
        if (!$this->reflector->hasMethod(sprintf($methodName))) {
            throw new \Exception(sprintf("Method '%s' does not exist", $methodName));
        }

        $method = $this
            ->reflector
            ->getMethod($methodName);
        $method->setAccessible(true);
        $method->invoke($this, $event);

        if ($isNew) {
            $this->changes[] = $event;
        }
    }
}
