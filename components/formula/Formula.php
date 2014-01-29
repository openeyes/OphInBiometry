<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 1/28/14
 * Time: 5:05 PM
 * To change this template use File | Settings | File Templates.
 */

interface Formula
{
	public function getSuggestedPower();
	public function PowerFor($lensPower);
	public function GetName();
	public function getAConstant();
	public function getPersonalized();
	public function getSpecialAConstants();
}








