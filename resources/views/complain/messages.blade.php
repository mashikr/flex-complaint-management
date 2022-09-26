<div class="iq-card">
    <div class="iq-card-body" style="height: 68vh; overflow-y: scroll;" id="msg-body" data-offset-no="1">
        <div class="text-center d-none" id="spinner"><i class="fas fa-spinner fa-pulse"></i></div>
        <div id="new-msg-body"></div>
        {{-- <div class="d-flex justify-content-start"><span class="py-1 px-3 rounded bg-light">Hello Sir</span></div>
        <div class="d-flex justify-content-end"><span class="py-1 px-3 rounded bg-danger text-white">How are you?</span></div>
        
        <div class="d-flex my-2 justify-content-start">
            <span style="max-width: 75%" class="py-3 px-3 rounded bg-light">
                <img class="img-fluid" style="min-height: 100px" src="{{ asset("assets/complain/images/test1.jpeg") }}" alt="">
            </span>
        </div>
        <div class="d-flex my-2 justify-content-end">
            <span style="max-width: 75%" class="py-3 px-3 rounded bg-danger text-white">
                <img class="img-fluid" style="min-height: 100px" src="{{ asset("assets/complain/images/test1.jpeg") }}" alt="">
            </span>
        </div>

        <div class="d-flex justify-content-start">
            <span style="max-width: 75%" class="py-1 px-3 rounded bg-light">
                <a href="{{ asset("assets/complain/files/Tayloy_Hi.pdf") }}" target="_blank">
                    <i class="far fa-file-pdf text-warning"></i> Tayloy_Hi.pdf
                </a>
            </span>
        </div>
        <div class="d-flex justify-content-end">
            <span style="max-width: 75%" class="py-1 px-3 rounded bg-danger">
                <a href="{{ asset("assets/complain/files/Tayloy_Hi.pdf") }}" target="_blank" class="text-white">
                    <i class="far fa-file-pdf text-warning"></i> Tayloy_Hi.pdf
                </a>
            </span>
        </div>

        <div class="d-flex justify-content-start">
            <span class="py-1 px-3 rounded bg-light">
                <a href="{{ asset("assets/complain/files/Tayloy_Hi.pdf") }}" target="_blank" rel="noopener noreferrer"><i class="far fa-file-word" style="color: blue"></i> Tayloy_Hi.doc
                </a>
            </span>
        </div>
        <div class="d-flex justify-content-end">
            <span class="py-1 px-3 rounded bg-danger">
                <a href="{{ asset("assets/complain/files/Tayloy_Hi.pdf") }}" target="_blank" rel="noopener noreferrer" class="text-white"><i class="far fa-file-word" style="color: blue"></i> Tayloy_Hi.doc
                </a>
            </span>
        </div> --}}

        @foreach ($messages as $message)
            {!! message_body_template($message) !!}
        @endforeach
    </div>

    <div class="iq-card-body border-top" style="">
        <div class="d-flex align-items-center">
            <div class="mr-3">
                <form enctype='multipart/form-data' id="file-form">
                    <label for="attached_file" style="font-size: 1.5rem" class="pt-2" data-toggle="tooltip" data-placement="top" title="Attached File"><i class="fas  fa-link"></i></label>
                    <input type="file" name="attached_file" id="attached_file" class="d-none">
                    <input type="hidden" id="receiver" name="receiver" value="{{ $user_id }}">
                    <input type="hidden" id="sender" name="sender" value="{{ $sender }}">
                </form>
            </div>
            <input type="text" style="height: 2.5rem" class="form-control mr-3" name="message" placeholder="Write Your Complain" id="text_msg_input">
            <button class="btn btn-primary d-flex justify-content-center align-items-center" style="height: 2.5rem" id="send_btn"><i class="fas fa-paper-plane mb-1"></i> Send</button>
        </div>
    </div>   
</div>

@push("message-scripts")
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    "X-CSRFToken": $('meta[name="csrf-token"]').attr('content')
                }
            });

            function msgAnimate() {
                $('#msg-body').animate({scrollTop: $('#msg-body')[0].scrollHeight}, 1000);
            }
            msgAnimate();

            function send_text_message() {
                var msg =  $("#text_msg_input").val();
                $("#text_msg_input").val("");
                if(msg = msg.trim()) {
                    $.post("{{ route('complain.text.store') }}",
                    { 
                        msg: msg, 
                        to: $("#receiver").val(),
                    },
                    function(data, status){
                        if(status=="success") {
                            //console.log(data);
                            $("#msg-body").append(data);
                            msgAnimate();
                        }
                    });
                }
            }

            $("#send_btn").click(function() {
                send_text_message();
            });

            $("#text_msg_input").keyup(function(e) {
                if (e.keyCode == 13) {
                    send_text_message();
                }
            });

            $("#attached_file").change(function() {
                    $.ajax({
                        url : '{{ route('complain.file.store') }}',
                        type : 'POST',
                        data : new FormData ($("#file-form")[0]),
                        processData: false,  // tell jQuery not to process the data
                        contentType: false,  // tell jQuery not to set contentType
                        success : function(data) {
                            if(data.status == "error") {
                                toastr.warning(data.errors.attached_file);
                            } else {
                                $("#msg-body").append(data);
                                msgAnimate();
                            }

                        }
                    });
            });

            $("#msg-body").on('scroll', function() {
                if($(this).scrollTop()==0) {
                    $("#spinner").removeClass("d-none").addClass("d-block");
                    var offset_no = parseInt($(this).attr("data-offset-no"));
                    $.post("{{ route('complain.get.prev-message') }}",
                    { 
                        sender: $("#sender").val(),
                        receiver: $("#receiver").val(),
                        offset_no: offset_no,
                    },
                    function(data, status){
                        if(status=="success") {
                            $("#spinner").removeClass("d-block").addClass("d-none");
                            $("#msg-body").attr("data-offset-no", offset_no+1);
                            //console.log(data);
                            $("#new-msg-body").prepend(data);
                            $('#msg-body').animate({scrollTop: 20}, 10);
                        }
                    });
                }
            })


            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = false;

            var pusher = new Pusher('c73cd1b9dfff3358f39d', {
                cluster: 'ap2'
            });

            var channel = pusher.subscribe('message-channel');
            channel.bind('message', function(data) {
                function get_message(msg_id) {
                    $.post("{{ route('complain.get.single-message') }}",
                    { msg_id: msg_id },
                    function(data, status){
                        if(status=="success") {
                            //console.log(data);
                            $("#msg-body").append(data);
                            msgAnimate();
                        }
                    });
                }
                var me = $("#sender").val();
                if(me == "admin" && data.message.to == "admin") {
                    get_message(data.message.id);
                } else if (data.message.to == "user" && me == data.message.user_id) {
                    get_message(data.message.id);
                }
            });
        })
    </script>
@endpush