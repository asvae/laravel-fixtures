<?php

namespace Asvae\LaravelFixtures;

use Illuminate\Console\Command;
use Asvae\LaravelFixtures\FixtureContract;

abstract class AbstractFixture implements FixtureContract
{
    /**
     * Utility counter. Useful for long operations.
     *
     * @var int
     */
    protected $counter = 0;

    /**
     * Console kernel instance. Use it to commute with terminal.
     *
     * @var Command
     */
    protected $command;

    public function __construct(Command $command)
    {
        $this->command = $command;
    }

    protected function getCommand()
    {
        return $this->command;
    }

    protected function runFixture($className)
    {
        $this->command->call('fixture:run', ['fixture' => $className]);
    }

    protected function runArray(array $array){
        foreach ($array as $item) {
            if (is_array($item)){
                $this->runArray($item);
                continue;
            }
            $this->runFixture($item);
        }
    }
}