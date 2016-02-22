<?php

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

