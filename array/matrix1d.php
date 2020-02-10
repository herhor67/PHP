<?php

class Matrix extends SplFixedArray
{
	private $height;
	private $width;
	
	public function __construct(int $height, int $width)
	{
		if (!is_int($height) || !is_int($width) || $height < 0 || $width < 0)
			throw new InvalidArgumentException('Dimensions must be nonnegative ints, given: '.$height.', '.$width);
		$this->height = $height;
		$this->width  = $width;
		parent::__construct($height*$width); 
	}
	
	public function at(int $y, int $x, $val=NULL)
	{
		if (!is_int($y) || !is_int($x) || $y < 0 || $x < 0 || $y >= $this->height || $x >= $this->width)
			throw new InvalidArgumentException('Coordinates must be nonnegative ints in range of H & W, given: '.$y.', '.$x);
		if ($val !== NULL)
			$this[$y*$this->width+$x] = $val;
		return $this[$y*$this->width+$x];
	}
	
	function draw()
	{
		echo '<table>'.PHP_EOL;
		for ($y = 0; $y < $this->height; $y++)
		{
			echo '<tr>';
			for ($x = 0; $x < $this->width; $x++)
				echo '<td>'.($this[$y*$this->width+$x]??0).'</td>';
			echo '</tr>'.PHP_EOL;
		}
		echo '</table><br>';
	}

	function dump()
	{
		echo '<pre>';
		print_r($this);
		echo '</pre><br>';
	}

	function flip_vertical(array &$array)
	{
		$maxRow   =  count($array) - 1;
		$maxRowIt = (count($array)>>1) - 1;
		for ($row=0; $row<=$maxRowIt; ++$row)
		{
			$temp = $array[$row];
			$array[$row] = $array[$maxRow-$row];
			$array[$maxRow-$row] = $temp;
		}
		return true;
	}

	function flip_horizontal(array &$array)
	{
		$maxIter  = count($array)-1;
		for ($row=0; $row<=$maxIter; ++$row)
			$array[$row] = array_reverse($array[$row]);
		return true;
	}

	function flip_both(array &$array)
	{
		$maxRow   =  count($array) - 1;
		$maxRowIt = (count($array)>>1) - 1;
		for ($row=0; $row<=$maxRowIt; ++$row)
		{
			$temp = $array[$row];
			$array[$row] = array_reverse($array[$maxRow-$row]);
			$array[$maxRow-$row] = array_reverse($temp);
		}
		if (($maxRow&1) == 0)
			$array[$maxRowIt+1] = array_reverse($array[$maxRowIt+1]);
		return true;
	}
	
function transpose()
	{
		$temp = new Matrix($this->width, $this->height);
		$iter = new SplFixedArray($this->width*$this->height);
		for ($y = 0; $y < $this->width; $y++)
			for ($x = 0; $x < $this->height; $x++)
				$temp[$y*$this->height+$x] = $this[$x*$this->width+$y] ?? 0;
		
		$temp->draw();
		echo '<br>';
		for ($y = 0; $y < $this->width; $y++)
			for ($x = 0; $x < $this->height; $x++)
				if (!$iter[$y*$this->height+$x])
				{
					$first = $next = $y*$this->height+$x;
					$iter[$first] = true;
					echo $first;
//					echo $temp[$next];
					while (true)//$next != $first)
					{
//						echo $next.'&'.$temp[$next];
						$next = $temp[$next];
						echo '→'.$next;
						$iter[$next] = true;
						if ($next == $first)
							break;
					}
					echo '<br>';
				}
		echo '<br>';
		
	}
/*
	function antitranspose(array &$array)
	{
		return flip_both($array) && transpose($array);
	}

	function rotate_clockwise(array &$array)
	{
		return flip_vertical($array) && transpose($array);
	}

	function rotate_anticlockwise(array &$array)
	{
		return transpose($array) && flip_vertical($array);
	}*/

}

?>
