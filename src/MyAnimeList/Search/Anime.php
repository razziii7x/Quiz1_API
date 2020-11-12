<?php

namespace MyAnimeList\Search;

use MyAnimeList\Builder\AbstractSearch;

class Anime extends AbstractSearch {

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
		[ '<a[^>]+href="[^"]+anime/(\d+)[^"]+"[^>]+>.*?<strong>', '<strong>(.*?)</strong>', '<img[^>]+src="([^"]+images/anime[^"]+)"[^>]+>' ],
		[ 'id', 'title', 'poster' ],
		static::$limit
		);
	}
}