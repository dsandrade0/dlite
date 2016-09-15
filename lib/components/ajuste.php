<?php
class :d:ajuste extends :x:element {

	public function render() {
		return
			<x:frag>
		<div class="row">
			<div class="col-md-7">
				<div class="panel panel-default demo-dashboard-graph" data-widget="">
					<div class="panel-heading">
						<div class="panel-ctrls button-icon-bg"
							data-actions-container="" 
							data-action-collapse="{'target': '.panel-body'}"
							data-action-expand=""
							data-action-colorpicker=""
							data-action-refresh="{'type': 'circular'}"
							data-action-close=""
						>
						</div>
							<ul class="nav nav-tabs" id="chartist-tab">
								<li><a href="#tab-visitor" data-toggle="tab"><i class="fa fa-user visible-xs"></i><span class="hidden-xs">Visitor Stats</span></a></li>
								<li class="active"><a href="#tab-revenues" data-toggle="tab"><i class="fa fa-bar-chart-o visible-xs"></i><span class="hidden-xs">Revenues</span></a></li>
							</ul>
					</div>
					<div class="panel-editbox" data-widget-controls=""></div>
					<div class="panel-body">
						<div class="tab-content">
							<div class="clearfix mb-md">
								<button class="btn btn-default pull-left" id="daterangepicker2">
									<i class="fa fa-calendar visible-xs"></i> 
										<span class="hidden-xs" style="text-transform: uppercase;"> - 
											<b class="caret"></b>
										</span>
								</button>

							    <div class="btn-toolbar pull-right">
							        <div class="btn-group">
												<a href="#" 
													class="btn btn-default dropdown-toggle" 
													data-toggle="dropdown">
														<i class="fa fa-cloud-download visible-xs"></i>
														<span class="hidden-xs">Export as </span> 
														<span class="caret"></span>
												</a>
												<ul class="dropdown-menu">
														<li><a href="#">Text File (*.txt)</a></li>
														<li><a href="#">Excel File (*.xlsx)</a></li>
														<li><a href="#">PDF File (*.pdf)</a></li>
												</ul>
							        </div>
							    </div>
							</div>
							<div id="tab-visitor" class="tab-pane">
								<div class="demo-chartist" id="chart1"></div>
							</div>
							<div id="tab-revenues" class="tab-pane active">
								<div class="demo-chartist-sales" id="chart2"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<div class="panel-group panel-default" id="accordionA">
					<div class="panel panel-default">
						<a data-toggle="collapse" data-parent="#accordionA" href="#collapseOne"><div class="panel-heading"><h2><img src="/htdocs/img/bancos/banese.jpg"/> BANESE </h2><h2 style="float:right">Saldo: R$ 75.000,00</h2></div></a>
						<div id="collapseOne" class="collapse">
							<div class="panel-body">
								<div class="col-md-6">
									<h5><i class="fa fa-info-circle" style="color:#03A9F4"></i> Informações</h5>
									Agência: 214<br />
									Conta: 03/101101-7<br />
									Venculada ao PROGRAMA MAIS ESCOLA
								</div>
								<div class="col-md-6">
									<h5>Últimas movimentações</h5><br/>
									<i class="fa fa-square" style="color:#689f38"></i> + 3.500,00 | Pró jovem<br/>
									<i class="fa fa-square" style="color:#e51c23"></i> + 1.000,00 | Agricultura familiar<br/>
									
								</div>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<a data-toggle="collapse" data-parent="#accordionA" href="#collapseTwo"><div class="panel-heading"><h2><img src="assets/img/bancos/bb.jpg"/> BANCO DO BRASIL </h2><h2 style="float:right">Saldo: R$ 75.000,00</h2></div></a>
						<div id="collapseTwo" class="collapse">
							<div class="panel-body">
								<div class="col-md-6">
									<h5><i class="fa fa-info-circle" style="color:#03A9F4"></i> Informações</h5>
									Agência: 214<br />
									Conta: 03/101101-7<br />
									Venculada ao PROGRAMA MAIS ESCOLA
								</div>
								<div class="col-md-6">
									<h5>Últimas movimentações</h5><br/>
									<i class="fa fa-square" style="color:#689f38"></i> + 3.500,00 | Pró jovem<br/>
									<i class="fa fa-square" style="color:#e51c23"></i> + 1.000,00 | Agricultura familiar<br/>
									
								</div>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<a data-toggle="collapse" data-parent="#accordionA" href="#collapseThree"><div class="panel-heading"><h2><img src="assets/img/bancos/caixa.jpg"/> CAIXA ECONÔMICA </h2><h2 style="float:right">Saldo: R$ 75.000,00</h2></div></a>
						<div id="collapseThree" class="collapse">
							<div class="panel-body">
								<div class="col-md-6">
									<h5><i class="fa fa-info-circle" style="color:#03A9F4"></i> Informações</h5>
									Agência: 214<br />
									Conta: 03/101101-7<br />
									Venculada ao PROGRAMA MAIS ESCOLA
								</div>
								<div class="col-md-6">
									<h5>Últimas movimentações</h5><br/>
									<i class="fa fa-square" style="color:#689f38"></i> + 3.500,00 | Pró jovem<br/>
									<i class="fa fa-square" style="color:#e51c23"></i> + 1.000,00 | Agricultura familiar<br/>
									
								</div>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<a data-toggle="collapse" data-parent="#accordionA" href="#collapseFour"><div class="panel-heading"><h2><img src="assets/img/bancos/caixa.jpg"/> CAIXA ECONÔMICA </h2><h2 style="float:right">Saldo: R$ 75.000,00</h2></div></a>
						<div id="collapseFour" class="collapse">
							<div class="panel-body">
								<div class="col-md-6">
									<h5><i class="fa fa-info-circle" style="color:#03A9F4"></i> Informações</h5>
									Agência: 214<br />
									Conta: 03/101101-7<br />
									Venculada ao PROGRAMA MAIS ESCOLA
								</div>
								<div class="col-md-6">
									<h5>Últimas movimentações</h5><br/>
									<i class="fa fa-square" style="color:#689f38"></i> + 3.500,00 | Pró jovem<br/>
									<i class="fa fa-square" style="color:#e51c23"></i> + 1.000,00 | Agricultura familiar<br/>
									
								</div>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<a data-toggle="collapse" data-parent="#accordionA" href="#collapseFive"><div class="panel-heading"><h2><img src="assets/img/bancos/caixa.jpg"/> CAIXA ECONÔMICA </h2><h2 style="float:right">Saldo: R$ 75.000,00</h2></div></a>
						<div id="collapseFive" class="collapse">
							<div class="panel-body">
								<div class="col-md-6">
									<h5><i class="fa fa-info-circle" style="color:#03A9F4"></i> Informações</h5>
									Agência: 214<br />
									Conta: 03/101101-7<br />
									Venculada ao PROGRAMA MAIS ESCOLA
								</div>
								<div class="col-md-6">
									<h5>Últimas movimentações</h5><br/>
									<i class="fa fa-square" style="color:#689f38"></i> + 3.500,00 | Pró jovem<br/>
									<i class="fa fa-square" style="color:#e51c23"></i> + 1.000,00 | Agricultura familiar<br/>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
			</x:frag>;
	}
}
