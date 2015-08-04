<?php 
require_once('../src/db.php');

$conn = new DBConn();
$c = $conn->connect();

$query = "SELECT * FROM curso INNER JOIN grupo_curso3 ON curso.cur_gcu3_id = grupo_curso3.gcu3_id WHERE curso.cur_ecu_id =1";
$r = mysqli_query($c,$query);
$cursos_activos = array();

while ($row = mysqli_fetch_assoc($r)) {
        $cursos_activos[] = $row;
    }
$cant_cursos_activos = sizeof($cursos_activos);
//Usuarios para validar
$query = "SELECT count(*) as validar FROM usuario_sitio WHERE usi_validado =  '-'";
$r = mysqli_query($c,$query);
$cant_validar = mysqli_fetch_assoc($r);
?>
<div class="row">
	<div id="breadcrumb" class="col-xs-12">
		<ol class="breadcrumb">
			<li><a href="index.html">Panel de Control</a></li>
			<li><a href="#">Indice</a></li>
			<!--li><a href="#">Simple Tables</a></li-->
		</ol>
	</div>
</div>
<div class="row">
	
               <div class="col-lg-3 col-md-6">
                    <div class="panel panel-show">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?=$cant_validar['validar']?></div>
                                    <div>Usuarios para validar</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <a href="http://cfj.gov.ar/test/src/index.php?frm=principal&nxt=usuario&t=2" class="pull-left">Ver m&aacute;s...</a>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                           <div class="col-lg-3 col-md-6">
                    <div class="panel panel-show">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?=$cant_cursos_activos?></div>
                                    <div>Cursos Activos</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <a href="http://cfj.gov.ar/test/src/index.php?frm=principal&nxt=curso" class="pull-left">Ver m&aacute;s...</a>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

                           <div class="col-lg-3 col-md-6">
                    <div class="panel panel-show">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">18</div>
                                    <div>............</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Ver m&aacute;s...</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                           <div class="col-lg-3 col-md-6">
                    <div class="panel panel-show">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-9 text-center">
                                    <div class="huge">108</div>
                                    <div>...............</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Ver m&aacute;s...</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

<div class="col-xs-12 col-sm-6">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-table"></i>
					<span>Cursos Activos</span>
				</div>
				<div class="box-icons">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
					<a class="expand-link">
						<i class="fa fa-expand"></i>
					</a>
					<a class="close-link">
						<i class="fa fa-times"></i>
					</a>
				</div>
				<div class="no-move"></div>
			</div>
			<div class="box-content">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th class="col-md-3">Fec. Inicio</th>
							<th class="col-md-3">Fec. Fin</th>
							<!--th>Categor&iacute;a</th-->
							<th>Curso</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($cursos_activos as $curso) {?>
						<tr>
							<td class="col-md-3"><?=$curso['cur_fechaInicio'];?></td>
							<td class="col-md-3"><?=$curso['cur_fechaFin'];?></td>
							<!--td></td-->
							<td><?=utf8_encode($curso['gcu3_titulo']);?></td>
						</tr>
				
					<?php }?>
						
						<!--tr>
							<td>02/01/2015</td>
							<td>10/01/2015</td>
							<td>Otras Actividades - Otras Actividades</td>
							<td>Ley 2095 - Compras y Contrataciones en el ámbito de la Ciudad Autónoma de Buenos Aires</td>
						</tr>
						<tr>
							<td>03/01/2015</td>
							<td>10/01/2015</td>
							<td>Otras Actividades - Otras Actividades</td>
							<td>Casos y problemas urbanísticos de la ciudad de Buenos Aires	</td>
						</tr>
						<tr>
							<td>04/01/2015</td>
							<td>10/01/2015</td>
							<td>Otras Actividades - Otras Actividades</td>
							<td>Filiaci&oacute;n y responsabilidad parental en el nuevo C&oacute;digo Civil y Comercial -en el marco del Programa permanente en G&eacute;nero y Derecho-	</td>
						</tr-->
					</tbody>
				</table>
			</div>
		</div>
	</div>

<div class="row full-calendar">
	<!--div class="col-sm-3">
		<div id="add-new-event">
			<h4 class="page-header">Add new event</h4>
			<div class="form-group">
				<label>Event title</label>
				<input type="text" id="new-event-title" class="form-control">
			</div>
			<div class="form-group">
				<label>Event description</label>
				<textarea class="form-control" id="new-event-desc" rows="3"></textarea>
			</div>
			<a href="#" id="new-event-add" class="btn btn-primary pull-right">Add event</a>
			<div class="clearfix"></div>
		</div>
		<div id="external-events">
			<h4 class="page-header" id="events-templates-header">Draggable Events</h4>
			<div class="external-event">Work time</div>
			<div class="external-event">Conference</div>
			<div class="external-event">Meeting</div>
			<div class="external-event">Restaurant</div>
			<div class="external-event">Launch</div>
			<div class="checkbox">
				<label>
					<input type="checkbox" id="drop-remove"> remove after drop
					<i class="fa fa-square-o small"></i>
				</label>
			</div>
		</div>
	</div-->
	<div class="col-sm-6">
		<div id="calendar"></div>
	</div>
</div>

