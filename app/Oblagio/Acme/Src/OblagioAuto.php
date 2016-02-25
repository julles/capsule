<?php
/**
 * Author : Muhamad Reza Abdul Rohim <reza.wikrama3@gmail.com>
 * 
 * CV Oblagio Berdaya
 * 
 * Helper Core Oblagio Class
 * 
 */
function og()
{
	return new App\Oblagio\Acme\Src\Oblagio;
}

function oblagioRandom()
{
	return og()->oblagioRandom();
}

function contentsPath($url="")
{
	return og()->contentsPath.$url;
}

function assetContents($url)
{
	return og()->assetUrl.'contents/'.$url;
}

function menuAttribute($permalink = "")
{
	return og()->getMenuAttribute($permalink);
}

function menuAttributeFind($id)
{
	return og()->getMenuAttributeFind($id);
}

function actionAttribute($permalink = "")
{
	return og()->getActionAttribute($permalink);
}

function user()
{
	return og()->user();
}

function carbonParse($parse,$format)
{
	return og()->carbon()->parse($parse)->format($format);
}