<?php

namespace App\Calculator;

use Mockery\Exception\InvalidArgumentException;

interface Operation {
	public function run($num, $current);
}

class Addition implements Operation {
	public function run($num, $current)
	{
		return $current + $num;
	}
}

class Multiplication implements Operation {
	public function run($num, $current)
	{
		// Any number times 0 is 0
		if ($current === 0) return $num;

		return $current * $num;
	}

}


class Subtraction implements Operation {

	public function run($num, $current)
	{
		return $current - $num;
	}
}

class Calculator {

	protected $result = 0;
	
	public function getResult()
	{
		return $this->result;
	}

	public function setOperands()
	{
		$this->operands = func_get_args();
	}

	public function setOperation(Operation $operation)
	{
		$this->operation = $operation;
	}

	public function calculate()
	{
		foreach ($this->operands as $num)
		{
			if ( ! is_numeric($num))
				throw new InvalidArgumentException;

			$this->result = $this->operation->run($num, $this->result);
		}

		return $this->result;
	}
}