<?php
$this->MACRO['TITLE']   = "HTTP Response Times";
$this->MACRO['COMMENT'] = "For WEB Servers";
$services = $this->tplGetServices("eco","HTTP$");
#throw new Kohana_exception(print_r($services,TRUE));
# The Datasource Name for Graph 0
$ds_name[0] = "Response Times";
$opt[0]     = "--title \"Response Times\"";
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
