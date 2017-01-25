<?php

namespace Asvae\LaravelFixtures\Commands;

use Illuminate\Console\Command;
use Asvae\LaravelFixtures\FixtureContract;

/**
 *
 */
class FixtureRun extends Command
{
    protected $signature        = 'fixture:run {fixture}';

    protected $description      = 'Run given fixture';

    protected $fixtureNamespace;

    public function __construct()
    {
        parent::__construct();

        $this->fixtureNamespace = getenv('FIXTURES_NAMESPACE');
    }

    public function handle()
    {
        $className = $this->getClassName();

        $this->info("Running $className");

        $this->initializeFixture($className)->run();
    }

    /**
     * @param $className
     * @return FixtureContract
     */
    private function initializeFixture($className)
    {
        return app($className, [$this]);
    }

    private function getClassName()
    {
        $slug = $this->argument('fixture');

        // Is full class name.
        if (strpos($slug, '\\') !== false) {
            return $slug;
        };

        // Is shortened class name so we'll append namespace.
        $className = $this->fixtureNamespace.studly_case($slug);

        if (! class_exists($className)) {
            throw new \Exception("Class $className does not exist.");
        }

        return $className;
    }
}