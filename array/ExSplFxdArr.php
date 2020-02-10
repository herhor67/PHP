<?php

class ExSplFxdArr extends SplFixedArray// implements ArrayAccess
{
	private $default;
	
	public function __construct(int $length, $default=null) // default constructor
	{
		parent::__construct($length);
		$this->setDefault($default);
		if ($default !== NULL)
			for ($i = 0; $i < $length; ++$i)
				$this[$i] = $this->getDefault();
	}
	
	public function __clone() // copy constructor
	{
		$length = $this->getSize()-1;
		for ($i = 0; $i <= $length; ++$i)
			if (is_object($this[$i]))
				$this[$i] = clone($this[$i]);
	}
	
/*	// ArrayAccess
	public function offsetExists($offset)      // ArrayAccess
	{
		return parent::offsetExists($offset);
	}
	public function offsetGet($offset)         // ArrayAccess
	{
		return parent::offsetGet($offset);
	}
	public function offsetUnset($offset)       // ArrayAccess
	{
		parent::offsetUnset($offset);
	}*/
	public function offsetSet($offset, $value) // ArrayAccess
	{
		if ($offset === NULL)
			$offset = $this->getSize();
		if ($offset >= $this->getSize())
			$this->setSize($offset+1);
		parent::offsetSet($offset, $value);
	}
	public function setSize($size) // SplFixedArray
	{
		$i = $this->getSize();
		if (parent::setSize($size))
		{
			if ($size > $i && $this->default !== NULL)
				for (; $i < $size; ++$i)
					$this[$i] = $this->getDefault();
			return true;
		}
		return false;
	}
	public function setDefault($default)
	{
		if (is_object($default))
			$this->default = clone($default);
		elseif ($default !== NULL)
			$this->default = $default;
	}
	public function getDefault()
	{
		if (is_object($this->default))
			return clone($this->default);
		else
			return $this->default;
	}
	
	public function pop()
	{
		$temp = $this[$this->getSize()-1];
		$this->setSize($this->getSize()-1);
		return $temp;
	}
	
	public function reverse()
	{
		$maxEl   =  $this->getSize() - 1;
		$maxElIt = ($this->getSize() >>1) - 1;
		for ($elIt = 0; $elIt <= $maxElIt; ++$elIt)
		{
			$temp = $this[$elIt];
			$this[$elIt] = $this[$maxEl-$elIt];
			$this[$maxEl-$elIt] = $temp;
		}
		return $this;
	}
	
	public function max()
	{
		$max = -INF;
		$maxElIt = $this->getSize() - 1;
		for ($elIt = 0; $elIt <= $maxElIt; ++$elIt)
			if ($this[$elIt] > $max)
				$max = $this[$elIt];
		return $max;
	}
	
	public function min()
	{
		$min = INF;
		$maxElIt = $this->getSize() - 1;
		for ($elIt = 0; $elIt <= $maxElIt; ++$elIt)
			if ($this[$elIt] < $min)
				$min = $this[$elIt];
		return $min;
	}
	
	public function walk(callable $callback, array $params = [])
	{
		$maxElIt = $this->getSize() - 1;
		for ($elIt = 0; $elIt <= $maxElIt; ++$elIt)
			$this[$elIt] = call_user_func($callback, $this[$elIt], ...$params);
		return $this;
	}
	
	public function map(callable $callback, array $params = [])
	{
		$temp = new ExSplFxdArr($this->getSize());
		$maxElIt = $this->getSize() - 1;
		for ($elIt = 0; $elIt <= $maxElIt; ++$elIt)
			$temp[$elIt] = call_user_func($callback, $this[$elIt], ...$params);
		return $temp;
	}
	public function call(callable $callback, array $params = [])
	{
		$maxElIt = $this->getSize() - 1;
		for ($elIt = 0; $elIt <= $maxElIt; ++$elIt)
			call_user_func($callback, $this[$elIt], ...$params);
		return $this;
	}
}

?>
