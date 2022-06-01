<div class="row">
    <div class="col-12">
        <div class="jumbotron">
            <div class="row">
                <div class="col-2" id="divInputPlaca"></div>
                <div class="col-3" id="divInputNome"></div>
                <div class="col-2" id="divDataOcorrenciaIni"></div>
                <div class="col-2" id="divDataOcorrenciaFim"></div>
                <div id="divBtnConsultar"></div>
            </div>
            
        </div>

        <div id="divCmpGridFuncionario"></div>
    </div>
</div>

<style type="text/css">
    .jumbotron {
        padding: 32px;
    }

    #divInputNome, #divBtnConsultar {
        display: inline-block;
        vertical-align: top;
    }

    #divBtnConsultar {
        margin-top: 31px;
        margin-left: 10px;
    }

    #divCmpGridFuncionario {
        display: inline-block;
        width: 100%;
        margin-bottom: 20px;
    }
</style>

<script type="text/javascript">
    Cmp.ready(function() {
        new Cmp.RelRastreamento().init();   
    });
    jQuery(function($){
        $("#dataOcorrenciaIni").mask("9999-99-99");
        $("#dataOcorrenciaFim").mask("9999-99-99");
    });

</script>