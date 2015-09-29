<?php

// This is "On the Fly Thumbnailer with Caching Option" by Pallieter Koopmans.
// Based on Marcello Colaruotolo (1.5.1) which builds upon Nathan Welch (1.5)
// and Roberto Ghizzi. With improvements by @Quest WebDesign, http://atQuest.nl/
//
// Scales product images dynamically, resulting in smaller file sizes, and keeps
// proper image ratio.
//
// Used in conjunction with modified tep_image in html_output.php (see: readme.txt).
//
// CONFIGURATION SETTINGS
//
// Use Resampling? Set the value below to true to generate resampled thumbnails
// resulting in smoother-looking images. Not supported in GD ver. < 2.01
$use_resampling = true;
//
// Create True Color Thumbnails? Better quality overall but set to false if you
// have GD version < 2.01 or if creating transparent thumbnails.
$use_truecolor = true;
//
// Output GIFs as JPEGS? Set this option to true if you have GD version > 1.6
// and want to output GIF thumbnails as JPGs instead of GIFs or PNGs. Note that your
// GIF transparencies will not be retained in the thumbnail if you output them
// as JPGs. If you have GD Library < 1.6 with GIF create support, GIFs will
// be output as GIFs. Set the "matte" color below if setting this option to true.
$gif_as_jpeg = false;
//
// Cache Images? Set to true if you want to create cached images for each thumbnail.
// This will add to disk space but will save your processor from having to create
// the thumbnail for every visitor.
$tn_cache = true;
//
// Define RGB Color Value for background matte color if outputting GIFs as JPEGs
// Example: white is r=255, b=255, g=255; black is r=0, b=0, g=0; red is r=255, b=0, g=0;
$r = 255; // Red color value (0-255)
$g = 255; // Green color value (0-255)
$b = 255; // Blue color value (0-255)
//
// Allow the creation of thumbnail images that are larger than the original images:
$allow_larger = false; // The default is false.
// If allow_larger is set to false, you can opt to output the original image:
// Better leave it true if you want pixel_trans_* to work as expected
$show_original = true; // The default is true.
//
// END CONFIGURATION SETTINGS

// Note: In order to manually debug this script, you might want to comment
// the three header() lines -- otherwise no output is shown.

//$_GET=$HTTP_GET_VARS;

if ($_GET['img']!='') $_GET['img']=''.$_GET['img'];

// Get the size of the image:
$image = @getimagesize($_GET['img']);

$new_img = $_GET['h'] / $_GET['w'];
$h1 = $_GET['h'];
$w1 = $_GET['w'];

// Check the input variables and decide what to do:
if (empty($image) || empty($_GET['w']) || empty($_GET['h']) || (empty($allow_larger) && ($_GET['w'] > $image[0] || $_GET['h'] > $image[1])))
{
	if (empty($image) || empty($show_original))
	{
		// Originally a simple return was given, now we show an error image:
		header('Content-type: image/jpeg');
		$src = imagecreate(75, 150); // Create a blank image
		$bgc = imagecolorallocate($src, 255, 255, 255);
		$tc  = imagecolorallocate($src, 0, 0, 0);
		imagefilledrectangle($src, 0, 0, 75, 150, $bgc);
		imagestring($src, 1, 5, 5, 'Error', $tc);
		imagejpeg($src, '', 100);
		exit();
		// return;
        
	}else{
        
		// 2Do: Return the original image w/o making a copy (as that is what we currently do):
		//$_GET['w'] = $image[0];
		//$_GET['h'] = $image[1];
        /*
        if ($image[1] > $image[0])
        {    
            $ratio = $image[1] / $image[0];
            $_GET['w'] = $h1 * $ratio;
        }
        
        if ($image[1] < $image[0])
        {
            $ratio = $image[1] / $image[0];
            $_GET['h'] = $w1 * $ratio;
        }
         * 
         */
    }

}
$srcW = $image[0];
$srcH = $image[1];
$rate = $srcH / $srcW;
if (isset($_GET['crop'])){
    $rate = $_GET['h'] / $_GET['w'];
    $srcW = $image[0];
    $srcH = $image[0] * $rate;
    $newW = $_GET['w'];
    $newH = $_GET['h'];
}else{
    if ($srcW > $srcH){
        if ($rate > ($_GET['h'] / $_GET['w'])){
            $rate = $srcW / $srcH;
            $newH = $_GET['h'];
            $newW = $newH * $rate;
        }else{
            $newW = $_GET['w'];
            $newH = $newW * $rate;
        }
    }else{
        $rate = $srcH / $srcW;
        $newH = $_GET['h'];
        $newW = $newH / $rate;
    }
}
/*
echo "srcH: $srcH<br/>";
echo "scrW: $srcW<br/>";
echo "rate: $rate<br/>";
echo "newH: $newH<br/>";
echo "newW: $newW<br/>";
exit;
//echo $image[0] ;
/*
if  ( $image[0] > $_GET['h']){
		   $ratio = $image[1]/$_GET['h']; 
		   $_GET['w'] =   round($image[0]/$ratio);
		   $_GET['h'] = $_GET['h'];
}

//echo $image[1] ;
if ( $image[1] > $_GET['w']){
			$ratio = $image[0]/$_GET['w']; 
			$_GET['w'] =  $_GET['w']; 
			$_GET['h'] = round($image[1]/$ratio); 
}
*/
// Create appropriate image header:
$name = $_GET['img'] . '.thumb_' . $_GET['w'] . 'x' . $_GET['h'];
if (isset($_GET['crop'])){
    $name .= '_crop';
}
if ($image[2] == 2 || ($image[2] == 1 && $gif_as_jpeg))
{
	header('Content-type: image/jpeg');
	if ($tn_cache) $filename = $name.'.jpg';
}
elseif ($image[2] == 1 && function_exists('imagegif'))
{
	header('Content-type: image/gif');
	if ($tn_cache) $filename = $name.'.gif';
}
elseif ($image[2] == 3 || $image[2] == 1)
{
	header('Content-type: image/png');
	if ($tn_cache) $filename = $name.'.png';
}

