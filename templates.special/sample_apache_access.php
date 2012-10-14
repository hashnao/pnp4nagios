<?php
$this->MACRO['TITLE']   = "Apache:Performance[Access]";
$this->MACRO['COMMENT'] = "For WEB Servers";
$services = $this->tplGetServices("(web|mgr)","Apache_Performance");
# The Datasource Name for Graph 0
$ds_name[0] = "Apache_Performance:Access";
$opt[0]     = "--title \"Apache:Performance[Access]\"";
$def[0]     = "";
# Iterate through the list of hosts
foreach($services as $key=>$val){
  $data = $this->tplGetData($val['host'],$val['service']);
  $hostname   = rrd::cut($data['MACRO']['HOSTNAME']);
  $def[0]    .= rrd::def("var$key" , $data['DS'][15]['RRDFILE'], $data['DS'][15]['DS'] );
  $def[0]    .= rrd::line1("var$key", rrd::color($key), $hostname);
  $def[0]    .= rrd::gprint("var$key", array("MAX", "AVERAGE"));
}
?>
