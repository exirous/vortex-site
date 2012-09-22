<div class="view left">
    <div class="clear"></div>
    <object type="application/x-shockwave-flash" height="250" width="400" id="live_embed_player_flash"
            data="http://ru.twitch.tv/widgets/live_embed_player.swf?channel=<?php echo CHtml::encode($data->channel); ?>" bgcolor="#000000">
        <param name="allowFullScreen" value="true" />
        <param name="allowScriptAccess" value="always" />
        <param name="allowNetworking" value="all" />
        <param name="movie" value="http://ru.twitch.tv/widgets/live_embed_player.swf" />
        <param name="flashvars" value="hostname=ru.twitch.tv&channel=rusmaxim&auto_play=false&start_volume=25" />
    </object>
    <br />
    <span class="<?php echo $data->owner->mainCharacter->warcraftClass->english_name;?>"><?php echo $data->owner->mainCharacter->name; ?></span>
    <p><?php echo CHtml::encode($data->description); ?></p>
</div>