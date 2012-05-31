<div class="box">
	<h2>TeamSpeak 3</h2>

	<div class="box_content">
	<?php
	echo "<ul class='ts3_channels'>";
	if ($onlineList) {
		foreach ($onlineList as $channel) {
			$clients = $channel->clientList(array('client_type' => 0));
			if (count($clients) > 0) {
				echo "<li class='ts3_channel'>".$channel['channel_name']."</li>";
				echo "<ul class='ts3_clients'>";
				foreach ($clients as $client) {
					echo "<li class='ts3_client'>".$client."</li>";
				}
				echo "</ul>";
			}
		}
	} else {
		echo "<li>TeamSpeak 3 недоступен</li>";
	}
	echo "</ul>";
	?>
	</div>
</div>