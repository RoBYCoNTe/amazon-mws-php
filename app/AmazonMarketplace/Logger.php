<?php

interface AMLogger {
  
  public function info($message);
  
  public function warn($message);
  
  public function error($message);

  public function verbose($message);
}