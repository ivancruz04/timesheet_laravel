@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Foro/Comentarios</h1>
@stop

@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="card card-primary direct-chat direct-chat-primary">
                <div class="card-header">
                    <h3 class="card-title">Comentarios de la actividad</h3>
                    <div class="card-tools">
                        <span title="New Messages" class="badge bg-danger">{{$num_com}}</span>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" fdprocessedid="rwu3cu">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle"
                            fdprocessedid="m4rxyt">
                            <i class="fas fa-comments"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" fdprocessedid="q2poqm">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="direct-chat-messages">
                        @foreach ($comentarios as $comentario)
                        @if ($comentario->id_usuario != $quien_sesion)
                        <div class="direct-chat-msg">
                            <div class="direct-chat-infos clearfix">
                                <span class="direct-chat-name float-left">{{$comentario->nombre_usuario}}</span>
                                <span class="direct-chat-timestamp float-right">{{$comentario->fecha}}
                                    {{$comentario->hora}}</span>
                            </div>
                            <img class="direct-chat-img" src="{{ asset("/img/usuario2.png")}}" alt="Message User Image">
                            <div class="direct-chat-text">
                                {{$comentario->descripcion_comentario}}
                            </div>
                        </div>

                        @else
                        <div class="direct-chat-msg right">
                            <div class="direct-chat-infos clearfix">
                                <span class="direct-chat-name float-right">{{$comentario->nombre_usuario}}</span>
                                <span class="direct-chat-timestamp float-left">{{$comentario->fecha}}
                                    {{$comentario->hora}}</span>
                            </div>
                            <img class="direct-chat-img" src="{{ asset("/img/usuario2.png")}}" alt="Message User Image">
                            <div class="direct-chat-text">
                                {{$comentario->descripcion_comentario}}
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>

                <div class="card-footer">
                    <form action="#" method="post">
                        <div class="input-group">
                            <input id="texto_comentario" type="text" name="message" placeholder="Escribe un comentario" class="form-control"
                                fdprocessedid="lf5ze">
                                <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">
                                

                            <span class="input-group-append">
                                <a onclick="guardarComentario({{$quien_sesion}}, {{$idAct}})" class="btn btn-warning" fdprocessedid="jzcwij">Enviar</a>
                            </span>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
<script src="/js/comentarios/comentarios.js"></script>
<script src="/js/alertas.js"></script>
@stop