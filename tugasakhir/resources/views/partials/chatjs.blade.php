<script type="text/javascript">
    jQuery(document).ready(function ($) {
        loadChat();

        $('.live_chat').click(function() {
            $('#modal-live-chat').modal('toggle');
        });

        $('.text-chat').keypress(function (e) {
            var key = e.which;
            if(key == 13){
                var chatMessage = $('.text-chat').val();
                $.ajax({
                    url: "{{ route('home.send_chat') }}" ,
                    type: 'POST',
                    data: {
                        _token : '{{csrf_token()}}',
                        chat_message : chatMessage
                    },
                    success: function (response) {
                        if(response.status == 'success'){
                            var myReply = '';
                            $.each(response.message_list.reverse(),function(i,v){
                                myReply += '<li class="clearfix message-id-'+ v.id_chat +'">';
                                myReply += '<div class="message-data">'
                                myReply += '<span class="message-data-time">'+ moment(v.created_at).format('DD-MM-YYYY HH:mm:ss') +'</span>'
                                myReply += '</div>'
                                myReply += '<div class="message my-message float-left">'+ v.chat_message +'</div>'
                                myReply += '</li>';
                            })

                            $('.text-chat').val('');
                            $('[class*=message-id-]').fadeOut().hide();
                            $('.list-message').append(myReply).hide().fadeIn();
                        }else{
                            Swal.fire('Gagal !',response.message, response.status);
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
                url: "{{ route('home.load_chat') }}" ,
                type: 'GET',
                success: function (response) {
                    if(response.status == 'success'){
                        var myReply = '';
                        $.each(response.message_list.reverse(),function(i,v){
                            myReply += '<li class="clearfix message-id-'+ v.id_chat +'">';
                            myReply += '<div class="message-data">'
                            myReply += '<span class="message-data-time">'+ moment(v.created_at).format('DD-MM-YYYY HH:mm:ss') +'</span>'
                            myReply += '</div>'
                            myReply += '<div class="message my-message float-left">'+ v.chat_message +'</div>'
                            myReply += '</li>';
                        })

                        $('.text-chat').val('');
                        $('[class*=message-id-]').fadeOut().hide();
                        $('.list-message').append(myReply).hide().fadeIn();
                    }else{
                        Swal.fire('Gagal !',response.message, response.status);
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