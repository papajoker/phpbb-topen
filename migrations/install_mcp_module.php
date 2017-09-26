<?php
/**
 *
 * Topten PCM. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2017, papajoke
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace papajoke\topten\migrations;

class install_mcp_module extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		$sql = 'SELECT module_id
			FROM ' . $this->table_prefix . "modules
			WHERE module_class = 'mcp'
				AND module_langname = 'MCP_TOPTEN_TITLE'";
		$result = $this->db->sql_query($sql);
		$module_id = $this->db->sql_fetchfield('module_id');
		$this->db->sql_freeresult($result);

		return $module_id !== false;
	}

	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v31x\v314');
	}

	public function update_data()
	{
		return array(
			array('module.add', array(
				'mcp',
				0,
				'MCP_TOPTEN_TITLE'
			)),
			array('module.add', array(
				'mcp',
				'MCP_MAIN',
				array(
					'module_basename'	=> '\papajoke\topten\mcp\main_module',
					'modes'				=> array('front'),
				),
			)),
		);
	}
}
