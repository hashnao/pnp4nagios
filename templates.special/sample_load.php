<?php
$this->MACRO['TITLE']   = "LOADAVERAGE";
$this->MACRO['COMMENT'] = "For All Servers";
$services = $this->tplGetServices("","LOADAVERAGE$");
#throw new Kohana_exception(print_r($services,TRUE));
# The Datasource Name for Graph 0
$ds_name[0] = "LOADAVERAGE";
$opt[0]     = "--title \"LOADAVERAGE\"";
$def[0]     = "";
# Iterate through the list of hosts
foreach($services as $key=>$val){
  $data = $this->tplGetData($val['host'],$val['service']);
  #throw new Kohana_exception(print_r($a,TRUE));
  $hostname   = rrd::cut($data['MACRO']['HOSTNAME']);
  $def[0]    .= rrd::def("var$key" , $data['DS'][0]['RRDFILE'], $data['DS'][0]['DS'] );
  $def[0]    .= rrd::line1("var$key", rrd::color($key), $hostname);
  $def[0]    .= rrd::gprint("var$key", array("MAX", "AVERAGE"));
}
?>
