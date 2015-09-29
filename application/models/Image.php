<?php
class Model_Image{
    protected static $defaultImg = 'img/defaultImg.jpg';
    
    public static function getUrl($src_img, $w, $h, $crop = false){
        $src_img = 'img/apartments/' . $src_img;
        
        $use_resampling = true;
        $use_truecolor = true;
        $gif_as_jpeg = false;
        $tn_cache = true;
        $r = 255; // Red color value (0-255)
        $g = 255; // Green color value (0-255)
        $b = 255; // Blue color value (0-255)
        $allow_larger = true; // The default is false.

        $image = @getimagesize($src_img);
        
        if (empty($image) || empty($w) || empty($h) || (empty($allow_larger) && ($w > $image[0] || $h > $image[1]))){
            $src_img = self::$defaultImg;
            $image = @getimagesize($src_img);
        }
        $srcW = $image[0];
        $srcH = $image[1];
        $rate = $srcH / $srcW;
        if (isset($crop)){
            $rate = $h / $w;
            $srcW = $image[0];
            $srcH = $image[0] * $rate;
            $newW = $w;
            $newH = $h;
        }else{
            if ($srcW > $srcH){
                if ($rate > ($h / $w)){
                    $rate = $srcW / $srcH;
                    $newH = $h;
                    $newW = $newH * $rate;
                }else{
                    $newW = $w;
                    $newH = $newW * $rate;
                }
            }else{
                $rate = $srcH / $srcW;
                $newH = $h;
                $newW = $newH / $rate;
            }
        }

        $name = $src_img . '.thumb_' . $w . 'x' . $h;
        if ($crop){
            $name .= '_crop';
        }
        if ($image[2] == 2 || ($image[2] == 1 && $gif_as_jpeg)){
            if ($tn_cache) 
                $filename = $name.'.jpg';
        }elseif ($image[2] == 1 && function_exists('imagegif')){
            if ($tn_cache) 
                $filename = $name.'.gif';
        }elseif ($image[2] == 3 || $image[2] == 1){
            if ($tn_cache) 
                $filename = $name.'.png';
        }

        if (file_exists($filename) && $tn_cache && filemtime($filename) > filemtime($src_img)){
            return '/' . $filename;
        }else{
            if (function_exists('imagecreatetruecolor') && $use_truecolor && ($image[2] == 2 || $image[2] == 3)){
                $tmp_img = imagecreatetruecolor($newW,$newH);
            }else{
                $tmp_img = imagecreate($newW,$newH);
            }
            $th_bg_color = imagecolorallocate($tmp_img, $r, $g, $b);
            imagefill($tmp_img, 0, 0, $th_bg_color);
            imagecolortransparent($tmp_img, $th_bg_color);
            if ($image[2] == 2 && function_exists('imagecreatefromjpeg')){
                $src = imagecreatefromjpeg($src_img);
            }elseif ($image[2] == 1 && function_exists('imagecreatefromgif')){
                $src = imagecreatefromgif($src_img);
            }elseif (($image[2] == 3 || $image[2] == 1) && function_exists('imagecreatefrompng')){
                $src = imagecreatefrompng($src_img);
            }
            if (function_exists('imagecopyresampled') && $use_resampling){
                imagecopyresampled($tmp_img, $src, 0, 0, 0, 0, $newW, $newH, $srcW, $srcH);
            }else{
                imagecopyresized($tmp_img, $src, 0, 0, 0, 0, $newW, $newH, $srcW, $srcH);
            }
            if ($image[2] == 2 || ($image[2] == 1 && $gif_as_jpeg)){
                if ($tn_cache) 
                    imagejpeg($tmp_img, $name.'.jpg', 100);
                return '/' . $name . '.jpg';
            }elseif ($image[2] == 1 && function_exists('imagegif')){
                if ($tn_cache) 
                    imagegif($tmp_img, $name.'.gif');
                return '/' . $name . '.gif';
            }elseif ($image[2] == 3 || $image[2] == 1){
                if ($tn_cache) 
                    imagepng($tmp_img, $name.'.png');
                return '/' . $name . '.png';
            }
            return '/' . self::$defaultImg;
            imagedestroy($src);
            imagedestroy($tmp_img);
        }
    }
}