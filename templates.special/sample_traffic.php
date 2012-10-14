<?php
$this->MACRO['TITLE']   = "TRAFFIC:eth0[total]";
$this->MACRO['COMMENT'] = "For DB Servers";
$services = $this->tplGetServices("db","TRAFFIC_eth0");
# The Datasource Name for Graph 0
$ds_name[0] = "TRAFFIC:eth0[total]";
$opt[0]     = "--title \"TRAFFIC:eth0[total]\"";
$def[0]     = "";
# Iterate through the list of hosts
foreach($services as $key=>$val){
  $data = $this->tplGetData($val['host'],$val['service']);
  $hostname   = rrd::cut($data['MACRO']['HOSTNAME']);
  $def[0]    .= rrd::def("var$key" , $data['DS'][0]['RRDFILE'], $data['DS'][0]['DS'] );
  $def[0]    .= rrd::line1("var$key", rrd::color($key), $hostname);
  $def[0]    .= rrd::gprint("var$key", array("MAX", "AVERAGE"));
}
?>
