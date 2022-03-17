Cmp.RelRastreamento = function() {
    
    var private = {

        render: function() {

            Cmp.createInput({
                id: 'inputPlaca',
                renderTo: '#divInputPlaca',
                label: 'Placa',
            });

            Cmp.createInput({
                id: 'inputNome',
                renderTo: '#divInputNome',
                label: 'Funcionário',
            });

            Cmp.createInput({
                id: 'dataOcorrenciaIni',
                renderTo: '#divDataOcorrenciaIni',
                label: 'Data inicio',
                class: 'teste'
            });

            Cmp.createInput({
                id: 'dataOcorrenciaFim',
                renderTo: '#divDataOcorrenciaFim',
                label: 'Data fim',
                name:'DtFim'
            });

            Cmp.createButton({
                id: 'btnBuscar',
                renderTo: '#divBtnConsultar',
                text: 'Buscar',
                handler: function() {
                    private.buscar();
                }
            });

            Cmp.createGrid({
                id: 'gridDadosFuncionario',
                renderTo: '#divCmpGridFuncionario',
                header: [
                    {
                        text: 'Placa',
                        field: 'placa'
                    }, {
                        text: 'Funcionário',
                        field: 'nome',
                        width: 200
                    }, {
                        text: 'Data',
                        field: 'data_registro',
                        width: 200
                    }, {
                        text: 'Vel. Max.',
                        field: 'vel_maxima',
                        width: 200,
                        align: 'center'
                    }, {
                        text: 'Vel. Reg.',
                        field: 'vel_registrada',
                        width: 200,
                        align: 'center'
                    }, {
                        text: 'Diff. Vel.',
                        field: 'diferenca',
                        width: 200,
                        align: 'center'
                    }, {
                        text: 'Latitude',
                        field: 'latitude',
                        width: 200,
                        align: 'center'
                    }, {
                        text: 'Longitude',
                        field: 'longitude',
                        width: 200,
                        align: 'center'
                    },{
                        text: 'Mapa',
                        field: 'link_map',
                        align: 'center'
                    }
                ]
            });
        },

        buscar: function() {
            Cmp.showLoading();

            Cmp.request({
                url: 'index.php?mdl=relRastreamento&file=ds_rastreamento.php',
                params: {
                    placa: Cmp.get('inputPlaca').getValue(),
                    nome: Cmp.get('inputNome').getValue(),
                    dataOcorrenciaIni:Cmp.get('dataOcorrenciaIni').getValue(),
                    dataOcorrenciaFim:Cmp.get('dataOcorrenciaFim').getValue()
                },
                success: function(res) {
                    Cmp.hideLoading();
                    if(res.status == 'success') {
                        Cmp.get('gridDadosFuncionario').loadData(res.data);
                    } else {
                        Cmp.showErrorMessage(res.message || 'Ocorreu um erro na requisição');
                    }
                }
            });
        }

    };

    this.init = function() {
        private.render();
    }

}