<?php
function check_email($email)
	  {
	    if (!preg_match( '/^([a-z0-9]+([-_\.]?[a-z0-9])+)@[a-z0-9äöü]+([-_\.]?[a-z0-9äöü])+\.[a-z]{2,4}$/i', $email)) return false;
	 
	    if (!function_exists('checkdnsrr'))
	    {
	      function checkdnsrr($host, $type)
	      {
	        @exec('nslookup -type=' . $type . ' ' . $host, $output);
	 
	        foreach ($output as $line)
	        if (preg_match('/^' . $host . '/i', $line)) return true;
	 
	        return false;
	      }
	    }
	 
	    $host = substr(strrchr($email, '@'), 1);
	 
	    if (checkdnsrr($host, 'MX') or checkdnsrr($host, 'A'))
	    {
	      return true;
	    }
	    else
	    {
	      return false;
	    }
	  }
?>