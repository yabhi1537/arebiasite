@extends('admin.layouts.app')

@section('content')


<div class="email-wrapper wrapper">
    <div class="row align-items-stretch">
        <div class="mail-sidebar d-none d-lg-block col-md-2 pt-3 bg-white">
            <div class="menu-bar">
                <ul class="menu-items">
                    <li class="nav-item compose mb-3">
                        <button href="" class="btn btn-primary btn-block" id="info-tab" data-toggle="modal" href="#info"
                            role="tab" data-target="#exampleModal" aria-controls="info"
                            aria-expanded="true">Compose</button>
                    </li>

                </ul>
                <div class="wrapper">
                    <!-- <div class="online-status d-flex justify-content-between align-items-center">
                    <p class="chat">Chats</p> <span class="status offline online"></span></div> -->
                </div>
                <!-- <ul class="profile-list">
                    <li class="profile-list-item"> <a href="#"> <span class="pro-pic"><img src="https://placehold.it/100x100" alt=""></span><div class="user"><p class="u-name">David</p><p class="u-designation">Python Developer</p></div> </a></li>
                    <li class="profile-list-item"> <a href="#"> <span class="pro-pic"><img src="https://placehold.it/100x100" alt=""></span><div class="user"><p class="u-name">Stella Johnson</p><p class="u-designation">SEO Expert</p></div> </a></li>
                    <li class="profile-list-item"> <a href="#"> <span class="pro-pic"><img src="https://placehold.it/100x100" alt=""></span><div class="user"><p class="u-name">Catherine</p><p class="u-designation">IOS Developer</p></div> </a></li>
                    <li class="profile-list-item"> <a href="#"> <span class="pro-pic"><img src="https://placehold.it/100x100" alt=""></span><div class="user"><p class="u-name">John Doe</p><p class="u-designation">Business Analyst</p></div> </a></li>
                    <li class="profile-list-item"> <a href="#"> <span class="pro-pic"><img src="https://placehold.it/100x100" alt=""></span><div class="user"><p class="u-name">Daniel Russell</p><p class="u-designation">Tester</p></div> </a></li>
                    <li class="profile-list-item"> <a href="#"> <span class="pro-pic"><img src="https://placehold.it/100x100" alt=""></span><div class="user"><p class="u-name">Sarah Graves</p><p class="u-designation">Admin</p></div> </a></li>
                    <li class="profile-list-item"> <a href="#"> <span class="pro-pic"><img src="https://placehold.it/100x100" alt=""></span><div class="user"><p class="u-name">Sophia Lara</p><p class="u-designation">UI/UX</p></div> </a></li>
                    <li class="profile-list-item"> <a href="#"> <span class="pro-pic"><img src="https://placehold.it/100x100" alt=""></span><div class="user"><p class="u-name">Catherine Myers</p><p class="u-designation">Business Analyst</p></div> </a></li>
                    <li class="profile-list-item"> <a href="#"> <span class="pro-pic"><img src="https://placehold.it/100x100" alt=""></span><div class="user"><p class="u-name">Tim</p><p class="u-designation">PHP Developer</p></div> </a></li>
                  </ul> -->
            </div>
        </div>
        <div class="mail-list-container col-md-3 pt-4 pb-4 border-right bg-white">
            <div class="border-bottom pb-4 mb-3 px-3">
                <div class="form-group">
                    <input class="form-control w-100" type="search" placeholder="Search mail" id="Mail-rearch">
                </div>
            </div>
            @if(!$emaildata->isEmpty())
            @foreach($emaildata as $email)
            <div class="mail-list">
                <div class="form-check"> <label class="form-check-label"> <input type="checkbox"
                            class="form-check-input"> </label></div>
                <div class="content">
                    <option class="sender-name" id="mailmessage" data-name="{{$email->id}}" onclick="addRow(this)">
                        {{$email->name}} </option>
                    <p class="message_text">{{$email->description}}</p>
                </div>
                <div class="details">
                    <i class="mdi mdi-star favorite"></i>
                </div>
            </div>
            @endforeach
            @endif
        </div>
        <div class="mail-view d-none d-md-block col-md-9 col-lg-7 bg-white">
            <div class="row">
                <div class="col-md-12 mb-4 mt-4">
                </div>
            </div>

            <div class="message-body">
                <div class="sender-details">
                    <img class="img-sm rounded-circle mr-3" src="https://placehold.it/100x100" alt="">
                    <div class="details">
                        @if(!$emaildata->isEmpty())
                        <p class="msg-subject">
                            Weekly Update - Week {{$emaildata[0]->created_at}}
                        </p>
                        @endif
                        <p class="sender-email">
                            Sarah Graves
                            <a href="#">itsmesarah268@gmail.com</a>
                            &nbsp;<i class="mdi mdi-account-multiple-plus"></i>
                        </p>
                    </div>
                </div>
                <h4><strong> Email</strong></h4>
                <div class="message-content">
                    <h5> <strong> Name :- </strong></h5>
                    <p id="namemess"> </p>
                    <h6> <strong>Subject :-</strong></h6>
                    <p id="subjecmessage"> </p>
                    <h6><strong> Message :-</strong></h6>
                    <p id="listmessage"> </p>

                    <p> <strong><br><br>DateTime,<br></strong><span id="dateshow"></span></p>
                </div>
                <div class="attachments-sections">
                    <ul>
                        <!-- <li>
                            <div class="thumb"><i class="mdi mdi-file-pdf"></i></div>
                            <div class="details">
                                <p class="file-name" id="attachments">Seminar Reports.pdf</p>
                                <div class="buttons">
                                    <p class="file-size">678Kb</p>
                                    <a href="#" class="view">View</a>
                                    <a href="#" class="download">Download</a>
                                </div>
                            </div>
                        </li> -->
                        <li>
                            <div class="thumb"><i class="mdi mdi-file-pdf"></i></div>
                            <div class="details">
                                <p class="file-name" id="attachments"></p>
                                <div class="buttons">
                                    <p class="file-size"></p>
                                    <a href="#" class="view">View</a>
                                    <a href="#" class="download">Download</a>
                                </div>
                            </div>
                        </li>
                        <!-- <li>
                            <div class="thumb"><i class="mdi mdi-file-image"></i></div>
                            <div class="details">
                                <p class="file-name">Product Design.jpg</p>
                                <div class="buttons">
                                    <p class="file-size">1.96Mb</p>
                                    <a href="#" class="view">View</a>
                                    <a href="#" class="download">Download</a>
                                </div>
                            </div>
                        </li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:../../partials/_footer.html -->
    <footer class="footer">
        <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018 <a
                    href="http://www.urbanui.com/" target="_blank">urbanui</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i
                    class="mdi mdi-heart text-danger"></i></span>
        </div>
    </footer>
