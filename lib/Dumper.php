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
        $filtered = [];
        $final = [];
        foreach($items as $item) {
            $counter = 0;
            $needed =  count($filters);
            foreach($filters as $filter) {
                if(strpos($item, $filter) > -1) $counter++;
            }

            if($counter == $needed) array_push($filtered, $item);
        }

        foreach($filtered as $item) {
            $cols = [];
            $arr = explode('dnsmasq', $item);
            $date = trim($arr[0]);

            if(strpos($date, date('M d')) != 0) continue;

            array_push($cols, $date);
            $exploded = explode(' ', $arr[1]);
            $c = 0;
            foreach($exploded as $br) {
                if($c > 0) array_push($cols, $br);
                $c++;
            }

            array_push($final, $cols);


        }

        return $final;
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
