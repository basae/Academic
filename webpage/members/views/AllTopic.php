<?php
session_start();
?>
<script>
var subscriberId="<?php echo $_SESSION['login_user']['id'] ?>"
var token="<?php echo $_SESSION['login_user']['accessToken'] ?>"
</script>
<script src="../Javascripts/AllTopic.js"></script>
<div class="row-fluid">
	<div class="row-fluid">
    	<div class="col-lg-4"></div>
        <div class="col-lg-4">
        
        	<form role="form" class="form-vertical" id="search">
            	<label for="topic">Busqueda</label>
                <div class="row">
                	<div class="col-lg-9">
                    <p>
                	<input type="radio" id="filter" name="filter" value="Todos" checked="checked" />Todos
                	<input type="radio" id="filter" name="filter" value="Filtro" />Usar Filtro
                    </p>
                    </div>
                </div>
                <div class="row">
                	
		            <div class="col-lg-9">
                    	<div class="row">
                        <p>
    		            <input type="text" placeholder="introduce el tema" id="topic" name="topic" required class="form-control" disabled="disabled"/>
                        </p>
                        </div>
                        <div class="row">
                        <p>
                        <select name="dificultyGrade" id="dificultyGrade" class="form-control" required disabled="disabled">
                            <option value="">Selecciona un Nivel</option>
                            <option value="BASICO">Nivel Basico</option>
                            <option value="MEDIO">Nivel Medio</option>
                            <option value="SUPERIOR">Nivel Superior</option>                    
                    	</select>
                        </p>
                        </div>
            	    </div>
                    <div class="col-lg-3">
                    <p class="text-left">                
                	<button type="submit" class="btn btn-default">Buscar</button>
                    </p>
                	</div>
            </form>
        </div>
        <div class="col-lg-4"></div>
    </div>
    <div class="rows">
    	<div class="col-lg-12">
        	<table class="table table-bordered" id="search-table">
            <thead>
            	<th>Tema</th>
                <th>Nivel</th>
                <th>No. Preguntas</th>
                <th>Creado Por</th>
            </thead>
            <tbody>
            </tbody>
            </table>
        </div>
    </div>
</div>
