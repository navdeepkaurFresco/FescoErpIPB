<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Mail configurations
|--------------------------------------------------------------------------
| 
*/
//$config['protocol'] = 'sendmail';
$config['protocol'] = 'mail';
//$config['mailpath'] = '/usr/sbin/sendmail';
//$config['charset']  = 'iso-8859-1';
$config['charset']  = 'utf-8'; 
$config['newline']  = '\r\n';
//$config['mailtype'] = 'html'; 
$config['mailtype'] = 'text';
$config['wordwrap'] = TRUE;