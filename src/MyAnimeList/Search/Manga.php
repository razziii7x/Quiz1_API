<?php

namespace MyAnimeList\Search;

use MyAnimeList\Builder\AbstractSearch;

class Manga extends AbstractSearch {

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
		[ '<a[^>]+href="[^"]+manga/(\d+)[^"]+"[^>]+>.*?<strong>', '<strong>(.*?)</strong>', '<img[^>]+src="([^"]+images/manga[^"]+)"[^>]+>' ],
		[ 'id', 'title', 'poster' ],
		static::$limit
		);
	}
}