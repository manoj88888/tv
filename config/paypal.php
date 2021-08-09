<?php 

return [
	/** set your paypal credential **/
	'client_id' => 'AabeLs7PtctOGhZQio3e11eqwKaKSfB6jDRrvtoXWE8-Lk0TvXY9pGabDcEBEbH4K7MySnANewStN8Q7',
	'secret' => 'EKnif6SqwXTXkAXDvP0jWejqNXRcuUJ_qg3uGqG7slTI23m-S8mOBzZiAmkYctc8XHQUIOyOwVQur9lE',
	/**
	* SDK configuration 
	*/
	'settings' => array(
		/**
		* Available option 'sandbox' or 'live'
		*/
		'mode' => 'SANDBOX',
		/**
		* Specify the max request time in seconds
		*/
		'http.ConnectionTimeOut' => 90,
		/**
		* Whether want to log to a file
		*/
		'log.LogEnabled' => true,
		/**
		* Specify the file that want to write on
		*/
		'log.FileName' => storage_path() . '/logs/paypal.log',
		/**
		* Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
		*
		* Logging is most verbose in the 'FINE' level and decreases as you
		* proceed towards ERROR
		*/
		'log.LogLevel' => 'FINE'
	),
];