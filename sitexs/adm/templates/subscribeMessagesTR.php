<tr>
	<td align="right">$data[id]</td>
	<td>$data[subj]</td>
	<td>$data[date_sent]</td>
	<td align="center"><a href="?chid=$chid&action=test_Messages&id=$this->id&mid=$data[id]$page" title="<?php __("����") ?>"><img src="i/test.gif" alt="<?php __("����") ?>" width="16" height="16" border="0"></a>&nbsp;<a href="?chid=$chid&action=send_Messages&id=$this->id&mid=$data[id]$page" title="<?php __("���������") ?>"><img src="i/send.gif" alt="<?php __("���������") ?>" width="16" height="16" border="0"></a>&nbsp;&nbsp;&nbsp;<a href="?chid=$chid&action=edit_Messages&id=$this->id&mid=$data[id]$page" title="<?php __("�������������") ?>"><img src="i/edit.gif" alt="<?php __("�������������") ?>" width="16" height="16" border="0"></a> &nbsp; <a href="?chid=$chid&action=delete_Messages&id=$this->id&mid=$data[id]$page" onClick="return submit_delete();" title="<?php __("�������") ?>"><img src="i/del.gif" alt="<?php __("�������") ?>" width="16" height="16" border="0"></a></td>
</tr>