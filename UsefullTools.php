<?php 


class UsefullTools
{
	public static function getHtmlFromUrl($url)
	{
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $html = curl_exec($ch);
        curl_close($ch);
        return $html;
	} 
}

 ?>