<?php
#
# Copyright (c)  2010 Yannig Perre (http://lesaventuresdeyannigdanslemondeit.blogspot.com)
# Revised Naoya Hashimoto(mrhashnao@gmail.com) (https://github.com/hashnao/pnp4nagios/tree/master/templates)
# Plugin: check_cpu
#
$ds_name[1] = "$NAGIOS_AUTH_SERVICEDESC";
$opt[1] = "--vertical-label $UNIT[1] --title \"$hostname / $servicedesc\" --upper-limit 100 --lower-limit 0";

$trend_array = array(
  "one_month"    => array(strtotime("-1 month", $this->TIMERANGE['end']), $this->TIMERANGE['end'], "1 month trend:dashes=10", "#FF007F", "line3"),
  "global_trend" => array($this->TIMERANGE['start'], $this->TIMERANGE['end'], "Global trend\\n:dashes=20", "#707070", "line2"),
);

$def[1] =  rrd::def("var1", $RRDFILE[1], $DS[1]);
$def[1] .= rrd::def("var2", $RRDFILE[2], $DS[2]);
$def[1] .= rrd::def("var3", $RRDFILE[3], $DS[3]);
$def[1] .= rrd::def("var4", $RRDFILE[4], $DS[4]);

$trends_graphic = "";

foreach(array_keys($trend_array) as $trend) {
  $def[1] .= rrd::def("var1$trend", $RRDFILE[1], $DS[1], "AVERAGE:start=".$trend_array[$trend][0]);
  $def[1] .= rrd::def("var2$trend", $RRDFILE[2], $DS[2], "AVERAGE:start=".$trend_array[$trend][0]);
  $def[1] .= rrd::cdef("user$trend", "var2$trend,var1$trend,+");

  $def[1] .= rrd::vdef("dtrend$trend", "user$trend,LSLSLOPE");
  $def[1] .= rrd::vdef("htrend$trend", "user$trend,LSLINT");
  $def[1] .= rrd::cdef("curve_user$trend", "user$trend,POP,dtrend$trend,COUNT,*,htrend$trend,+");
  $trends_graphic .= rrd::$trend_array[$trend][4]("curve_user$trend", $trend_array[$trend][3], $trend_array[$trend][2]);
}

if ($WARN[1] != "") {
    $def[1] .= rrd::hrule($WARN[1], "#FFFF00");
}
if ($CRIT[1] != "") {
    $def[1] .= rrd::hrule($CRIT[1], "#FF0000");
}

$def[1] .= rrd::area("var4", "#EACC00", "idle");
$def[1] .= rrd::gprint("var4", "LAST", " %6.2lf");
$def[1] .= rrd::gprint("var4", "AVERAGE", "%6.2lf");
$def[1] .= rrd::gprint("var4", "MAX", "max %6.2lf\\n");
$def[1] .= rrd::area("var1", "#0000FF", "user");
$def[1] .= rrd::gprint("var1", "LAST", "%6.2lf");
$def[1] .= rrd::gprint("var1", "AVERAGE", "avg %6.2lf");
$def[1] .= rrd::gprint("var1", "MAX", "max %6.2lf\\n");
$def[1] .= rrd::area("var2", "#ff0000", "system");
$def[1] .= rrd::gprint("var2", "LAST", "%6.2lf");
$def[1] .= rrd::gprint("var2", "AVERAGE", "avg %6.2lf");
$def[1] .= rrd::gprint("var2", "MAX", "max %6.2lf\\n");
$def[1] .= rrd::area("var3", "#00FF00", "iowait");
$def[1] .= rrd::gprint("var3", "LAST", "%6.2lf");
$def[1] .= rrd::gprint("var3", "AVERAGE", "avg %6.2lf");
$def[1] .= rrd::gprint("var3", "MAX", "max %6.2lf\\n");
?>
