<?php
session_start();
if(isset($_SESSION['login_user'])){ ?>
<script>
var token="<?php echo $_SESSION['login_user']['accessToken'] ?>";
var subscriberId="<?php echo $_SESSION['login_user']['id'] ?>";
Control.getService(urlApi+"subscribers/"+subscriberId+"/groups/",token);
var answers;
var team;
var teams
var turno;
var rondas;
var tem_points=0;
var resp_correct="";
Control.initGame();
</script>

<div class="row-fluid" id="acordion">
<h3>Configuración</h3>
	<div class="row-fluid" id="config">
		<div class="col-lg-6">
        	<form role="form" class="form-horizontal">
            	<div class="form-group">
                    <label for="no_team" class="col-sm-4 control-label"># Equipos</label>
                    <div class="col-xs-3">
                    <input type="numeric" name="no_team" id="no_team" class="form-control" required>
                    </div>
                </div>
                
                <div id="nameTeam">
                </div>
                
                <div class="form-group">
                    <label for="tema" class="col-sm-4 control-label">Tema</label>
                    <div class="col-xs-8">
					<select name="tema" id="tema" required class="form-control">
                    	<option value="">Selecciona un tema</option>
                    </select>
                    <input type="button" id="cargar" class="btn btn-success btn-xs" value="Cargar">
                    </div>
                </div>
                <button type="button" class="btn btn-primary" id="beginGame">Empezar Juego</button>
            </form>
        </div>
        
        <div class="col-lg-6">
        	<table class="table table-bordered">
            	<thead>
                	<tr>
                    	<th># Equipos</th>
                        <th># Preguntas</th>
                        <th>Tema</th>
                    </tr>
                </thead>
            	<tbody>
                	<td></td>
                    <td></td>
                    <td></td>
                </tbody>
            </table>
        </div>
    </div>

    <h3>Tablero de Juego</h3>
	<div class="row-fluid" id="tablero">
    	<div class="row-fluid">
        	<table class="table table-bordered table-condensed">
            	<thead>
                	<tr>
                    </tr>
                </thead>
                <tbody>
                	<tr>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row-fluid">
        	<table class="table table-bordered">
            	<caption>Preguntas</caption>
                <tbody>
                </tbody>
            </table>
        </div>
    	
    </div>
</div>
<div id="msgbox" title="Eductronic"></div>
<div id="winners" title="Eductronic">
    <div class="row-fluid">
            <div class="col-sm-3"><img src="../Content/images/GIF020.gif" class="hidden" /></div>
            <div class="col-sm-9"></div>
    </div>
</div>

<div id="tablero_preguntas" title="Eductronic">
</div>
<?php } ?>