// If you are required to set the full path for file_exists(), set this:
// $filename = '/your/path/to/catalog/'.$filename;


if (file_exists($filename) && $tn_cache && filemtime($filename) > filemtime($_GET['img']))
{
	if ($image[2] == 2 || ($image[2] == 1 && $gif_as_jpeg))
	{
		$src = imagecreatefromjpeg($filename);
		imagejpeg($src, '', 100);
	}
	elseif ($image[2] == 1 && function_exists('imagegif'))
	{
		$src = imagecreatefromgif($filename);
		imagegif($src);
	}
	elseif ($image[2] == 3 || $image[2] == 1)
	{
		$src = imagecreatefrompng($filename);
		imagepng($src);
	}
	else
	{
		$src = imagecreate($_GET['w'], $_GET['h']); // Create a blank image
		$bgc = imagecolorallocate($src, 255, 255, 255);
		$tc  = imagecolorallocate($src, 0, 0, 0);
		imagefilledrectangle($src, 0, 0, $_GET['w'], $_GET['h'], $bgc);
		imagestring($src, 1, 5, 5, 'Error', $tc);
		imagejpeg($src, '', 100);
		exit();
	}
}
else
{
	// Create a new, empty image based on settings:
	if (function_exists('imagecreatetruecolor') && $use_truecolor && ($image[2] == 2 || $image[2] == 3))
	{
		$tmp_img = imagecreatetruecolor($newW,$newH);
	}
	else
	{
		$tmp_img = imagecreate($newW,$newH);
	}

	$th_bg_color = imagecolorallocate($tmp_img, $r, $g, $b);

	imagefill($tmp_img, 0, 0, $th_bg_color);
	imagecolortransparent($tmp_img, $th_bg_color);

	// Create the image to be scaled:
	if ($image[2] == 2 && function_exists('imagecreatefromjpeg'))
	{
		$src = imagecreatefromjpeg($_GET['img']);
	}
	elseif ($image[2] == 1 && function_exists('imagecreatefromgif'))
	{
		$src = imagecreatefromgif($_GET['img']);
	}
	elseif (($image[2] == 3 || $image[2] == 1) && function_exists('imagecreatefrompng'))
	{
		$src = imagecreatefrompng($_GET['img']);
	}
	else
	{
		$src = imagecreate($_GET['w'], $_GET['h']); // Create a blank image.
		$bgc = imagecolorallocate($src, 255, 255, 255);
		$tc  = imagecolorallocate($src, 0, 0, 0);
		imagefilledrectangle($src, 0, 0, $_GET['w'], $_GET['h'], $bgc);
		imagestring($src, 1, 5, 5, 'Error', $tc);
		imagejpeg($src, '', 100);
		exit();
	}

	// Scale the image based on settings:
	if (function_exists('imagecopyresampled') && $use_resampling)
	{
		imagecopyresampled($tmp_img, $src, 0, 0, 0, 0, $newW, $newH, $srcW, $srcH);
	}
	else
	{
		imagecopyresized($tmp_img, $src, 0, 0, 0, 0, $newW, $newH, $srcW, $srcH);
	}

	// Output the image:
    
    
	if ($image[2] == 2 || ($image[2] == 1 && $gif_as_jpeg))
	{
		imagejpeg($tmp_img, '', 100);
		if ($tn_cache) imagejpeg($tmp_img,$name.'.jpg', 100);
	}
	elseif ($image[2] == 1 && function_exists('imagegif'))
	{
		imagegif($tmp_img);
		if ($tn_cache) imagegif($tmp_img,$name.'.gif');
	}
	elseif ($image[2] == 3 || $image[2] == 1)
	{
		imagepng($tmp_img);
		if ($tn_cache) imagepng($tmp_img,$name.'.png');
	}
	else
	{
		$src = imagecreate($_GET['w'], $_GET['h']); // Create a blank image.
		$bgc = imagecolorallocate($src, 255, 255, 255);
		$tc  = imagecolorallocate($src, 0, 0, 0);
		imagefilledrectangle($src, 0, 0, $_GET['w'], $_GET['h'], $bgc);
		imagestring($src, 1, 5, 5, 'Error', $tc);
		imagejpeg($src, '', 100);
		exit();
	}

	// Clear the image from memory:
	imagedestroy($src);
	imagedestroy($tmp_img);
}

?>