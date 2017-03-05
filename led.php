<?php
	// Default IP
$ip="192.168.1.101";
	// Python script location
$script="/scripts/flux_led.py";
	// Set a password if you want some sort of security, leave blank for none.
$pw="";
	// Colors name (flux_led.py --listcolors )
$colors=array("aliceblue", "antiquewhite", "aqua", "aquamarine", "azure", "beige", "bisque", "black", "blanchedalmond", "blue", "blueviolet", "brown", "burlywood", "cadetblue", "chartreuse", "chocolate", "coral", "cornflowerblue", "cornsilk", "crimson", "darkblue", "darkcyan", "darkgoldenrod", "darkgray", "darkgreen", "darkkhaki", "darkmagenta", "darkolivegreen", "darkorange", "darkorchid", "darkred", "darksalmon", "darkseagreen", "darkslateblue", "darkslategray", "darkturquoise", "darkviolet", "deeppink", "deepskyblue", "dimgrey", "dodgerblue", "firebrick", "floralwhite", "forestgreen", "fuchsia", "gainsboro", "ghostwhite", "gold", "goldenrod", "gray", "green", "greenyellow", "grey", "honeydew", "hotpink", "indianred", "indigo", "ivory", "khaki", "lavender", "lavenderblush", "lawngreen", "lemonchiffon", "lightblue", "lightcoral", "lightcyan", "lightgoldenrodyellow", "lightgray", "lightgreen", "lightpink", "lightsalmon", "lightseagreen", "lightskyblue", "lightslategrey", "lightsteelblue", "lightyellow", "lime", "limegreen", "linen", "magenta", "maroon", "mediumaquamarine", "mediumblue", "mediumorchid", "mediumpurple", "mediumseagreen", "mediumslateblue", "mediumspringgreen", "mediumturquoise", "mediumvioletred", "midnightblue", "mintcream", "mistyrose", "moccasin", "navajowhite", "navy", "oldlace", "olive", "olivedrab", "orange", "orangered", "orchid", "palegoldenrod", "palegreen", "paleturquoise", "palevioletred", "papayawhip", "peachpuff", "peru", "pink", "plum", "powderblue", "purple", "red", "rosybrown", "royalblue", "saddlebrown", "salmon", "sandybrown", "seagreen", "seashell", "sienna", "silver", "skyblue", "slateblue", "slategray", "snow", "springgreen", "steelblue", "tan", "teal", "thistle", "tomato", "turquoise", "violet", "wheat", "white", "whitesmoke", "yellow", "yellowgreen");

	// code starts here
$gpwd="";
if (isset($_GET['pw'])){$gpwd=$_GET['pw'];}

if (isset($_GET['led'])&&$pw==$gpwd){
	$led=$_GET['led'];
	if (isset($_GET['ip'])){$ip=$_GET['ip'];}
	switch ($led){
		case ("on"):
			$cmd="--on";
			break;
		case ("off"):
			$cmd="--off";
			break;
		case ("warm"):
			$level="100";
			if (isset($_GET['level'])){$level=$_GET['level'];}
			$cmd="-w ".$level;
			break;
                case ("jump"):
                case ("gradual"):
                case ("strobe"):
			if (isset($_GET['color'])){
		       		$color=$_GET['color'];
				$speed="25";
	                	if (isset($_GET['speed'])){$speed=$_GET['speed'];}
				$cmd="-C ".$led." ".$speed." \"".$color."\"";
			}
                        break;
		default:
			if (in_array($led,$colors)){$cmd="-c ".$led;}
			break;
	}
	//echo $script." ".$ip." ".$cmd;
	echo exec($script." ".$ip." ".$cmd." 2>&1"); //remove <." 2>&1"> is you get errors in windows.
}
?>
