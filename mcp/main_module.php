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
 * Topten MCP module.
 */
class main_module
{
	var $u_action;

	function main($id, $mode)
    {
        global $phpbb_container, $db;
        $user = $phpbb_container->get('user');
        $template = $phpbb_container->get('template');
        $request = $phpbb_container->get('request');

        $user->add_lang_ext('papajoke/topten', 'mcp_topten_front');
        $this->tpl_name = 'mcp_topten_body';
        $this->page_title = $user->lang('MCP_TOPTEN_TITLE');
        add_form_key('papajoke/topten');

        $condition="from_unixtime(post_time) > DATE_SUB(CURDATE(), interval 30 DAY)";
        $title = "30 ".$user->lang('LAST_DAYS');
        
        if ($request->is_set_post('submit')) {
            if (!check_form_key('papajoke/topten')) {
                trigger_error('FORM_INVALID');
            }
        }

        $ladate = request_var('ladate', '');
        if ($ladate !='')
        {
            $dt = new \DateTime($ladate);
            $year = (int)$dt->format('Y'); //substr($ladate,0,4);
            $month = (int)$dt->format('n'); //substr($ladate,5,2);
            $condition="
                YEAR(from_unixtime(post_time)) = ".$year." AND
                MONTH(from_unixtime(post_time)) = ".$month." ";
            $title = ": ".$dt->format('F')." ".$year;
            $template->assign_vars(array(
                'LADATE'               => $dt->format('Y-m-d'),
            ));
        }

        $template->assign_vars(array(
            'TOP_TITLE'               => $title,
        ));

        $sql="SELECT count(poster_id) as nb, u.username_clean, poster_id, u.user_posts, u.user_avatar  FROM ".POSTS_TABLE." p
                LEFT JOIN ".USERS_TABLE." u ON u.user_id=p.poster_id
            WHERE 
                ". $condition ."
                AND group_id<4 AND poster_id>1
            GROUP BY poster_id
            ORDER BY nb DESC
            LIMIT 10";

        $result = $db->sql_query($sql);
        while ($row = $db->sql_fetchrow($result)) 
        {
            $template->assign_block_vars('tops', array(
                'NAME' => $row['username_clean'],
                'ID' => $row['poster_id'],
                'COUNT' => $row['nb'],
                'POSTS' => $row['user_posts'],
                'AVATAR' => $row['user_avatar'],
            ));
        }
        $db->sql_freeresult($result);

        $template->assign_var('U_POST_ACTION', $this->u_action);
    }
}
