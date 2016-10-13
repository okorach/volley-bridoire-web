<?
// Configuration de chrisGallery
// Indiquer le dossier contenant les images avec un slash a la fin
$cheminPhotos = "photos/";
// Indiquer les formats autorises separes par un espace
$formats = "jpg gif png swf";

// Variables
$compteur=0;
$reponse = "";

$myDir = dir($cheminPhotos);

while($entry = $myDir->read()){
	if($entry != "." and $entry != ".."){
		$x = strpos($entry,".")+1;
		$suf = substr($entry,$x,3);
		if(eregi($suf,$formats)){
			$compteur++;
			$entry = substr($entry,0,strlen($entry));
			$reponse .= trim($entry).":";
		}
	}
}
$myDir->close();

$reponse = substr($reponse,0,strlen($entry)-1);
echo "compteur=$compteur&reponse=$reponse&chemin=$cheminPhotos&done=done";

?>