</div>
<!-- modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="baseForm" name="" class="forms-sample" method="POST" action="{{ route('sendmail') }}"
            enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Send Email</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="title">Name</label>
                            <input type="text" class="form-control" required id="nameval" placeholder="Name"
                                name="name">

                            @error('name')
                            <label id="title-error" class="text-danger mt-2" for="title">
                                {{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="title">Email</label>
                            <input type="text" class="form-control" required id="emaivall" placeholder="email"
                                name="email">

                            @error('email')
                            <label id="title-error" class="text-danger mt-2" for="title">
                                {{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="title">Subject</label>
                            <input type="text" class="form-control" required id="subject" placeholder="subject"
                                name="subject">

                            @error('subject')
                            <label id="title-error" class="text-danger mt-2" for="title">
                                {{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="title">Description</label>
                            <textarea class="form-control required" rows="8" id="description" placeholder="description"
                                required name="description"></textarea>

                            @error('description')
                            <label id="title-error" class="text-danger mt-2" for="title">
                                {{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Attachment</label>
                            <input type="file" name="attachment[]" class="file-upload-default" multiple="multiple">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled=""
                                    placeholder="Upload Attachment">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-info" type="button">Upload</button>
                                </span>
                            </div>
                        </div>
                        @error('attachment')
                        <label id="title-error" class="alert alert-danger" for="alert alert-danger">
                            {{ $message }}</label>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success mr-2">Send</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
    function addRow(ele) {
        var emailId = $(ele).attr('data-name');
        $.ajax({
            url: "{{ route('emailmessage') }}",
            type: 'post',
            data: {
                'emailId': emailId,
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                // alert(data.b);
                //     console.log(data);$subjec
                $('#listmessage').html(data.descr);
                $('#subjecmessage').html(data.subjec);
                $('#namemess').html(data.name);
                $('#attachments').html(data.attachment);
                $('#dateshow').html(data.createdat);
            }
        });
        alert(data);
    }
    </script>

    @endsection