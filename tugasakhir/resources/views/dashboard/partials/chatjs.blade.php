<script type="text/javascript">
    jQuery(document).ready(function ($) {

        $('#modal-live-chat').on('shown.bs.modal', function () {
            loadUser();
            loadChat();
        })

        $('.live_chat').click(function() {
            $('#modal-live-chat').modal('toggle');
        });

        $('.text-chat').keypress(function (e) {
            var key = e.which;
            if(key == 13){
                var chatMessage = $('.text-chat').val();
                $.ajax({
                    url: "{{ route('chat.send_chat') }}" ,
                    type: 'POST',
                    data: {
                        _token : '{{csrf_token()}}',
                        chat_message : chatMessage
                    },
                    success: function (response) {
                        if(response.status == 'success'){
                            var userReply = '';
                            $.each(response.message_list.reverse(),function(i,v){
                                if(v.role == 'admin'){
                                    userReply += '<li class="clearfix message-id-'+ v.id_chat +'">';
                                    userReply += '<div class="message-data text-right">'
                                    userReply += '<span class="message-data-time">'+ moment(v.created_at).format('DD-MM-YYYY HH:mm:ss') +'</span>'
                                    userReply += '</div>'
                                    userReply += '<div class="message other-message float-right">'+ v.chat_message +'</div>'
                                }else{
                                    userReply += '</li>';
                                    userReply += '<li class="clearfix message-id-'+ v.id_chat +'">';
                                    userReply += '<div class="message-data text-left">'
                                    userReply += '<span class="message-data-time">'+ moment(v.created_at).format('DD-MM-YYYY HH:mm:ss') +'</span>'
                                    userReply += '</div>'
                                    userReply += '<div class="message my-message float-left">'+ v.chat_message +'</div>'
                                    userReply += '</li>';
                                }
                            })

                            $('.text-chat').val('');
                            $('[class*=message-id-]').fadeOut().hide();
                            $('.list-message').append(userReply).hide().fadeIn();
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire('Gagal !', 'Terjadi Kesalahan', 'error');
                        console.log(xhr);
                        console.log(status);
                        console.log(error);
                    }
                });
            }
        }); 

        function loadChat(){
            $.ajax({
                url: "{{ route('chat.load_chat') }}" ,
                type: 'GET',
                success: function (response) {
                    if(response.status == 'success'){
                        var userReply = '';
                        $.each(response.message_list.reverse(),function(i,v){
                            if(v.role == 'admin'){
                                userReply += '<li class="clearfix message-id-'+ v.id_chat +'">';
                                userReply += '<div class="message-data text-right">'
                                userReply += '<span class="message-data-time">'+ moment(v.created_at).format('DD-MM-YYYY HH:mm:ss') +'</span>'
                                userReply += '</div>'
                                userReply += '<div class="message other-message float-right">'+ v.chat_message +'</div>'
                            }else{
                                userReply += '</li>';
                                userReply += '<li class="clearfix message-id-'+ v.id_chat +'">';
                                userReply += '<div class="message-data text-left">'
                                userReply += '<span class="message-data-time">'+ moment(v.created_at).format('DD-MM-YYYY HH:mm:ss') +'</span>'
                                userReply += '</div>'
                                userReply += '<div class="message my-message float-left">'+ v.chat_message +'</div>'
                                userReply += '</li>';
                            }
                        })

                        $('.text-chat').val('');
                        $('[class*=message-id-]').fadeOut().hide();
                        $('.list-message').append(userReply).hide().fadeIn();
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire('Gagal !', 'Terjadi Kesalahan', 'error');
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            });
        }

        function loadUser(){
            $.ajax({
                url: "{{ route('chat.list_user') }}" ,
                type: 'GET',
                success: function (response) {
                    if(response.status == 'success'){
                        var listUser = '';
                        $.each(response.list_user,function(i,v){
                            listUser += '<li class="clearfix active load-chat-'+ v.id_user +'" attr-id="'+ v.id_user +'">';
                            listUser += '<img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">';
                            listUser += '<div class="about">';
                            listUser += '<div class="name">'+ v.nama_pelanggan +'</div>';
                            listUser += '<div class="status"> <i class="fa fa-circle online"></i> online </div>';
                            listUser += '</div>';
                            listUser += '</li>';
                        })

                        $('.list-user').append(listUser).hide().fadeIn(100);
                        $('[class*=load-chat-]').on('click',function(){
                            var idUser = $(this).attr('attr-id');
                            loadChat(idUser);
                        })
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire('Gagal !', 'Terjadi Kesalahan', 'error');
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            });
        }
    });
</script>