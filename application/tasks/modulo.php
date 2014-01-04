<?php

	Class Modulo_Task {

		// set the repos url
		private $url_repos = "https://api.github.com/repos/webcoag/modules/contents/noticias";
		// save the content of repo in array
		private $repo_content;

		public function run($arguments)
		{
			var_dump($arguments);
		}

		public function install($arguments)
		{
			$this->url_repos = $this->url_repos . "/" . $arguments[0];

			if( $this->get_repo_content() )
			{
				$repo = $this->repo_content;

				foreach( $repo as $file )
				{
					printf("%s\n", $file['name']);
				}
			}
		}

		public function get_repo_content()
		{
			try {

				$ch = curl_init();
				// Disable SSL verification
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
				// Will return the response, if false it print the response
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				// set correct headers from json
				curl_setopt($ch, CURLOPT_HTTPHEADER,array('Accept: application/json', "Content-type: application/json"));
				curl_setopt($ch, CURLOPT_FAILONERROR, FALSE);
				// disable default headers from curl
				curl_setopt($ch, CURLOPT_HEADER, false);
				// set an user agent valid to api
				curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
				// Set the url
				curl_setopt($ch, CURLOPT_URL, $this->url_repos );
				// execute
				$result = curl_exec($ch);
				// Will dump a beauty json :3
				$this->repo_content = json_decode($result, true);

			} catch (Exception $e) {
				return $e->getMessage();
			}
			return true;
		}

	}