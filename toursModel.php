<?php 
include("functions.php");
class Tour 
{
	public $Id;
	public $Hotel;
	public $City;
	public $Stars;
	public $Cost;

	function __construct( )
	{
		 
	}
	function createObj($id,$h,$Cid,$s,$c){
		$t= new self();
		$t->Id=$id;
		$t->Hotel=$h;
		$t->City=$Cid;
		$t->Stars=$s;
		$t->Cost=$c;
		 
	 
		return $t;
	}
	function convertFromDb(){
		$entity=getHotels();
		$HotelsArr=[];
		while ($row=mysqli_fetch_array($entity))
	    {
		 
		#$tr=$this->createObj($row[0],$row[1],$row[2],$row[3],$row[4]);
		 
		array_push($HotelsArr, $this->createObj($row[0],$row[2],$row[1],$row[3],$row[4]));				 
		}
		return $HotelsArr;
	}
	function serialaiz(){
		 $hotels=$this->convertFromDb();
		 if(isset($hotels)){
		 	$str=serialize($hotels);
		 	file_put_contents('JSON.txt', $str);
		 	echo "done";
		 }
	}
	function deserialaiz(){
		$strpoint=file_get_contents('JSON.txt');
		#echo $strpoint.'<br/>';
		$p=unserialize($strpoint);
		 for ($i=0; $i <count($p) ; $i++) { 
		 	$p[$i]->show();
		 }

	}
	function show(){
		echo "<div>";
		echo "<p>"; 
		echo " Id=".$this->Id;
		echo " Hotel=".$this->Hotel;
		echo " Ucity=".$this->City;
		echo " Stars=".$this->Stars;
		echo " Cost=".$this->Cost;
		echo "</p>";
		echo "</div>";
	}
}
$t = new Tour;
echo "<h1>serialaize</h1>";

$t->serialaiz();
echo "<h1>deserialaize</h1>";
$t->deserialaiz();
?>