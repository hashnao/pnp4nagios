<?php
#
# Copyright (c) 2009 Gerhard Lausser (gerhard.lausser@consol.de)
# Revised Naoya Hashimoto(mrhashnao@gmail.com) (https://github.com/hashnao/pnp4nagios/tree/master/templates)
# Plugin: check_apachestatus_auto (http://www.spreendigital.de/blog/nagios/?#check_apachestatus_auto)
# Release 1.0 2009-07-14
#
# This is a template for the visualisation addon PNP (http://www.pnp4nagios.org)
#

$defcnt = 1;

$colors['idle'] = "EACC00";
$colors['busy'] = "00FF00";
$colors['slots'] = "000000";
$colors['open'] = "c6c6c6";
$colors['reqpersec'] = "00FF00";
$colors['bytespersec'] = "00FF00";
$colors['acccess'] = "00FF00";

foreach ($DS as $i) {
    $warning = ($WARN[$i] != "") ? $WARN[$i] : "";
    $warnmin = ($WARN_MIN[$i] != "") ? $WARN_MIN[$i] : "";
    $warnmax = ($WARN_MAX[$i] != "") ? $WARN_MAX[$i] : "";
    $critical = ($CRIT[$i] != "") ? $CRIT[$i] : "";
    $critmin = ($CRIT_MIN[$i] != "") ? $CRIT_MIN[$i] : "";
    $critmax = ($CRIT_MAX[$i] != "") ? $CRIT_MAX[$i] : "";
    $minimum = ($MIN[$i] != "") ? $MIN[$i] : "";
    $maximum = ($MAX[$i] != "") ? $MAX[$i] : "";

    if(preg_match('/^Idle$/', $NAME[$i])) {
        $ds_name[$defcnt] = "Busy/Idle";
        $opt[$defcnt] = "--vertical-label \"\" --title \"Busy and Idle Workers\" ";
        $def[$defcnt] = "";
        $def[$defcnt] .= "DEF:idle=$rrdfile:$DS[$i]:AVERAGE:reduce=LAST " ;
        $def[$defcnt] .= "LINE:idle#".$colors['idle'].":\" \" ";
        $def[$defcnt] .= "VDEF:vidle=idle,LAST " ;
        $def[$defcnt] .= "GPRINT:vidle:\"$NAME[$i] %.0lf\\n\" " ;
        foreach ($DS as $j) {
          if(preg_match('/^Busy$/', $NAME[$j])) {
            $def[$defcnt] .= "DEF:busy=$rrdfile:$DS[$j]:AVERAGE:reduce=LAST " ;
            $def[$defcnt] .= "LINE:busy#".$colors['busy'].":\" \" ";
            $def[$defcnt] .= "VDEF:vbusy=busy,LAST " ;
            $def[$defcnt] .= "GPRINT:vbusy:\"$NAME[$j] %.0lf\\n\" " ;
          }
        }
        $defcnt++;
    }
    if(preg_match('/^Slots$/', $NAME[$i])) {
        $ds_name[$defcnt] = "Slots";
        $opt[$defcnt] = "--vertical-label \"\" --title \"Slots and OpenSlots\" ";
        $def[$defcnt] = "";
        $def[$defcnt] .= "DEF:slots=$rrdfile:$DS[$i]:AVERAGE:reduce=LAST " ;
        $def[$defcnt] .= "LINE1:slots#".$colors['slots'].":\" \" ";
        $def[$defcnt] .= "VDEF:vslots=slots,LAST " ;
        $def[$defcnt] .= "GPRINT:vslots:\"$NAME[$i] %.0lf\\n\" " ;
        foreach ($DS as $j) {
          if(preg_match('/^OpenSlots$/', $NAME[$j])) {
            $def[$defcnt] .= "DEF:open=$rrdfile:$DS[$j]:AVERAGE:reduce=LAST " ;
            $def[$defcnt] .= "LINE1:open#".$colors['open'].":\" \" ";
            $def[$defcnt] .= "VDEF:vopen=open,LAST " ;
            $def[$defcnt] .= "GPRINT:vopen:\"$NAME[$j] %.0lf\\n\" " ;
          }
        }
        $defcnt++;
    }
    if(preg_match('/^ReqPerSec$/', $NAME[$i])) {
        $ds_name[$defcnt] = "Requests per Second";
        $opt[$defcnt] = "--vertical-label \"\" --title \"Requests per Second\" ";
        $def[$defcnt] = ""; 
        $def[$defcnt] .= "DEF:reqpersec=$rrdfile:$DS[$i]:AVERAGE:reduce=LAST " ; 
        $def[$defcnt] .= "LINE2:reqpersec#".$colors['reqpersec'].":\" \" ";
        $def[$defcnt] .= "VDEF:vreqpersec=reqpersec,LAST " ; 
        $def[$defcnt] .= "GPRINT:vreqpersec:\"Request/sec %.2lf\\n\" " ; 
        $defcnt++;
    }
    if(preg_match('/^BytesPerSec$/', $NAME[$i])) {
        $ds_name[$defcnt] = "Bytes per Second";
        $opt[$defcnt] = "--vertical-label \"\" --title \"Bytes per Second\" ";
        $def[$defcnt] = "";
        $def[$defcnt] .= "DEF:bytespersec=$rrdfile:$DS[$i]:AVERAGE:reduce=LAST " ;
        $def[$defcnt] .= "AREA:bytespersec#".$colors['bytespersec'].":\" \" ";
        $def[$defcnt] .= "VDEF:vbytespersec=bytespersec,LAST " ;
        $def[$defcnt] .= "GPRINT:vbytespersec:\"Byte/sec %.2lf\\n\" " ;  
        $defcnt++;
    }
    if(preg_match('/^Accesses$/', $NAME[$i])) {
        $ds_name[$defcnt] = "Access";
        $opt[$defcnt] = "--vertical-label \"\" --title \"Access\" ";
        $def[$defcnt] = ""; 
        $def[$defcnt] .= "DEF:access=$rrdfile:$DS[$i]:AVERAGE:reduce=LAST " ; 
        $def[$defcnt] .= "LINE2:access#".$colors['reqpersec'].":\" \" ";
        $def[$defcnt] .= "VDEF:vaccess=access,LAST " ; 
        $def[$defcnt] .= "GPRINT:vaccess:\"Access %.2lf\\n\" " ; 
        $defcnt++;
    }
}
