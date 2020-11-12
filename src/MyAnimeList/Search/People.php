<?php

namespace MyAnimeList\Search;

use MyAnimeList\Builder\AbstractSearch;

class People extends AbstractSearch {

	/**
	 * @var 		array 			Key list for all purposes
	 */
	public $keyList = [ 'results' ];

	/**
	 * @return 		array
	 * @usage 		results
	 */
	protected function getResultsFromData() {

		return
		$this->request()::matchTable(
		$this->config(),
		'search results(.*?</table>)', '<tr>(.*?)</tr>',
		[ '<a[^>]+href="[^"]+people/(\d+)[^"]+">[^<]+</a>', '<a[^>]+href="[^"]+people/\d+[^"]+">([^<]+)</a>', '<img[^>]+src="([^"]+images/voiceactors[^"]+)"[^>]*>' ],
		[ 'id', 'name', 'poster' ],
		static::$limit
		);
	}
}