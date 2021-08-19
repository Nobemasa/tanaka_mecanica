<link rel="stylesheet" type="text/css" href="css/pdf_ordemservico.css"/>
<div class='container mt-3 mb-5'>

    <div id="impOsCss">
        <div id="impOsCss1"><img src="../public/img/LOGO.jpeg" /></div>
        <div id="impOsCss4">
            <div id="impOsCss2">ORDEM DE SERVIÇOS </div>
            <div id="impOsCss3">TANAKA AUTO MECÂNICA</div>
            </div>
        </div> 
        <div id="impOsCssEndereco">
            Rua Claudionor Francisco Dos Santos 30 Porto Ferreira/SP    Tel. 19 3589-1584
        </div> 
        <div id="impOsCssSite">
            www.tanakamecanica.com.br
        </div>

        {{-- NUMERO E DATA DA OS --}}
        <div id="impOsCss5">
            <div id="impOsCss11"><h3>Ordem de Serviço N. <span>{{ $ordemservico->id }}</span></h3></div>
            <div id="impOsCss10">Data do Serviço {{ date( 'd/m/Y' , strtotime($ordemservico->created_at)) }}.</div>
            
        </div>
        <div id="impOsCss12">
            {{-- DADOS DO CLIENTE --}}
            <fieldset id="impOsCss6">
                <legend><img src="img/icon/cliente.png">Dados Cadastrais</legend>
                
                <div id="impOsCss7">{{ $ordemservico->nome }}</div>
                <div id="impOsCss8">Contato(s): {{ $ordemservico->celular1 }}
                    {{ $ordemservico->cadCelular2 ? '/'.$ordemservico->cadCelular2 : '' }}</div>
                <div id="impOsCss9">Endereço: {{ $ordemservico->Endereço }}</div>
            </fieldset>
            {{-- DADOS DO VEICULO --}}
            <fieldset id="impOsCss6">
                <legend> <img src="img/carrinho.jpg"> Dados do Veículo</legend>
                
                <div id="impOsCss7">Placa: {{ $ordemservico->veiPlaca }}</div>
                <div id="impOsCss8">Modelo: {{ $ordemservico->veiModelo}}</div>
                <div id="impOsCss9">Marca: {{ $ordemservico->veiMarca}}</div>
                <div id="impOsCss9">KM: {{ $ordemservico->km ?? '' }}</div>
            </fieldset>
        </div>	

        {{-- LISTAGEM DE PEÇAS / SERVIÇOS --}}
        <fieldset id="impOsCss13">
            <legend> <img src="img/icon/dsc.png"> Lista de Pe&ccedil;as / Produtos</legend>
            <div id="impOsCss14Titulos">
                <div id="impOsCss15">Quantidade</div>
                <div id="impOsCss16">Descri&ccedil;&atilde;o</div>
                <div id="impOsCss17">Valor</div>
            </div>
            @if (isset($produto))
                @foreach ($produto as $key => $produtos )
                @csrf
                <div id="impOsCss14">
                    <div id="impOsCss18">{{ $produtos->quantidade }} </div>
                    <div id="impOsCss19">{{ $produtos->descricao }} </div>
                    <div id="impOsCss20">{{ $produtos->valor }} </div>
                </div>
                @endforeach
            @endif
        </fieldset>

        {{-- MÃO DE OBRA --}}
        <fieldset id="impOsCss13">
            <legend> <img src="img/icon/ferramentas.png"> Valor do Serviço Prestado</legend>
            <div id="impOsCss14Titulos">
                <div id="impOsCss14">
                    <div id="impOsCss15">Garantia de 3</div>
                    <div id="impOsCss16">meses na mão de obra</div>
                    <div id="impOsCss17">{{ 'R$ '.number_format($ordemservico->valor_mo, 2, ',', '.') }}</div>
                    </div>
            </div>
        </fieldset>

        {{-- TOTAL DA OS --}}          
        <fieldset id="impOsCss13">
            <div id="impOsCss14Titulos">
                <div id="impOsCss21">
                    <div id="impOsCss15"><label>TOTAL</label></div>
                    <div id="impOsCss16"></div>
                    <div id="impOsCss17"><label>{{ 'R$ '.number_format($ordemservico->total, 2, ',', '.') }}</label></div>
                    </div>
            </div>
        </fieldset>             
              
        {{-- OBSERVAÇÕES --}}  
        @if ($ordemservico->obs != '')
        <fieldset id="impOsCss13">
            <legend> <img src="img/icon/enc.png"> Observações</legend>
            <div id="impOsCss14T">
                {{ $ordemservico->obs }}
            </div>
        </fieldset>
        @endif

    </div>
