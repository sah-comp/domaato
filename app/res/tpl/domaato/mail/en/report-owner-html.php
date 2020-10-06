<?php echo $head ?>
<body>
	<table cellpadding="0" cellspacing="0" border="0" id="backgroundTable">
	<tr>
		<td align="center" valign="top">
            <p style="padding: 20px;">
                <img class="image_fix" src="<?php echo Url::host() ?>/img/domaato-logo-white.png" alt="Domaato Logo" title="Domaato - Das Kunden-Serviceportal" width="320" height="72" />
            </p>
		    <table cellpadding="0" cellspacing="0" border="0" align="center">
			    <tr>
    			<td width="640" valign="top">
                    <p class="headline"><?php echo htmlspecialchars($record->person->owner->getName()) ?>,</p>
                    <p>your business <strong><?php echo htmlspecialchars($record->person->getName()) ?></strong>
					has received a new <strong><?php echo ($record->vote) ? 'positive' : 'negative' ?></strong> vote by user <strong><?php echo htmlspecialchars($record->user->getName()) ?></strong> who reported the following:</p>
					<hr />
					<?php echo Flight::textile($record->content) ?>
					<hr />
					<p><a href="<?php echo Url::host() . '/review-a-report/' . $record->getId() ?>">You should react on short notice</a> to achieve higher customer satisfaction.</p>
                </td>
			</tr>
		    </table>
		</td>
	</tr>
	</table>
</body>
</html>
