@extends('dashboard::layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{ route('app.import-user-wallet', ['token' => $token]) }}" method="post" class="card">
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">Informações da Carga</h3>
                        <div class="card-tools">
                          <span class="badge badge-dark">IMPORT</span>
                        </div>
                    </div>
                    
                    <div class="row justify-content-center px-4 py-3">
                        <div class="col-sm-6">
                            <div class="border-bottom border-success mb-2">
                                <h3>Carteira de Cliente</h3>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Inserir Arquivo <small>| xlsx</small></label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="file_user_wallet" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Selecione o Arquivo</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mb-4">
                        <button type="submit" class="btn btn-outline-primary">Enviar Arquivo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
