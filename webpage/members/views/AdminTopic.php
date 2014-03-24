<?php 
session_start();
if(isset($_SESSION['login_user'])){ ?>
<div class="row-fluid">
	<div class="col-lg-2"></div>
    <div class="col-lg-8">
    	<table class="table table-bordered table-hover table-condensed">
        	<thead>
            	<tr>
                	<th>Nombre</th><th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div class="col-lg-2"></div>
</div>
<div id="msgbox" title="Eductronic"></div>
<div id="confirmation" title="Eductronic"></div>
<div title="Editar" id="div-form-edit-topic">
	<form role="form" name="edit-topic-form" id="edit-topic-form">
    	<input type="hidden" name="id" id="id" value="0" />
        <div class="form-group">
        	<label for="topic">Nombre</label>
            <input type="text" name="topic" id="topic" placeholder="Nombre del tema" required class="form-control" />
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>

    </form>
</div>
<script>
var subscriberId="<?php echo $_SESSION['login_user']['id'] ?>"
var token="<?php echo $_SESSION['login_user']['accessToken'] ?>"
</script>
<script src="../Javascripts/AdminTopic.js"></script>

<?php } ?>