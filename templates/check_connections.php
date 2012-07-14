<?php
#
# Copyright (c) 2012 Naoya Hashimoto(mrhashnao@gmail.com) (https://github.com/hashnao/pnp4nagios/tree/master/templates)
# Plugin: check_connection
#
$ds_name[1] = "$NAGIOS_AUTH_SERVICEDESC";
$opt[1] = "--vertical-label \"$UNIT[1]\" --title \"$hostname / $servicedesc\" ";

$def[1]  = rrd::def("var1", $RRDFILE[1], $DS[1], "AVERAGE");
$def[1] .= rrd::def("var2", $RRDFILE[2], $DS[2], "AVERAGE");
$def[1] .= rrd::def("var3", $RRDFILE[3], $DS[3], "AVERAGE");
$def[1] .= rrd::def("var4", $RRDFILE[4], $DS[4], "AVERAGE");
$def[1] .= rrd::def("var5", $RRDFILE[5], $DS[5], "AVERAGE");
$def[1] .= rrd::def("var6", $RRDFILE[6], $DS[6], "AVERAGE");
$def[1] .= rrd::def("var7", $RRDFILE[7], $DS[7], "AVERAGE");
$def[1] .= rrd::def("var8", $RRDFILE[8], $DS[8], "AVERAGE");
$def[1] .= rrd::def("var9", $RRDFILE[9], $DS[9], "AVERAGE");
$def[1] .= rrd::def("var10", $RRDFILE[10], $DS[10], "AVERAGE");
$def[1] .= rrd::def("var11", $RRDFILE[11], $DS[11], "AVERAGE");
$def[1] .= rrd::def("var12", $RRDFILE[12], $DS[12], "AVERAGE");
$def[1] .= rrd::def("var13", $RRDFILE[13], $DS[13], "AVERAGE");
$def[1] .= rrd::def("var14", $RRDFILE[14], $DS[14], "AVERAGE");
$def[1] .= rrd::def("var18", $RRDFILE[18], $DS[18], "AVERAGE");
$def[1] .= rrd::def("var20", $RRDFILE[20], $DS[20], "AVERAGE");

if ($WARN[1] != "") {
    $def[1] .= "HRULE:$WARN[1]#FFFF00 ";
}
if ($CRIT[1] != "") {
    $def[1] .= "HRULE:$CRIT[1]#FF0000 ";       
}

$def[1] .= rrd::line1("var1", "#FFFF00", "$NAME[1]") ; 
$def[1] .= rrd::gprint("var1", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line1("var2", "#CC0000", "$NAME[2]") ; 
$def[1] .= rrd::gprint("var2", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line1("var3", "#6600CC", "$NAME[3]") ; 
$def[1] .= rrd::gprint("var3", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line1("var4", "#00CC66", "$NAME[4]") ; 
$def[1] .= rrd::gprint("var4", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line1("var5", "#00CCCC", "$NAME[5]") ; 
$def[1] .= rrd::gprint("var5", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line1("var6", "#CCCC00", "$NAME[6]") ; 
$def[1] .= rrd::gprint("var6", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line1("var7", "#00FFFF", "$NAME[7]") ; 
$def[1] .= rrd::gprint("var7", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line1("var8", "#006666", "$NAME[8]") ; 
$def[1] .= rrd::gprint("var8", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line1("var9", "#660066", "$NAME[9]") ; 
$def[1] .= rrd::gprint("var9", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line1("var10", "#0000FF", "$NAME[10]") ; 
$def[1] .= rrd::gprint("var10", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line1("var11", "#00FF00", "$NAME[11]") ; 
$def[1] .= rrd::gprint("var11", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line1("var12", "#6600FF", "$NAME[12]") ; 
$def[1] .= rrd::gprint("var12", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line1("var13", "#CC6600", "$NAME[13]") ; 
$def[1] .= rrd::gprint("var13", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line1("var14", "#ff9999", "$NAME[14]") ; 
$def[1] .= rrd::gprint("var14", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line1("var18", "#0000FF", "$NAME[18]") ; 
$def[1] .= rrd::gprint("var18", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line1("var20", "#FF6600", "$NAME[20]") ; 
$def[1] .= rrd::gprint("var20", array("LAST", "AVERAGE", "MAX"), "%6.2lf");


$opt[2] = "--vertical-label \"$UNIT[1]\" --title \"$hostname / $servicedesc\" ";
$def[2]  = rrd::def("var15", $RRDFILE[15], $DS[15], "AVERAGE");
$def[2] .= rrd::def("var16", $RRDFILE[16], $DS[16], "AVERAGE");
$def[2] .= rrd::def("var17", $RRDFILE[17], $DS[17], "AVERAGE");
$def[2] .= rrd::def("var19", $RRDFILE[19], $DS[19], "AVERAGE");

$def[2] .= rrd::line1("var15", "#000000", "$NAME[15]") ; 
$def[2] .= rrd::gprint("var15", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[2] .= rrd::line1("var16", "#00FF00", "$NAME[16]") ; 
$def[2] .= rrd::gprint("var16", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[2] .= rrd::line1("var17", "#0000FF", "$NAME[17]") ; 
$def[2] .= rrd::gprint("var17", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[2] .= rrd::line1("var19", "#FF6600", "$NAME[19]") ; 
$def[2] .= rrd::gprint("var19", array("LAST", "AVERAGE", "MAX"), "%6.2lf");

if ($WARN[1] != "") {
    $def[2] .= "HRULE:$WARN[1]#FFFF00 ";
}
if ($CRIT[1] != "") {
    $def[2] .= "HRULE:$CRIT[1]#FF0000 ";       
}

?>

