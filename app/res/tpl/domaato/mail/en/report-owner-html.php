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
                    <p>das von Ihnen betreute Unternehmen <strong><?php echo htmlspecialchars($record->person->getName()) ?></strong>
					hat eine neue <strong><?php echo ($record->vote) ? 'positive' : 'negative' ?></strong> Bewertung durch den Benutzer <strong><?php echo htmlspecialchars($record->user->getName()) ?></strong> mit dem folgenden Bericht erhalten:</p>
					<hr />
					<?php echo Flight::textile($record->content) ?>
					<hr />
					<p><a href="<?php echo Url::host() . '/review-a-report/' . $record->getId() ?>">Reagieren Sie kurzfristig darauf</a> und erhöhen Sie die Kundenzufriedenheit.</p>
                </td>
			</tr>
		    </table>
		</td>
	</tr>
	</table>
</body>
</html>
