<?php
#
# Copyright (c) 2012 Forschooner,Inc. Naoya Hashimoto (https://svn.forschooner.net/config/pnp4nagios/share/templates/)
# Plugin: check_http
#
$ds_name[1] = "$NAGIOS_AUTH_SERVICEDESC";
$opt[1] = "--vertical-label \"$UNIT[1]\" --title \"$hostname / $servicedesc\" ";
$def[1]  = rrd::def("var1", $RRDFILE[1], $DS[1], "AVERAGE");

if ($WARN[1] != "") {
    $def[1] .= "HRULE:$WARN[1]#FFFF00 ";
}
if ($CRIT[1] != "") {
    $def[1] .= "HRULE:$CRIT[1]#FF0000 ";       
}
$def[1] .= rrd::line1("var1", "#00FF00", "$NAME[1]") ;
$def[1] .= rrd::gprint("var1", array("LAST", "AVERAGE", "MAX"), "%6.2lf");

$opt[2] = "--vertical-label \"$UNIT[2]\" --title \"$hostname / $servicedesc\" ";
$def[2]  = rrd::def("var1", $RRDFILE[2], $DS[2], "AVERAGE");

if ($WARN[2] != "") {
    $def[2] .= "HRULE:$WARN[2]#FFFF00 ";
}
if ($CRIT[2] != "") {
    $def[2] .= "HRULE:$CRIT[2]#FF0000 ";       
}
$def[2] .= rrd::area("var1", "#00FF00", "$NAME[2]") ;
$def[2] .= rrd::gprint("var1", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
?>
