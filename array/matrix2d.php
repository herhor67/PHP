<?php

include 'ExSplFxdArr.php';

class Matrix extends ExSplFxdArr implements Countable, Iterator
{
	private $height;
	private $width;
	private $positiony = 0;
	private $positionx = 0;
	
	public function __construct(int $height, int $width)
	{
		if (!is_int($height) || !is_int($width) || $height < 0 || $width < 0)
			throw new InvalidArgumentException('Dimensions must be ints: H>=0, W>=0, given: H'.$height.', W'.$width);
		$this->height = $height;
		$this->width  = $width;
		parent::__construct($height, new ExSplFxdArr($width, 0));
	}
	public function count()   // Countable
	{
		return $this->height*$this->width;
	}
	public function rewind()  // Iterator
	{
		$this->positiony = 0;
		$this->positionx = 0;
	}
	public function current() // Iterator
	{
		return $this[$this->positiony][$this->positionx];
	}
	public function key()     // Iterator
	{
		return $this->positiony*$this->width+$this->positionx;
	}
	public function next()    // Iterator
	{
		++$this->positionx;
		if (!$this[$this->positiony]->offsetExists($this->positionx))
		{
			$this->positionx = 0;
			++$this->positiony;
		}
	}
	public function valid()   // Iterator
	{
		return $this->offsetExists($this->positiony) && $this[$this->positiony]->offsetExists($this->positionx);
	}
	
	public function resize($height=NULL, $width=NULL)
	{
		echo 'resize: H'.$height.', W'.$width.'<br>';
		if ($height === NULL)
			$height = $this->height;
		if ($width  === NULL)
			$width  = $this->width;
		if (!is_int($height) || !is_int($width) || $height < 0 || $width < 0)
			throw new InvalidArgumentException('Dimensions must be ints: H>=0, W>=0, given: H'.$height.', W'.$width);
		if ($width  != $this->width)
		{
			$this->call(function($el)use($width){$el->setSize($width);});
			$this->setDefault(new ExSplFxdArr($width, 0));
		}
		if ($height != $this->height)
			$this->setSize($height);
		$this->height = $height;
		$this->width  = $width;
		return $this;
	}
	
	public function disp()
	{
		echo '<table>'.PHP_EOL;
		for ($y = 0; $y < $this->height; $y++)
		{
			echo '<tr>';
			for ($x = 0; $x < $this->width; $x++)
				echo '<td>'.$this[$y][$x].'</td>';
			echo '</tr>'.PHP_EOL;
		}
		echo '</table><br>'.PHP_EOL;
	}
	public function dump()
	{
		echo '<pre>';
		print_r($this);
		echo '</pre><br>';
	}
	
	public function flip_vertical()
	{
		return $this->reverse();
	}
	
	public function flip_horizontal()
	{
		return $this->call(function($el){$el->reverse();});
	}
	
	public function transpose()
	{
		$maxRowIt = $this->height - 1;
		$maxColIt = $this->width  - 1;
		$square = min($maxRowIt, $maxColIt);
		for ($row = 0; $row <= $square; ++$row)
			for ($col = $row+1; $col <= $square; ++$col)
			{
				$temp = $this[$row][$col];
				$this[$row][$col] = $this[$col][$row];
				$this[$col][$row] = $temp;
			}
		if ($maxColIt > $square)
		{
			$this->setSize($this->width);
			for ($col = $square+1; $col <= $maxColIt; ++$col)
			{
				$this[$col] = new ExSplFxdArr($this->height);
				for ($row = 0; $row <= $maxRowIt; ++$row)
					$this[$col][$row] = $this[$row][$col];
			}
			for ($row = 0; $row <= $maxRowIt; ++$row)
				$this[$row]->setSize($this->height);
		}
		if ($maxRowIt > $square)
		{
			for ($col=0; $col<=$maxColIt; ++$col)
			{
				$this[$col]->setSize($this->height);
				for ($row = $square+1; $row <= $maxRowIt; ++$row)
					$this[$col][$row] = $this[$row][$col];
			}
			$this->setSize($this->width);
		}
		$temp = $this->height;
		$this->height = $this->width;
		$this->width = $temp;
		return $this;
	}
	
	public function flip_both()
	{
		return $this->flip_vertical()->flip_horizontal();
	}
	
	public function antitranspose()
	{
		return $this->flip_both()->transpose();
	}
	
	public function rotate_clockwise()
	{
		return $this->flip_vertical()->transpose();
	}
	
	public function rotate_anticlockwise()
	{
		return $this->transpose()->flip_vertical();
	}
}

?>
