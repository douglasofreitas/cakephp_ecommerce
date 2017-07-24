<?php
uses('sanitize');
define('TEXT_IMAGE_PNG', 0);
define('TEXT_IMAGE_GIF', 1);
class FontImageComponent extends Object {
    var $fontFile = "hannoma.ttf";
    var $pointSize = 32;
    var $fgColor = array('r'=>0, 'g'=>0, 'b'=>0);
    var $bgColor = array('r'=>255, 'g'=>255, 'b'=>255);
    var $type = TEXT_IMAGE_PNG;    
    var $cache = -1;
    var $aliasing = false;
    var $softenFactor = 0;
    var $transparent = true;
	var $padTop = 0;
    var $padRight = 0;
    var $padBottom = 0;
    var $padLeft = 0;
    var $lineSpacing = 1.4;
    var $baseAlign = true;
    var $__fontPath = 'fonts';
    function image($text, $wrapWidth = 0)
    {             
        $ps = $this->pointSize;
        $top = $this->padTop;
        $bottom = $this->padBottom;
        $left = $this->padLeft;
        $right = $this->padRight;
        if ($this->softenFactor > 0)
        {
            $ps *= $this->softenFactor;
            $top *= $this->softenFactor;
            $bottom *= $this->softenFactor;
            $left *= $this->softenFactor;
            $right *= $this->softenFactor;
        }        
        $font = APP . $this->__fontPath . DS . $this->fontFile;
        if (!file_exists($font))
        {
            echo "font file not found: " . $font;
            return;
        }
        // extended parameters for gd/freetype
        $xtraParamArr = array('linespacing' => $this->lineSpacing);
        // do hard wrap if required
        $numLines = 1;
        if ($wrapWidth != 0)
        {
            $text = $this->__hardwrap($text, $wrapWidth, $this->pointSize, $font, $xtraParamArr);
            $numLines = count(explode("\n", $text));
        }
        // try to calculate an optimal image height
        // for this point size and font
        // by rendering a text with big ascenders and descenders
        $testText = "gyT§?_";
        if ($wrapWidth != 0)
        {
            $testText = implode("\n", array_fill(0, $numLines, $testText));
        }
        $maxSizeArr = imageftbbox($ps, 0, $font, $testText, $xtraParamArr);
        $minY = min($maxSizeArr[5], $maxSizeArr[7]);
        $maxY = max($maxSizeArr[1], $maxSizeArr[3]);    
        $fontHeight = $maxY - $minY; 
        $imageH = $fontHeight + $top + $bottom; 
        // calculate baseline using a string with big ascender
        $baselineArr  = imageftbbox($ps, 0, $font, "Ül", $xtraParamArr);
        $baselineY = (max($baselineArr[5], $baselineArr[7])) - $top;    
        // calculate image dimensions    
        $textSizeArr = imageftbbox($ps, 0, $font, $text, $xtraParamArr);
        // process image dimenstions
        $minX = min($textSizeArr[0], $textSizeArr[6]);
        $maxX = max($textSizeArr[2], $textSizeArr[4]);        
        $textW = ($maxX - $minX) + 2;
        if (!$this->baseAlign)
        {
            $minY = min($textSizeArr[5], $textSizeArr[7]);
            $maxY = max($textSizeArr[1], $textSizeArr[3]);
            $imageH = $maxY - $minY + $top + $bottom; 
            $baselineY = (max($textSizeArr[5], $textSizeArr[7])) - $top;
        }
        // make image
        $width = $textW; //max($wrapWidth, $textW);
        $width  += ($left + $right); 
        $im = imagecreatetruecolor($width, $imageH);
        // define colors 
        $backCol = imagecolorallocate($im, $this->bgColor['r'], $this->bgColor['g'], $this->bgColor['b']);
        if ($this->transparent)
        {
            //imagecolortransparent($im, $backCol);
			// Create the text colour with alpha transparency
			$alpha = imagecolorallocatealpha($im, 255, 255, 255, 127);
			//fill the background with the transparant colour
			imagefill($im, 0, 0, $alpha);
			//save the alpha transparency
			imagesavealpha($im, true);
        }
        else
        {
            imagefill($im, 0, 0, $backCol);
        }
        $textCol = imagecolorallocate ($im, $this->fgColor['r'], $this->fgColor['g'], $this->fgColor['b']);    
        // render text
        $col = $textCol;
        if ($this->aliasing)
        {
            $col = 0 - $col;
            if ($col == 0)
            {
                $col = -1;
            }
        }
        imagefttext($im, $ps, 0, (1-$minX) + $left, -1 - $baselineY,
            $col, $font,  $text,
            $xtraParamArr);    
        // create the PNG
		$tempFileName = 'img/'.uniqid('im', true).'.png';
		imagepng($im, $tempFileName);
		$imageData = file_get_contents($tempFileName);
		$encodedImageData = 'data:image/png;base64,' . base64_encode($imageData);
		unlink($tempFileName);
		//destroy the $im from the memory
		imagedestroy($im);
		return $encodedImageData;
    }
    /**
    *
    */
    function setFontPath($fontPath)
    {
        $this->__fontPath = $fontPath;
    }
    /**
     * Set the point size to render at
     */
    function setPointSize($pointSize)
    {
        $this->pointSize = $pointSize / 96 * 72;
    }
    /**
     * Set the foreground color for the images in hex e.g. 0xFF0000
     */
    function setColor($color)
    {
        $rgb = hexdec($color);
        $this->fgColor['r'] = ($rgb & 0xFF0000) >> 16;
        $this->fgColor['g'] = ($rgb & 0xFF00) >> 8;
        $this->fgColor['b'] = ($rgb & 0xFF);
    }
    /**
     * Set the background color for the images in hex e.g. 0xCCCCCC
     */
    function setBgColor($color)
    {
        $rgb = hexdec($color);
        $this->bgColor['r'] = ($rgb & 0xFF0000) >> 16;
        $this->bgColor['g'] = ($rgb & 0xFF00) >> 8;
        $this->bgColor['b'] = ($rgb & 0xFF);
    }    
	    /**
     * Set pixel padding around the rendered text
     * useful if clipping is occurring
     */
    function setPadding($top, $right, $bottom, $left)
    {
        $this->padTop = $top;
        $this->padRight = $right;
        $this->padBottom = $bottom;
        $this->padLeft = $left;
    }
    /**
    * wrap a text for a specific width
    * inserts hard returns into the returned string
    */
    function __hardwrap($text, $wrapWidth, $ptSize, $font, $xtraParamArr)
    { 
		$result = "";
		// calculate the width of one character
		$bbox = imageftbbox($ptSize, 0, $font, "的一是不了人我在有他这中大来上", $xtraParamArr);
		$left = ($bbox[0] > $bbox[6])?$bbox[6]:$bbox[0];
		$right = ($bbox[2] > $bbox[4])?$bbox[2]:$bbox[4];
		$totalWidth = $right - $left;
		$singleWidth = $totalWidth/15;
		// calculate how many characters fit
		$n = floor($wrapWidth/$singleWidth);
        // break lines into an array
		$textArray = explode("\r", $text);
		// wrap each line
		for($i = 0; $i < count($textArray); $i++) 	{
			//Check if there is just one character just after the line break
			$chunk_n = mb_chunk_split($textArray[$i], $n, "\n");
			$chunk_n1 = mb_chunk_split($textArray[$i], $n+1, "\n");
			$justOne = substr_count($chunk_n, "\n") != substr_count($chunk_n1, "\n");
			if($justOne) {
				$result .= $chunk_n1;
			}else{
				$result .= $chunk_n;
			}
		}
        return $result;
    }    
}
	//multibyte safe way to chunk_split
	function mb_chunk_split($str, $len, $glue) {
		if (empty($str)) return false;
		$array = mbStringToArray ($str);
		$n = 0;
		$new = '';
		foreach ($array as $char) {
			if ($n < $len) $new .= $char;
			elseif ($n == $len) {
				$new .= $glue . $char;
				$n = 0;
			}
			$n++;
		}
		return $new;
	}
	function mbStringToArray ($str) {
		if (empty($str)) return false;
		$len = mb_strlen($str);
		$array = array();
		for ($i = 0; $i < $len; $i++) {
			$array[] = mb_substr($str, $i, 1);
		}
		return $array;
	}
?>
