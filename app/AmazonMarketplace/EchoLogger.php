<?php 
require_once ("Logger.php");

class AMEchoLogger implements AMLogger {
  public function info ($message) {
    $this->out("INFO", $message);
  }
  public function warn ($message) {
    $this->out("WARN", $message);
  }
  public function error($message) {
    $this->out("ERROR", $message);
  }
  public function verbose($message) {
    $this->out("VERBOSE", $message);
  }
  
  private function out($type, $message) {
    $timestamp = date('Y-m-d H:i:s');
    echo "$timestamp - $type - $message" . PHP_EOL;
  }
}