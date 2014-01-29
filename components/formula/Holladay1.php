<?php

class Holladay1 implements Formula {

	private $r;
	private $Alm;
	private $AL;
	private $RefTgt;
	private $SF;
	private $ACD;
	private $BF8;
	private $BF7;
	private $AG;
	private $Rag;
	const na = 1.336;
	private $nc_1;

	public function Holladay1($Measurements, $Constants, $Personalized, $TargetRefraction)
	{
		$this->nc_1 = 1.0/3.0;
		$this->r = $Measurements->GetKsForIOLCalculations()->Radius;
		$this->AL = $Measurements->AxialLength;
		$this->RefTgt = $TargetRefraction;
		$this->SF = $Constants->SF;
		$this->Alm = $this->AL + 0.2;
		$this->Rag = $this->r < 7.0 ? 7.0 : $this->r;
		$this->AG = (12.5 * $this->AL / 23.45 > 13.5) ? 13.5 : 12.5 * $this->AL / 23.45;
		$this->BF7 = ($this->Rag * $this->Rag - ($this->AG * $this->AG / 4.0));
		$this->BF8 = sqrt($this->BF7);
		$this->ACD = 0.56 + $this->Rag - $this->BF8;
		$this->AConstant = $Constants->AConstant;
		$this->Personalized = $Personalized;
	}

	public function GetName()
	{
		return "Holladay 1";
	}


	public function getSuggestedPower()
	{
		$Numerator = (1000.0 * $this->na * ($this->na * $this->r - $this->nc_1 * $this->Alm - 0.001 * $this->RefTgt * (12.0 * ($this->na * $this->r - $this->nc_1 * $this->Alm) + $this->Alm * $this->r)));
		$Denominator = (($this->Alm - $this->ACD - $this->SF) * ($this->na * $this->r - $this->nc_1 * ($this->ACD + $this->SF) - 0.001 * $this->RefTgt * (12.0 * ($this->na * $this->r - $this->nc_1 * ($this->ACD + $this->SF)) + ($this->ACD + $this->SF) * $this->r)));
		return $Numerator / $Denominator;
	}


	public function PowerFor($LensPower)
	{
		if (isset($LensPower))
		{
			$Numerator = (1000.0 * $this->na * ($this->na * $this->r - ($this->nc_1) * $this->Alm) - $this->LensPower * ($this->Alm - $this->ACD - $this->SF) * ($this->na * $this->r - ($this->nc_1) * ($this->ACD + $this->SF)));
			$Denominator = ($this->na * (12.0 * ($this->na *$this->r - ($this->nc_1) * $this->Alm) + $this->Alm * $this->r) - 0.001 * $this->LensPower * ($this->Alm - $this->ACD - $this->SF) * (12.0 * ($this->na * $this->r - ($this->nc_1) * ($this->ACD + $this->SF)) + ($this->ACD + $this->SF) * $this->r));
			return $Numerator / $Denominator;
		}
		else
			return null;
	}



	public function getAConstant()
	{
	}

	public function setAConstant()
	{
	}


	public function getPersonalized()
	{

	}

	public function setPersonalized()
	{

	}

	public function getSpecialAConstants()
	{
		return false;

	}


}
