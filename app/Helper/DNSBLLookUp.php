<?php

namespace App\Helper;

class DNSBLLookUp
{
    public $servers = [
        "dnsbl-1.uceprotect.net",
        "dnsbl-2.uceprotect.net",
        "dnsbl-3.uceprotect.net",
        "dnsbl.dronebl.org",
        "dnsbl.sorbs.net",
        "zen.spamhaus.org",
        "bl.spamcop.net",
        "list.dsbl.org",
        "sbl.spamhaus.org",
        "xbl.spamhaus.org",
        "relays.osirusoft.com"
    ];

    public function Check($ip = null){

        $clearMsg = "'A' record was not found";
        $listed = [];
        if (!filter_var($ip, FILTER_VALIDATE_IP))
            return $clearMsg;

        $reverse_ip = implode(".", array_reverse(explode(".", $ip)));

        foreach ($this->servers as $host) {
            if (checkdnsrr($reverse_ip . "." . $host . ".", "A")) {
                $listed[]= $reverse_ip . '.' . $host . 'Listed';
            }
        }

        if (empty($listed))
            return $clearMsg;

        return $listed;
    }

}