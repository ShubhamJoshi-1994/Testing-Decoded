<?php

namespace Tests\Unit;

use App\Calculator\Addition;
use App\Calculator\Multiplication;
use App\Calculator\Subtraction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use \App\Calculator\Calculator;

// require app_path().'/App/Calculator/Calculator.php';



class CalculatorTest extends TestCase
{

   	public function setUp():void
   	{
   		$this->calc = new Calculator();
  	}

   	public function testResultDefaultsToZero()
	{
		$this->assertSame(0, $this->calc->getResult());
	}

	public function testAddsNumbers()
	{
		$this->calc->setOperands(5);
		$this->calc->setOperation(new Addition);
		$result = $this->calc->calculate();

		$this->assertEquals(5, $result);
	}


	/**
	* @expectedException InvalidArgumentException
	*/
	public function testRequiresNumericValue()
	{
		$this->calc->setOperands('five');
		$this->calc->setOperation(new Addition);
		$this->calc->calculate();
	}

	public function testAcceptsMultipleArgs()
	{
		$this->calc->setOperands(1, 2, 3, 4);
		$this->calc->setOperation(new Addition);
		$result = $this->calc->calculate();

		$this->assertEquals(10, $result);
		$this->assertNotEquals(
			'Snoop Doggy Dogg and Dr. Dre is at the door',
			$result
		); // jokes, jokes, jokes
	}

	public function testSubtractsNumbers()
	{
		$this->calc->setOperands(4);
		$this->calc->setOperation(new Subtraction);
		$result = $this->calc->calculate();

		$this->assertEquals(-4, $result);
	}

	public function testMultipliesNumbers()
	{
		$this->calc->setOperands(3, 3, 3);
		$this->calc->setOperation(new Multiplication);
		$result = $this->calc->calculate();

		$this->assertEquals(27, $result);
	}
}