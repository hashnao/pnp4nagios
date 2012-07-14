<?php
#
# Copyright (c) 2012 Forschooner,Inc. Naoya Hashimoto (https://svn.forschooner.net/config/pnp4nagios/share/templates/)
# Plugin: check_postgres
#
$def[1] = "";
$opt[1] = "";

$defcnt = 1;

$colors['response'] = "00FF00";
$colors['number'] = "c6c6c6";
$colors['rate'] = "e5ca44";
$colors['ratenow'] = "00FF00";

foreach ($DS as $i) {
    $warning = ($WARN[$i] != "") ? $WARN[$i] : "";
    $warnmin = ($WARN_MIN[$i] != "") ? $WARN_MIN[$i] : "";
    $warnmax = ($WARN_MAX[$i] != "") ? $WARN_MAX[$i] : "";
    $critical = ($CRIT[$i] != "") ? $CRIT[$i] : "";
    $critmin = ($CRIT_MIN[$i] != "") ? $CRIT_MIN[$i] : "";
    $critmax = ($CRIT_MAX[$i] != "") ? $CRIT_MAX[$i] : "";
    $minimum = ($MIN[$i] != "") ? $MIN[$i] : "";
    $maximum = ($MAX[$i] != "") ? $MAX[$i] : "";

    if(preg_match('/^time$/', $NAME[$i])) {
        $ds_name[$defcnt] = "$NAME[$i]";
        $opt[$defcnt] = "--vertical-label \"$UNIT[$i]\" --title \"$hostname / $servicedesc\" ";
        $def[$defcnt] = "";
        $def[$defcnt] .= "DEF:connectiontime=$RRDFILE[$i]:$DS[$i]:AVERAGE:reduce=LAST " ;
        $def[$defcnt] .= "LINE1:connectiontime#".$colors['response'].":\" \" ";
        $def[$defcnt] .= "VDEF:vconnetiontime=connectiontime,LAST " ;
        $def[$defcnt] .= "GPRINT:vconnetiontime:\"$NAME[$i] %3.2lf\\n\" ";
        $defcnt++;
    }
    if(preg_match('/^replay_delay$/', $NAME[$i])) {
        $ds_name[$defcnt] = "$NAME[$i]";
        $opt[$defcnt] = "--vertical-label \"$UNIT[$i]\" --title \"$hostname / $servicedesc\" ";
        $def[$defcnt] = "";
        $def[$defcnt] .= "DEF:replaydelay=$RRDFILE[$i]:$DS[$i]:AVERAGE:reduce=LAST " ;
        $def[$defcnt] .= "LINE:replaydelay#".$colors['rate'].":\" \" ";
        $def[$defcnt] .= "VDEF:vreplaydelay=replaydelay,LAST " ;
        $def[$defcnt] .= "GPRINT:vreplaydelay:\"$NAME[$i] %3.2lf\\n\" " ;
        foreach ($DS as $j) {
          if(preg_match('/^receive_delay$/', $NAME[$j])) {
            $def[$defcnt] .= "DEF:receivedelay=$rrdfile:$DS[$j]:AVERAGE:reduce=LAST " ;
            $def[$defcnt] .= "LINE:receivedelay#".$colors['ratenow'].":\" \" ";
            $def[$defcnt] .= "VDEF:vreceivedelay=receivedelay,LAST " ;
            $def[$defcnt] .= "GPRINT:vreceivedelay:\"$NAME[$j] %.0lf\\n\" " ;
          }
        }
        $defcnt++;
    } 
}
?>
