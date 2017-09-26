<?php
/**
 *
 * Topten PCM. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2017, papajoke
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace papajoke\topten\mcp;

/**
 * Topten PCM MCP module info.
 */
class main_info
{
	function module()
	{
		return array(
			'filename'	=> '\papajoke\topten\mcp\main_module',
			'title'		=> 'MCP_TOPTEN_TITLE',
			'modes'		=> array(
				'front'	=> array(
					'title'	=> 'MCP_TOPTEN',
					'auth'	=> 'ext_papajoke/topten',
					'cat'	=> array('MCP_MAIN')
				),
			),
		);
	}
}
