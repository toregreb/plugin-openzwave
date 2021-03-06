<?php
/* This file is part of Jeedom.
 *
 * Jeedom is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Jeedom is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
 */

if (!isConnect('admin')) {
	throw new Exception('401 Unauthorized');
}
?>
<span class="pull-left alert" id="span_state" style="background-color : #dff0d8;color : #3c763d;height:35px;border-color:#d6e9c6;display:none;margin-bottom:0px;"><span style="position:relative; top : -7px;">{{Demande envoyée}}</span></span>
<span class='pull-right'>
	<select class="form-control expertModeVisible" style="width : 200px;" id="sel_zwaveBackupServerId">
		<?php
foreach (openzwave::listServerZwave() as $id => $server) {
	if (isset($server['name'])) {
		echo '<option value="' . $id . '" data-path="' . $server['path'] . '">' . $server['name'] . '</option>';
	}
}
?>
	</select>
</span>

<br/><br/>

<div id='div_backupAlert' style="display: none;"></div>
 <form class="form-horizontal">
    <fieldset>
        <div class="form-group">
            <label class="col-sm-4 col-xs-6 control-label">{{Créer une sauvegarde}}</label>
            <div class="col-sm-4 col-xs-6">
                <a class="btn btn-success" id="bt_createBackup"><i class="fa fa-floppy-o"></i> {{Lancer}}</a>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 col-xs-6 control-label">{{Sauvegardes disponibles}}</label>
            <div class="col-sm-4 col-xs-6">
                <select class="form-control" id="sel_restoreBackup"> </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 col-xs-6 control-label">{{Restaurer/Supprimer la sauvegarde}}</label>
            <div class="col-sm-4 col-xs-6">
                <a class="btn btn-warning" id="bt_restoreBackup"><i class="fa fa-refresh fa-spin" style="display : none;"></i> <i class="fa fa-file"></i> {{Restaurer}}</a>
                <a class="btn btn-danger" id="bt_removeBackup"><i class="fa fa-trash-o"></i> {{Supprimer}}</a>
            </div>
        </div>
    </fieldset>
</form>
</div>
<?php include_file('desktop', 'backup', 'js', 'openzwave');?>
<script>
	var path = $('#sel_zwaveBackupServerId option:selected').attr('data-path')+'/';
	$("#sel_zwaveBackupServerId").on("change",function() {
		path = $('#sel_zwaveBackupServerId option:selected').attr('data-path')+'/';
        updateListBackup();
	});
    updateListBackup();
</script>