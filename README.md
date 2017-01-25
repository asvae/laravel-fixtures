## Installation
To your `App\Console\Kernel` add command like this:

```php
protected $commands = [
    // ...
    
    \Asvae\LaravelFixtures\Commands\FixtureRun::class,
];
```

## Usage
For your fixtures be sure to extend`\Asvae\LaravelFixtures\AbstractFixture` class or at least implement `Asvae\LaravelFixtures\FixtureContract`. Abstract class has several utility methods to keep you going:
```
$this->runFixture($className); // Runs another fixture.
$this->runArray($className); // Run [nested] array of fixtures
```
To run fixture do `php artisan fixture:run "\App\Fixtures\YourFixture"`. This will basically run `run` method in given class, while also resolving dependencies in case you defined any in constructor.



## Config
No config file provided as the library is way too small. You can define default namespace in `.env` file though. This will be used when you pass class name without namespace
```
FIXTURES_NAMESPACE=App\MyFixtures
```

## Examples
[Take a look](src/Examples). For the case depicted, in production, to fully migrate data you will run 
```
php artisan fixture:run "\Asvae\LaravelFixtures\Examples\FixtureSet"
```
In development, to refresh single table you will run solitary fixtures as these are much faster.



## Hints
* You can copy class name in PHPStorm by placing cursor onto class name and pressing `Command + Shift + Alt + C` 