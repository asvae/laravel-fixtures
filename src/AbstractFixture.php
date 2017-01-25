<?php

namespace Asvae\LaravelFixtures;

use Illuminate\Console\Command;

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

    /**
     * Get command kernel instance.
     *
     * @return Command
     */
    protected function getCommand()
    {
        return $this->command;
    }

    /**
     * Run another fixture by class name.
     *
     * @param $className
     */
    protected function runFixture($className)
    {
        $this->command->call('fixture:run', ['fixture' => $className]);
    }

    /**
     * Run fixtures in array order.
     * Array keys are ignored, use them as comments.
     *
     * @param array $array
     */
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