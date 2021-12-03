<?php
declare(strict_types=1);

namespace unit\Domain\Processor;

use Codeception\Test\Unit;
use Project\Domain\AlvanumplCard\BlueAlvanumplCard;
use Project\Domain\AlvanumplCard\CardFactory;
use Project\Domain\AlvanumplCard\GreenAlvanumplCard;
use Project\Domain\AlvanumplCard\RedAlvanumplCard;
use Project\Domain\Processor\Processor;

class ProcessorTest extends Unit
{
    public function testProcessSizeFeature()
    {
        $processor = new Processor();

        $processor->process(['size' => 17]);

        $result = $processor->result();

        $this->assertEquals(GreenAlvanumplCard::KIND, reset($result)[0]);
    }

    public function testProcessHornFeature()
    {
        $processor = new Processor();

        $processor->process(['horn' => 'spiral']);

        $result = $processor->result();
        $result = reset($result);

        $this->assertEquals(GreenAlvanumplCard::KIND,$result[0]);
        $this->assertEquals(BlueAlvanumplCard::KIND,$result[1]);
    }

    public function testProcessWoolFeature()
    {
        $processor = new Processor();

        $processor->process(['wool' => false]);

        $result = $processor->result();

        $this->assertEquals(BlueAlvanumplCard::KIND, reset($result)[0]);
    }

    public function testProcessColorFeature()
    {
        $processor = new Processor();

        $processor->process(['color' => 'red']);

        $result = $processor->result();

        $this->assertEquals(RedAlvanumplCard::KIND, reset($result)[0]);
    }

    public function testProcessMultipleFeatures()
    {
        $result = [];
        $processor = new Processor();

        $processor->process(['size' => 15, 'wool' => true, 'horn' => 'straight'], false);

        $found = $processor->result();

        if (count($found) > 0) {
            $bestResult = reset($found);
            foreach ($bestResult as $kind) {
                $result[] = (new CardFactory())->build($kind);
            }
        }

        $this->assertEquals('Зеленый', $result[0]->kind());
        $this->assertEquals('Красный', $result[1]->kind());
    }
}
