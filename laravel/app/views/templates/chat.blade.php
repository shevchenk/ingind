<div id='chat'>
    
    <a class="open-chat-button tooltips hidden" @click.prevent="live_chat=true" data-toggle="tooltip" data-placement="right" data-original-title="Info Chat"><i class="fa fa-wechat"></i>
    </a>
    <a class="open-chat-button-active tooltips" data-toggle="tooltip" data-placement="right" data-original-title="Info Chat"><i class="fa fa-wechat"></i>
    </a>

    <div class="live-chat" v-show="live_chat">
        <form action="#" id="form-chat" class="sky-form">
            <header>
                <span>Chat</span>
                <span type="button" class="nuevo-chat btn-sm"  @click.prevent="nuevoMensaje=true"><i class="glyphicon glyphicon-edit"></i></span>
                <span type="button" class="btn-sm" aria-hidden="true" @click.prevent="live_chat=false"><i class="fa fa-minus"></i></span>
            </header>
            <fieldset class="myscroll"> 
                <div id="conversationList">
                    @include('templates/conversations')
                </div>
            </fieldset>
        </form>
    </div>

    <div class="chatonline" v-show="current_conversation.name">
        <header>
            <span id="spanNombre">Chat</span>
            <span type="button" class="btn-sm" aria-hidden="true" @click.prevent="current_conversation=[]" style="float:right;"><i class="fa fa-minus"></i></span>
        </header>
        <fieldset>
            <div id="messageList" class="conversation myscroll">
                @include('templates/messages')
            </div>
            <footer>
                <div class="row bodyBottom">
                    <div class="contComments hacerComentario" style="margin-bottom: 5px"> 
                        <div class="replicate">
                            <img class="comentarioPropio" src="http://www.e-quipu.pe/static/img/btnEnviarcomentario.png" @click.prevent="sendMessage" :disabled="messageBox.trim()===''">
                            <textarea @keyup.prevent="handleKeypress" id="messageBox" v-model='messageBox' class="comentariohacer"></textarea>
                        </div>
                    </div>
                </div>
            </footer>
        </fieldset>
    </div>

    <div class="nuevomensaje" v-show="nuevoMensaje">
        <header>
            <span id="spanNombre">Nuevo Mensaje</span>
            <span type="button" class="btn-sm" aria-hidden="true" @click.prevent="nuevoMensaje=false" style="float:right;"><i class="fa fa-minus"></i></span>
        </header>
        <fieldset>
            <form v-on:submit.prevent='sendConversation'>
                <div class="row area">
                    <div class="col-md-12 col-sm-12 col-xs-12 left">
                        <span>Seleccione area:</span>
                        <select class="form-control" v-model="area_id" @change="changeArea">
                            <option selected>Debe escoger una area primero</option>
                            <option v-for="area in areas" v-bind:value="area.id">@{{ area.nombre }}</option>
                        </select>
                     </div>
                </div>
                <div class="row usuario">
                    <div class="col-md-12 col-sm-12 col-xs-12 left">
                    <span>Seleccione usuario:</span>
                        <select class="form-control" v-model="users_id" @change="changeUser">
                            <option selected>Seleccione usuario</option>
                            <option v-bind:class="{ option_sesion: consesion.indexOf(user.id)>=0 }" v-for="user in users" v-bind:value="user.id">@{{ user.nombre + " " + user.paterno }} </option>
                        </select>
                     </div>
                </div>
                <div class="row mensaje">
                    <div class="col-md-12 col-sm-12 col-xs-12 left">
                        <span>Mensaje:</span>
                        <textarea @keyup.prevent="handleKeypressModal" id='new_message' v-model="body" rows="5" class="form-control" style="border-radius: 5px !important"></textarea>
                    </div>
                </div>
                <div class="row enviar" style="margin-top:10px">
                    <div class="col-md-12 col-sm-12 col-xs-12 left">
                        <input class="btn btn-primary" type="submit" :disabled="body.trim()===''" value="Enviar">
                    </div>
                </div>
            </form>
        </fieldset> 
    </div>

</div>
{{ HTML::script('https://cdn.socket.io/socket.io-1.2.0.js') }}
{{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.24/vue.min.js') }}
{{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.7.2/vue-resource.min.js') }}
<script>
var user_id="{{ Auth::user()->id }}";
var socket = io('http://procesos.munindependencia.pe:3000');
</script>
{{ HTML::script('js/chat.js') }}