<!-- -->
	<!--div class="col-xs-12 col-sm-6">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-table"></i>
					<span>Striped rows</span>
				</div>
				<div class="box-icons">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
					<a class="expand-link">
						<i class="fa fa-expand"></i>
					</a>
					<a class="close-link">
						<i class="fa fa-times"></i>
					</a>
				</div>
				<div class="no-move"></div>
			</div>
			<div class="box-content">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Homepage</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>Nginx</td>
							<td>http://nginx.org</td>
							<td>webserver</td>
						</tr>
						<tr>
							<td>2</td>
							<td>Apache</td>
							<td>http://apache.org</td>
							<td>webserver</td>
						</tr>
						<tr>
							<td>3</td>
							<td>Skype</td>
							<td>http://www.skype.com</td>
							<td>Messenger</td>
						</tr>
						<tr>
							<td>4</td>
							<td>Blender</td>
							<td>http://www.blender.org</td>
							<td>3D-modeller</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div-->
</div>
<!--div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-table"></i>
					<span>Combined Table</span>
				</div>
				<div class="box-icons">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
					<a class="expand-link">
						<i class="fa fa-expand"></i>
					</a>
					<a class="close-link">
						<i class="fa fa-times"></i>
					</a>
				</div>
				<div class="no-move"></div>
			</div>
			<div class="box-content no-padding">
				<table class="table table-striped table-bordered table-hover table-heading no-border-bottom">
					<thead>
						<tr>
							<th>#</th>
							<th>Company</th>
							<th>Product</th>
							<th>Homepage</th>
							<th>Product description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>Oracle</td>
							<td>OracleDB</td>
							<td>http://oracle.com</td>
							<td>SQL server</td>
						</tr>
						<tr>
							<td>2</td>
							<td>RedHat</td>
							<td>RedHat Advanced Server</td>
							<td>http://redhat.com</td>
							<td>Operation System</td>
						</tr>
						<tr>
							<td>3</td>
							<td>Microsoft</td>
							<td>Windows</td>
							<td>http://microsoft.com</td>
							<td>Operation System</td>
						</tr>
						<tr>
							<td>4</td>
							<td>Apple</td>
							<td>MacOSX</td>
							<td>http://apple.com</td>
							<td>Operation System</td>
						</tr>
						<tr>
							<td>5</td>
							<td>Adobe</td>
							<td>Adobe Photoshop</td>
							<td>http://adobe.com</td>
							<td>Design suite</td>
						</tr>
						<tr>
							<td>6</td>
							<td>Corel</td>
							<td>Corel Draw!</td>
							<td>http://corel.com</td>
							<td>Design suite</td>
						</tr>
						<tr>
							<td>7</td>
							<td>Google</td>
							<td>Chrome</td>
							<td>http://google.com</td>
							<td>Web-browser</td>
						</tr>
						<tr>
							<td>8</td>
							<td>Mozilla</td>
							<td>Firefox</td>
							<td>http://mozilla.org</td>
							<td>Web-browser</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div-->
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-table"></i>
					<span>Combined Table 2</span>
				</div>
				<div class="box-icons">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
					<a class="expand-link">
						<i class="fa fa-expand"></i>
					</a>
					<a class="close-link">
						<i class="fa fa-times"></i>
					</a>
				</div>
				<div class="no-move"></div>
			</div>
			<div class="box-content no-padding">
				<div class="bs-callout">
					<button class="close" data-dismiss="alert">&times;</button>
					<h4>Combine some classes to best view</h4>
					<p><code>.table-striped</code>, <code>.table-bordered</code>, <code>.table-hover</code> and <code>.table-heading</code></p>
					<p>Also you can use contextual classes to color table rows or individual cells</p>
				</div>
				<table class="table table-striped table-bordered table-hover table-heading no-border-bottom">
					<thead>
						<tr>
							<th>Column #1</th>
							<th>Column #2</th>
							<th>Column #3</th>
							<th>Column #4</th>
							<th>Column #5</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>no</td>
							<td>class</td>
							<td>to</td>
							<td>default</td>
							<td>view</td>
						</tr>
						<tr class="active">
							<td>class</td>
							<td><code>active</code></td>
							<td>to</td>
							<td>color</td>
							<td>row</td>
						</tr>
						<tr class="primary">
							<td>class</td>
							<td><code>primary</code></td>
							<td>to</td>
							<td>color</td>
							<td>row</td>
						</tr>
						<tr class="success">
							<td>class</td>
							<td><code>success</code></td>
							<td>to</td>
							<td>color</td>
							<td>row</td>
						</tr>
						<tr class="info">
							<td>class</td>
							<td><code>info</code></td>
							<td>to</td>
							<td>color</td>
							<td>row</td>
						</tr>
						<tr class="warning">
							<td>class</td>
							<td><code>warning</code></td>
							<td>to</td>
							<td>color</td>
							<td>row</td>
						</tr>
						<tr class="danger">
							<td>class</td>
							<td><code>danger</code></td>
							<td>to</td>
							<td>color</td>
							<td>row</td>
						</tr>
						<tr>
							<td class="active"><code>active</code> class to color cell</td>
							<td class="success"><code>success</code> class to color cell</td>
							<td class="info"><code>info</code> class to color cell</td>
							<td class="warning"><code>warning</code> class to color cell</td>
							<td class="danger"><code>danger</code> class to color cell</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	// Drag-n-Drop feature
	WinMove();
});
</script>
<script>
$(document).ready(function() {
	// Set Block Height
	SetMinBlockHeight($('#calendar'));
	// Create Calendar
	DrawFullCalendar();
});
</script>