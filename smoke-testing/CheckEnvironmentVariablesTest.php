<?php

namespace Tests\SmokeTesting;

use Symfony\Component\Dotenv\Dotenv;

class CheckEnvironmentVariablesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function check()
    {
        $path = __DIR__.'/../../.env.dist';

        $dotenv = new Dotenv();
        $vars = $dotenv->parse(file_get_contents($path), $path);
        $varNames = array_keys($vars);

        foreach ($varNames as $varName) {
            $value = getenv($varName);
            if (false === $value) {
                $this->fail(sprintf('Environment variable "%s" does not exist', $varName));
            }
            if (empty($value)) {
                $this->fail(sprintf('Environment variable "%s" is empty', $varName));
            }
        }

        $this->assertTrue(true);
    }
}
