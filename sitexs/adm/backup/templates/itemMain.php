<script language="JavaScript">
<!--
var dragObject;
var X, Y, eid, feid;
var icons= new Array(6);
var id=$lid;

function Document_OnMouseDown(e) {
	eid=null;feid=null;
	var element=window.event.srcElement;
	if (element.drag=="inhibit") {
		feid=element.eid;
		element=element.parentElement;
		dragObject = document.createElement("div");
		dragObject.className="drag";
		dragObject.style.pixelLeft = event.clientX;
		dragObject.style.pixelTop = event.clientY;
		dragObject.innerHTML=element.innerHTML;
		document.body.appendChild(dragObject);
		X=event.offsetX;
		Y=event.offsetY;
	}
}

function Document_OnMouseMove(e) {
	if (dragObject) {
		dragObject.style.pixelLeft = event.clientX + document.body.scrollLeft+5;
		dragObject.style.pixelTop = event.clientY + document.body.scrollTop+5;
		element = window.event.srcElement;
		return false;
	}
}

function Document_OnMouseUp(e) {

	if (dragObject) {
		dragObject.removeNode(true)
		dragObject = null;
		eid=event.srcElement.eid;
		if (!isNaN(eid)) {
			window.location="./?chid=$chid&action=reorder&eid=" + eid + "&feid=" + feid + "&id=" + id;
		}
	}
}

document.onmousedown = Document_OnMouseDown;
document.onmousemove = Document_OnMouseMove;
document.onmouseup = Document_OnMouseUp; 

function submit_delete()	{
	return confirm('������� ��������� ������?')
}
</script>
<p><a href="?chid=$chid&action=add&pid=0&level=1&lid=$lid"><img src="i/add.gif" alt="��������" width="16" height="16" border="0" hspace="3" align="absmiddle">��������</a></p>
<table width="100%">
<tr>
	<th width="80%">��������</th><th width="10%">������</th><th width="10%"></th><th>��������</th>
</tr>
$content
</table>

<br>
<table style="font-size: 80%;color: gray;" class="noborder">
<tr>
	<th colspan="4" align="left">�����������:</th>
</tr>
<tr>
	<td><img src="i/folder1.gif" alt="" width="16" height="16" border="0" align="absmiddle" hspace="3">������</td>
	<td><img src="i/folder2.gif" alt="" width="16" height="16" border="0" align="absmiddle" hspace="3">�������</td>
	<td><img src="i/folder3.gif" alt="" width="16" height="16" border="0" align="absmiddle" hspace="3">������</td>
	<td><img src="i/page.gif" alt="" width="16" height="16" border="0" align="absmiddle" hspace="3">������</td>
</tr>
</table>

