<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="UTF-8" />
		<title>Bó Beber</title>
		<!-- BOOTSTRAP CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<!-- AWESOME -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<!-- CSS PERSONALIZADO -->
		<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" />
		<!-- JAVASCRIPT -->
		<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
		<!-- JS PERSONALIZADO -->
		<script src="<?php echo base_url(); ?>assets/js/script.js" type="text/javascript" ></script>
		<script data-ad-client="ca-pub-5599769195803461" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	</head>
	<body>
		<div id="cabecalho" >
			<div class="container" >
				<div class="row" >
					<img src="<?php echo base_url(); ?>assets/images/LogoAprovadaFB.png" class="img-thumbnail float-start logoBb" alt="Bó Beber">
				</div>
			</div>
		</div>
		<div class="ms-auto" >
			<nav style="position: relative; margin-top: -30px;" class="navbar navbar-expand-lg navbar-dark bg-dark mb-5 " >
				<div class="container" >
					<div class="navbar-collapse" id="navPrincipal" >
						<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
							<li class="nav-item ms-auto">
								<a class="nav-link" aria-current="login" data-bs-toggle="modal" data-bs-target="#exampleModal" href="#" ><i class="fa fa-user-alt-slash" ></i> Login</a>
							</li>
							<li class="nav-item ms-auto">
								<a class="nav-link user-select-none" data-bs-toggle="offcanvas" data-bs-target="#ShoppingCart" aria-controls="ShoppingCart" href="#" ><i class="fa fa-shopping-cart" ></i> <span class="ms-1 badge border border-warning totProdCart" >0<span></a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</div>
		<div id="mainPage" class="shadow-sm container pb-2" >
			<div class="row" >	

				<div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="ShoppingCart" aria-labelledby="ShoppingCartLabel" >
					<div class="offcanvas-header" style="margin-bottom: -20px;" >
						<span style="font-weight: 600; font-size: 18px; color: #000; margin: 0 0 0 0; display: inline-block;"> Meus Produtos</span>
						<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
					</div>
					<div class="offcanvas-body">
						<div style="max-height: 300px; overflow-y: auto;" >
							<small>Selecione o produto para excluir</small>							
							<ul class="list-group mb-3" id="listaProdCards" >
								<?php $valFrete = 10; $totalProdutos = 0; $totalQtdProdutos = 0; foreach($Cart as $key => $item) { $totalProdutos += $item->valor; $totalQtdProdutos += $item->qtd; ?>
								<li class="list-group-item d-flex justify-content-between itemCart noselect" >
									<div class="invisible bgDelete" ></div>
									<div class="text-end invisible btnDeleteItem" >
										<button class="btn btn-sm btn-danger" onclick="DeletarProdutoCart(<?php echo $key; ?>)" ><i class="fa fa-trash" ></i></button>
									</div>

									<span><img src="<?php echo $item->foto; ?>" class="rounded float-left img-fluid" style="width: 30px;" /> <?php echo $item->qtd . " x " . $item->nome; ?></span>
									<span class="col-auto" >R$ <?php echo number_format($item->valor, 2, ',', '.'); ?></span>
								</li>
								<?php } if(count($Cart) == 0) { $valFrete = 0; ?>
								<li class="list-group-item d-flex justify-content-center">
									<span>Não há produto selecionado.</span>
								</li>
								<?php } ?>
							</ul>
						</div>
						<span style="font-size: 18px; margin-bottom: 10px; display: inline-block;" >Resumo da compra</span>
						<div class="d-flex justify-content-between">
							<p><i class="fa fa-archive text-muted" ></i> Produtos (<span class="totProdCart" ><?php echo $totalQtdProdutos; ?></span>)</p>
							<p class="fw-bold totalProdutos" >R$ <?php echo number_format($totalProdutos, 2, ',', '.'); ?></p>
						</div>
						<div class="d-flex justify-content-between">
							<p><i class="fa fa-truck text-muted" ></i> Entrega</p>
							<p class="fw-bold valFrete" >R$ <?php echo number_format($valFrete, 2, ',', '.'); ?></p>
						</div>
						<div class="d-flex justify-content-between">
							<p><i class="fa fa-tag text-muted" ></i> Desconto</p>
							<p class="fw-bold tatalDesconto" >- R$ 0,00 (0%)</p>
						</div>
						<hr />
						<div class="d-flex justify-content-between">
							<p class="fw-bold" >Total</p>
							<p class="fw-bold totalFinal" >R$ <?php echo number_format($totalProdutos + $valFrete, 2, ',', '.'); ?></p>
						</div>
						<button class="btn btn-success w-100" > Finalizar Compra</button>
					</div>
				</div>

				<div class="col-md-12" >
					
					<div class="row mb-3" >
						<div class="col-md-12" >
							<h3 class="pb-4 mb-4 fst-italic border-bottom">
								Delivery <small>Selecione um produto clicando no card</small>
							</h3>
						</div>

						<!--<div class="col-md-2" >
							<ul class="nav flex-column nav-pills" id="categorias" >	
							</ul>
						</div>-->
						<div class="col-md-12" id="categProd" >
							
							<!-- <ins class="adsbygoogle"
								style="display:block"
								data-ad-format="fluid"
								data-ad-layout-key="-fb+5w+4e-db+86"
								data-ad-client="ca-pub-5599769195803461"
								data-ad-slot="9996717166"></ins>
							<script>
								(adsbygoogle = window.adsbygoogle || []).push({});
							</script> -->
						</div>
					</div>
					
					<!-- <ins class="adsbygoogle"
						 style="display:block"
						 data-ad-format="fluid"
						 data-ad-layout-key="-fb+5w+4e-db+86"
						 data-ad-client="ca-pub-5599769195803461"
						 data-ad-slot="9996717166"></ins>
					<script>
						 (adsbygoogle = window.adsbygoogle || []).push({});
					</script> -->
					
					<div class="row mb-3" >
						<div class="col-md-12" >
							<h3 class="pb-4 mb-4 fst-italic border-bottom">
								Orçamentos para eventos
							</h3>
						</div>

						<div class="col-md-12" >
							<p class="text-muted fst-italic" >Aguarde! Opção em desenvolvimento.</p>
						</div>
					</div>

					<div class="row justify-content-around mb-3" >
						<div class="col-md-12" >
							<h3 class="pb-4 mb-4 fst-italic border-bottom">
								Parceiros <small>Clique nos cards para abrir os aplicativos</small>
							</h3>
						</div>
						<?php foreach($parceiros as $key => $parceiro) { ?>
						<div class="col-lg-5 col-md-10 col-sm-10" >
							<div class="card mb-3 clickCard noselect" style="max-width: 540px;" onclick="linkParceiro('<?php echo $parceiro->linkParceiro; ?>')" >
								<div class="row g-0">
									<div class="col-4">
										<img src="<?php echo base_url(); ?>uploads/parceiros/<?php echo $parceiro->fotoParceiro; ?>" class="img-fluid rounded-start" alt="<?php echo $parceiro->nomeParceiro; ?>" >
									</div>
									<div class="col-8">
										<div class="card-body">
											<h5 class="card-title"><?php echo $parceiro->nomeParceiro; ?></h5>
											<p class="card-text d-flex flex-column position-static"><?php echo $parceiro->descricaoParceiro; ?></p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
						
						<div class="col-8">
							<!-- deitadinho -->
							<!-- <ins class="adsbygoogle"
							style="display:block"
							data-ad-client="ca-pub-5599769195803461"
							data-ad-slot="9920695548"
							data-ad-format="auto"
							data-full-width-responsive="true"></ins>
							<script>
								(adsbygoogle = window.adsbygoogle || []).push({});
							</script> -->
						</div>
					</div>

					<!-- Modal -->
					<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header text-center border-0" >
									<h3 id="LoginCadastro" class="modal-title w-100" >Login</h3>
								</div>
								<div class="modal-body">
									<div class="row" >
										<!-- <div class="col-md-6 col-6 m-auto" style="border-right: solid 1px rgba(20, 20, 20, .2);" >
											<img src="<?php echo base_url(); ?>assets/images/LogoAprovadaFB.png" class="img-fluid" />
										</div> -->
										<div class="col-md-12 col-12" id="contentLogin" >
											<form class="form-signin" >					  
												<div class="input-group mb-3">
													<span class="input-group-text" id="basic-addon1">@</span>
													<input type="email" id="inputEmail" class="form-control" placeholder="E-mail" required="" autofocus="">
												</div>
										
												<div class="input-group mb-3">
													<span class="input-group-text" id="basic-addon2"><i class="fa fa-key" ></i></span>
													<input type="password" id="inputPassword" class="form-control" placeholder="Senha" required="">
												</div>

												<p class="text-justify" ><a href="" > Recuperar senha? </a></p>
											
												<div class="d-grid gap-2 d-md-flex " >
													<button type="button" class="btn btn-sm btn-warning">Entrar</button>
													<button id="CadastroSite" type="button" class="btn btn-sm btn-dark" >Cadastrar</button>
												</div>
											</form>
										</div>
										<div class="col-md-12 col-12 d-none" id="contentCadastro" >
											<form class="form-signin" >					  
												<div class="input-group mb-3">
													<span class="input-group-text" id="basic-addon1">@</span>
													<input type="email" id="email" class="form-control" placeholder="E-mail" required="true" autofocus="" >
												</div>
										
												<div class="input-group mb-3">
													<span class="input-group-text" id="basic-addon2"><i class="fa fa-key" ></i></span>
													<input type="password" id="psswd" class="form-control" placeholder="Senha" required="true" >
												</div>

												<div class="input-group mb-3">
													<span class="input-group-text" id="basic-addon3"><i class="fa fa-key" ></i></span>
													<input type="password" id="confirmPsswd" class="form-control" placeholder="Confirmar senha" required="true" >
												</div>

												<div class="input-group mb-3">
													<span class="input-group-text" id="basic-addon4"><i class="fa fa-map-marker-alt" ></i></span>
													<input type="text" id="cep" class="form-control" placeholder="CEP" required="true" autofocus="" >
												</div>

												<div class="mb-3 form-check">
													<input type="checkbox" class="form-check-input" id="exampleCheck1">
													<label class="form-check-label" for="exampleCheck1" >Aceito os <a target="_blank" href="<?php echo base_url(); ?>assets/Documents/termosDeUso.pdf" >Termos de uso & Privacidade.</a></label>
												</div>

												<div class="d-grid gap-2 d-md-flex " >
													<button type="button" class="btn btn-sm btn-warning">Cadastrar</button>
													<button id="LogaSite" type="button" class="btn btn-sm btn-dark" >Já tenho conta</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="modal fade" id="DetalhesProduto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog modal-lg modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id='modalNomeProduto' >Nome Produto</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<div class="ProdImg" >
										<img id='modalFotoProduto' src="" />
									</div>
									<div id="ProdDados" >
										<p>Não foi possível carregar o produto.</p>
									</div>
								</div>
								<div class="modal-footer d-flex justify-content-between" >
									<div class="border border-dark" style="border-radius: 5px;" >
										<button class="incrementInput btnMaxMin bg-dark text-white" data-sum='min' ><i class="fa fa-arrow-circle-left" ></i></button>
										<input id="modalQTD" class="text-center" style="border: none; min-width: 35px; width: 35px;" value="1" />
										<button class="decrementInput btnMaxMin bg-dark text-white" data-sum='max' ><i class="fa fa-arrow-circle-right" ></i></button>
									</div>
									<button data-produto='' class='btn sm btn-success' id="addProdutoCarrinho" onclick="AddProdCart()" ><i class="fa fa-plus-circle"></i> Adicionar ao carrinho (<span id="modalPrecoProduto"></span>)</button>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>

		<?php if(!isset($_COOKIE['acceptCookies'])) { ?>
		<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
			<div id="SobreCookies" class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
				<div class="toast-header">
					<i class="fa fa-cookie-bite" ></i>&nbsp;
					<strong class="me-auto">Sobre Cookies</strong>
					<button type="button" class="btn sm btn-success" data-bs-dismiss="toast" aria-label="Close" onclick="$('#SobreCookies').toast('hide'); createCookie('acceptCookies', true, 30);" >Ok</button>
				</div>
				<div class="toast-body">Usamos cookies para personalizar, coletar dados e melhorar sua experiência em nosso site. Ao continuar navegando, entendemos que você está ciente e concorda com nosso <a target="_blank" href="<?php echo base_url(); ?>assets/Documents/termosDeUso.pdf" >Termos de uso & Privacidade.</a></div>
			</div>
		</div>
		<?php } ?>
		
		<div class="toast-container position-fixed top-0 end-0 p-3" id="AlertaGeral" >
			
		</div>

		<footer class="bg-dark text-white" >
			<div class="container pt-3" >
				<div class="row">

					<div class="col-6 col-md text-justify">
                        <small class="d-block text-muted font-weight-light"><i class="fab fa-mandalorian float-start mt-1 me-1" style="font-size: 35px;"></i> Desenvolvedor: Robert Cassimiro</small>
                        <small class="d-block mb-3 text-muted">© 2021-2021</small>
                    </div>
					<div class="col-6 col-md">
						<small class="d-block text-muted font-weight-light float-end">Distribuidora de bebidas <b class="text-warning" >BÓ BEBER</b></small>
                    </div>
                </div>

			</div>
		</footer>
		
		<!-- BOOTSTRAP JS -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	
	</body>
</html> 