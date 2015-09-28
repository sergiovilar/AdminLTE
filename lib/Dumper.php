<?php

class Dumper {

    private $logpath;
    private $piholepath;

    // Data
    private $queries;
    private $ads_blocked;
    private $domains_amount;

    public function __construct($logpath = "/var/log", $piholepath = "/etc/pihole" ) {
        $this->logpath = $logpath;
        $this->piholepath = $piholepath;
    }

    private function getLogPath($p) {
        return $this->logpath.$p;
    }

    private function getPiholePath($p) {
        return $this->piholepath.$p;
    }

    public function getQueries() {
        if(empty($this->queries))
            $this->queries = exec("today=$(date \"+%b %e\");cat ".$this->getLogPath('/pihole.log')." | awk '/query/ {print $6}' | wc -l");
        return $this->queries;
    }

    public function getQueriesRaw($filters = []) {
        array_push($filters, "query[A]");
        $items = explode("\n", file_get_contents($this->getLogPath('/pihole.log')));
        $final = [];
        foreach($items as $item) {
            $add = false;
            foreach($filters as $filter) {
                if(strpos($item, $filter) > -1) {
                    $add = true;
                } else {
                    $add = false;
                }
            }
            if($add) array_push($final, $item);
        }
        return implode("\n", $final);
    }

    public function getAds() {
        if(empty($this->queries))
            $this->ads_blocked = exec("today=$(date \"+%b %e\");cat /var/log/pihole.log | awk '".$this->getPiholePath("gravity.list/")." {print $6}' | wc -l");
        return $this->ads_blocked;
    }

    public function getDomainAmount() {
        if(empty($this->domains_amount))
            $this->domains_amount = exec("wc -l ".$this->getPiholePath("/gravity.list/")." | awk '{print $1}'");
        return $this->domains_amount;
    }

}
