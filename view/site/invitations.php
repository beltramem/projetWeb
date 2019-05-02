<section>
<ul>
<?php
foreach($data["invitations"] as $invitation)
{
	echo "<a href='?page=gameRoom/joinGame/&player=".$_SESSION['pseudo']."&game=".$invitation["game"]."'><li>".$invitation["game"].":".$invitation["author"]."</li></a>";
}
?>
</ul>

</section>