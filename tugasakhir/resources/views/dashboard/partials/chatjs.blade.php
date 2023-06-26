<script type="text/javascript">
    jQuery(document).ready(function ($) {

        $('#modal-live-chat').on('shown.bs.modal', function () {
            loadUser();
        })

        $('.live_chat').click(function() {
            $('#modal-live-chat').modal('toggle');
        });

        $('.search-user-chat').on('keyup',function(){
            var namaPelanggan = $(this).val();

            if(namaPelanggan.length != 0){
                $('li[attr-nama-pelanggan]').hide();
                $('li[attr-nama-pelanggan*="' + namaPelanggan + '"]').show(200);
            }else{
                $('li[attr-nama-pelanggan]').show();
            }
        })

        $('.text-chat').keypress(function (e) {
            var key = e.which;
            if(key == 13){
                var sesiChat = $('.sesi-chat').val();
                var chatMessage = $('.text-chat').val();
                $.ajax({
                    url: "{{ route('chat.send_chat_admin') }}" ,
                    type: 'POST',
                    data: {
                        _token : '{{csrf_token()}}',
                        sesi_chat : sesiChat,
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
                        console.log(xhr);
                        console.log(status);
                        console.log(error);
                    }
                });
            }
        }); 

        function loadChat(idUser){
            $.ajax({
                url: "{{ route('chat.load_chat_by_user') }}" ,
                type: 'POST',
                data: {
                    _token : '{{csrf_token()}}',
                    id_user : idUser
                },
                success: function (response) {
                    if(response.status == 'success'){
                        var userReply = ''; var headerChat = '';
                        $.each(response.message_list.reverse(),function(i,v){
                            $('.sesi-chat').val(v.sesi_chat); // Input Sesi Chat
                            
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

                        headerChat += '<img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">';
                        headerChat += '<div class="chat-about">';
                        headerChat += '<h6 class="m-b-0">'+ response.data_user.nama_pelanggan +' ( '+ response.data_user.username +' )</h6>';
                        headerChat += '<div class="status"> <i class="fa fa-circle online"></i> online </div>';
                        headerChat += '</div>';

                        $('.text-chat').val('');
                        $('[class*=message-id-]').hide();
                        $('.list-message').append(userReply);
                        $('.header-chat-user').empty().append(headerChat);
                    }
                },
                error: function(xhr, status, error) {
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
                            listUser += '<li class="clearfix load-chat-'+ v.id_user +'" attr-id-user="'+ v.id_user +'" attr-nama-pelanggan="'+ v.nama_pelanggan +'">';
                            listUser += '<img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">';
                            listUser += '<div class="about">';
                            listUser += '<div class="name">'+ v.nama_pelanggan +'</div>';
                            listUser += '<div class="status"> <i class="fa fa-circle online"></i> online </div>';
                            listUser += '</div>';
                            listUser += '</li>';
                        })

                        $('.list-user').empty();
                        $('.list-user').append(listUser);

                        $('[class*=load-chat-]').on('click',function(){
                            var idUser = $(this).attr('attr-id-user');
                            loadChat(idUser);
                            $(this).addClass('active').siblings().removeClass('active');
                        })
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            });
        }
    });
</script>